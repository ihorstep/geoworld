<?php
include("functions.php");

$connection = connect();

$continents = getContinents($connection);

print_r($continents);
?>