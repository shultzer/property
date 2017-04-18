<?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    switch ($page){
        case 'home':
            $title = 'Госимущество';
            $include = 'home';
            break;
        case 'insertLetter':
            $title = 'Внесение ходатайства';
            $include = 'insertLetter';
            break;
        case 'insertOrder':
            $title = 'Внесение приказа';
            $include = 'insertOrder';
            break;
        case 'insertActs':
            $title = 'Внесение отчета об исполнении приказа';
            $include = 'insertActs';
            break;
        case 'reportOrder':
            $title = 'Формирование отчета по приказам';
            $include = 'reportOrder';
            break;
        case 'lettersworders_query':
            $title = 'Формирование отчета  по ходатайствам c приказами';
            $include = 'lettersworders_query';
            break;
        case 'letterswoorders_query':
            $title = 'Формирование отчета  по ходатайствам без приказов';
            $include = 'letterswoorders_query';
            break;
        case 'ordersworeports_query':
            $title = 'Формирование отчета  по неисполненным приказам';
            $include = 'ordersworeports_query';
            break;
        case 'orderswreports_query':
            $title = 'Формирование отчета  по исполненным приказам';
            $include = 'orderswreports_query';
            break;

        default:

            $title = '404';

    }