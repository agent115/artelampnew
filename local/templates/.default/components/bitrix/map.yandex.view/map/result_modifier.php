<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
//общий вывод призаходе на странциу
$arFiltermap=array('IBLOCK_ID'=>17, 'ACTIVE'=>'Y');

if(isset($_GET['city']) && !empty($_GET['city']) && $_GET['city'] != 'choose_city'){
    $arFiltermap['SECTION_ID']=$_GET['city'];
}

if(isset($_GET['type-mag']) && !empty($_GET['type-mag']) && $_GET['type-mag']!='all-shop' ){
    $arFiltermap['PROPERTY_TYPE_SHOP']=$_GET['type-mag'];
}

$mas= CIBlockElement::GetList(array(), $arFiltermap, false, false, array('ID', 'NAME', 'PROPERTY_MAP','PROPERTY_TYPE_SHOP',"IBLOCK_ID"));
$i=0;
while($row = $mas ->Fetch())
{
    $i++;


    $arTmp = explode(',', $row['PROPERTY_MAP_VALUE']); // т.к. координаты хранятся через запятую , разделим их

    //для центрирования ставим адрес первого машгазина если выбран город
    if( $i==1 && isset($_GET['city']) && !empty($_GET['city']) && $_GET['city'] != 'choose_city'){
        $arResult['POSITION']['yandex_lat']=$arTmp['0'];
        $arResult['POSITION']['yandex_lon']=$arTmp['1'];
    }

    $arResult['POSITION']['PLACEMARKS'][] = array(

        'LON' => $arTmp['1'],// LON и LAT - координаты элемента

        'LAT' => $arTmp['0'],

        'TEXT' =>$row['NAME'],// имя элемента, которое будет отображаться на метке

    );
}

?>
