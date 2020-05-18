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
        <style>
            #map {
                height: 100%;
            }
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
    </head>
    <body>
        <?= include("header.php") ?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-6 col-md4">
                        <table class="table">
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
                                <td><span id="area"><?= number_format($country['area']); ?></span> km&sup2;</td>
                            </tr>
                            <tr>
                                <td>Currency</td>
                                <td><?= $country['currency'] ?></td>
                            </tr>
                            <tr hidden>
                                <td>Coordinates</td>
                                <td id="coords"><?= $country['coords'] ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6 col-md4">
                        <div id="map"></div>
                        <script>
                            var map;
                            var coords;
                            var area;

                            /** Experimental attempt to calculate zoom from area size */
                            function getLog(n) {
                                var base = 10;
                                if (n < 100) { base = 100 }
                                return Math.log(n) / Math.log(base);
                            }

                            function initMap() {
                                coords = JSON.parse(document.getElementById("coords").innerText);
                                area = parseInt(document.getElementById("area").innerText.replace(/,/g,""));

                                /** 11 - is a base zoom for small regions of 50 square kilometers */
                                var zoom = 11 - getLog(area)

                                map = new google.maps.Map(document.getElementById('map'), {
                                    center: {lat: coords[0], lng: coords[1] },
                                    zoom: zoom
                                });
                            }
                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?key=<?= getenv("GOOGLE_API_KEY"); ?>&callback=initMap"
                                async defer></script>
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
