<?php
$servername = "localhost";
$username = "mtipikina";
$password = "neto1539";
$dbname = "mtipikina";
$q = 'dump.txt';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    if(isset($_POST['newTask'])){
        $fieldData = $_POST['newTask'];
        $isdone = "В процессе";
        $data = $conn->prepare('INSERT INTO `tasks`(`description`, `is_done`, `date_added`, `do`) VALUES ($fieldData, $isdone, date("y.m.d.H:i:s"), do)');
        $data->bindParam(':description', $fieldData);
        $data->execute();
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

    <?php
    $data = $conn->query('SELECT * FROM tasks');
    foreach($data as $rows) {
        echo '<pre>';
        print_r($data);
        ?>
            <tr>
                <td align="center"><?php echo $rows['id'] ?></td>
                <td align="center"><?php echo $rows['description'] ?></td>
                <td align="center"><?php echo $rows['is_done'] ?></td>
                <td align="center"><?php echo date("y.m.d.H:i:s") ?></td>
            </tr>
        <?php
    }
    ?>
</table>
