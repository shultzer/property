<?php

$db = new mysqli('localhost', 'root', '', 'property') or die('error');
if (!$db) {
    die('Connection failed: ' . mysqli_connect_error());
}
$sql = 'SELECT * FROM Orders JOIN Reports ON Orders.ordersnum=Reports.ordersnum';

?>


<div class="w3-container">
    <h2><?=$title?></h2>


    <table class="w3-table-all">
        <tr>
            <th>Номер письма организации</th>

            <th>Организация</th>
            <th>Ходатайство организации</th>
            <th>Номер приказа</th>
            <th>Дата приказа</th>
            <th>Приказ</th>


        </tr>
        <?php $res=$db->query($sql);
            foreach ( $res as $row) :?>
        <tr>
            <td> <?php echo $row['letternum']?></td>

            <td><?php  echo $companylist[$row ['company']]; ?></td>
            <td><a href="<?php echo $row['letterpath'];?>" target="_blank">ссылка</a></td>
            <td> <?php echo $row['ordersnum']?></td>
            <td> <?php echo $row['ordersdate']?></td>
            <td><a href="<?php echo $row['orderpath'];?>" target="_blank">ссылка</a></td>


            <?php endforeach;?>
        </tr>

    </table>
</div>