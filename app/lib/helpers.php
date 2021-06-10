<?php
function url($param = '')
{
    $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $url .= "://" . $_SERVER['HTTP_HOST'];
    $url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    return $url . $param;
}

function redirect($param = '')
{
    header('Location:' . url($param));
    exit;
}

function view($view, $data = [])
{
    if (is_array($data)) {
        extract($data);
        unset($data);
    }
    require_once 'app/views/' . $view . '.php';
}

function getActivePage()
{
    if (isset($_GET['url']))
        return $_GET['url'];
    return 'home/index';
}

function setFlashData($message = [])
{
    $_SESSION['flash'] = $message;
}

function getFlashData()
{
    $flash = false;
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
    }
    return $flash;
}

function getIndex()
{
    if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return end($url);
    }
}

function parseContent($content = "")
{
    $match = preg_match("/<small.*?>(.*?)<\/small>/", $content);
    if ($match) {
        preg_match("/<small.*?>(.*?)<\/small>/", $content, $match);
        $data = ['desc' => $match[0], 'isi' => strip_tags($content, '<p><a>')];
    } else {
        $data = ['desc' => '', 'isi' => strip_tags($content, '<p><a>')];
    }
    return $data;
}

function filterStrongText($str = "")
{
    // if (strpos($str, '<strong>')) {
    //     $str = str_replace('<strong>', '', $str);
    //     if (strpos($str, '</strong>')) {
    //         $str = str_replace('</strong>', '', $str);
    //     }
    // }
    return strip_tags($str, '<p>');
}
