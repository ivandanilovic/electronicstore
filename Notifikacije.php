<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 4/12/2018
 * Time: 7:49 PM
 */

require_once "ControllerUser.php";

$k = new ControllerUser();
$k->obavestiKorisnike();
// header("Location: Index.php");