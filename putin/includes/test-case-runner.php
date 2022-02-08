<?php
namespace Putin;

class TestCaseRunner{
    private $testCases;
    private $runInterface;

    function __construct($testCases, $runInterface){
        if(is_array($testCases)){
            $valid=true;
            foreach ($testCases as $testCase) {
                $interfaces = class_implements(get_class($testCase));
                if (!isset($interfaces['Putin\IUnitTest'])) {
                    $valid=false;
                    break;
                }
            }

            if ($valid)
                $this->testCases=$testCases;
            else{
                echo "testCases must be of Putin\IUnitTest implementors";
            }
        }else{
            echo "testCases required in Putin\TestSuite::__construct()";
        }

        if(isset($runInterface)){
            $interfaces = class_implements(get_class($runInterface));
            if (isset($interfaces['Putin\IRunInterface'])) {
                $this->runInterface=$runInterface;
            }else{
                echo "runInterface must be a Putin\IRunInterface implementor";
            }
        }else{
            echo "runInterface required in Putin\TestSuite::__construct()";
        }
            
    }

    function start(){
        $this->runInterface->prepare();
        foreach($this->testCases as $testCase){
            $testCase->setRunInterface($this->runInterface);
            $testCase->run();
        }
        $this->runInterface->finish();
    }
    
}
