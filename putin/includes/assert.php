<?php
namespace Putin;

class TypeMismatchException extends \Exception {

}
  

class Assert {

    private static function equals($op1, $op2){
        $type1=gettype($op1);
        $type2=gettype($op2);
        
        if(strcmp($type1, $type2) == 0){
            if(strcmp($type1, "string")==0){
                return strcmp($op1, $op2) == 0;
            } else{
                return $result= $op1 == $op2;
            }
        }else{
            throw new TypeMismatchException();
        }
    }

    private static function caller(){
        $backfiles = debug_backtrace();
        return $backfiles[3]['function'];
    }

    static function assertTrue($val, $msg){
        $result= $val ? TestResult::SUCCESS : TestResult::FAILURE;
        $caller= Assert::caller();
        return new TestResult($result, $msg, $caller);
    }

    static function assertFalse($val, $msg){
        $result= $val ? TestResult::FAILURE : TestResult::SUCCESS;
        $caller= Assert::caller();
        return new TestResult($result, $msg, $caller);
        
    }

    static function assertNull($val, $msg){
        $result= $val == null ? TestResult::SUCCESS : TestResult::FAILURE;
        $caller= Assert::caller();
        return new TestResult($result, $msg, $caller);
    }

    static function assertNotNull($val, $msg){
        $result= $val != null ? TestResult::SUCCESS : TestResult::FAILURE;
        $caller= Assert::caller();
        return new TestResult($result, $msg, $caller);
    }

    static function assertEquals($op1, $op2, $msg){
        $result;
        try{
            $result = Assert::equals($op1, $op2) ? TestResult::SUCCESS : TestResult::FAILURE;
        } catch (TypeMismatchException $ex) {
            $result = TestResult::TYPE_MISMATCH;
        }

        $caller= Assert::caller();
        return new TestResult($result, $msg, $caller);
    }

    static function assertNotEquals($op1, $op2, $msg){
        $result;
        try{
            $result = !Assert::equals($op1, $op2) ? TestResult::SUCCESS : TestResult::FAILURE;
        } catch (TypeMismatchException $ex) {
            $result = TestResult::TYPE_MISMATCH;
        }
        
        $caller= Assert::caller();
        return new TestResult($result, $msg, $caller);
    }

}