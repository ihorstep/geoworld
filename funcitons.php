<?php

function connect() {
    $user = "root";
    $psd = "SITsdc32536";

    $dsn = "mysql:host=192.168.5.36;dbname=geoworld;port=3306;charset=utf8";

    $connection = new $PDO($dsn, $user, $psd);

    $connection->setAttribute(PDO::AFTER_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}

function getContinents(PDO $connection) {
    $sql = "SELECT * FROM continents";

    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $continents = $stmt->fetchAll();

    return $continents;
}

return $connection;
?>