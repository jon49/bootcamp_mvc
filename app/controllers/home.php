<?php

// Controller
class Controller extends AppController {
	protected function init() {
		
		$this->view->primaryHeader->title = 'Little Shop of Horrors';

	}
}
$controller = new Controller();

// Extract Main Controller Vars
extract($controller->view->vars);

?>
