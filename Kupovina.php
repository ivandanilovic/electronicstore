<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 1/12/2018
 * Time: 6:31 PM
 */
require_once("ControllerProizvod.php");

session_start();

$k=new ControllerProizvod();
$k->loadCart($_SESSION['cart']);
