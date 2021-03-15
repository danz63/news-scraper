<?php
header("Location:public/");

// URL yang di kirimkan http://localhost/root_app/nama_folder/nama_controller/nama_function/parameter ....
// $url[0] = nama_folder
// $url[1] = nama_controller
// $url[2] = nama_function
// $url[3] = parameter

if (file_exists('../app/controllers/' . $url[0] . '/' . $url[1] . '.php')) {
    $this->controller = $url[1];
    unset($url[0]);
    unset($url[1]);
}
require_once '../app/controllers/' . $url[0] . '/' . $this->controller . '.php';
$this->controller = new $this->controller;

if (isset($url[2])) {
    if (method_exists($this->controller, $url[2])) {
        $this->method = $url[2];
        unset($url[2]);
    }
}
