<?php
/*/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 12/23/2017
 * Time: 5:24 PM
 */
require_once ("Controller.php");
require_once ("NoviProizvod.php");

class ControllerNoviProizvod extends Controller
{
    public function load()
    {
        // TODO: Implement load() method.
        $upit = "SELECT * FROM proizvodi";
        $rezultat = mysqli_query($this->db, $upit); // Ovdje će biti upisan blok podataka koji nam vrati ovaj upit.
        $proizvod = array(); // Stvaramo novi niz.
        while ($red = mysqli_fetch_row($rezultat)) { // Dok nismo pročitali sve redove iz bloka 'rezultat'...
            array_push($proizvod, new Proizvod($red[0], $red[1], $red[2], $red[3], $red[4], $red[5]));
        }
        return $proizvod;
    }
}