<?php

$db = new mysqli('localhost', 'root', '', 'property') or die('error');
if (!$db) {
    die('Connection failed: ' . mysqli_connect_error());
}
$sql = 'SELECT * FROM Letters JOIN Orders ON Orders.letternum=Letters.letternum ORDER BY letterdate';

?>

<div class="w3-container">
    <h2><?=$title?></h2>


    <table class="w3-table-all">
        <tr>
            <th>Номер письма организации</th>
            <th>Дата письма организации</th>
            <th>Организация</th>
            <th>Ходатайство организации</th>
            <th>Номер приказа</th>
            <th>Дата приказа</th>
            <th>Приказ</th>
            <th>Наименование имущества</th>

        </tr>
        <?php foreach ($db->query($sql) as $row) :?>
        <tr>
            <td> <?php echo $row['letternum']?></td>
            <td> <?php echo $row['letterdate']?></td>
            <td><?php  echo $companylist[$row ['company']]; ?></td>
            <td><a href="<?php echo $row['letterpath'];?>" target="_blank">ссылка</a></td>
            <td> <?php echo $row['ordersnum']?></td>
            <td> <?php echo $row['ordersdate']?></td>
            <td><a href="<?php echo $row['orderpath'];?>" target="_blank">ссылка</a></td>
            <td> <?php echo $propertylist[$row['property']]?></td>

            <?php endforeach;?>
        </tr>

    </table>
</div>
