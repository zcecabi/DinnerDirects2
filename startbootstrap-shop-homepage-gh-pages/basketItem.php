<?php
/**
 * Created by PhpStorm.
 * User: AZZA
 * Date: 2019-02-20
 * Time: 17:11
 */

class basketItem{
    private $connection;
    private table_name = "basketItem";

    public $id;
    public $menu_id;
    public $quantity;
    public $userid;

    public function _construct($db){
        $this ->connection=$db;
    }
}