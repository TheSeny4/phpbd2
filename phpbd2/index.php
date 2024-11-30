<?php

function Database()
{
    $db = new mysqli("192.168.199.13", "learn", "learn", "learn_deryabichev364");
    $db->set_charset("utf8mb4");
    return $db;
}

$db = Database();

$ress = $db->query("Select name, category, price from products");

$result = $ress->fetch_all(MYSQLI_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == 'POST') {
   $selected_option = $_POST['options'];
   if ($selected_option == 'cloth') {
    $ress = $db->query("SELECT * FROM products WHERE category = 'Одежда'");
    $result = $ress->fetch_all(MYSQLI_ASSOC);
   }
    else if ($selected_option == 'Electro') {
    $ress = $db->query("SELECT * FROM products WHERE category = 'Электроника'");
    $result = $ress->fetch_all(MYSQLI_ASSOC);
   }
   else if ($selected_option == 'furniture') {
    $ress = $db->query("SELECT * FROM products WHERE category = 'Мебель'");
    $result = $ress->fetch_all(MYSQLI_ASSOC);
   }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section class="hero">
        <div class="hero__info">
            <div class="hero__top">
                <h1 class="hero__title">Все товары</h1>
                <form action="" method="post">
                    <select name="options" id="options">
                        <option value="all">Все категории</option>
                        <option value="Electro">Электроника</option>
                        <option value="cloth">Одежда</option>
                        <option value="furniture">Мебель</option>
                    </select>
                    <input type="submit" value="Отправить">
                </form>
            </div>
        </div>
        <?php foreach ($result as $key) { ?>
            <div class="card">
                <h2>Название:
                    <?= $key['name'] ?>
                </h2>
                <p>категория:
                    <?= $key['category'] ?>
                </p>
                <p>Цена:
                    <?= $key['price'] ?>
                </p>
            </div>
        <?php } ?>
    </section>
</body>

</html>

<style>
    .card {
        padding-left: 200px;
    }

    .hero__top {
        display: flex;
        padding-left: 200px;
        align-items: center;
        gap: 30px;
    }
</style>