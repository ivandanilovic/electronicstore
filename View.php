<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 11/20/2017
 * Time: 8:19 PM
 */
if (!isset($_SESSION))
{
    session_start();
    if (!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] = array();
    }
    if (!isset($_SESSION['user_id']))
    {
        $_SESSION['user_id'] = 0;
    }
}

require_once("ModelProizvoda.php");
require_once("ModelBrendovi.php");
require_once("ControllerKategorije.php");
require_once("ControllerBrendovi.php");
//require_once("ControllerNoviProizvod.php");

abstract class View
{

    public abstract function showContent($data);

    public function showPage($data)

    {
        echo'
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <title>Electronix Store</title>
            <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
            <link rel="stylesheet" type="text/css" href="style.css" />
            <!--[if IE 6]>
            <link rel="stylesheet" type="text/css" href="iecss.css" />
            <![endif]-->
            <script type="text/javascript" src="js/boxOver.js"></script>
            </head>
            <body>
            <div id="main_container">
              <div class="top_bar">
                <div class="top_search">
                  <div class="search_text"><a href="#">Advanced Search</a></div>
                  <input type="text" class="search_input" name="search" />
                  <input type="image" src="images/search.gif" class="search_bt"/>
                </div>
                <div class="languages">
                  <div class="lang_text">Languages:</div>
                  <a href="#" class="lang"><img src="images/en.gif" alt="" border="0" /></a> <a href="#" class="lang"><img src="images/de.gif" alt="" border="0" /></a> </div>
              </div>
              <div id="header">
                <div id="logo"> <a href="Index.php"><img src="images/logo.png" alt="" border="0" width="237" height="140" /></a> </div>
                
               <div class="oferte_content">
                  <div class="top_divider"><img src="images/header_divider.png" alt="" width="1" height="164" /></div>
                  <div class="oferta">
                    <div class="oferta_content"> <img src="images/laptop.png" width="94" height="92" alt="" border="0" class="oferta_img" />
                      <div class="oferta_details">
                        <div class="oferta_title">Samsung GX 2004 LM</div>
                        <div class="oferta_text"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco </div>
                        <a href="details.html" class="details">details</a> </div>
                    </div>
                    <div class="oferta_pagination"> <span class="current">1</span> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">5</a> </div>
                  </div>
                  <div class="top_divider"><img src="images/header_divider.png" alt="" width="1" height="164" /></div>
                </div>
                
                <!-- end of oferte_content-->
              </div>
              <div id="main_content">
                <div id="menu_tab">
                  <div class="left_menu_corner"></div>
                  <ul class="menu">
                    <li><a href="Index.php" class="nav1"> Home</a></li>
                    <li class="divider"></li>
                    <li><a href="#" class="nav2">Products</a></li>
                    <li class="divider"></li>
                    <li><a href="#" class="nav3">Specials</a></li>
                    <li class="divider"></li>
                    <li><a href="#" class="nav4">My account' . ($_SESSION["user_id"]>0 ? " [" . $_SESSION["user_id"] . "]" : "") . '</a></li>
                    <li class="divider"></li>
                    <li><a href="#" class="nav4">Sign Up</a></li>
                    <li class="divider"></li>
                    <li><a href="#" class="nav5">Shipping</a></li>
                    <li class="divider"></li>
                    <li><a href="contact.html" class="nav6">Contact Us</a></li>
                    <li class="divider"></li>
                    <li class="currencies">Currencies
                      <select>
                        <option>US Dollar</option>
                        <option>Euro</option>
                      </select>
                    </li>
                  </ul>
                  <div class="right_menu_corner"></div>
                </div>
                <!-- end of menu tab -->
                <div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
                <div class="left_content">
                  <div class="title_box">Categories</div>
                  <ul class="left_menu">
                  ';
        $controller = new controllerKategorije();
        $kategorije = $controller->load();
        for ($i=0; $i<sizeof($kategorije); $i++)
        {
            echo '<li class="'. ($i%2==0 ? 'even' : 'odd') .'"><a href="Kategorija.php?id='.$kategorije[$i]->getId().'">'.$kategorije[$i]->getNaziv().'</a></li>'; // Ternarni operator.
        }

        echo'
                  </ul>
                  <div class="title_box">Special Products</div>
                  <div class="border_box">
                    <div class="product_title"><a href="details.html">Motorola 156 MX-VL</a></div>
                    <div class="product_img"><a href="details.html"><img src="images/laptop.png" alt="" border="0" /></a></div>
                    <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
                  </div>
                  <div class="title_box">Newsletter</div>
                  <div class="border_box">
                    <input type="text" name="newsletter" class="newsletter_input" value="your email"/>
                    <a href="#" class="join">join</a> </div>
                  <div class="banner_adds"> <a href="#"><img src="images/bann2.jpg" alt="" border="0" /></a> </div>
                </div>
                <!-- end of left content -->
                <div class="center_content">
                  
        ';


        $this->showContent($data); // Na osnovu tipa view-a se zna koji showContent se poziva.

        echo '
            </div>
            <!-- end of center content -->
            <div class="right_content">
              <div class="shopping_cart">
                <div class="cart_title">Shopping cart</div>
                <div class="cart_details"> '.count($_SESSION['cart']).' items <br /> 
                  <span class="border_cart"></span> Total: <span class="price">';
        $controller=new ControllerProizvod();
        echo sprintf("%.2f", $controller->cartPrice($_SESSION['cart']));
        /*
         * ime_promenljive
         * ImeKlase
         * imeFunkcije
         * */
        echo ' rsd</span> </div>
                <div class="cart_icon"><a href="Kupovina.php" title="header=[Checkout] body=[&nbsp;] fade=[on]"><img src="images/shoppingcart.png" alt="" width="48" height="48" border="0" /></a></div>
              </div>
              <div class="title_box">What’s new</div>
              ';
        /*-----------------------------------------------------------------------------------------------------------------------------
        $controller=new contro();
        $proizvodi=$controller->load();*/

                echo '
              <div class="border_box">
                <div class="product_title"><a href="details.html">Motorola 156 MX-VL</a></div>
                <div class="product_img"><a href="details.html"><img src="images/p2.gif" alt="" border="0" /></a></div>
                <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
              </div>
              <div class="title_box">Manufacturers</div>
              <ul class="left_menu">
         ';

        $controller=new controllerBrendovi();
        $brendovi=$controller->load();
                for ($i=0; $i<sizeof($brendovi); $i++)
                {
                    echo '<li class="'.($i%2==0 ? 'even':'odd').'"><a href="Brend.php?id='.$brendovi[$i]->getId().'">'.$brendovi[$i]->GetNaziv().'</a></li>';
                }

          echo '     
                
              </ul>
              <div class="banner_adds"> <a href="#"><img src="images/bann1.jpg" alt="" border="0" /></a> </div>
            </div>
            <!-- end of right content -->
          </div>
          <!-- end of main content -->
          <div class="footer">
            <div class="left_footer"> <img src="images/footer_logo.png" alt="" width="170" height="49"/> </div>
            <div class="center_footer"> Template name. All Rights Reserved 2008<br />
              <a href="http://csscreme.com"><img src="images/csscreme.jpg" alt="csscreme" border="0" /></a><br />
              <img src="images/payment.gif" alt="" /> </div>
            <div class="right_footer"> <a href="#">home</a> <a href="#">about</a> <a href="#">sitemap</a> <a href="#">rss</a> <a href="contact.html">contact us</a> </div>
          </div>
        </div>
        <!-- end of main_container -->
        </body>
        </html>
        ';
    }
}