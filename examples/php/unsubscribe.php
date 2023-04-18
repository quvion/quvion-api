<?php
require_once("quvion.php");

if ((isset($_GET["mx"])) && (isset($_GET["my"]))) {
    $subscriberKey = $_GET["mx"];
    $validationHash =  $_GET["my"];
    $quvion = new quvion;
    $quvion->setup($_ENV["API_KEY"], $_ENV["DOMAIN"]);
    $res = $quvion->unsubscribe($subscriberKey,$validationHash);
    $val = json_decode( $res, true);
    if ($val["updated"]==1) {
        echo("DONE");
    } else {
        echo("NOT DONE");
    }
}




