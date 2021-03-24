<?php
class Situs extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        view('situs/index');
    }
}
