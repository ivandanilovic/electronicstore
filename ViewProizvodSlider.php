<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 12/23/2017
 * Time: 4:34 PM
 */

class ViewProizvodSlider extends View
{
    public function showContent($proizvod)
    {
        // TODO: Implement showContent() method.
        echo '
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
        ';
    }
}