<?php

class CustomersTable {

    private static function form($title, $action, $id) {
        return <<<html
        <form action="/customer" method="POST">
            <input type="hidden" name="action" value="$action">
            <input type="hidden" name="customerID" value="$id">
            <input type="submit" value="$title">
        </form>
html;
    }

    public static function create($data) {

        $header = [
            ['title' => 'Name', 'key'   => 'customerName'],
            ['title' => '',     'key'   => 'newInvoice'],
            ['title' => '',     'key'   => 'edit'],
            ['title' => '',     'key'   => 'remove']
        ];

        $data_ = array_map( function ($record) {
            extract($record);
            return [
                'customerName' => $customerName,
                'newInvoice' =>
                  self::form('New Invoice', 'invoice', $customerID),
                'edit' => self::form('Edit', 'edit', $customerID),
                'remove' => self::form('Remove', 'delete', $customerID)
            ];
        }, $data);

        return ['headers' => $header, 'data' => $data_];

    }
}
