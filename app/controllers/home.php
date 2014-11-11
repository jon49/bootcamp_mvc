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

<ul>
    <li><a href="/customers">Customers</a></li>
    <li><a href="/items">Items</a></li>
    <li><a href="/invoices">Invoices</a></li>
</ul>
