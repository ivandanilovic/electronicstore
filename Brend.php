<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 12/15/2017
 * Time: 7:39 PM
 */
require_once("ControllerProizvod.php");

if(empty($_GET))
{
    header("Location: Index.php");
}

$k = new controllerProizvod();
$k->loadBrend($_GET['id']);
