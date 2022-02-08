<?php
namespace Putin;

interface IRunInterface {
    function prepare();
    function finish();
    function caseInfo($case);
    function caseClosed($case, $results);
    function displayResults($results);
}
