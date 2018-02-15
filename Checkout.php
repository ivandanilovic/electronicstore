<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 2/15/2018
 * Time: 9:44 AM
 */

require_once "ControllerUser.php";

if ($_SESSION['user_id']>0 && count($_SESSION['cart'])>0)
{
    $k = new ControllerUser();
    $k -> procesOrder($_SESSION['user_id'], $_SESSION['cart']);
}