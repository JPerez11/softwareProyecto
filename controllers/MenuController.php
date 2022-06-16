<?php

require_once 'views/MenuView.php';

class MenuController
{
    function showMenu()
    {
        $MenuView = new MenuView();
        $MenuView->showMenu();
    }
}
?>