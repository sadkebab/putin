<?php 
namespace Putin; //Php Unit TestINg

interface IUnitTest {
    function run();
    function setRunInterface($runInterface);
}

abstract class TestCase implements IUnitTest{
    private $runInterface;
    var $testMethods = array();
    private $results;
    
    public function addTest(callable $function) {
        $this->testMethods[] = $function;
    }

    function run(){
        $this->results=array();
        $this->runInterface->caseInfo($this);
        foreach($this->testMethods as $function) {
            call_user_func($function);
        }
        $this->runInterface->displayResults($this->results);
        $this->runInterface->caseClosed($this, $this->results);
    }

    function setRunInterface($runInterface){
        $this->runInterface=$runInterface;
    }

    function assertTrue($val, $msg){
        $this->results[] = Assert::assertTrue($val, $msg);
    }
    
    function assertFalse($val, $msg){
        $this->results[] = Assert::assertFalse($val, $msg);
    }
    
    function assertNull($val, $msg){
        $this->results[] = Assert::assertNull($val, $msg);
    }
    
    function assertNotNull($val, $msg){
        $this->results[] = Assert::assertNotNull($val, $msg);
    }
    
    function assertEquals($op1, $op2, $msg){
        $this->results[] = Assert::assertEquals($op1, $op2, $msg);
    }

    function assertNotEquals($op1, $op2, $msg){
        $this->results[] = Assert::assertNotEquals($op1, $op2, $msg);
    }
}