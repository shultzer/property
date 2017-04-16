
<?php

$alert=[''];

$db = mysqli_connect('localhost', 'root', '', 'property');
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $error = $_FILES['filedoc']['error'];

    if (0 == $error) {                                                       //если файл загружен без ошибок
        $fileName = $_FILES['filedoc']['name'];            //ложим в переменные его название и путь
        $remoteFileName = $_FILES['filedoc']['tmp_name'];
        $folderName = 'doc/' . date('dmY');

        if(! is_dir($folderName)){
            mkdir($folderName, 0777, true);
        }
        $path =  sprintf('%s/%s', $folderName, $fileName);                           //создаем папку для файлов


        if (move_uploaded_file($remoteFileName, $path)) {                                   //передвигаем его в спецпапку
            $letternum=filter_input(INPUT_POST, 'letternum', FILTER_SANITIZE_STRING);       //забираем в переменные данные из поста
            $letterdate=filter_input(INPUT_POST,'letterdate', FILTER_SANITIZE_STRING);
            $company=filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
            $property=filter_input(INPUT_POST, 'property', FILTER_SANITIZE_STRING);
            $reason=mysqli_real_escape_string($db, getRequest('reason'));
            $sql = "INSERT INTO Letters (letternum,letterdate, letterpath, company, property, reason) VALUES 
                ('$letternum', '$letterdate', '$path', '$company', '$property', '$reason')";



        }
        if (mysqli_query($db, $sql)===TRUE){
            $alert[]="Одна запись внесена";
        }else{
            $alert[]="Error: " . $sql . "<br>" . mysqli_error($db);
        }
        //если в посте есть несколько наименований имущества, то делаем несколько записетй в базу

        if (isset($_POST['property2'])){
            $property2=filter_input(INPUT_POST, 'property2', FILTER_SANITIZE_STRING);

            $sql2="INSERT INTO Letters (letternum,letterdate, letterpath, company, property) VALUES 
                    ('$letternum', '$letterdate', '$path', '$company', '$property2')";

            if (mysqli_query($db, $sql2)===TRUE){
                $alert[]="Вторая запись внесена";
            }else{
                $alert[]="Error2: " . $sql . "<br>" . mysqli_error($db);
            }
        }


        if (isset($_POST['property3'])){
            $property3=filter_input(INPUT_POST, 'property3', FILTER_SANITIZE_STRING);

            $sql3="INSERT INTO companyletters (letternum,Letterdate, letterpath, company, property) VALUES 
                    ('$letternum', '$letterdate', '$path', '$company', '$property3')";

            if (mysqli_query($db, $sql3)===TRUE){
                $alert[]="Третья запись внесена";
            }else{
                $alert[]="Error3: " . $sql . "<br>" . mysqli_error($db);
            }
        }

    }


}

//echo htmlspecialchars(print_r($_REQUEST, true));


?>


<h3 class="w3-container w3-center">Внесение ходатайства</h3>
<div class="w3-container w3-center w3-padding-top">
    <p style="color: #46dc17">
        <?php
        foreach ($alert as $alertname){
        echo $alertname;}?>
    </p>
</div>


<form class="w3-container" action="" method="post" enctype="multipart/form-data">
    <div class="w3-row-padding">
        <fieldset>
            <legend>Письмо и его реквизиты</legend>
            <div class="w3-container w3-half">
                <label class="w3-label w3-validate">Номер письма</label>
                <input class="w3-input w3-border" type="text" name="letternum" required>
            </div>
            <div class="w3-container w3-half">
                <label class="w3-label w3-validate">Дата письма</label>
                <input class="w3-input w3-border" type="date" name="letterdate" required>
            </div>
            <div class="w3-quarter">
                <label class="w3-label w3-validate">Прикрепить письмо</label>
                <input class="w3-input w3-border"type="file" name="filedoc" required>
            </div>
            <div class="w3-quarter w3-padding">
                    <label class="w3-label w3-validate">Выберите адресата</label>
                    <select class="w3-select" name="company" required>
                    <option value="" disabled selected>Выбрать</option>
                        <?php complist($companylist);?>
                     </select>
            </div>
        </fieldset>


    </div>
        <div class="w3-container w3-center w3-padding-top">

        <fieldset class="w3-quarter">
            <legend>Выберите наименование имущества</legend>

            <select class="w3-select" name="property"required>
                <option value="" disabled selected>Выбрать</option>
                <?php proplist($propertylist);?>
            </select>
        </fieldset>

        <fieldset class="w3-quarter">
            <legend>Выберите наименование имущества</legend>

            <select class="w3-select" name="property2">
                <option value="" disabled selected>Выбрать</option>
                <?php proplist($propertylist);?>
            </select>
        </fieldset>

        <fieldset class="w3-quarter">
            <legend>Выберите наименование имущества</legend>

            <select class="w3-select" name="property3">
                <option value="" disabled selected>Выбрать</option>
                <?php proplist($propertylist);?>
            </select>
         </fieldset>
    </div>

    <div class="w3-padding">
        <fieldset class="w3-threequarter">
            <input class="w3-check" type="checkbox" name="reason" value="231">
            <label>По 231 Распоряжению</label>
        </fieldset>
        <fieldset class="w3-threequarter">
            <input class="w3-check" type="checkbox" name="reason" value="294">
            <label>По 294 Указу</label>
        </fieldset>
        <fieldset class="w3-threequarter">
            <input class="w3-check" type="checkbox" name="reason" value="50">
            <label>По 50 Указу</label>
        </fieldset>
    </div>


    <div class="w3-container w3-center ">

        <input type="submit" name="submit" class="w3-btn w3-xlarge w3-red w3-margin-large" value="Внести в базу данных">
</div>

</form>




