<?php
class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        view('home/index');
    }
    public function logout()
    {
        session_destroy();
    }
}
