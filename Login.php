<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 1/30/2018
 * Time: 8:48 PM
 */
// Ovoj skripti pristupamo pomoću 2 request-a: POST i GET (login i prikaz stranice za login).

require_once("ControllerUser.php");

$k = new ControllerUser();


if(!empty($_POST)) // ako smo poslali parametre onda tereba obraditi login
{
    $k->validateLogin($_POST['username'], $_POST['password']);
}
else // ako nema parametara prikazi formu login
{
    $k->showLogin();
}