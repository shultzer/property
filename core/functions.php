<?php

    function validate($user, $pass) {

        $users=[
            'admin' => 'admin',
            'guest' => 'guest'
        ];

        if (isset($users[$user]) && ($users[$user] === $pass)) {
            return true;
            } else {
            return false;
        }
    }
/*
 отрисовка ссылок навигации сайта
*/
    function menu($menu){

        foreach($menu as $item){
            echo "<a href=\"{$item['href']}\">{$item['anchor']}</a>";
        }
    }

/*
проверка на пост
*/
        function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    function getRequest($key, $default=0)
    {
        return (! empty($_REQUEST[$key]) ) ? $_REQUEST[$key] : $default;
    }


    function goBack()
    {
        $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'http://localhost/property/index.php';

        header("Location: $url");
    }

/*
отрисовка списка организаций
*/
    function complist($companylist) {

        foreach ($companylist as $comp_en=> $comp_rus) {
            echo "<option value = \"{$comp_en}\" > {$comp_rus}</option >";

        }
    }
/*
 отрисовка перечня имущества
*/
    function proplist($propertylist)
    {

        foreach ($propertylist as $prop_en => $prop_rus) {
            echo "<option value = \"{$prop_en}\" > {$prop_rus}</option >";

        }
    }
/*
 отрисовка списка писем
*/
    function letters ($db) {

        $sql = 'SELECT letternum FROM Letters';
        $res=$db->query($sql);
            foreach ($res as $lnums){
                foreach ($lnums as $lnum){
                    echo "<option value = \"$lnum\" > {$lnum}</option >";
                }
            }

    }
/*
 отрисовка списка приказов
*/
function orders ($db)
{

    $sql = 'SELECT ordersnum FROM Uniqueorders';
    $res=$db->query($sql);
    foreach ($res as $onums){
        foreach ($onums as $onum){
            echo "<option value = \"$onum\" > {$onum}</option >";
        }
    }

}