<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 11/20/2017
 * Time: 8:18 PM
 */

require_once("ControllerProizvod.php");



if (isset($_GET))
{
    if (isset($_GET['action']))
    {
        if ($_GET['action']=='addtocart')
        {
            if (!isset($_SESSION['cart']))
            {
                $_SESSION['cart'] = array();
            }
            array_push($_SESSION['cart'], $_GET['id']);

        }
        if ($_GET['action']=='delete')
        {
            $k = new ControllerProizvod();
            $k->deleteProizvod($_GET['id']);
        }

    }

}

$k = new ControllerProizvod();
$k->load();