<?php 

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
        $this->assertEquals($op1, $op2, "yeah is equals to yeah");
    }
    function testIsNotEquals(){
        $op1="yeah";
        $op2="nyeah";
        $this->assertNotEquals($op1, $op2, "yeah is not equals to nyeah");
    }
}