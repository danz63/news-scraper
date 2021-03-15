<?php

class Controller
{
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }
}
