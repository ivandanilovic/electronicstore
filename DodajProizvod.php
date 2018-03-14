<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 1/30/2018
 * Time: 8:48 PM
 */
// Ovoj skripti pristupamo pomoću 2 request-a: POST i GET (login i prikaz stranice za login).

require_once "ControllerProizvod.php";

$k = new ControllerProizvod();


if(!empty($_POST)) // ako smo poslali parametre onda tereba obraditi login
{
    // provjera da li je polje prazno?
    $k->dodajProizvod($_POST['Naziv'], $_POST['Cena'], $_POST['AkcijskaCena'], $_POST['Kolicina'], $_POST['Kategorija'], $_POST['Brend']);
}
else // ako nema parametara prikazi formu login
{
    $k->prikaziDodavanjeProizvoda();
}