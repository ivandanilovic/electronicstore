<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 12/4/2017
 * Time: 6:58 PM
 */

require_once("ControllerProizvod.php");

if(empty($_GET))
{
    header("Location: Index.php");
}

$k = new ControllerProizvod();
$k->load($_GET['id']);

