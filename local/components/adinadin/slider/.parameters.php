<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

use Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use AdinAdin\Artelamp\HLAdditional;
Loc::loadMessages(__FILE__);

if (!Loader::includeModule('adinadin.artelamp'))
	die();

$hlAddtional = HLAdditional::getInstance();
$HLList = $hlAddtional->getHLList();
$HLFormatedList = array();
$i = 0;
foreach ($HLList as $hl) {
    $i++;
    $HLFormatedList[$hl['ID']] = $hl['NAME'].'['.$hl['ID'].']';
    if ((!isset($arCurrentValues['BLOCK_ID']) || empty($arCurrentValues['BLOCK_ID'])) && $i == 1)
        $arCurrentValues['BLOCK_ID'] = $hl['ID'];
}
if (intval($arCurrentValues['BLOCK_ID']) > 0) {
    $HLFormatedListProps = array();
	$params = array('HL_ID' => $arCurrentValues['BLOCK_ID']);
    $HLFields = $hlAddtional->getHLFields($params);
    foreach ($HLFields as $field) {
        $HLFormatedListProps[$field['CODE']] = $field['NAME'].'['.$field['CODE'].']';
    }
}

$arResizesMethods = array(
    BX_RESIZE_IMAGE_EXACT => Loc::getMessage('RESIZE_IMG_METHOD_BX_RESIZE_IMAGE_EXACT'),
    BX_RESIZE_IMAGE_PROPORTIONAL => Loc::getMessage('RESIZE_IMG_METHOD_BX_RESIZE_IMAGE_PROPORTIONAL'),
    BX_RESIZE_IMAGE_PROPORTIONAL_ALT => Loc::getMessage('RESIZE_IMG_METHOD_BX_RESIZE_IMAGE_PROPORTIONAL_ALT'),
);

$arComponentParameters = array(
	"GROUPS" => array(
        "RESIZE_SETTINGS" => array(
            "NAME" => Loc::getMessage('RESIZE_SETTINGS')
        ),
	),
	"PARAMETERS" => array(
        "BLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage('SLIDER_BLOCK_ID'),
            "TYPE" => "LIST",
            "VALUES" => $HLFormatedList,
            "REFRESH" => "Y",
        ),
        "FIELDS" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage('SLIDER_BLOCK_FIELDS'),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "MULTIPLE" => "Y",
            "SIZE" => (count($arProperty) > 5 ? 8 : 3),
            "VALUES" => $HLFormatedListProps,
        ),
        "IMAGE_FIELD" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage('SLIDER_BLOCK_FIELD_IMAGE'),
            "TYPE" => "LIST",
            "SIZE" => 1,
            "VALUES" => $HLFormatedListProps,
            "DEFAULT" => 'UF_IMAGE'
        ),
		"FILTER_NAME" => array(
			"PARENT" => "BASE",
			"TYPE" => 'STRING',
			"NAME" => Loc::getMessage('SLIDER_BLOCK_FILTER_NAME'),
			"DEFAULT" => 'arrSliderFilter'
		),
		"COUNT_ON_PAGE" => array(
			"PARENT" => "BASE",
			"TYPE" => 'STRING',
			"NAME" => Loc::getMessage('SLIDER_BLOCK_COUNT_ON_PAGE'),
			"DEFAULT" => ''
		),
        "IMG_WIDTH" => array(
            "PARENT" => "RESIZE_SETTINGS",
            "NAME" => Loc::getMessage("RESIZE_IMG_WIDTH"),
            "TYPE" => "STRING",
            "DEFAULT" => "0",
        ),
        "IMG_HEIGHT" => array(
            "PARENT" => "RESIZE_SETTINGS",
            "NAME" => Loc::getMessage("RESIZE_IMG_HEIGHT"),
            "TYPE" => "STRING",
            "DEFAULT" => "0",
        ),
        "IMG_RESIZE_METHOD" => array(
            "PARENT" => "RESIZE_SETTINGS",
            "NAME" => Loc::getMessage("RESIZE_IMG_METHOD"),
            "TYPE" => "LIST",
            "VALUES" => $arResizesMethods,
            "SIZE" => 1,
            "DEFAULT" => BX_RESIZE_IMAGE_PROPORTIONAL,
        ),
        "IMG_JPG_QUANTITY" => array(
            "PARENT" => "RESIZE_SETTINGS",
            "NAME" => Loc::getMessage("RESIZE_IMG_JPG_QUANTITY"),
            "TYPE" => "STRING",
            "DEFAULT" => "95",
        ),
	),
);