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
            $folderName = 'reports/' . date('dmY');

            if(! is_dir($folderName)){
                mkdir($folderName, 0777, true);
            }
            $reportpath = sprintf('%s/%s', $folderName, $fileName);


            if (move_uploaded_file($remoteFileName, $reportpath)) {
                $reportsnum=mysqli_real_escape_string($db, getRequest('reportsnum'));
                $ordersnum=mysqli_real_escape_string($db, getRequest('ordersnum'));
                $reportsdate=mysqli_real_escape_string($db, getRequest('reportsdate'));
                $company=mysqli_real_escape_string($db, getRequest('company'));

                $sql = "INSERT INTO Reports (reportsdate, reportsnum, reportpath, company, ordersnum) 
                        VALUES ('$reportsdate', '$reportsnum', '$reportpath', '$company', '$ordersnum')";


                if (mysqli_query($db, $sql)===TRUE){
                    $alert[]="Запись внесена<br>";
                }else{
                    $alert[]="Error: " . $sql . "<br>" . mysqli_error($db);
                }

                //если в посте есть несколько писем, то делаем несколько записей в базу

                if (isset($_POST['ordernum2'])){
                    $ordersnum2=mysqli_real_escape_string($db, getRequest('ordersnum2'));
                    $sql2="INSERT INTO Reports (reportsdate, reportsnum, reportpath, company, ordersnum) 
                        VALUES ('$reportsdate', '$reportsnum', '$reportpath', '$company', '$ordersnum2')";

                    if (mysqli_query($db, $sql2)===TRUE){
                        $alert[]="Вторая запись внесена<br>";
                    }else{
                        $alert[]="Error2: " . $sql . "<br>" . mysqli_error($db);
                    }
                }


                if (isset($_POST['ordernum3'])){
                    $ordernum3=mysqli_real_escape_string($db, getRequest('ordersnum3'));
                    $sql3="INSERT INTO Reports (reportsdate, reportsnum, reportpath, company, ordersnum) 
                        VALUES ('$reportsdate', '$reportsnum', '$reportpath', '$company', '$ordersnum3')";

                    if (mysqli_query($db, $sql3)===TRUE){
                        $alert[]="Третья запись внесена<br>";
                    }else{
                        $alert[]="Error3: " . $sql . "<br>" . mysqli_error($db);
                    }
                }

                if (isset($_POST['ordernum4'])){
                    $ordersnum4=mysqli_real_escape_string($db, getRequest('ordersnum4'));
                    $sql4="INSERT INTO Reports (reportsdate, reportsnum, reportpath, company, ordersnum) 
                        VALUES ('$reportsdate', '$reportsnum', '$reportpath', '$company', '$ordersnum4')";

                    if (mysqli_query($db, $sql4)===TRUE) {
                        $alert[]="Четвертая запись внесена<br>";
                    } else {
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



    <h3 class="w3-container w3-center">Внесение Отчета об исполнении приказа</h3>
    <div class="w3-container w3-center w3-padding-top">
        <p style="color: #46dc17"><?php
            foreach ($alert as $alertname){
                echo $alertname;}?></p>
    </div>



    <form class="w3-container" action="" method="post" enctype="multipart/form-data">
        <div class="w3-row-padding">


                <div class="w3-container w3-half">
                    <label class="w3-label w3-validate">Номер отчета</label>
                    <input class="w3-input w3-border" type="text" name="reportsnum" required>
                </div>
                <div class="w3-container w3-half">
                    <label class="w3-label w3-validate">Дата отчета</label>
                    <input class="w3-input w3-border" type="date" name="reportsdate"  required>
                </div>
                <div class="w3-row-padding">
                    <fieldset>
                        <legend>Выберите организацию </legend>

                        <select class="w3-select" name="company">
                            <option value="" disabled selected>Выбрать</option>
                            <?php complist($companylist);?>
                        </select>
                    </fieldset>
                </div>
                <div class="w3-row-padding w3-quarter">
                    <fieldset>
                        <legend>Выберите номер приказа</legend>

                        <select class="w3-select" name="ordersnum">
                            <option value="" disabled selected>Выбрать</option>
                            <?php orders ($db);?>
                        </select>
                    </fieldset>
                </div>
                <div class="w3-row-padding w3-quarter">
                    <fieldset>
                        <legend>Выберите номер приказа</legend>

                        <select class="w3-select" name="ordersnum2">
                            <option value="" disabled selected>Выбрать</option>
                            <?php orders ($db);?>
                        </select>
                    </fieldset>
                </div>
                <div class="w3-row-padding w3-quarter">
                    <fieldset>
                        <legend>Выберите номер приказа</legend>

                        <select class="w3-select" name="ordersnum3">
                            <option value="" disabled selected>Выбрать</option>
                            <?php orders ($db);?>
                        </select>
                    </fieldset>
                </div>
                <div class="w3-row-padding w3-quarter">
                    <fieldset>
                        <legend>Выберите номер приказа</legend>

                        <select class="w3-select" name="ordersnum4">
                            <option value="" disabled selected>Выбрать</option>
                            <?php orders ($db);?>
                        </select>
                    </fieldset>
                </div>

        </div>




        <div class="w3-third">
            <label class="w3-label w3-validate">Прикрепить отчет</label>
            <input class="w3-input w3-border" type="file" name="filedoc" required>
        </div>

        <div class="w3-container w3-center w3-padding-top">
            <input type="submit" class="w3-btn w3-xlarge w3-red" value="Внести в базу данных">
        </div>

    </form>
<?php

