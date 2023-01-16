<?php
$user = 'root';
$pass = '';
$db = 'testing-task';

$mysgl = new mysqli("localhost", $user, $pass, $db) or die("Unable to connect");
$mysgl->query("SET NAMES 'utf8'");

echo $_POST['INPUT_VALUE'];

if (!empty($_POST['INPUT_VALUE'])) {
    $result = [];

    $result['POST'] = $_POST['INPUT_VALUE'];

    $search = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["INPUT_VALUE"]))));

    $searchCities = $mysgl->query("SELECT city from `cities` WHERE city LIKE '%$search%'");
    $resultQueryCheckSearchCities = mysqli_num_rows($searchCities);

    if ($resultQueryCheckSearchCities > 0) {
        while ($row = $searchCities->fetch_array()) {
            echo "\n<li class='cities-popup__item'>" . $row["city"] . "</li>";
        }
    } else {
        echo 'Ничего не найдено';
    }
} else {
    $searchCities = $mysgl->query("SELECT city from `cities`");
    while ($row = $searchCities->fetch_array()) {
        echo "\n<li class='cities-popup__item'>" . $row["city"] . "</li>";
    }
}
