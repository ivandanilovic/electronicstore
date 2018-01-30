<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 1/30/2018
 * Time: 8:57 PM
 */

class ViewLogin extends View
{

    public function showContent($data)
    {
        echo '
        <form method="post" action="Login.php">
            <label>Username:</label><input type="text" name="username"/>
            <label>Password:</label><input type="password" name="password"/>
            <button type="submit">Login</button>
        </form>
        ';
    }
}