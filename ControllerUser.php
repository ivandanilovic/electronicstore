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
        $upit = "SELECT id FROM users WHERE username='". $username ."' AND password='". $password ."'";
        $rezultat = mysqli_query($this->db, $upit); // Odradimo upit i odmah izvadimo prvi (i, nadamo se, jedini) red kao asocijativni niz.
        if(!$rezultat) // Ako nema rezultata...
        {
            $this->showLogin();
        }
        else {
            $red = $rezultat->fetch_assoc();
            $_SESSION["user_id"] = $red['id'];
            // Vraćamo se na kupovinu:
           header("Location: Kupovina.php");
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