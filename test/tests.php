<?php

$test = @include_once(dirname(__FILE__) . '/simpletest/autorun.php');
if (!$test) {
    exit(1);
}

set_error_handler(function($errno, $errstr, $errfile, $errline) {
	die('asdf');
	throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});
error_reporting(E_ALL | E_STRICT);

$path = dirname(__FILE__) . '/../lib/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

spl_autoload_extensions('.php');
spl_autoload_register();

require_once("Elements.php");

include_once(dirname(__FILE__) . "/Elements/ElementsTest.php");
foreach (array_diff(glob(dirname(__FILE__) . "/Elements/*Test.php"), array(dirname(__FILE__) . "/Elements/ElementsTest.php")) as $file) {
    require_once($file);
}

