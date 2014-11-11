<?php

// Init
include($_SERVER['DOCUMENT_ROOT'] . '/app/core/initialize.php');

// Main Sections
Router::add('/', '/app/controllers/home.php');
// Customer list page
Router::add('/customers', '/app/controllers/customers.php');
// Item for sales page
Router::add('/items', '/app/controllers/items.php');
// List of customer invoices
Router::add('/invoices', '/app/controllers/invoices.php');

// Issue Route
Router::route();
