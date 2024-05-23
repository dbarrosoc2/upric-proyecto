<?php
if ($_SERVER["HTTP_HOST"] === "www.upric.es") {
    $url_base = "/dashboard/";
    $url_base_http = "https://www.upric.es/dashboard/";
} else if ($_SERVER["HTTP_HOST"] === "localhost" || $_SERVER["HTTP_HOST"] === "127.0.0.1:8000") {
    $url_base = "/UPRIC/";
    $url_base_http = "/UPRIC/";
}
