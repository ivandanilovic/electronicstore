<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 1/30/2018
 * Time: 8:50 PM
 */

require_once "Controller.php";
require_once "ControllerProizvod.php";
require_once "ViewLogin.php";

class ControllerUser extends Controller
{
    public function showLogin()
    {
        $view = new ViewLogin();
        $view->showPage(null);
    }

    public function validateLogin($username, $password)
    {
        $upit = "SELECT id, privilegija FROM users WHERE username='". $username ."' AND password='". $password ."'";
        $rezultat = mysqli_query($this->db, $upit); // Odradimo upit i odmah izvadimo prvi (i, nadamo se, jedini) red kao asocijativni niz.
        if(!$rezultat) // Ako nema rezultata...
        {
            $this->showLogin();
        }
        else {
            $red = $rezultat->fetch_assoc();

            $_SESSION["user_id"] = (int)$red['id'];
            $_SESSION["privilegija"] = (int)$red['privilegija'];

            if (count($_SESSION['cart']) != 0) // Ako korpa nije prazna, vraćamo se na pregled korpe (checkout); u suprotnom, vraćamo se na početnu.
                header("Location: Kupovina.php");
            else
                header("Location: Index.php");
        }
    }

    public function load()
    {
        // TODO: Implement load() method.
        // Npr. učitavanje korisničkog profila.
    }

    public function procesOrder($id, $proizvodi)
    {
        $suma=0;
        foreach ($proizvodi as $proizvod_id)
        {
            $upit = "SELECT * FROM proizvodi WHERE id = '".$proizvod_id."'";
            $red = mysqli_query($this->db, $upit)->fetch_row();
            $proizvod = new Proizvod($red[0], $red[1], $red[2], $red[3], $red[4], $red[5]);
            if ($proizvod->getAkcijskaCena() != 0)
            {
                $suma += $proizvod->getAkcijskaCena();
            }
            else
            {
                $suma += $proizvod->getCena();
            }
        }
        $upit = "INSERT INTO porudzbine (iduser, cena) VALUES ('". $id ."', '". $suma ."')";
        // Provjeriti usješnost query-ja?
        mysqli_query($this->db, $upit); // Dodati poruku o (ne)uspješnoj porudžbini?

        foreach ($proizvodi as $proizvod_id)
        {
            $upit = "SELECT * FROM proizvodi WHERE id = '".$proizvod_id."'";
            $red = mysqli_query($this->db, $upit)->fetch_assoc();
            $kolicina = intval($red['kolicina']) - 1;   // I: calculate value of int - intval($red['kolicina'])
                                                        // II: cast to type int - (int)$red['kolicina']
            // proveriti kolicina veca od 0
            $upit = "UPDATE proizvodi SET kolicina='". $kolicina ."' WHERE id = '".$proizvod_id."'";
            // Provjeriti usješnost query-ja?
            mysqli_query($this->db, $upit);
        }

        $_SESSION['cart'] = array();
        $k = new ControllerProizvod();
        $k->load();
        // Poruka?
    }
}

/*
 * class Counter {
 *  private static int $count = 0;
 *  public static function inc() {
 *      count++;
 *      if($count == 7) $count = 0;
 *  }
 * }
 * Counter::inc();
 */