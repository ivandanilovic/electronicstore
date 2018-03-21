<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 12/4/2017
 * Time: 8:25 PM
 */

class ViewProizvodi extends View
{
    public function showContent($proizvodi)
    {
        echo '<div class="center_title_bar">Latest Products</div>';
        foreach ($proizvodi as $proizvod) {
            echo '
                    <div class="prod_box">
                    <div class="top_prod_box"></div>
                    <div class="center_prod_box">
                      <div class="product_title"><a href="proizvod.php?id=' . $proizvod->getId() .'&kategorija='.$proizvod->getKategorija().'">' . $proizvod->getNaziv() . '</a></div>
                      <div class="product_img"><a href="proizvod.php?id='.$proizvod->getId().'&&proizvod.php?kategorija='.$proizvod->getKategorija().'"><img src="images/'.$proizvod->getSlika().'" alt="" border="0" /></a></div> 
                ';
            if ($proizvod->getAkcijskaCena() == 0) {
                echo '<div class="prod_price"><span class="price">' . $proizvod->getCena() . ' rsd </span></div>';
            } else {
                echo '<div class="prod_price"><span class="reduce">' . $proizvod->getCena() . ' rsd </span> <span class="price">' . $proizvod->getAkcijskaCena() . ' rsd</span></div>';
            }
            echo '
                    </div>
                    <div class="bottom_prod_box"></div>
                    <div class="prod_details_tab"> <a href="Index.php?id='.$proizvod->getId().'&action=addtocart" title="header=[Add to cart] body=[&nbsp;] fade=[on]"><img src="images/cart.gif" alt="" border="0" class="left_bt" /></a> <a href="#" title="header=[Specials] body=[&nbsp;] fade=[on]"><img src="images/favs.gif" alt="" border="0" class="left_bt" /></a> <a href="#" title="header=[Gifts] body=[&nbsp;] fade=[on]"><img src="images/favorites.gif" alt="" border="0" class="left_bt" /></a>
                     ';

                    if ($_SESSION['privilegija']>=2) echo '<a href="Index.php?id='.$proizvod->getId().'&action=delete" title="header=[delete product] body=[&nbsp;] fade=[on]"><img src="images/cart.gif" alt="" border="0" class="left_bt" /></a>';
                    echo '
                     <a href="Proizvod.php?id='.$proizvod->getId().'&&Proizvod.php?kategorija='.$proizvod->getKategorija().'" class="prod_details">details</a> 
                    
                    </div> 
                </div>
                ';
        }
    }
}