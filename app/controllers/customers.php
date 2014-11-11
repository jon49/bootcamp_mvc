<?php

// Controller
class Controller extends AppController {
	protected function init() {

        $this->view->primaryHeader->title = 'Customers';
        $customers = new Customer();
        $this->view->customerList = 
            json_encode(CustomersTable::create($customers->_list()));

	}
}
$controller = new Controller();

// Extract Main Controller Vars
extract($controller->view->vars);

?>

<script class="table-model" type="application/json">
<?= $customerList ?>
</script>
