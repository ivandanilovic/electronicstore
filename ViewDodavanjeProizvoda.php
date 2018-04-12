<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 3/14/2018
 * Time: 6:42 PM
 */

class ViewDodavanjeProizvoda extends View
{
    public function showContent($data)
    {
        echo '
        <form method="post" action="DodajProizvod.php" enctype="multipart/form-data">
            <label>Naziv:</label><input type="text" name="Naziv"/> <br>
            <label>Cena:</label><input type="text" name="Cena"/> <br>
            <label>Akcijska Cena:</label><input type="text" name="AkcijskaCena"/> <br>
            <label>Kolicina:</label><input type="text" name="Kolicina"/> <br>
            <label>Kategorija:</label>
            <select name="Kategorija">
            ';
            foreach ($data['kategorije'] as $kategorija)
            {
                echo '<option value="'. $kategorija->getId() .'">'. $kategorija->getNaziv() .'</option>';
            }
            echo '
            </select>
            <br>
            <label>Brend:</label>
            <select name="Brend">
            ';
            foreach ($data['brendovi'] as $brend)
            {
                echo '<option value="'. $brend->getId() .'">'. $brend->getNaziv() .'</option>';
            }
            echo '
            </select>
            <br>
            <input type="file" name="Slika" id="Slika"> <br>
            <button type="submit">Dodaj</button>
        </form>
        ';
    }
}