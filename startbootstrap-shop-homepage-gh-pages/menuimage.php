<?php
/**
 * Created by PhpStorm.
 * User: AZZA
 * Date: 2019-02-20
 * Time: 17:03
 */

class menuimage{

    private $connection;
    private $table_name = "menuimage";

    public $id;
    public $menu_id;
    public $name;

    public function  _construct($db){
        $this ->connection =$db;
    }

}

// read the first product image related to a product
function readFirst(){

    // select query
    $query = "SELECT id, menu_id, name
            FROM " . $this->table_name . "
            WHERE menu_id = ?
            ORDER BY name DESC
            LIMIT 0, 1";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));

    // bind prodcut id variable
    $stmt->bindParam(1, $this->menu_id);

    // execute query
    $stmt->execute();

    // return values
    return $stmt;
}

// check if a cart item exists
public function exists(){

    // query to count existing cart item
    $query = "SELECT count(*) FROM " . $this->table_name . " WHERE menu_id=:menu_id AND userid=:userid";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // sanitize
    $this->menu_id=htmlspecialchars(strip_tags($this->menu_id));
    $this->userid=htmlspecialchars(strip_tags($this->userid));

    // bind category id variable
    $stmt->bindParam(":menu_id", $this->menu_id);
    $stmt->bindParam(":userid", $this->userid);

    // execute query
    $stmt->execute();

    // get row value
    $rows = $stmt->fetch(PDO::FETCH_NUM);

    // return
    if($rows[0]>0){
        return true;
    }

    return false;
}
