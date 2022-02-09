# Putin
Putin is a compact and customizable Unit Test framework for PHP.

## Usage
In order to use Putin for unit testing after you include it<sup>[1](#n1)</sup> in your project you need to implement one or many classes that extend the abstract class **Putin\TestCase** and specify which methods are unit test entry points with the **addTest** function in their constructor.

```php
class PutinTestExample extends Putin\TestCase {

    function __construct(){
        $this->addTest(array($this, 'testIsTrue'));
        $this->addTest(array($this, 'testIsFalse'));
        $this->addTest(array($this, 'testIsNull'));
        $this->addTest(array($this, 'testIsNotNull'));
        $this->addTest(array($this, 'testIsEquals'));
        $this->addTest(array($this, 'testIsNotEquals'));
    }
    
    function testIsTrue(){
        $op = (2 + 2) == 4;
        $this->assertTrue($op, "2 + 2 is truly 4");
    }

    function testIsFalse(){
        $op = (2 + 2) == 5;
        $this->assertFalse($op, "2 + 2 is falsely 5");
    }

    function testIsNull(){
        $op = null;
        $this->assertNull($op, "null is null");
    }

    function testIsNotNull(){
        $op = [1, 2, 3];
        $this->assertNotNull($op, "[1, 2, 3] is not null");
    }

    function testIsEquals(){
        $op1="yeah";
        $op2="yeah";
        $this->assertEquals($op1, $op2, "yeah is equal to yeah");
    }
    function testIsNotEquals(){
        $op1="yeah";
        $op2="nyeah";
        $this->assertNotEquals($op1, $op2, "yeah is not equal to nyeah");
    }
}
```

When the test cases are defined, in order to run the tests you have to instantiate your test cases and push them into an array that will be passed to the **Putin\Putin::run(...)** method.

```php
$testCases = array();
$testCases[] = new PutinTestExample();
Putin\Putin::run($testCases);
```

## Customization
The **Putin\Putin::run(...)** method accepts up to 3 arguments.
* __testCases__: an array of Putin\TestCase concrete implementations.
* __target__: a string used to choose the interface where the test results will be displayed, by default is set to the constant ExecutionTarget::AUTO. It can also be ExecutionTarget::WEB, ExecutionTarget::CLI or ExecutionTarget::CUSTOM. With AUTO Putin will chose the interface by itself and will display a web page if the .php file is requested from a Browser, otherwise it will echo results following a logging pattern if the same file is executed on a terminal. You can force it to use only one or the other if needed.
* __interface__: a IRunInterface implementation that Putin will choose by itself unless you specify the target argument as ExecutionTarget::CUSTOM, in that case you need to pass a valid  IRunInterface implementation as this argument.


```php
//Force to use CLI interface
Putin\Putin::run($testCases, ExecutionTarget::CLI);
```
You can customize the **CliInterface** implementation of IRunInterface by specifying the string format patters in his constructor.
It requires a format patter for the name of the TestCase class as the first argument and a format pattern for the test results for each test method.

```php
class CliInterface implements IRunInterface{
    const DEFAULT_INFO_FORMAT="@{class}";
    const DEFAULT_RESULT_FORMAT="[{method}] {message}: {result}";
    private $caseInfoFormat;
    private $resultFormat;

    function __construct($caseInfoFormat=CliInterface::DEFAULT_INFO_FORMAT, $resultFormat=CliInterface::DEFAULT_RESULT_FORMAT){
        $this->caseInfoFormat=$caseInfoFormat;
        $this->resultFormat=$resultFormat;
    }
    ...
}
```

```php
//Use the CLI interface with custom patterns
$customCli = new CliInterface("Executing {class}", "The method {method} resulted in a {result}. Method info: {message}");
Putin\Putin::run($testCases, ExecutionTarget::CUSTOM, $customCli);
```

Feel free to implement your own custom Putin\IRunInterface if you want to display the results of your unit tests in a different, perhaps better, way.
```php
interface IRunInterface {
    function prepare();
    function finish();
    function caseInfo($case);
    function caseClosed($case, $results);
    function displayResults($results);
}
```

```php
//Example with no practical use that sends the results of the unit tests via mail as a csv file
class CsvInterface implements Putin\IRunInterface {

    const HEADER = "case,method,result,message\n";
    const FILE_NAME = "results.csv";

    private $outputFile;

    function __construct(){
    }

    function prepare(){
        echo "Starting Unit tests.\n";
        $this->outputFile=fopen(CsvInterface::FILE_NAME, "w");
        echo "results.csv created\n";
        fwrite($this->outputFile, CsvInterface::HEADER);
    }

    function finish(){
        fclose($this->outputFile);
        send_email();
        cleanup();
    }

    function caseInfo($case){
        //do nothing
    }

    function caseClosed($case, $results){
        $caseName = get_class($case);
        foreach ($results as $result) {
            $find = explode(",",CsvInterface::HEADER);
            $replace = [$caseName, $result->caller, $result->result, $result->msg];
            $row=str_replace($find, $replace, CsvInterface::HEADER);
            fwrite($this->outputFile, $row);
        }
    }

    function displayResults($results){
        //do nothing
    }

    function cleanup(){
        unlink($this->outputFile);
    }

    function send_email(){
        $mailto = 'devops@company.com';
        $subject = 'Unit test results';
        $message = '';
    
        $content = file_get_contents($this->outputFile);
        $content = chunk_split(base64_encode($content));
    
        // a random hash will be necessary to send mixed content
        $separator = md5(time());
    
        // carriage return type (RFC)
        $eol = "\r\n";
    
        // main header (multipart mandatory)
        $headers = "From: CI System <ci@company.com>" . $eol;
        $headers .= "MIME-Version: 1.0" . $eol;
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
        $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
        $headers .= "This is a MIME encoded message." . $eol;
    
        // message
        $body = "--" . $separator . $eol;
        $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
        $body .= "Content-Transfer-Encoding: 8bit" . $eol;
        $body .= $message . $eol;
    
        // attachment
        $body .= "--" . $separator . $eol;
        $body .= "Content-Type: application/octet-stream; name=\"" . CsvInterface::FILE_NAME . "\"" . $eol;
        $body .= "Content-Transfer-Encoding: base64" . $eol;
        $body .= "Content-Disposition: attachment" . $eol;
        $body .= $content . $eol;
        $body .= "--" . $separator . "--";
    
        //SEND Mail
        if (mail($mailto, $subject, $body, $headers)) {
            echo "Email sent\n"; // or use booleans here
        } else {
            echo "Can't send the email\n";
            print_r( error_get_last() );
        }
    }
}


Putin\Putin::run($testCases, ExecutionTarget::CUSTOM, new CsvInterface());
```


## Screenshots
### Default CLI implementation
![](/screenshots/putin-cli.JPG)
### Default Web implementation
![](/screenshots/putin-web.JPG)

## TODO
* Add the project to packagist

## Notes
<a name="n1"></a>
<sup>[1]</sup> Putin is not available on any package/dependency manager yet.

