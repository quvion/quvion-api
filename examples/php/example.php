<?php
require_once("quvion.php");

if(isset($_GET["mx"])) {
    $cKey = $_GET["mx"];
    $quvion = new quvion;
    $quvion->setup($_ENV["API_KEY"], $_ENV["DOMAIN"]);
    $quvion->confirmSubscription($cKey,
        getIPAddress(), "2021-09-07T12:16:43+00:00");
}

function getIPAddress() {
    $clientIP = '0.0.0.0';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $clientIP = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        # when behind cloudflare
        $clientIP = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $clientIP = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $clientIP = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
        $clientIP = $_SERVER['HTTP_FORWARDED'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $clientIP = $_SERVER['REMOTE_ADDR'];
    }
    return $clientIP;
}





