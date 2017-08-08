<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = array(
    "NAME" => Loc::getMessage("SLIDER_NAME"),
    "DESCRIPTION" => Loc::getMessage("SLIDER_DESCRIPTION"),
    //"ICON" => "/images/cat_detail.gif",
    "CACHE_PATH" => "Y",
    "SORT" => 5,
    "PATH" => array(
        "ID" => "adinadin",
        "NAME" => Loc::getMessage("ADINADIN"),
        "CHILD" => array(
            "ID" => "hl_slider",
            "NAME" => Loc::getMessage("CATEGORY_SLIDER_NAME"),
            "SORT" => 10,
        ),
    ),
);

?>