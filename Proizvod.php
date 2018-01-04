<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 12/14/2017
 * Time: 7:18 PM
 */
require_once("ControllerProizvod.php");

if(empty($_GET))
{
    header("Location: Index.php");
}

$k = new controllerProizvod();
$k->loadProizvod($_GET['id']);
