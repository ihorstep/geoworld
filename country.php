<?php

include("functions.php");

$connection = connect();
$code = $_GET['code'];
$country = getCountry($connection, $code);

function getCountry(PDO $connection, $code) {
    $sql = "SELECT * FROM countries WHERE code=?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$code]);
    return $stmt->fetch();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>GeoWorld</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>
        <?= include("header.php") ?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-6 col-md4" style="border: 1px solid;">
                        <table class="table">
                            <!--<thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                            </thead>-->
                            <tbody>
                            <tr>
                                <td>Name</td>
                                <td><?= $country['name'] ?></td>
                            </tr>
                            <tr>
                                <td>Official name</td>
                                <td><?= $country['official_name'] ?></td>
                            </tr>
                            <tr>
                                <td>Capital</td>
                                <td><?= $country['capital'] ?></td>
                            </tr>
                            <tr>
                                <td>Area</td>
                                <td><?= $country['area'] ?> km&sup2;</td>
                            </tr>
                            <tr>
                                <td>Currency</td>
                                <td><?= $country['currency'] ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6 col-md4" style="border: 1px solid;">

                    </div>
                </div>
            </div>
        </main>
        <?= include("footer.php") ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>
