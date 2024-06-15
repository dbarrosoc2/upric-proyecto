<?php
echo $_SERVER["HTTP_HOST"];
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
if ($_SERVER["HTTP_HOST"] === "upric.barrosocda.com") {
    $url_base = "/";
    $url_base_http = "https://www.upric.barrosocda.com/";
} else if ($_SERVER["HTTP_HOST"] === "localhost" || $_SERVER["HTTP_HOST"] === "127.0.0.1:8000") {
    $url_base = "/upric-proyecto/";
    $url_base_http = "/upric-proyecto/";
}
