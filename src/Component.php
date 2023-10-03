<?php
namespace gentree;
class Component {
	public $itemname, $type, $parent;
	public $children = [];
	function __construct($row = array()) {
		$this->itemname = $row[0];
		$this->type = $row[1];
		$this->parent = $row[2];
	}
	public function add_child ($child, $rel = NULL) {
		if (!(in_array($child, $this->children))) {
			$this->children[$child] = $rel;
		}
	}
	protected function show_child($components, $elem, $rel, $recurs = TRUE, $gap = 1) {
		echo str_repeat("\t", $gap) . "- " . $elem . "\n";
		if (empty($rel)) {
			$rel = $elem;
		}
		if (($recurs) && ($components)) {
			foreach($components[$rel]->children as $child => $elem) {
				$this->show_child($components, $child, $elem, TRUE, ++$gap);
			}
		}
	}
	public function show_children ($components, $all = TRUE) {
		echo "Элементы компонента " . $this->itemname . ": \n";
		foreach($this->children as $child =>$rel) {
			$this->show_child($components, $child, $rel, $all);
		}
	}
}
?>