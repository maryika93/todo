<?php
$servername = "localhost";
$username = "mtipikina";
$password = "neto1539";
$dbname = "mtipikina";
$q = 'dump.txt';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    if(isset($_POST['newTask'])){
        $data = $conn->prepare('INSERT INTO tasks VALUES(:description)');
        $fieldData = $_POST['newTask'];
        $data->bindParam(':description', $fieldData, PDO::PARAM_STR);
        $data->execute();
        echo ($_POST['newTask']);
    }

}
catch(PDOException $e)
{
    die("Error: " . $e->getMessage());
}

?>

<h1> Список дел на сегодня </h1>
<form method="post" action="" enctype="multipart/form-data">
    <input type="text" placeholder="Новая задача" name="newTask">
    <input type="submit" value="Добавить"><br/><br/>
</form>

<table border="1", cellpadding="10", width="100%">
    <tr>
        <td align="center"> Описание задачи </td>
        <td align="center"> Дата добавления </td>
        <td align="center"> Статус </td>
        <td align="center">  </td>
    </tr>

</table>