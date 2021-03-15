<?php
function url($param = '')
{
    $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $url .= "://" . $_SERVER['HTTP_HOST'];
    $url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    return $url . $param;
}

function view($view, $data = [])
{
    if (is_array($data)) {
        extract($data);
        unset($data);
    }
    require_once '../app/views/' . $view . '.php';
}
