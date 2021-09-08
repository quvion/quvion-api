<?php
require_once("quvion.php");

if(isset($_GET["mx"])) {
    $cKey = $_GET["mx"];
    $quvion = new quvion;
    $quvion->setup($_ENV["API_KEY"], $_ENV["DOMAIN"]);
    $quvion->confirmSubscription($cKey,
        "10.10.10.10", "2021-09-07T12:16:43+00:00");
}




