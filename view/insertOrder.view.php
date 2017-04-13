<?php
$alert=[];

    $db = mysqli_connect('localhost', 'root', '', 'property') or die('error');
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $error = $_FILES['filedoc']['error'];

        if (0 == $error) {
            $fileName = $_FILES['filedoc']['name'];
            $remoteFileName = $_FILES['filedoc']['tmp_name'];
            $folderName = 'orders/' . date('dmY');

            if(! is_dir($folderName)){
                mkdir($folderName, 0777, true);
            }
            $orderpath = sprintf('%s/%s', $folderName, $fileName);


            if (move_uploaded_file($remoteFileName, $orderpath)) {
                $ordernum=mysqli_real_escape_string($db, getRequest('Ordersnum'));
                $letternum=mysqli_real_escape_string($db, getRequest('letternum'));
                $orderdate=mysqli_real_escape_string($db, getRequest('Ordersdate'));
                $company=mysqli_real_escape_string($db, getRequest('company'));
                $sql = "INSERT INTO Orders (letternum, ordersdate,ordersnum, orderpath, company) 
                        VALUES ('$letternum', '$orderdate', '$ordernum', '$orderpath', '$company')";
                $sqlU = "INSERT INTO Uniqueorders (ordersdate,ordersnum, orderpath, company) 
                        VALUES ('$orderdate', '$ordernum', '$orderpath', '$company')";

                if (mysqli_query($db, $sql)===TRUE){
                    $alert[]="Запись внесена<br>";
                }else{
                    $alert[]="Error: " . $sql . "<br>" . mysqli_error($db);
                }
                if (mysqli_query($db, $sqlU)===TRUE){
                    $alert[]="Запись внесена<br>";
                }else{
                    $alert[]="Error: " . $sql . "<br>" . mysqli_error($db);
                }
                //если в посте есть несколько наименований имущества, то делаем несколько записетй в базу

                if (isset($_POST['company2'])){
                    $company2=mysqli_real_escape_string($db, getRequest('company2'));
                    $letternum2=mysqli_real_escape_string($db, getRequest('letternum2'));
                    $sql2="INSERT INTO Orders (letternum, Ordersdate,Ordersnum, orderpath, company) 
                        VALUES ('$letternum2', '$orderdate', '$ordernum', '$orderpath', '$company2')";

                    if (mysqli_query($db, $sql2)===TRUE){
                        $alert[]="Вторая запись внесена<br>";
                    }else{
                        $alert[]="Error2: " . $sql . "<br>" . mysqli_error($db);
                    }
                }


                if (isset($_POST['company3'])){
                    $company3=mysqli_real_escape_string($db, getRequest('company3'));
                    $letternum3=mysqli_real_escape_string($db, getRequest('letternum3'));
                    $sql3="INSERT INTO Orders (letternum, ordersdate,ordersnum, orderpath, company) 
                        VALUES ('$letternum3', '$orderdate', '$ordernum', '$orderpath', '$company3')";

                    if (mysqli_query($db, $sql3)===TRUE){
                        $alert[]="Третья запись внесена<br>";
                    }else{
                        $alert[]="Error3: " . $sql . "<br>" . mysqli_error($db);
                    }
                }

                if (isset($_POST['company4'])){
                    $company4=mysqli_real_escape_string($db, getRequest('company4'));
                    $letternum4=mysqli_real_escape_string($db, getRequest('letternum4'));
                    $sql4="INSERT INTO Orders (letternum, Ordersdate,Ordersnum, orderpath, company) 
                        VALUES ('$letternum4', '$orderdate', '$ordernum', '$orderpath', '$company4')";

                    if (mysqli_query($db, $sql4)===TRUE){
                        $alert[]="Четвертая запись внесена<br>";
                    }else{
                        $alert[]="Error4: " . $sql . "<br>" . mysqli_error($db);
                    }
                }



            }

        }
        /*echo '<pre>';
        echo htmlspecialchars(print_r($sql));
        echo htmlspecialchars(print_r($_FILES, true));
        echo '</pre>';*/
       /* goBack();
        die;*/
    }
     /*echo '<pre>';
     echo htmlspecialchars(print_r($_POST, true));
    echo htmlspecialchars(print_r($_FILES, true));
     echo '</pre>';*/
?>



    <h3 class="w3-container w3-center">Внесение приказа Минэнерго</h3>
    <div class="w3-container w3-center w3-padding-top">
        <p style="color: #46dc17"><?php
            foreach ($alert as $alertname){
                echo $alertname;}?></p>
    </div>



<form class="w3-container" action="" method="post" enctype="multipart/form-data">
    <div class="w3-row-padding">
        <fieldset>
            <legend>Приказ и его реквизиты</legend>
                <div class="w3-container w3-half">
                <label class="w3-label w3-validate">Номер приказа</label>
                <input class="w3-input w3-border" type="text" name="Ordersnum" required>
                </div>
                <div class="w3-container w3-half">
                <label class="w3-label w3-validate">Дата приказа</label>
                <input class="w3-input w3-border" type="date" name="Ordersdate"  required>
                </div>
            <div class="w3-row-padding w3-quarter">
                <fieldset>
                    <legend>Выберите номер ходатайства организации</legend>

                    <select class="w3-select" name="letternum">
                        <option value="" disabled selected>Выбрать</option>
                        <?php letters($db);?>
                    </select>
                </fieldset>
            </div>
            <div class="w3-row-padding w3-quarter">
                <fieldset>
                    <legend>Выберите номер ходатайства организации</legend>

                    <select class="w3-select" name="letternum2">
                        <option value="" disabled selected>Выбрать</option>
                        <?php letters($db);?>
                    </select>
                </fieldset>
            </div>
            <div class="w3-row-padding w3-quarter">
                <fieldset>
                    <legend>Выберите номер ходатайства организации</legend>

                    <select class="w3-select" name="letternum3">
                        <option value="" disabled selected>Выбрать</option>
                        <?php letters($db);?>
                    </select>
                </fieldset>
            </div>
            <div class="w3-row-padding w3-quarter">
                <fieldset>
                    <legend>Выберите номер ходатайства организации</legend>

                    <select class="w3-select" name="letternum4">
                        <option value="" disabled selected>Выбрать</option>
                        <?php letters($db);?>
                    </select>
                </fieldset>
            </div>

    </div>

    <div class="w3-row-padding w3-quarter">
        <fieldset>
            <legend>Выберите организацию из приказа</legend>

         <select class="w3-select" name="company">
            <option value="" disabled selected>Выбрать</option>
            <?php complist($companylist);?>
         </select>
     </fieldset>
    </div>

    <div class="w3-row-padding w3-quarter">
        <fieldset>
            <legend>Выберите организацию из приказа</legend>

            <select class="w3-select" name="company2">
            <option value="" disabled selected>Выбрать</option>
            <?php complist($companylist);?>
            </select>
        </fieldset>
    </div>

    <div class="w3-row-padding w3-quarter">
        <fieldset>
        <legend>Выберите организацию из приказа</legend>

        <select class="w3-select" name="company3">
            <option value="" disabled selected>Выбрать</option>
            <?php complist($companylist);?>
        </select>
    </fieldset>

    </div>
    <div class="w3-row-padding w3-quarter">
        <fieldset>
            <legend>Выберите организацию из приказа</legend>

            <select class="w3-select" name="company4">
                <option value="" disabled selected>Выбрать</option>
                <?php complist($companylist);?>
            </select>
        </fieldset>

    </div>

            <div class="w3-third">
                <label class="w3-label w3-validate">Прикрепить приказ</label>
                <input class="w3-input w3-border" type="file" name="filedoc" required>
            </div>

    <div class="w3-container w3-center w3-padding-top">
        <input type="submit" class="w3-btn w3-xlarge w3-red" value="Внести в базу данных">
    </div>

</form>
<?php
/*echo htmlspecialchars(print_r($_POST, true));
mysqli_close($controllers);*/