<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


foreach($arResult['GRID']['ROWS'] as $item){

    unset($arrFilterDop['=ID']);
    GLOBAL $arrFilterDop;
    $arOrder = array("SORT" => "ASC", 'NAME' => 'ASC');
    $arFilter = array('ACTIVE' => 'Y', "IBLOCK_ID"=>19, 'PROPERTY_MAIN_OFFER'=>$item['PRODUCT_ID']);
    $arSelectFields = array("ID","IBLOCK_ID", "ACTIVE", "NAME","PROPERTY_MAIN_OFFER","PROPERTY_DOP_OFFER","PROPERTY_DOP_OFFER_COUNT");
    $rsElements = CIBlockElement::GetList($arOrder, $arFilter, FALSE, FALSE, $arSelectFields);
    while ($arElement = $rsElements->GetNext())
    {
        $arrFilterDop['=ID'][]=$arElement['PROPERTY_DOP_OFFER_VALUE'];
    }

?>

<?if(!empty($arrFilterDop)){?>
     
        <?$this->__template->SetViewTarget('basket-item-'.$item['ID']);?>
       <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "basket_recommend",
            Array(
                "ACTION_VARIABLE" => "action",
                "ADD_PICT_PROP" => "-",
                "ADD_PROPERTIES_TO_BASKET" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "ADD_TO_BASKET_ACTION" => "BUY",
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
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "ELEMENT_SORT_FIELD" => "sort",
                "ELEMENT_SORT_FIELD2" => "id",
                "ELEMENT_SORT_ORDER" => "asc",
                "ELEMENT_SORT_ORDER2" => "desc",
                "FILTER_NAME" => 'arrFilterDop',

                "SHOW_ALL_WO_SECTION" => "Y",
                "HIDE_NOT_AVAILABLE" => "N",
                "IBLOCK_ID" => "25",
                "IBLOCK_TYPE" => "catalog",
                "INCLUDE_SUBSECTIONS" => "Y",
                "LABEL_PROP" => "-",
                "LINE_ELEMENT_COUNT" => "4",
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
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Товары",
                "PAGE_ELEMENT_COUNT" => "3",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array("BASE", "Оптовая"),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPERTIES" => array(""),
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "",
                "PRODUCT_SUBSCRIPTION" => "N",
                "PROPERTY_CODE" => array("IP", "BREND", "VID_SVETILNIKA", "VYGRUZHAT_NA_SAYT", "BLOG_POST_ID", "CML2_ARTICLE", "CML2_BASE_UNIT", "VYSOTA_KOROBKI", "BLOG_COMMENTS_CNT", "CML2_MANUFACTURER", "CML2_TRAITS", "CML2_TAXES", "CML2_ATTRIBUTES", "CML2_BAR_CODE", "VYSOTA_SVETILNIKA", "GRUPPA_NA_SAYTE", "GRUPPA_TOVARA_AVS", "DIAMETR_SVETILNIKA", "DLINA_KOROBKI", "DLINA_SVETILNIKA", "IZGOTOVITEL", "INDEKS_MOSKVA", "INDEKS_PITER", "KOD_TAMOZHENNOY_GRUPPY", "KOLICHESTVO_LAMP", "KOLICHESTVO_PATRONOV", "LAMPAVKOMPLEKTE", "MATERIAL_ARMATURY", "MATERIAL_DLYA_INVOYSA", "MATERIAL_PLAFONA_DEKORA", "MINIMALNOE_KOLICHESTVO_V_UPAKOVKE", "MOSHCHNOST", "NAIMENOVANIE_DLYA_SAYTA", "NAPRYAZHENIE", "NOVINKA", "NOMER_SERTIFIKATA", "NOMERBLANKASERTIFIKATA", "ORGAN_PO_SERTIFIKATSII", "PATRON", "PORYADOK_SORTIROVKI_NA_SAYTE", "PRIMECHANIE", "RASPRODAZHA", "SEMEYSTVO", "SENSORNOE_VKLYUCHENIE", "SERIYA", "SERTIFIKATDEYSTVITELENDO", "SERTIFIKATDEYSTVITELENS", "STEKLO", "STIL_SVETILNIKA", "STRANITSAKATALOGARUS", "TAMOZHENNAYA_GRUPPA", "TIP_LAMPY", "TIP_LAMPY_ANGLIYSKIY", "TIP_SVETILNIKA", "TIP_SVETILNIKA_ANGLIYSKIY", "TIP_SVETILNIKA_UKRAINSKIY", "TOVARNAYA_GRUPPA", "TREBUET_SERTIFIKATSII", "TSVET_ARMATURY", "TSVET_PLAFONA", "TSVET_FONA_NA_SAYTE", "SHIRINA_KOROBKI", "SHIRINA_SVETILNIKA", "VES_NETTO", "V_KOROBKE_NESKOLKO_SHTUK", "VYKLYUCHATEL_V_KOMPLEKTE", "DLINATSEPIILISHNURA", "KLASS_ENERGOEFFEKTIVNOSTI", "KOMPLEKT_KOROBOK", "KREPLENIE", "MONTAZHNOE_OTVERSTIE", "RAZDELNOE_VKLYUCHENIE", "SVETOVOY_POTOK", "TOP_ASSORTIMENT", "_3D_MODEL", "DIAMETR_VREZNOGO_OTVERSTIYA_SM", "_PRIMECHANIYA", "_VID_IZDELIYA", "_IZGOTOVITEL", "_LAMPA", "_MATERIAL", "_RAZMERY", "_TOVARINTERNETMAGAZINA", "MATERIAL", "NE_KONTROLIROVAT_UPAKOVKU", "SROK_SLUZHBY", ""),
                "SECTION_CODE" => "",
                "SECTION_ID" => $_REQUEST["SECTION_ID"],
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => array("", ""),
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
                "USE_PRODUCT_QUANTITY" => "Y"
            )
        );

    }

    unset($item);
    ?>
    <?$this->__template->EndViewTarget();?>
<?}


?>