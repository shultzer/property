<?php
$db = new mysqli('localhost', 'root', '', 'property') or die('error');
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql ='SELECT * FROM Uniqueorders ORDER BY ordersnum';
/*echo '<pre>';
echo htmlspecialchars(print_r($db->query($sql), true));
echo '</pre>';*/
?>

<div class="w3-container">
    <h2><?=$title?></h2>


    <table class="w3-table-all">
        <tr>

            <th>Номер приказа</th>
            <th>Дата приказа</th>
            <th>Приказ</th>
        </tr>
        <?php foreach ($db->query($sql) as $row) :?>
        <tr>

            <td> <?php echo $row['ordersnum']?></td>
            <td> <?php echo $row['ordersdate']?></td>
            <td><a href="<?php echo $row['orderpath'];?>" target="_blank">ссылка</a></td>
                <?php endforeach;?>
        </tr>

    </table>
</div>







