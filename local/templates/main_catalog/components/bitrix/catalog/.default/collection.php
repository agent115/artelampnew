<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);
//$this->addExternalCss("/bitrix/css/main/bootstrap.css");

if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '')
    $arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

$isVerticalFilter = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
$isSidebar = ($arParams["SIDEBAR_SECTION_SHOW"] == "Y" && isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));
$isFilter = ($arParams['USE_FILTER'] == 'Y');

if ($isFilter)
{
    $arFilter = array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ACTIVE" => "Y",
        "GLOBAL_ACTIVE" => "Y",
    );
    if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
        $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
    elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
        $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

    $obCache = new CPHPCache();
    if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
    {
        $arCurSection = $obCache->GetVars();
    }
    elseif ($obCache->StartDataCache())
    {
        $arCurSection = array();
        if (Loader::includeModule("iblock"))
        {
            $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

            if(defined("BX_COMP_MANAGED_CACHE"))
            {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache("/iblock/catalog");

                if ($arCurSection = $dbRes->Fetch())
                    $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

                $CACHE_MANAGER->EndTagCache();
            }
            else
            {
                if(!$arCurSection = $dbRes->Fetch())
                    $arCurSection = array();
            }
        }
        $obCache->EndDataCache($arCurSection);
    }
    if (!isset($arCurSection))
        $arCurSection = array();
}
?>

<section class="indexCatalog">
    <div class="container">
        <div class="row">
            <?$APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "breadcrumb",
                Array(
                    "PATH" => "",
                    "SITE_ID" => "s1",
                    "START_FROM" => "0"
                )
            );?>

        </div>
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-2">
                <aside class="indexCatalog__param">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.smart.filter",
                        "",
                        array(
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "SECTION_ID" => $arCurSection['ID'],
                            "FILTER_NAME" => $arParams["FILTER_NAME"],
                            "PRICE_CODE" => $arParams["PRICE_CODE"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "SAVE_IN_SESSION" => "N",
                            "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                            "XML_EXPORT" => "Y",
                            "SECTION_TITLE" => "NAME",
                            "SECTION_DESCRIPTION" => "DESCRIPTION",
                            'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                            "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                            "SEF_MODE" => $arParams["SEF_MODE"],
                            "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                            "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        ),
                        $component,
                        array('HIDE_ICONS' => 'Y')
                    );?>

                    <?$APPLICATION->IncludeComponent(
                        "adinadin:slider",
                        "catalog_left_slider",
                        array(
                            "BLOCK_ID" => "4",
                            "COUNT_ON_PAGE" => "",
                            "FIELDS" => array(
                                0 => "UF_ACTIVE",
                                1 => "UF_HREF",
                                2 => "UF_PICTURE",
                                3 => "UF_NAME",
                                4 => "",
                            ),
                            "FILTER_NAME" => "arrMainSliderFilter",
                            "IMAGE_FIELD" => "UF_PICTURE",
                            "IMG_HEIGHT" => "0",
                            "IMG_JPG_QUANTITY" => "95",
                            "IMG_RESIZE_METHOD" => "1",
                            "IMG_WIDTH" => "0",
                            "COMPONENT_TEMPLATE" => "mainSlider"
                        ),
                        false
                    );?>


                </aside>
            </div>



            <? GLOBAL $arrFilterCollection;
            $arrFilterCollection = array(
                'PROPERTY_SERIYA' => $_GET['COLLECTION'],
            ); ?>
            <? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"collection", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilterCollection",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "25",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "5",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "pagenavigation_catalog",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "15",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
			1 => "Оптовая",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "IP",
			1 => "BREND",
			2 => "VID_SVETILNIKA",
			3 => "VYGRUZHAT_NA_SAYT",
			4 => "BLOG_POST_ID",
			5 => "CML2_ARTICLE",
			6 => "CML2_BASE_UNIT",
			7 => "VYSOTA_KOROBKI",
			8 => "BLOG_COMMENTS_CNT",
			9 => "CML2_MANUFACTURER",
			10 => "CML2_TRAITS",
			11 => "CML2_TAXES",
			12 => "CML2_ATTRIBUTES",
			13 => "CML2_BAR_CODE",
			14 => "VYSOTA_SVETILNIKA",
			15 => "GRUPPA_NA_SAYTE",
			16 => "GRUPPA_TOVARA_AVS",
			17 => "DIAMETR_SVETILNIKA",
			18 => "DLINA_KOROBKI",
			19 => "DLINA_SVETILNIKA",
			20 => "IZGOTOVITEL",
			21 => "INDEKS_MOSKVA",
			22 => "INDEKS_PITER",
			23 => "KOD_TAMOZHENNOY_GRUPPY",
			24 => "KOLICHESTVO_LAMP",
			25 => "KOLICHESTVO_PATRONOV",
			26 => "LAMPAVKOMPLEKTE",
			27 => "MATERIAL_ARMATURY",
			28 => "MATERIAL_DLYA_INVOYSA",
			29 => "MATERIAL_PLAFONA_DEKORA",
			30 => "MINIMALNOE_KOLICHESTVO_V_UPAKOVKE",
			31 => "MOSHCHNOST",
			32 => "NAIMENOVANIE_DLYA_SAYTA",
			33 => "NAPRYAZHENIE",
			34 => "NOVINKA",
			35 => "NOMER_SERTIFIKATA",
			36 => "NOMERBLANKASERTIFIKATA",
			37 => "ORGAN_PO_SERTIFIKATSII",
			38 => "PATRON",
			39 => "PORYADOK_SORTIROVKI_NA_SAYTE",
			40 => "PRIMECHANIE",
			41 => "RASPRODAZHA",
			42 => "SEMEYSTVO",
			43 => "SENSORNOE_VKLYUCHENIE",
			44 => "SERIYA",
			45 => "SERTIFIKATDEYSTVITELENDO",
			46 => "SERTIFIKATDEYSTVITELENS",
			47 => "STEKLO",
			48 => "STIL_SVETILNIKA",
			49 => "STRANITSAKATALOGARUS",
			50 => "TAMOZHENNAYA_GRUPPA",
			51 => "TIP_LAMPY",
			52 => "TIP_LAMPY_ANGLIYSKIY",
			53 => "TIP_SVETILNIKA",
			54 => "TIP_SVETILNIKA_ANGLIYSKIY",
			55 => "TIP_SVETILNIKA_UKRAINSKIY",
			56 => "TOVARNAYA_GRUPPA",
			57 => "TREBUET_SERTIFIKATSII",
			58 => "TSVET_ARMATURY",
			59 => "TSVET_PLAFONA",
			60 => "TSVET_FONA_NA_SAYTE",
			61 => "SHIRINA_KOROBKI",
			62 => "SHIRINA_SVETILNIKA",
			63 => "VES_NETTO",
			64 => "V_KOROBKE_NESKOLKO_SHTUK",
			65 => "VYKLYUCHATEL_V_KOMPLEKTE",
			66 => "DLINATSEPIILISHNURA",
			67 => "KLASS_ENERGOEFFEKTIVNOSTI",
			68 => "KOMPLEKT_KOROBOK",
			69 => "KREPLENIE",
			70 => "MONTAZHNOE_OTVERSTIE",
			71 => "RAZDELNOE_VKLYUCHENIE",
			72 => "SVETOVOY_POTOK",
			73 => "TOP_ASSORTIMENT",
			74 => "_3D_MODEL",
			75 => "DIAMETR_VREZNOGO_OTVERSTIYA_SM",
			76 => "_PRIMECHANIYA",
			77 => "_VID_IZDELIYA",
			78 => "_IZGOTOVITEL",
			79 => "_LAMPA",
			80 => "_MATERIAL",
			81 => "_RAZMERY",
			82 => "_TOVARINTERNETMAGAZINA",
			83 => "MATERIAL",
			84 => "NE_KONTROLIROVAT_UPAKOVKU",
			85 => "SROK_SLUZHBY",
			86 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "collection"
	),
	false
); ?>

            <?



            ?>
        </div>
        <hr>
        <hr>
        <div class="row indexCatalog__article">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/main_catalog_template/catalog_info.php"
                )
            );?>


        </div>

    </div>

</section>
