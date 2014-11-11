<?php

// Customer
class Customer extends Model {

    public function __construct($id = '') {
        if ($id) parent::__construct($id);
    }

    public function _list() {

        $customerQuery =<<<sql
        SELECT
            customerID,
            CONCAT(firstName, ' ', lastName) AS customerName
        FROM customer;
sql;

        $customers = db::execute($customerQuery); 

        $assoc = [];

        while ($row = $customers->fetch_assoc()) {
            extract($row);
            $assoc[] = [
                'customerID' => $customerID,
                'customerName' => $customerName
            ];
        }

        return $assoc;

    }
}
