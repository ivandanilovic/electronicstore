<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 11/27/2017
 * Time: 7:17 PM
 */
require_once("View.php");

abstract class controller
{
    protected $db;

    public function __construct()
    {
        $this->db = mysqli_connect("localhost", "root", "", "elektornikstore");
    }

    public abstract function load();

    public function __destruct()
    {
        mysqli_close($this->db);
    }
}