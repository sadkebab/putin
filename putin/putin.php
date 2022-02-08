<?php 
namespace Putin;

include "includes/test-result.php";
include "includes/assert.php";
include "includes/test-case.php";
include "includes/run-interface.php";
include "includes/cli-interface.php";
include "includes/web-interface.php";
include "includes/test-case-runner.php";

class ExecutionTarget{
    const AUTO = "auto";
    const WEB = "web";
    const CLI = "cli"; 
    const CUSTOM = "custom";
}

class NoTargetException extends \Exception{

}

class Putin {

    public static function run($testCases, $executionTarget = ExecutionTarget::AUTO, $interface = null){
        if(strcmp($executionTarget, ExecutionTarget::CUSTOM) !== 0)
           $interface=Putin::getInterfaceFromTarget($executionTarget);

        if(!isset($interface)){
            throw new NoTargetException("Putin requires a valid IRunInterface");
        }

        $runner=new TestCaseRunner($testCases, $interface);
        $runner->start();
    }

    private static function getInterfaceFromTarget($target){
        switch ($target) {
            case ExecutionTarget::CLI:
                return new CliInterface();
            case ExecutionTarget::WEB:
                return new WebInterface();
            case ExecutionTarget::AUTO:
            default:
                return Putin::isCli() ? new CliInterface() : new WebInterface();
        }
    }

    private static function isCli(){
	    if( defined('STDIN') )  return true;
	    if( empty($_SERVER['REMOTE_ADDR']) and !isset($_SERVER['HTTP_USER_AGENT']) and count($_SERVER['argv']) > 0) return true;
	    return false;
    }

}