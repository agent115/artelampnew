<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Сотрудники");
?>
<section class="company">
    <div class="container">
        <div class="row">
            <hr>
            <div class="text-center">
                <div class="company__title">Сотрудники</div>
            </div>
        </div>

        <? $arSort = array("SORT" => "ASC");
        $arFilter = array("IBLOCK_ID" => 12);
        $arSelect = array('ID', 'NAME');
        $rsSections = CIBlockSection::GetList($arSort, $arFilter, false, $arSelect);
        while ($arSection = $rsSections->GetNext()) {
            $arSections[] = $arSection;
        } ?>
        <? $countSections = count($arSections); ?>
        <? $i = 1; ?>

        <? foreach ($arSections as $section) { ?>
            <?
            GLOBAL $arrFilterSert;
            $arrFilterSert['SECTION_ID'] = $section['ID'];
            if (isset($_GET['ALL']) && $section['ID'] == $_GET['ALL']) {
                $countEl = 1000;
            } else {
                $countEl = 4;
            }
            ?>
            <div class="row">
                <div class="company__subtitle col-md-12"><?= $section['NAME'] ?></div>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "workers_list",
                    array(
                        "COMPONENT_TEMPLATE" => "workers_list",
                        "IBLOCK_TYPE" => "news",
                        "IBLOCK_ID" => "12",
                        "NEWS_COUNT" => $countEl,
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "DESC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "arrFilterSert",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "EMAIL",
                            1 => "APPOITNMENT",
                            2 => "PHONE",
                            3 => "",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "N",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "j F Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "Y",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => ""
                    ),
                    false
                ); ?>
                <div class="col-md-12 text-center">
                    <div class="company__btn"><a href="<?= $APPLICATION->getCurPage() ?>?ALL=<?= $section['ID'] ?>">Все
                            сотрудники</a></div>
                </div>
            </div>
            <? if ($countSections != $i) { ?>
                <hr>
                <hr>
            <? } ?>
            <? $i++;
            unset($arrFilterSert);
            ?>
        <? } ?>
        <div class="row">
            <div class="col-md-12 company__subtitle">Работа в компании</div>
            <div class="col-md-12 company__h3">
                Если вы хотите раблотать в нашей компании, пришлите нам свое резюме!
            </div>
            <div class="col-md-12">
                <div class="form">
                    <? $APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form", 
	"resume_form", 
	array(
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "Имя соискателя",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array(
			0 => "2",
		),
		"IBLOCK_ID" => "13",
		"IBLOCK_TYPE" => "form_result",
		"LEVEL_LAST" => "N",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(
			0 => "152",
			1 => "153",
			2 => "154",
			3 => "155",
			4 => "NAME",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "152",
			1 => "153",
			2 => "154",
			3 => "155",
			4 => "NAME",
		),
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "Спасибо, Ваше резюме принято.",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "Y",
		"COMPONENT_TEMPLATE" => "resume_form"
	),
	false
); ?>
                </div>
            </div>
        </div>

    </div>
</section>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
