<?php

/**
 * Default View
 */
class DefaultView extends View {
	public function __construct() {
		
		// Set Master Template for this View
		parent::__construct(ROOT . '/app/templates/master.php');
		
		// Make Sub Views
		$this->primaryHeader = new View(ROOT . '/app/templates/primary_header.php');
		
	}
}
