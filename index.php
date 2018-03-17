<?php
$servername = "localhost";
$username = "mtipikina";
$password = "neto1539";
$dbname = "mtipikina";
$q = 'dump.txt';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    if(isset($_POST['newTask'])){
        $data = $conn->prepare('INSERT INTO `tasks`(`description`, `is_done`, `date_added`) VALUES (:descr, :done, :datead)');
        $data->bindParam(':descr', $fieldData);
        $data->bindParam(':done', $isdone);
        $data->bindParam(':datead', date("y.m.d.H:i:s"));
        $fieldData = $_POST['newTask'];
        $isdone = "В процессе";
        $data->execute();
    }
    if(isset($_GET['delete'])){
        $del = $_GET['delete'];
        $datadel = $conn->prepare('DELETE FROM `tasks` WHERE id = :id');
        $datadel->bindParam(':id', $del);
        $datadel->execute();
    }

    if(isset($_GET['done'])){
        $isdone = "Выполнено";
        $datadone = $conn->prepare('UPDATE `tasks` SET `is_done`=:done WHERE id = :id');
        $datadone->execute(array(
            ':done' => $isdone,
            ':id' => $_GET['done']
        ));
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
        ?>
            <tr>
                <td align="center"><?php echo $rows['description'] ?></td>
                <td align="center"><?php echo $rows['date_added'] ?></td>
                <td align="center"><?php echo $rows['is_done'] ?></td>
                <td align="center"><?php echo '<a href="index.php?delete=' . $rows['id'] . '">Удалить</a> <br/>'.'<a href="index.php?done=' . $rows['id'] . '">Выполнить</a>'?></td>
        </tr>
        <?php
    }
    ?>
</table>
