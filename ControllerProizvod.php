<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 11/20/2017
 * Time: 8:19 PM
 */

require_once("Controller.php");
require_once("ModelProizvoda.php");
require_once ("ViewProizvodi.php");
require_once ("ViewPregledProizvoda.php");

class controllerProizvod extends controller
{

    public function load($id = 0) // Podrazumijevani parametar: ako ne navedemo ništa, pretpostaviće '0'.
    {
        $upit = "SELECT * FROM proizvodi".($id != 0 ? " WHERE kategorija = '".$id."'" : ""); // tj. "SELECT * FROM proizvodi WHERE kategorija = '1'", za $id == 1.
        $rezultat = mysqli_query($this->db, $upit); // Ovdje će biti upisan blok podataka koji nam vrati ovaj upit.
        $proizvodi = array(); // Stvaramo novi niz u koji ćemo dodavati proizvode.
        while($red = mysqli_fetch_row($rezultat)) { // Dok nismo pročitali sve redove iz bloka 'rezultat'...
            array_push($proizvodi, new Proizvod($red[0], $red[1], $red[2], $red[3], $red[4], $red[5]));
        }
        $view = new ViewProizvodi();
        $view->showPage($proizvodi);
    }

    public function loadProizvod($id) // Podrazumijevani parametar: ako ne navedemo ništa, pretpostaviće '0'.
    {
        $upit = "SELECT * FROM proizvodi WHERE id = '" . $id . "'";
        $rezultat = mysqli_query($this->db, $upit);
        $proizvodi = array();
        $red = mysqli_fetch_assoc($rezultat); // Red sa podacima 'glavnog' proizvoda (onog koji prikazujemo).
        $proizvod = new Proizvod($red['id'], $red['naziv'], $red['cena'], $red['akcijskacena'], $red['kolicina'], $red['kategorija']);
        array_push($proizvodi, $proizvod); // Dodali smo glavni proizvod.
        $slicni = $this->loadSlicniProizvodi($proizvod);
        foreach($slicni as $slican) array_push($proizvodi, $slican);
        // for ($i = 0; $i < sizeof($slicni); $i++) array_push($proizvodi, $slicni[$i]);  // alternativno^^^
        // $proizvodi = array_merge($proizvodi, $slicni); // alternativno ^^^
        $view = new ViewPregledProizvoda();
        $view->showPage($proizvodi);
    }

    public function loadBrend($id = 0) // Podrazumijevani parametar: ako ne navedemo ništa, pretpostaviće '0'.
    {
        $upit = "SELECT * FROM proizvodi".($id != 0 ? " WHERE brend = '".$id."'" : "");
        $rezultat = mysqli_query($this->db, $upit); // Ovdje će biti upisan blok podataka koji nam vrati ovaj upit.
        $proizvodi = array(); // Stvaramo novi niz u koji ćemo dodavati proizvode.
        while($red = mysqli_fetch_row($rezultat)) { // Dok nismo pročitali sve redove iz bloka 'rezultat'...
            array_push($proizvodi, new Proizvod($red[0], $red[1], $red[2], $red[3], $red[4], $red[5]));
        }
        $view = new ViewProizvodi();
        $view->showPage($proizvodi);
    }

    public function loadSlicniProizvodi($proizvod)
    {
        $proizvodi = array();
        $upit = "SELECT * FROM proizvodi WHERE id != '" . $proizvod->getId() . "' AND kategorija = '" . $proizvod->getKategorija() . "'";
        $rezultat = mysqli_query($this->db, $upit);
        $brojac = 3; // Broj proizovda koji maksimalno trebamo pročitati.
        while (($red = mysqli_fetch_assoc($rezultat)) && $brojac-- != 0) { // Dok nismo pročitali max 3 reda iz bloka 'rezultat'...
            array_push($proizvodi, new Proizvod($red['id'], $red['naziv'], $red['cena'], $red['akcijskacena'], $red['kolicina'], $red['kategorija']));
        }
        return $proizvodi;
    }

    public function cartPrice($id_array)
    {
        $suma = 0;
        foreach ($id_array as $id)
        {
            $upit = "SELECT cena, akcijskacena FROM proizvodi WHERE id='".$id."'";
            $rezultat = mysqli_fetch_assoc(mysqli_query($this->db, $upit)); // izvrši upit i pročitaj prvi (i jedini) red
            $suma += ($rezultat['akcijskacena']==0 ? $rezultat['cena'] : $rezultat['akcijskacena']);
        }
        return $suma;
    }

    /*public function loadNoviProizvod($id)
    {
        $upit = "SELECT MAX (id) FROM proizvodi";
        $rezultat = mysqli_query($this->db, $upit); // rezultate je posljednji ID (najveći)
        $upit = "SELECT * FROM proizvodi WHERE id = '" . $rezultat . "'";
        $rezultat = mysqli_query($this->db, $upit); // Ovdje će biti upisan blok podataka koji nam vrati ovaj upit.
        $proizvod = mysqli_fetch_assoc($rezultat); // Stvaramo novi niz u koji ćemo dodavati proizvode.
        $view = new ViewProizvodi(); // ovjde treba tvoj mali View
        $view->showContent($proizvod); // važi i za slider
    }*/

    /*public function loadSlicniProizvodi($kategorija) // Podrazumijevani parametar: ako ne navedemo ništa, pretpostaviće '0'.
    {
        $upit = "SELECT * FROM proizvodi LIMIT 3 WHERE kategorija = '" . $kategorija . "' ORDER BY id DESC";
        $rezultat = mysqli_query($this->db, $upit); // Ovdje će biti upisan blok podataka koji nam vrati ovaj upit.
        $proizvodi = array(); // Stvaramo novi niz u koji ćemo dodavati proizvode.
        while($red = mysqli_fetch_row($rezultat)) { // Dok nismo pročitali sve redove iz bloka 'rezultat'...
            array_push($proizvodi, new Proizvod($red[0], $red[1], $red[2], $red[3], $red[4], $red[5]));
        }
        $view = new ViewPregledProizvoda();
        $view->showPage($proizvodi);
    }*/

}