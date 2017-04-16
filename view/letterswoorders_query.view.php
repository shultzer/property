<?php
$db = new mysqli('localhost', 'root', '', 'property') or die('error');
if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
$sql = 'SELECT * FROM Letters WHERE Letters.letternum NOT IN (SELECT letternum FROM Orders)';

?>

<div class="w3-container">
    <h2><?=$title?></h2>


    <table class="w3-table-all">
        <tr>


            <th>Организация</th>
            <th>Номер письма организации</th>
            <th>Дата письма организации</th>
            <th>Наименование имущества</th>
            <th>Ходатайство организации</th>
        </tr>
        <?php foreach ($db->query($sql) as $row) :?>
        <tr>


            <td><?php  echo $companylist[$row ['company']]; ?></td>
            <td> <?php echo $row['letternum']?></td>
            <td> <?php echo $row['letterdate']?></td>
            <td> <?php echo $propertylist[$row['property']]?></td>
            <td><a href="<?php echo $row['letterpath'];?>" target="_blank">ссылка</a></td>
            <?php endforeach;?>
        </tr>

    </table>
</div>
