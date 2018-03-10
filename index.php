<?php
$filename = 'dump.txt'; // Имя файла дампа
$mysql_host = 'localhost'; // Адрес сервера MySQL
$mysql_username = 'mtipikina'; // Имя пользователя MySQL
$mysql_password = 'neto1539'; // Пароль MySQL
$mysql_database = 'mtipikina'; // Имя БД

$connection = mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysqli_error());
mysqli_select_db($connection, $mysql_database) or die('Error selecting MySQL database: ' . mysqli_error());

$templine = '';
$lines = file($filename);
foreach ($lines as $line){
    $templine .= $line;
}
echo $templine;
?>

