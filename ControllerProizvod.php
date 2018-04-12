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
require_once ("ViewKupovina.php");
require_once ("ViewDodavanjeProizvoda.php");
require_once ("ModelKategorije.php");

class ControllerProizvod extends Controller
{

    public function load($id = 0) // Podrazumijevani parametar: ako ne navedemo ništa, pretpostaviće '0'.
    {
        $upit = "SELECT * FROM proizvodi".($id != 0 ? " WHERE kategorija = '".$id."'" : ""); // tj. "SELECT * FROM proizvodi WHERE kategorija = '1'", za $id == 1.
        $rezultat = mysqli_query($this->db, $upit); // Ovdje će biti upisan blok podataka koji nam vrati ovaj upit.
        $proizvodi = array(); // Stvaramo novi niz u koji ćemo dodavati proizvode.
        while($red = mysqli_fetch_row($rezultat)) { // Dok nismo pročitali sve redove iz bloka 'rezultat'...
            array_push($proizvodi, new Proizvod($red[0], $red[1], $red[2], $red[3], $red[4], $red[5], $red[7]));
        }
        $view = new ViewProizvodi();
        $view->showPage($proizvodi);
    }

    public function deleteProizvod($id)
    {
        $upit = "DELETE FROM  proizvodi WHERE id='".$id."'";
        mysqli_query($this->db, $upit);
        // ne pozivamo view jer pozivajuća skripta Index.php to sama radi nakon ovoga
    }

    public function loadProizvod($id)
    {
        $upit = "SELECT p.id, p.naziv, p.cena, p.akcijskacena, p.kolicina, kategorije.naziv
                 FROM proizvodi AS p
                 INNER JOIN kategorije ON kategorije.id = p.kategorija AND p.id = '" . $id . "'";
        $rezultat = mysqli_query($this->db, $upit);

        $proizvodi = array();
        $red = mysqli_fetch_row($rezultat); // Red sa podacima 'glavnog' proizvoda (onog koji prikazujemo).
        $proizvod = new Proizvod($red[0], $red[1], $red[2], $red[3], $red[4], $red[5], $red[7]);
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
            array_push($proizvodi, new Proizvod($red[0], $red[1], $red[2], $red[3], $red[4], $red[5], $red[7]));
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
            array_push($proizvodi, new Proizvod($red['id'], $red['naziv'], $red['cena'], $red['akcijskacena'], $red['kolicina'], $red['kategorija'], $red['slika']));
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

    public function loadCart($id_array)
    {
        $proizvodi=array();
        foreach ($id_array as $id)
        {
            $upit = "SELECT * FROM proizvodi WHERE id='" . $id . "'";
            $red = mysqli_fetch_assoc(mysqli_query($this->db, $upit));
            array_push($proizvodi,new Proizvod($red['id'], $red['naziv'], $red['cena'], $red['akcijskacena'], $red['kolicina'], $red['kategorija'], $red['slika']));
        }
        $view = new ViewKupovina();
        $view->showPage($proizvodi);
    }

    public function prikaziDodavanjeProizvoda() // !! isto za brend
    {
        $upit = "SELECT * FROM kategorije ";
        $kategorije = mysqli_query($this->db, $upit);

        $upit = "SELECT * FROM brendovi ";
        $brendovi = mysqli_query($this->db, $upit);

        $niz_kategorija=array();
        $niz_brendova = array();
        while ($kategorija = mysqli_fetch_assoc($kategorije)) // fetch vraća null kada smo došli do kraja $kategorije; logički, null == false
        {
            array_push($niz_kategorija, new ModelKategorije($kategorija['id'],$kategorija['naziv']));
        }
        while ($brend = mysqli_fetch_assoc($brendovi)) // fetch vraća null kada smo došli do kraja $kategorije; logički, null == false
        {
            array_push($niz_brendova, new ModelBrendovi($brend['id'],$brend['naziv']));
        }
        $view = new ViewDodavanjeProizvoda();
        $view->showPage(array('kategorije' => $niz_kategorija, 'brendovi' => $niz_brendova));//asocijativni niz
    }

    public function dodajProizvod($naziv, $cena, $akijskacena, $kolicina, $kategorija, $brend, $slika) // ??
    {
        $naziv_slike = $this->okaciSliku($slika, $naziv);
        $upit = "INSERT INTO proizvodi (naziv, cena, akcijskacena, kolicina, kategorija, brend, slika) 
                 VALUES (\"".$naziv."\", ".$cena.", ".$akijskacena.", ".$kolicina.", ".$kategorija.", ".$brend.", \"".$naziv_slike."\")";
        mysqli_query($this->db, $upit);
        header("Location: Index.php");
    }

    private function okaciSliku($slika, $naziv)
    {
        $target_dir = "images/";
        $target_file = $target_dir . $naziv . basename($slika["name"]);
        $uploadOk = 1;
        $upload_message = "OK";
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($slika["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            $upload_message = "Image too large.";
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
            $upload_message = "File does not exist.";

        }
        // Check file size
        if ($slika["size"] > 7000000) {
            $uploadOk = 0;
            $upload_message = "Image too large.";
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $uploadOk = 0;
            $upload_message = "Image not supported.";
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
            if (move_uploaded_file($slika["tmp_name"], $target_file)) {
                return $naziv . basename($slika["name"]);
            } else {
                return null;
            }
        }
        else
            return null;
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