<?php
error_reporting(E_ALL);

    $menu = [
        ['href' => 'index.php?page=insertLetter', 'anchor' => 'Внесение ходатайства организации'],
        ['href' => 'index.php?page=insertOrder', 'anchor' =>'Внесение приказа Минэнерго'],
        ['href' => 'index.php?page=insertActs', 'anchor' => 'Внесение отчета об исполнении приказа'],
        ['href' => 'index.php?page=reportOrder', 'anchor' => 'Приказы Минэнерго'],
        ['href' => 'index.php?page=lettersworders_query', 'anchor' => 'Ходатайства по которым изданы приказы'],
        ['href' => 'index.php?page=letterswoorders_query', 'anchor' => 'Ходатайства по которым нет приказа'],
        ['href' => 'index.php?page=ordersworeports_query', 'anchor' => 'Неисполненные приказы'],
        ['href' => 'index.php?page=orderswreports_query', 'anchor' => 'Исполненные приказы']

    ];

    $companylist = [

        'brestenergo' => 'Брестэнерго',
        'vitebskenergo'=> 'Витебскэнерго',
        'grodnoenergo' => 'Гродноэнерго',
        'gomelenergo' => 'Гомельэнерго',
        'minskenergo' => 'Минскэнерго',
        'mogilevenergo' => 'Могилевэнерго',
        'belenergostroy' => 'Белэнергострой',
        'beltei' => 'БелТЭИ',
        'belnipi' => 'Белнипиэнергопром',
        'belenergosetproekt' => 'Белэнергосетьпроект'

    ];

    $propertylist = [
        
        'vl110' => 'ВЛ110кВ',
        'vl35'=> 'ВЛ35кВ',
        'vl10'=> 'ВЛ10кВ',
        'vl6'=> 'ВЛ6кВ',
        'v04'=> 'ВЛ0,4кВ',
        'teploset'=> 'Тепловые сети',
        'building'=> 'Здание',
        'equipment'=> 'Оборудование'
        
    ];