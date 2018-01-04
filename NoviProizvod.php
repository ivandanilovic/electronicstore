<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 12/23/2017
 * Time: 5:22 PM
 */
require_once("ControllerProizvod.php");

if(empty($_GET))
{
    header("Location: Index.php");
}

$k = new controllerProizvod();
$k->loadNoviProizvod($_GET['id']);
