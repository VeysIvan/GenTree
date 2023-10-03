<?php
require 'src/gentree.php';

if (isset($argv[1]) && isset($argv[2])) {
	//By default, streams are input.csv and output.json
	$tree = new GenTree($argv[1], $argv[2]);
	$tree->save_json();
	//To show children of specific component. 
	//$tree->show_branch([$component], [FALSE|TRUE] for recursion);
}
else {
	echo "Необходим ввод входного и выходного файлов...";
}
?>