<?php
/**
 * Created by PhpStorm.
 * User: AZZA
 * Date: 2019-02-20
 * Time: 16:11
 */

include ('dbConnect.php');

include_once ('menu.php');
include_once ('menuimage.php');
include_once ('basketItem.php');


class menu{
   private $connection;
   private $table_name = "menu";

   public $id;
   public $name;
   public $price;

   public function _construct($db){
       $this ->connection = $db;
   }
}

$database = new Database();
$db = $database -> getConnection();

$menu = new menu($db);
$menuimage = new menuimage($db);
$basketItem = new basketItem($db);

// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

// for pagination purposes
$page = isset($_GET['page']) ? $_GET['page'] : 1; // page is the current page, if there's nothing set, default is page 1
$records_per_page = 9; // set records or rows of data per page
$from_record_num = ($records_per_page * $page) - $records_per_page; // calculate for the query LIMIT clause

// read all products in the database
$stmt=$product->read($from_record_num, $records_per_page);

// count number of retrieved products
$num = $stmt->rowCount();

// if products retrieved were more than zero
if($num>0){
    // needed for paging
    $page_url="menu.php?";
    $total_rows=$product->count();

    // show products
    include_once "read_products_template.php";
}

// tell the user if there's no products in the database
else{
    echo "<div class='col-md-12'>";
    echo "<div class='alert alert-danger'>No products found.</div>";
    echo "</div>";
}
// read all products
function read($from_record_num, $records_per_page){

    // select all products query
    $query = "SELECT
                id, name, description, price 
            FROM
                " . $this->table_name . "
            ORDER BY
                name DESC
            LIMIT
                ?, ?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind limit clause variables
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

    // execute query
    $stmt->execute();

    // return values
    return $stmt;
}

// used for paging products
public function count(){

    // query to count all product records
    $query = "SELECT count(*) FROM " . $this->table_name;

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // execute query
    $stmt->execute();

    // get row value
    $rows = $stmt->fetch(PDO::FETCH_NUM);

    // return count
    return $rows[0];
}
