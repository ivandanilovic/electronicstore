<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 1/12/2018
 * Time: 7:03 PM
 */

class ViewKupovina extends View
{

    public function showContent($data)
    {
        echo '
        <table>
            <th>
                <td>Naziv</td>
                <td>Cena</td>
            </th>
            ';
        foreach ($data as $proizvod)
        {
            echo '
            <tr>
                <td>'.$proizvod->getNaziv().'</td>
                <td>'.($proizvod->getAkcijskaCena()==0 ? $proizvod->getCena() : $proizvod->getAkcijskaCena()).'</td>
            </tr>
            ';
        }
        echo '</table>';
        $k = new ControllerProizvod();
        echo '</br>Suma: ' .sprintf("%.2f", $k->cartPrice($_SESSION['cart'])).' rsd';
    }
}