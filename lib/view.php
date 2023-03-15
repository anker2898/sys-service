<?php

class View
{

    public function __construct()
    {
    }

    public function render(string $nombre)
    {
        require 'views/' . $nombre . '.php';
    }
}
