<?php

// Customer
class Customer extends Model {

    public function __construct($id = '') {
        if ($id) parent::__construct($id);
    }

    public function __get($prop) {
        if ($prop == 'name') {
            return $this->first_name.' '.$this->last_name;
        }
        return parent::__get($prop);
    }

    protected function insert($input) {
        $requiredKeys = [
            'first_name', 'last_name', 'birth_date', 'gender'
        ];
        $sqlValues = Util::validate($requiredKeys, $input);
        $sqlValues = db::auto_quote($sqlValues);
        $results = db::insert('customer', $sqlValues);
        return $results->insert_id;
    }

    protected function update($input) {
        $requiredKeys = [
            'first_name', 'last_name', 'birth_date', 'gender'
        ];
        $sqlValues = Util::validate($requiredKeys, $input);
        $sqlValues = db::auto_quote($sqlValues);
        $results = db::update(
            'customer',
            $sqlValues,
            'WHERE customer_id = '.$input['customer_id']);
    }

    public function remove() {
        $removalOfCustomer =<<<sql
            DELETE
            FROM customer
            WHERE customer_id = {$this->customer_id};
sql;
        return db::execute($removalOfCustomer);
    }

    public function listAll() {

        $customerQuery =<<<sql
        SELECT
            customer_id,
            CONCAT(first_name, ' ', last_name) AS customer_name
        FROM customer;
sql;

        $customers = db::execute($customerQuery); 

        $assoc = [];

        while ($row = $customers->fetch_assoc()) {
            extract($row);
            $assoc[] = [
                'customer_id' => $customer_id,
                'customer_name' => $customer_name
            ];
        }

        return $assoc;

    }
}
