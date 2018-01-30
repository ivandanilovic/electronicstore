<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 1/30/2018
 * Time: 8:50 PM
 */

require_once("Controller.php");
require_once("ControllerProizvod.php");

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
            // Temporary:
            $k = new ControllerProizvod();
            $k->load();
        }
    }

    public function load()
    {
        // TODO: Implement load() method.
        // Npr. učitavanje korisničkog profila.
    }
}