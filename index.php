<?php
$user = 'root';
$pass = '';
$db = 'testing-task';

$mysgl = new mysqli("localhost", $user, $pass, $db) or die("Unable to connect");
$mysgl->query("SET NAMES 'utf8'");

if ($mysgl->connect_error) {
    echo 'Error Number: ' . $mysgl->connect_errno . '<br>';
    echo 'Error: ' . $mysgl->connect_error;
} else {
    // $mysgl->query("DROP TABLE `cities`");
    $queryCheckTableCities = $mysgl->query("SHOW TABLES FROM `testing-task` like 'cities';");
    $resultQueryCheckTableCities = mysqli_num_rows($queryCheckTableCities);

    // Если нет таблицы, то создаем ее и заполняем городами
    if ($resultQueryCheckTableCities === 0) {
        $mysgl->query("CREATE TABLE `cities` (id INT(11) NOT NULL AUTO_INCREMENT, city VARCHAR(50) NOT NULL, PRIMARY KEY(id))");
        $citiesForInserts = [
            1 => 'Абаза',
            2 => 'Абакан',
            3 => 'Абдулино',
            4 => 'Абинск',
            5 => 'Агидель',
            6 => 'Агрыз',
            7 => 'Адыгейск',
            8 => 'Азнакаево',
            9 => 'Азов',
            10 => 'Ак-Довурак',
            11 => 'Аксай',
            12 => 'Алагир',
            13 => 'Алапаевск',
            14 => 'Алатырь',
            15 => 'Алдан',
            16 => 'Алейск',
            17 => 'Александров',
            18 => 'Александровск',
            19 => 'Александровск-Сахалинский',
            20 => 'Алексеевка',
            21 => 'Алексин',
            22 => 'Алзамай',
            23 => 'Алупка',
            24 => 'Алушта',
            25 => 'Альметьевск',
            26 => 'Амурск',
            27 => 'Анадырь',
            28 => 'Анапа',
            29 => 'Ангарск',
            30 => 'Андреаполь',
            31 => 'Анжеро-Судженск',
            32 => 'Анива',
            33 => 'Апатиты',
            34 => 'Апрелевка',
            35 => 'Апшеронск',
            36 => 'Арамиль',
            37 => 'Аргун',
            38 => 'Ардатов',
            39 => 'Ардон',
            40 => 'Арзамас',
            41 => 'Аркадак',
            42 => 'Армавир',
            43 => 'Армянск',
            44 => 'Арсеньев',
            45 => 'Арск',
            46 => 'Артём',
            47 => 'Артёмовск',
            48 => 'Артёмовский',
            49 => 'Архангельск',
            50 => 'Асбест',
            51 => 'Асино',
            52 => 'Астрахань',
            53 => 'Аткарск',
            54 => 'Ахтубинск',
            55 => 'Ачинск',
            56 => 'Аша',
            57 => 'Бабаево',
            58 => 'Бабушкин',
            59 => 'Бавлы',
            60 => 'Багратионовск',
            61 => 'Байкальск',
            62 => 'Баймак',
            63 => 'Бакал',
            64 => 'Баксан',
            65 => 'Балабаново',
            66 => 'Балаково',
            67 => 'Балахна',
            68 => 'Балашиха',
            69 => 'Балашов',
            70 => 'Балей',
            71 => 'Балтийск',
            72 => 'Барабинск',
            73 => 'Барнаул',
            74 => 'Барыш',
            75 => 'Батайск',
            76 => 'Бахчисарай',
            77 => 'Бежецк',
            78 => 'Белая Калитва',
            79 => 'Белая Холуница',
            80 => 'Белгород',
            81 => 'Белебей',
            82 => 'Белёв',
            83 => 'Белинский',
            84 => 'Белово',
            85 => 'Белогорск',
            86 => 'Белогорск',
            87 => 'Белозерск',
            88 => 'Белокуриха',
            89 => 'Беломорск',
            90 => 'Белоозёрский',
            91 => 'Белорецк',
            92 => 'Белореченск',
            93 => 'Белоусово',
            94 => 'Белоярский',
            95 => 'Белый',
            96 => 'Бердск',
            97 => 'Березники',
            98 => 'Берёзовский',
            99 => 'Берёзовский',
            100 => 'Беслан',
        ];
        foreach ($citiesForInserts as $city) {
            $mysgl->query("INSERT INTO `cities` (`city`) VALUES (' $city ')");
        }
    }

    $cities = [];
    $citiesSelctQuery = $mysgl->query("SELECT city FROM cities");

    if ($citiesSelctQuery->num_rows > 0) {
        while ($city = $citiesSelctQuery->fetch_assoc()) {
            $cities[] = $city['city'];
        }
    }
}

$mysgl->close();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/normalize.css">
    <link rel="stylesheet" href="assets/style.css">
    <script defer src="assets/jquery.js"></script>
    <script defer src="assets/script.js"></script>
    <title>Тестовове задание</title>
</head>

<body>
    <button data-path="cities" class="button popup-btn">
        Открыть список городов
    </button>
    <div data-popup="cities" class="cities-popup popup">
        <div class="popup__body">
            <div class="popup__content">
                <button class="popup__close close-popup">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 15L20 20L25 15" stroke="#3C3C3C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M25 25L20 20L15 25" stroke="#3C3C3C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <div class="cities-popup__search search">
                    <input placeholder="Поиск по городам" id="search-input" type="text" class="search__input">
                </div>
                <ul class="cities-popup__list">
                    <?php foreach ($cities as $city) : ?>
                        <li class="cities-popup__item">
                            <?= $city ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>