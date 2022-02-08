<?php 
namespace Putin;

class CliInterface implements IRunInterface{
    const DEFAULT_INFO_FORMAT="@{class}";
    const DEFAULT_RESULT_FORMAT="[{method}] {message}: {result}";
    private $caseInfoFormat;
    private $resultFormat;

    function __construct($caseInfoFormat=CliInterface::DEFAULT_INFO_FORMAT, $resultFormat=CliInterface::DEFAULT_RESULT_FORMAT){
        $this->caseInfoFormat=$caseInfoFormat;
        $this->resultFormat=$resultFormat;
    }

    function prepare(){
        echo "Привет";
        echo PHP_EOL;
        echo PHP_EOL;
    }

    function finish(){
        echo "До свидания";
        echo PHP_EOL;
    }

    function caseInfo($case){
        echo str_replace("{class}",get_class($case),$this->caseInfoFormat);
        echo PHP_EOL;
    }

    function caseClosed($case, $results){
        //do nothing
    }

    function displayResults($results){
        foreach ($results as $result) {
            $search = ["{method}", "{message}", "{result}"];
            $replace = [$result->caller, $result->msg, $result->result];
            echo str_replace($search, $replace, $this->resultFormat);
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

}

