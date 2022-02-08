<?php
namespace Putin;


class TestResult {
    const SUCCESS="Success";
    const FAILURE="Failure";
    const TYPE_MISMATCH="Type Mismatch";

    var $result;
    var $msg;
    var $caller;

    function __construct($result, $msg, $caller){
        $this->result=$result;
        $this->msg=$msg;
        $this->caller=$caller;
    }
}