<?php

include_once 'crud.class.php';

try {
    $db = new Database();
    $db->connect();

    /*
     * Insert
     */
//    $data_array = array('name' => 'Ranglo');
//    $res = $db->insert('test', $data_array);  // Table name, column names and respective values
//    echo '<pre>';
//    print_r($db->getResult());

    /*
     * Update
     */
    $reg_data = array('name' => 'Nidhi');
    $id = 8;
    $db->update('test', $reg_data, 'id=' . $id); // Table name, column names and values, WHERE conditions
    echo '<pre>';
    print_r($db->getResult());

    /*
     * Delete
     */
//    $isDelete = 11;
//    $db->delete('test', 'id=' . $isDelete);  // Table name, WHERE conditions
//    echo '<pre>';
//    print_r($db->getResult());


    /*
     * Select *
     */
    $res = $db->select('test'); // Table name
    echo '<pre>';
    print_r($db->getResult());
    
} catch (PDOException $e) {
    echo "There is some problem in connection: " . $e->getMessage();
}