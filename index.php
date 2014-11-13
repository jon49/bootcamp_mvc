<?php

// Init
include($_SERVER['DOCUMENT_ROOT'] . '/app/core/initialize.php');

// Main Sections
Router::add('/', '/app/controllers/home.php');

// -- Customer -- //
// Customer list page
Router::add('/customers', '/app/controllers/customer/list.php');
Router::add('/customer/edit', '/app/controllers/customer/form.php');
Router::add('/customer/process', '/app/controllers/customer/process_form.php');
Router::add('/customer/remove', '/app/controllers/customer/remove.php');

// -- Invoice -- //
Router::add('/invoice', '/app/controllers/invoice/form.php');
Router::add('/invoice/process',
    '/app/controllers/invoice/add_line_item.php');

// -- Item -- //
Router::add('items', '/app/controllers/item/list.php');
Router::add('/item/remove',
    '/app/controllers/invoice/remove_line_item.php');
Router::add('/item/add',
    '/app/controllers/invoice/add_line_item.php');



// Item for sales page
Router::add('/products', '/app/controllers/product/list.php');
// List of customer invoices
Router::add('/invoices', '/app/controllers/invoice/list.php');

// Issue Route
Router::route();
