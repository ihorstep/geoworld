<?php

include("functions.php");
$connection = connect();
$code = $_GET['code'];
$continent = getContinent($connection, $code);
$countries = getCountriesByContinent($connection, $code);

function getContinent(PDO $connection, $code) {
    $sql = "SELECT * FROM continents WHERE code=?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$code]);
    return  $stmt->fetch();
}

function getCountriesByContinent(PDO $connection, $code) {
    $sql = "SELECT * FROM countries WHERE continent_code=?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$code]);
    return $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>GeoWorld</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>
        <?= include("header.php"); ?>
        <main>
            <div class="container">
                <?= $continent['name'] ?>
                <ul class="list-group">
                    <div class="list-group-item list-group-item-secondary">Country List</div>
                    <?php foreach($countries as $countryItem): ?>
                        <a href="#" class="list-group-item list-group-item-action">
                            <img src="images/countries/png100px/<?= strtolower($countryItem['code']) ?>.png">
                            <?= $countryItem['name'] ?>
                        </a>
                        <li class="list-group-item">Vestibulum at eros</li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </main>
        <?= include("footer.php"); ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>
