<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 3/27/2018
 * Time: 10:22 PM
 */
require_once("ControllerUser.php");

if($_SESSION["user_id"]>0)
{
    session_unset();
}
header("Location: Index.php");