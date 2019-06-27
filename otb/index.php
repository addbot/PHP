<?php
/***************************************************************************
 * Filename  : index.php
 * Purpose   : This file serves as the entry point.
 * it instantiates objects and should execute the command parameter in cli.
 * This code is part of the request from otb company. c/o Abi Hart
 * Author(s) : marvin
 * Date      : Date(June 27 2019)
 ****************************************************************************/

function autoLoadEmuPhp($class) {
	require $class . '.php';
}

$className = '';
$command = '';
$param = '';
// p($argv);
if (!empty($argv)) {
	$className = @$argv[1];
	if (isset($argv[2])) {
		$command = $argv[2];
	}
	if (isset($argv[3])) {
		$param = $argv[3];
	} else {
		$param = null;
	}
	spl_autoload_register(function ($className) {
		require $className . '.php';
	});
} else {
	displayUsage();
}

function p($var) {
	echo '<pre>',print_r($var),'</pre>';exit;
}

function s($var) {
	// echo '<pre>',print_r($var),'</pre>';
	echo $var;exit;
}

function v($var) {
	echo '<pre>',print_r(var_dump($var)),'</pre>';exit;
}


if (!empty($className) && class_exists($className)) {
	$classObj = new $className;
	if (!empty($command) && method_exists($classObj,$command)) {
		if (!empty($param)) {
			$classObj->$command($param);
		} else {
			$classObj->$command($param);			
		}		
	} else {
		displayUsage();
	}
} else {
	displayUsage();
}

function displayUsage() {

$usage ="\n\n##################################################
#
# Jobs Processing Usage
#
#
##################################################\n
Usage: php index.php otb <command>\n
Note:\n

Command Options:\n
getjobs - will return string or array if an empty parameter was passed\n\n\n";

print $usage;
    
}

?>