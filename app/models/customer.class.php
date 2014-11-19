<?php

// Customer
class Customer extends CustomModel {

    public $success = true;
    public $failure = [];

    public function __get($prop) {
        if ($prop == 'name') {
            return htmlentities($this->first_name.' '.$this->last_name);
        }
        return htmlentities(parent::__get($prop));
    }

    private function validDate($date = null) {
        $dateArr = explode('-', $date);
        $month = (int) $dateArr[1];
        $day = (int) $dateArr[2];
        $year = (int) $dateArr[0];
        return checkdate($month, $day, $year);
    }

    private function validInsert($arr) {
        extract($arr);
        return is_string($first_name) 
            && is_string($last_name) 
            && $this->validDate($birth_date) 
            && ($gender == 'M' || $gender == 'F');
    }

    protected function insert($input) {
        if (!$this->validInsert($input)) {
            $this->success = false;
            return null;
        }
        $requiredKeys = [
            'first_name', 'last_name', 'birth_date', 'gender'
        ];
        $sqlValues = Util::validate($requiredKeys, $input);
        $results = db::insert('customer', $sqlValues);
        return $results->insert_id;
    }

    protected function update($input) {
        $requiredKeys = [
            'first_name', 'last_name', 'birth_date', 'gender'
        ];
        $sqlValues = Util::validate($requiredKeys, $input);
        $results = db::update(
            'customer',
            $sqlValues,
            'WHERE customer_id = '.$input['customer_id']);
        return $results->customer_id;
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
                'customer_id' => htmlentities($customer_id),
                'customer_name' => htmlentities($customer_name)
            ];
        }

        return $assoc;

    }
}
