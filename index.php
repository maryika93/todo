<?php
$servername = "localhost";
$username = "mtipikina";
$password = "neto1539";
$dbname = "mtipikina";
$q = 'dump.txt';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $sql = $conn->exec("CREATE TABLE 'tasks' (
'id' int(11) NOT NULL AUTO_INCREMENT,
'description' text NOT NULL,
'is_done' tinyint(4) NOT NULL DEFAULT '0',
'date_added' datetime NOT NULL,
PRIMARY KEY ('id')
)");

    if ($_POST) {

        $data = $conn->prepare('INSERT INTO tasks VALUES(:description)');
        $fieldData = $_POST['newTask'];
        $data->bindParam(':description', $fieldData);
        $var = $data->execute();

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