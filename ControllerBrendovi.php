<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 11/28/2017
 * Time: 7:55 PM
 */

require_once("Controller.php");
require_once ("ModelBrendovi.php");

class controllerBrendovi extends Controller
{
    public function load()
    {
        $upit = "SELECT * FROM brendovi";
        $rezultat = mysqli_query($this->db, $upit); // Ovdje će biti upisan blok podataka koji nam vrati ovaj upit.
        $brendovi = array(); // Stvaramo novi niz.
        while ($red = mysqli_fetch_row($rezultat)) { // Dok nismo pročitali sve redove iz bloka 'rezultat'...
            array_push($brendovi, new ModelBrendovi($red[0], $red[1]));
        }
        return $brendovi;
    }
}