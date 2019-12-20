<?php
ini_set('display_errors', E_ALL);
session_start();
spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'].'/classes/'.$class_name . '.php';
});
$data = ['title' => 'S.T.A.L.K.E.R.'];

include $_SERVER['DOCUMENT_ROOT'].'/includes/databaseconnect.php';