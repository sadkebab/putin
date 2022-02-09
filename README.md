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

