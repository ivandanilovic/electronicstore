<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 11/27/2017
 * Time: 7:13 PM
 */

require_once("Controller.php");
require_once ("ModelKategorije.php");

class controllerKategorije extends controller
{
    public function load()
    {
        $upit = "SELECT * FROM kategorije";
        $rezultat = mysqli_query($this->db, $upit); // Ovdje će biti upisan blok podataka koji nam vrati ovaj upit.
        $kategorije = array(); // Stvaramo novi niz.
        while ($red = mysqli_fetch_row($rezultat)) { // Dok nismo pročitali sve redove iz bloka 'rezultat'...
            array_push($kategorije, new ModelKategorije($red[0], $red[1]));
        }
        return $kategorije;
    }
}