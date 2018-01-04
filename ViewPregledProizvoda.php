<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 12/14/2017
 * Time: 6:49 PM
 */

/*
 * DODATI LISTU SLIČNIH PROIZVODA!
 */

class ViewPregledProizvoda extends View
{

    public function showContent($proizvodi)
    {
//        var_dump($proizvodi);
        echo ' 
        <div class="center_title_bar">' . $proizvodi[0]->getNaziv() . '</div>
          <div class="prod_box_big">
            <div class="top_prod_box_big"></div>
            <div class="center_prod_box_big">
              <div class="product_img_big"> <a href="javascript:popImage("images/big_pic.jpg","Some Title")" title="header=[Zoom] body=[&nbsp;] fade=[on]"><img src="images/laptop.gif" alt="" border="0" /></a>
                <div class="thumbs"> <a href="#" title="header=[Thumb1] body=[&nbsp;] fade=[on]"><img src="images/thumb1.gif" alt="" border="0" /></a> <a href="#" title="header=[Thumb2] body=[&nbsp;] fade=[on]"><img src="images/thumb1.gif" alt="" border="0" /></a> <a href="#" title="header=[Thumb3] body=[&nbsp;] fade=[on]"><img src="images/thumb1.gif" alt="" border="0" /></a> </div>
              </div>
              <div class="details_big_box">
                <div class="product_title_big">' . $proizvodi[0]->getNaziv() . '</div>
                <div class="specifications"> Disponibilitate: <span class="blue">In stoc</span><br />
                  Garantie: <span class="blue">24 luni</span><br />
                  Tip transport: <span class="blue">Mic</span><br />
                  Pretul include <span class="blue">TVA</span><br />
                </div>
                ';
            if ($proizvodi[0]->getAkcijskaCena() == 0) {
                echo '<div class="prod_price_big"><span class="price">' . $proizvodi[0]->getCena() . ' rsd </span></div>';
            } else {
                echo '<div class="prod_price_big"><span class="reduce">' . $proizvodi[0]->getCena() . ' rsd </span> <span class="price">' . $proizvodi[0]->getAkcijskaCena() . ' rsd</span></div>';
            }
            echo '
                <a href="#" class="addtocart">add to cart</a> <a href="#" class="compare">compare</a> </div>
            </div>
            <div class="bottom_prod_box_big"></div>
            
            
            </div>
            <div class="center_title_bar">Similar products</div>
              
              ';
        if(sizeof($proizvodi)!=1) {
            for ($i=1; $i<sizeof($proizvodi); $i++) {
                echo '
              <div class="prod_box">
                <div class="top_prod_box"></div>
                <div class="center_prod_box">
                  <div class="product_title"><a href="details.html">'.$proizvodi[$i]->getNaziv().'</a></div>
                  <div class="product_img"><a href="details.html"><img src="images/laptop.gif" alt="" border="0" /></a></div>
                  ';
            if ($proizvodi[$i]->getAkcijskaCena() == 0) {
                echo '<div class="prod_price"><span class="price">' . $proizvodi[$i]->getCena() . ' rsd </span></div>';
            } else {
                echo '<div class="prod_price"><span class="reduce">' . $proizvodi[$i]->getCena() . ' rsd </span> <span class="price">' . $proizvodi[$i]->getAkcijskaCena() . ' rsd</span></div>';
            }
            echo '
                </div>
                <div class="bottom_prod_box"></div>
                <div class="prod_details_tab"> <a href="#" title="header=[Add to cart] body=[&nbsp;] fade=[on]"><img src="images/cart.gif" alt="" border="0" class="left_bt" /></a> <a href="#" title="header=[Specials] body=[&nbsp;] fade=[on]"><img src="images/favs.gif" alt="" border="0" class="left_bt" /></a> <a href="#" title="header=[Gifts] body=[&nbsp;] fade=[on]"><img src="images/favorites.gif" alt="" border="0" class="left_bt" /></a> <a href="details.html" class="prod_details">details</a> </div>
              </div>
              
            ';
            }
        }
            echo '
            </div>
            
            
      </div>
      ';
    }
}