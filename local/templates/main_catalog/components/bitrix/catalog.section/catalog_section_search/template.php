<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(true);
use \Bitrix\Main\Localization\Loc;
?>
<?
if (!empty($arResult['ITEMS'])) {
    $templateLibrary = array('popup');
    $currencyList = '';
    if (!empty($arResult['CURRENCIES'])) {
        $templateLibrary[] = 'currency';
        $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
    }
    $templateData = array(
        'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
        'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME'],
        'TEMPLATE_LIBRARY' => $templateLibrary,
        'CURRENCIES' => $currencyList
    );
    unset($currencyList, $templateLibrary);

    $skuTemplate = array();
    if (!empty($arResult['SKU_PROPS'])) {
        foreach ($arResult['SKU_PROPS'] as $arProp) {
            $propId = $arProp['ID'];
            $skuTemplate[$propId] = array(
                'SCROLL' => array(
                    'START' => '',
                    'FINISH' => '',
                ),
                'FULL' => array(
                    'START' => '',
                    'FINISH' => '',
                ),
                'ITEMS' => array()
            );
            $templateRow = '';
            if ('TEXT' == $arProp['SHOW_MODE']) {
                $skuTemplate[$propId]['SCROLL']['START'] = '<div class="bx_item_detail_size full" id="#ITEM#_prop_' . $propId . '_cont">' .
                    '<span class="bx_item_section_name_gray">' . htmlspecialcharsbx($arProp['NAME']) . '</span>' .
                    '<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_' . $propId . '_list" style="width: #WIDTH#;">';;
                $skuTemplate[$propId]['SCROLL']['FINISH'] = '</ul></div>' .
                    '<div class="bx_slide_left" id="#ITEM#_prop_' . $propId . '_left" data-treevalue="' . $propId . '" style=""></div>' .
                    '<div class="bx_slide_right" id="#ITEM#_prop_' . $propId . '_right" data-treevalue="' . $propId . '" style=""></div>' .
                    '</div></div>';

                $skuTemplate[$propId]['FULL']['START'] = '<div class="bx_item_detail_size" id="#ITEM#_prop_' . $propId . '_cont">' .
                    '<span class="bx_item_section_name_gray">' . htmlspecialcharsbx($arProp['NAME']) . '</span>' .
                    '<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_' . $propId . '_list" style="width: #WIDTH#;">';;
                $skuTemplate[$propId]['FULL']['FINISH'] = '</ul></div>' .
                    '<div class="bx_slide_left" id="#ITEM#_prop_' . $propId . '_left" data-treevalue="' . $propId . '" style="display: none;"></div>' .
                    '<div class="bx_slide_right" id="#ITEM#_prop_' . $propId . '_right" data-treevalue="' . $propId . '" style="display: none;"></div>' .
                    '</div></div>';
                foreach ($arProp['VALUES'] as $value) {
                    $value['NAME'] = htmlspecialcharsbx($value['NAME']);
                    $skuTemplate[$propId]['ITEMS'][$value['ID']] = '<li data-treevalue="' . $propId . '_' . $value['ID'] .
                        '" data-onevalue="' . $value['ID'] . '" style="width: #WIDTH#;" title="' . $value['NAME'] . '"><i></i><span class="cnt">' . $value['NAME'] . '</span></li>';
                }
                unset($value);
            } elseif ('PICT' == $arProp['SHOW_MODE']) {
                $skuTemplate[$propId]['SCROLL']['START'] = '<div class="bx_item_detail_scu full" id="#ITEM#_prop_' . $propId . '_cont">' .
                    '<span class="bx_item_section_name_gray">' . htmlspecialcharsbx($arProp['NAME']) . '</span>' .
                    '<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_' . $propId . '_list" style="width: #WIDTH#;">';
                $skuTemplate[$propId]['SCROLL']['FINISH'] = '</ul></div>' .
                    '<div class="bx_slide_left" id="#ITEM#_prop_' . $propId . '_left" data-treevalue="' . $propId . '" style=""></div>' .
                    '<div class="bx_slide_right" id="#ITEM#_prop_' . $propId . '_right" data-treevalue="' . $propId . '" style=""></div>' .
                    '</div></div>';

                $skuTemplate[$propId]['FULL']['START'] = '<div class="bx_item_detail_scu" id="#ITEM#_prop_' . $propId . '_cont">' .
                    '<span class="bx_item_section_name_gray">' . htmlspecialcharsbx($arProp['NAME']) . '</span>' .
                    '<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_' . $propId . '_list" style="width: #WIDTH#;">';
                $skuTemplate[$propId]['FULL']['FINISH'] = '</ul></div>' .
                    '<div class="bx_slide_left" id="#ITEM#_prop_' . $propId . '_left" data-treevalue="' . $propId . '" style="display: none;"></div>' .
                    '<div class="bx_slide_right" id="#ITEM#_prop_' . $propId . '_right" data-treevalue="' . $propId . '" style="display: none;"></div>' .
                    '</div></div>';
                foreach ($arProp['VALUES'] as $value) {
                    $value['NAME'] = htmlspecialcharsbx($value['NAME']);
                    $skuTemplate[$propId]['ITEMS'][$value['ID']] = '<li data-treevalue="' . $propId . '_' . $value['ID'] .
                        '" data-onevalue="' . $value['ID'] . '" style="width: #WIDTH#; padding-top: #WIDTH#;"><i title="' . $value['NAME'] . '"></i>' .
                        '<span class="cnt"><span class="cnt_item" style="background-image:url(\'' . $value['PICT']['SRC'] . '\');" title="' . $value['NAME'] . '"></span></span></li>';
                }
                unset($value);
            }
        }
        unset($templateRow, $arProp);
    }

    if ($arParams["DISPLAY_TOP_PAGER"]) {
        ?><? echo $arResult["NAV_STRING"]; ?><?
    }

    $strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
    $strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
    $arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

    if ($arParams['HIDE_SECTION_DESCRIPTION'] !== 'Y') { ?>
        <div class="bx-section-desc <? echo $templateData['TEMPLATE_CLASS']; ?>">
            <p class="bx-section-desc-post"><?= $arResult["DESCRIPTION"] ?></p>
        </div>
    <? } ?>
    <div class="row">
        <? $i = 0; ?>
        <?
        foreach ($arResult['ITEMS'] as $key => $arItem) {
            $i++;
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
            $strMainID = $this->GetEditAreaId($arItem['ID']);

            $arItemIDs = array(
                'ID' => $strMainID,
                'PICT' => $strMainID . '_pict',
                'SECOND_PICT' => $strMainID . '_secondpict',
                'STICKER_ID' => $strMainID . '_sticker',
                'SECOND_STICKER_ID' => $strMainID . '_secondsticker',
                'QUANTITY' => $strMainID . '_quantity',
                'QUANTITY_DOWN' => $strMainID . '_quant_down',
                'QUANTITY_UP' => $strMainID . '_quant_up',
                'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                'BUY_LINK' => $strMainID . '_buy_link',
                'BASKET_ACTIONS' => $strMainID . '_basket_actions',
                'NOT_AVAILABLE_MESS' => $strMainID . '_not_avail',
                'SUBSCRIBE_LINK' => $strMainID . '_subscribe',
                'COMPARE_LINK' => $strMainID . '_compare_link',

                'PRICE' => $strMainID . '_price',
                'DSC_PERC' => $strMainID . '_dsc_perc',
                'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',
                'PROP_DIV' => $strMainID . '_sku_tree',
                'PROP' => $strMainID . '_prop_',
                'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                'BASKET_PROP_DIV' => $strMainID . '_basket_prop',
            );

            $strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

            $productTitle = (
            isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
                ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
                : $arItem['NAME']
            );
            $imgTitle = (
            isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
                ? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
                : $arItem['NAME']
            );

            $minPrice = false;
            if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
                $minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);

            ?>

            <div class="col-xs-12 shopSearch__li" id="<? echo $strMainID; ?>">
                <div class="col-xs-12 col-md-2">
                    <img  id="<? echo $arItemIDs['PICT']; ?>" src="<? echo $arItem['PREVIEW_PICTURE_SRC']; ?>" alt="">
                                        
                    <?if ($arItem['SECOND_PICT']) {?>
                        <img class="second_pict" id="<? echo $arItemIDs['SECOND_PICT']; ?>" src="<? echo(
                        !empty($arItem['PREVIEW_PICTURE_SECOND'])
                            ? $arItem['PREVIEW_PICTURE_SECOND']['SRC']
                            : $arItem['PREVIEW_PICTURE']['SRC']
                        ); ?>" alt="">
                    <?}?>
                </div>
                <div class="col-xs-12 col-md-10">
                    <div class="col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-4 shopSearch__name">
                            <? echo $productTitle; ?>
                            <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">www.artelamp.ru<?echo $arItem['DETAIL_PAGE_URL']; ?></a>
                        </div>
                        <div class="col-xs-5 col-md-2 col-md-offset-3 shopSearch__price">
                            <div id="<? echo $arItemIDs['PRICE']; ?>" class="bx_price"><?
                                if (!empty($minPrice)) {
                                    if ($minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE']) {
                                        ?> <span><del><? echo $minPrice['PRINT_VALUE']; ?></del></span><?
                                    }
                                    if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])) {
                                        echo GetMessage(
                                            'CT_BCS_TPL_MESS_PRICE_SIMPLE_MODE',
                                            array(
                                                '#PRICE#' => $minPrice['PRINT_DISCOUNT_VALUE'],
                                                '#MEASURE#' => GetMessage(
                                                    'CT_BCS_TPL_MESS_MEASURE_SIMPLE_MODE',
                                                    array(
                                                        '#VALUE#' => $minPrice['CATALOG_MEASURE_RATIO'],
                                                        '#UNIT#' => $minPrice['CATALOG_MEASURE_NAME']
                                                    )
                                                )
                                            )
                                        );
                                    } else {?>
                                        <span><?echo $minPrice['PRINT_DISCOUNT_VALUE'];?></span>
                                    <? }

                                }

                            ?></div>
                        </div>
                        <div class="col-xs-7 col-md-3">
                                <? if ($arItem['CAN_BUY']) { ?>
                                    <div class="shopSearch__btn" id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>">
                                        <a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="bx_bt_button bx_medium"
                                           href="javascript:void(0)" rel="nofollow"><?
                                            if ($arParams['ADD_TO_BASKET_ACTION'] == 'BUY') {
                                                echo('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCS_TPL_MESS_BTN_BUY'));
                                            } else {
                                                echo('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? $arParams['MESS_BTN_ADD_TO_BASKET'] : GetMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET'));
                                            }
                                            ?></a></div>
                                    <?
                                } ?>
                        </div>
                     </div>
                    <div class="col-xs-12 col-md-12">
                        <p>
                            <?=$arItem['PREVIEW_TEXT']?>
                        </p>
                    </div>
                </div>

                <?
                
                    $arJSParams = array(
                        'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
                        'SHOW_QUANTITY' => ($arParams['USE_PRODUCT_QUANTITY'] == 'Y'),
                        'SHOW_ADD_BASKET_BTN' => false,
                        'SHOW_BUY_BTN' => true,
                        'SHOW_ABSENT' => true,
                        'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
                        'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
                        'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
                        'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
                        'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
                        'PRODUCT' => array(
                            'ID' => $arItem['ID'],
                            'NAME' => $productTitle,
                            'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
                            'CAN_BUY' => $arItem["CAN_BUY"],
                            'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
                            'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
                            'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
                            'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
                            'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
                            'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL'],
                            'BASIS_PRICE' => $arItem['MIN_BASIS_PRICE']
                        ),
                        'BASKET' => array(
                            'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
                            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                            'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
                            'EMPTY_PROPS' => $emptyProductProperties,
                            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
                            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
                        ),
                        'VISUAL' => array(
                            'ID' => $arItemIDs['ID'],
                            'PICT_ID' => ('Y' == $arItem['SECOND_PICT'] ? $arItemIDs['SECOND_PICT'] : $arItemIDs['PICT']),
                            'QUANTITY_ID' => $arItemIDs['QUANTITY'],
                            'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
                            'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
                            'PRICE_ID' => $arItemIDs['PRICE'],
                            'BUY_ID' => $arItemIDs['BUY_LINK'],
                            'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV'],
                            'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
                            'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
                            'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK']
                        ),
                        'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
                    );
                    if ($arParams['DISPLAY_COMPARE']) {
                        $arJSParams['COMPARE'] = array(
                            'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
                            'COMPARE_PATH' => $arParams['COMPARE_PATH']
                        );
                    }
                    unset($emptyProductProperties);
                    ?>
                    <script type="text/javascript">
                        var <? echo $strObName; ?> =
                        new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
                    </script>
            </div>

            <? unset($minPrice);
        }
        ?>
    </div>
    <script type="text/javascript">
        BX.message({
            BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
            BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
            ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
            TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
            TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
            TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
            BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
            BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
            BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
            BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
            COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
            COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
            COMPARE_TITLE: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
            SITE_ID: '<? echo SITE_ID; ?>'
        });
    </script>
    <hr>
    <hr>
    <div class="shopSearch__pagination">
        <?
        if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
            ?><? echo $arResult["NAV_STRING"]; ?><?
        }?>
    </div>
<?}
