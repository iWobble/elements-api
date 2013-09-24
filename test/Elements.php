<?php

$test = @include_once(dirname(__FILE__) . '/simpletest/autorun.php');
if (!$test) {
    exit(1);
}

function exception_error_handler($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}




set_error_handler('exception_error_handler');
error_reporting(E_ALL | E_STRICT);

require_once(dirname(__FILE__) . '/../lib/Elements.php');

include_once(dirname(__FILE__) . "/Elements/ElementsTest.php");

foreach (array_diff(glob(dirname(__FILE__) . "/Elements/*Test.php"), array(dirname(__FILE__) . "/Elements/ElementsTest.php")) as $file) {
    require_once($file);
}

