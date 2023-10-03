<?php
require 'Component.php';
use gentree\Component;
	
class GenTree {
	public $components = array();
	public $input_file, $output_file;
	public $headers = array("itemName", "parent", "children");
	function __construct($input_file = "input.csv", $output_file = "output3.json") {
		if(!file_exists($input_file)) {
			die("Файл не найден");
		} else {
			$this->input_file = $input_file;
			$this->output_file = $output_file;
			$file=fopen($input_file,"r");
			$header = fgetcsv($file);
			$this->components["items"] = new Component(array("items", null, null));
			while ($row = fgetcsv($file, separator : ";")) {
				$elem = $row[0];
				if (!(empty($row[3]))) {
					$elem = $row[3];
				}
				if (!(array_key_exists($elem, $this->components))) {
					$this->components[$elem] = new Component($row);
				}
				$rel = "items";
				if (!(empty($row[2]))) {
					$rel = $row[2];
				}
				$this->components[$rel]->add_child($row[0], $row[3]);
			}
			fclose($file);
		}
	}
	public function make_tree ($component = "items", $itemname = FALSE, $parent = null) {
		if (!($itemname)) {
			$itemname = $parent;
		}
		$tree = [];
		$el = $this->components[$component];
		foreach($el->children as $child => $rel) {
			if (empty($rel)) {
				$rel = $child;
			}
			$tree[] = $this->make_tree($rel, $child, $itemname);
		}
		$tree = array($itemname, $parent, $tree);
		return array_combine($this->headers, $tree);
	}
	public function save_json ($component = "items") {
		if (file_put_contents($this->output_file, json_encode($this->make_tree($component)["children"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT))) {
			echo "File created.";
		}
		else {
			echo "Problems while creating..";
		}
	}
	public function show_branch ($component = "items", $all = TRUE) {
		if (isset($this->components[$component])) {
			$this->components[$component]->show_children($this->components, $all);
		}
	}
}

