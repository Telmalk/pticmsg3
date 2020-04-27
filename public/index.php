<?php
    define("APP_ROOT_DIR", dirname(__DIR__) . "/");

    require_once APP_ROOT_DIR . "includes/function.php";
    require_once APP_ROOT_DIR . "includes/data.php";

    $dataPage = $data['got'];
    getHeader($data);
    var_dump($data['got']);
    var_dump($data["link"]);
    getPage($dataPage);
    getFooter();