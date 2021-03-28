<?php
class Situs extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data = [
            'sites' => $this->db->get('situs'),
            'ekstraktor' => $this->db->get('ekstraktor')
        ];
        view('situs/index', $data);
    }
    public function create()
    {
        var_dump($_POST);
    }
}
