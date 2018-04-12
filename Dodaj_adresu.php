<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 4/12/2018
 * Time: 7:24 PM
 */

require_once "ControllerUser.php";

if(!empty($_POST)) {

    if(!empty($_POST['newsletter'])) {

        $k = new ControllerUser();
        $k->dodajAdresu($_POST['newsletter']);

    }

}
header("Location: Index.php");
