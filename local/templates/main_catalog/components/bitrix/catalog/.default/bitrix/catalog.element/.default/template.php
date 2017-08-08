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

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
    'ID' => $strMainID,
    'PICT' => $strMainID . '_pict',
    'DISCOUNT_PICT_ID' => $strMainID . '_dsc_pict',
    'STICKER_ID' => $strMainID . '_sticker',
    'BIG_SLIDER_ID' => $strMainID . '_big_slider',
    'BIG_IMG_CONT_ID' => $strMainID . '_bigimg_cont',
    'SLIDER_CONT_ID' => $strMainID . '_slider_cont',
    'SLIDER_LIST' => $strMainID . '_slider_list',
    'SLIDER_LEFT' => $strMainID . '_slider_left',
    'SLIDER_RIGHT' => $strMainID . '_slider_right',
    'OLD_PRICE' => $strMainID . '_old_price',
    'PRICE' => $strMainID . '_price',
    'DISCOUNT_PRICE' => $strMainID . '_price_discount',
    'SLIDER_CONT_OF_ID' => $strMainID . '_slider_cont_',
    'SLIDER_LIST_OF_ID' => $strMainID . '_slider_list_',
    'SLIDER_LEFT_OF_ID' => $strMainID . '_slider_left_',
    'SLIDER_RIGHT_OF_ID' => $strMainID . '_slider_right_',
    'QUANTITY' => $strMainID . '_quantity',
    'QUANTITY_DOWN' => $strMainID . '_quant_down',
    'QUANTITY_UP' => $strMainID . '_quant_up',
    'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
    'QUANTITY_LIMIT' => $strMainID . '_quant_limit',
    'BASIS_PRICE' => $strMainID . '_basis_price',
    'BUY_LINK' => $strMainID . '_buy_link',
    'ADD_BASKET_LINK' => $strMainID . '_add_basket_link',
    'BASKET_ACTIONS' => $strMainID . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $strMainID . '_not_avail',
    'COMPARE_LINK' => $strMainID . '_compare_link',
    'PROP' => $strMainID . '_prop_',
    'PROP_DIV' => $strMainID . '_skudiv',
    'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
    'OFFER_GROUP' => $strMainID . '_set_group_',
    'BASKET_PROP_DIV' => $strMainID . '_basket_prop',
);
$strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
    : $arResult['NAME']
);
$strAlt = (
isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
    : $arResult['NAME']
);
?>

<div class="row" id="<? echo $arItemIDs['ID']; ?>">
    <?
    reset($arResult['MORE_PHOTO']);
    $arFirstPhoto = current($arResult['MORE_PHOTO']);
    ?>
    <div class="col-md-1 col-xs-12" style="display: none">
        <?if($arResult['MIN_PRICE']['VALUE']>$arResult['MIN_PRICE']['DISCOUNT_VALUE']):?>
            <div class="col-xs-12 shopItem__bage shopItem__bage-percent"></div>
        <?endif;?>
        <? if ($arResult['PROPERTIES']['NOVINKA']['VALUE'] == 'да' || $arResult['PROPERTIES']['NOVINKA']['VALUE'] == 'Да'): ?>
            <div class="col-xs-12 shop__item-bage shop__item-bage--new"></div><?endif; ?>
        <? if ($arResult['PROPERTIES']['SALE']['VALUE'] == 'да' || $arResult['PROPERTIES']['SALE']['VALUE'] == 'Да'): ?>
            <div class="col-xs-12 indexCatalog__item-bage indexCatalog__item-bage--order"></div><?endif; ?>
        <? if ($arResult['PROPERTIES']['HIT']['VALUE'] == 'да' || $arResult['PROPERTIES']['HIT']['VALUE'] == 'Да'): ?>
            <div class="col-xs-12 indexCatalog__item-bage indexCatalog__item-bage--hit"></div>
        <?endif?>
        <? if ($arResult['PROPERTIES']['SHOW_ROOM']['VALUE'] == 'да' || $arResult['PROPERTIES']['SHOW_ROOM']['VALUE'] == 'Да'): ?>
            <div class="col-xs-12 indexCatalog__item-bage indexCatalog__item-bage--show"></div>
        <?endif?>
    </div>

    <div class="col-md-4 col-xs-12 gallery_slider">
        <div class="shopItem__gallery col-xs-12 cl">
            <div id="ninja-slider">
                <div class="slider-inner" id="<? echo $arItemIDs['BIG_SLIDER_ID']; ?>">
                <ul>
                    <? $i = 0; ?>
                    <? foreach ($arResult['MORE_PHOTO'] as $photo) {
                        $i++; ?>
                        <li>
                            <a class="fancybox ns-img" href="<?= $photo['SRC'] ?>">
                                <img <? if ($i == 1){ ?>id="<? echo $arItemIDs['PICT']; ?>"
                                     <? } ?>src="<?= $photo['SRC'] ?>" alt="">
                            </a>
                        </li>
                    <? } ?>

                </ul>
            </div>
        </div>
        <div id="thumbnail-slider">
            <div class="inner">
                <ul>
                    <? foreach ($arResult['MORE_PHOTO'] as $photo) { ?>
                        <li>
                            <a class="thumb" href="<?= $photo['SRC'] ?>"></a>
                        </li>
                    <? } ?>

                </ul>
            </div>
        </div>
        </div>
    </div>

    <div class="col-md-6 col-md-offset-1 col-xs-12">
        <div class="shopItem__info">
            <div class="shopItem__info-head">
                <div class="col-md-3">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/ARTE.png" alt="">
                </div>
                <div class="col-md-9">
                    <div class="shopItem__info-title"><?
					$productTitle = $arResult['NAME'];
					$productTitle = preg_replace_callback("/(.*)([^\s]+)\s([a-zA-Z0-9_\-]+)$/Uis", function ($matches) {
							return $matches[1].ucfirst($matches[2])." ".ToUpper($matches[3]);
						}, $productTitle);

					echo ($productTitle); ?></div>
                    <!--<div class="shopItem__info-quantity"><?=Loc::getMessage('CT_BCE_CATALOG_ON_SKLAD')?>: <?=$arResult['CATALOG_QUANTITY']?> <?=$arResult['CATALOG_MEASURE_NAME']?></div>-->
                    <div class="shopItem__info-quantity"><?=($arResult['CATALOG_QUANTITY'] > 0) ? 'в наличии' : ''?></div>
                </div>
            </div>
            <div class="shopItem__info-price">
                <div class="col-xs-12 col-md-5">
                    <?
                    $minPrice = (isset($arResult['RATIO_PRICE']) ? $arResult['RATIO_PRICE'] : $arResult['MIN_PRICE']);
                    $boolDiscountShow = (0 < $minPrice['DISCOUNT_DIFF']);
                    ?>
                    <?if($minPrice['PRINT_VALUE']>$minPrice['PRINT_DISCOUNT_VALUE']):?>
                        <del id="<? echo $arItemIDs['OLD_PRICE']; ?>"><?=$minPrice['PRINT_VALUE']?></del>
                    <?endif;?>
                    <big id="<? echo $arItemIDs['PRICE']; ?>"><? echo $minPrice['PRINT_DISCOUNT_VALUE']; ?></big>
                    <?if($minPrice['PRINT_VALUE']>$minPrice['PRINT_DISCOUNT_VALUE']):?>
                        <span id="<? echo $arItemIDs['DISCOUNT_PRICE']; ?>"><?=Loc::getMessage('CT_BCE_CATALOG_VIGODA');?> <?=$minPrice['DISCOUNT_DIFF_PERCENT']?> %</span>
                    <?endif;?>
                    <br>
                    <?unset($minPrice);?>
                   <!-- <div class="shopItem__info-price--btn"><a class="collection_link" href="/catalog/?COLLECTION=<?/*=$arResult['PROPERTIES']['SERIYA']['VALUE']*/?>">Вся коллекция</a></div>-->
                </div>
                <div class="col-xs-12 col-md-5 col-md-offset-1" id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>">
                    <div class="shopItem__info-btn shopItem__info-btn--inbasket"  id="<? echo $arItemIDs['ADD_BASKET_LINK']; ?>"><?=Loc::getMessage('CT_BCE_CATALOG_ADD')?></div>
                    <div class="shopItem__info-btn shopItem__info-btn--buyInOneClick" data-id-element="<?=$arResult['ID']?>" data-folder="<?=$templateFolder?>">Купить в 1 клик</div>
                </div>
            </div>
        </div>
    </div>

</div>

<?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor",
    "kit",
    array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ELEMENT_ID" => $arResult["ID"],
        "PRICE_CODE" => $arParams["PRICE_CODE"],
        "BASKET_URL" => $arParams["BASKET_URL"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "TEMPLATE_THEME" => $arParams['~TEMPLATE_THEME'],
        "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
        "CURRENCY_ID" => $arParams["CURRENCY_ID"]
    ),
    $component,
    array("HIDE_ICONS" => "Y")
);?>
    <div class="row shopItem__characteristics">
        <div class="col-md-9">
            <div class="shopItem__characteristics-title"><?=Loc::getMessage('CT_BCE_CATALOG_CHARACTERISTC')?></div>
            <div class="shopItem__table">
                <ul class="shopItem__table-menu">
                    <li class="col-xs-12 col-md-2 active" data-table="1"><?=Loc::getMessage('CT_BCE_CATALOG_CHARACTERISTC_MAIN')?></li>
                    <li class="col-xs-12 col-md-2" data-table="2"><?=Loc::getMessage('CT_BCE_CATALOG_CHARACTERISTC_VIEW')?></li>
                    <li class="col-xs-12 col-md-2" data-table="3"><?=Loc::getMessage('CT_BCE_CATALOG_CHARACTERISTC_ELECTRIC')?></li>
                    <li class="col-xs-12 col-md-2" data-table="4"><?=Loc::getMessage('CT_BCE_CATALOG_CHARACTERISTC_KOMPLECTATION')?></li>
                    <!--<li class="col-xs-12 col-md-3" data-table="5"><?/*=Loc::getMessage('CT_BCE_CATALOG_CHARACTERISTC_SERTIFICATION')*/?></li>-->
                </ul>
                <table id="table1" class="col-xs-12" cellpadding="0" cellspacing="0" width="90%" border="0">

                    <?if(!empty($arResult['PROPERTIES']['SERIYA']['VALUE'])){?>
                        <tr>
                            <td>Коллекция</td>
                            <td><?=$arResult['PROPERTIES']['SERIYA']['VALUE']?></td>
                        </tr>
                    <?}?>
                    <?if(!empty($arResult['PROPERTIES']['CML2_ARTICLE']['VALUE'])){?>
                    <tr>
                        <td><?=$arResult['PROPERTIES']['CML2_ARTICLE']['NAME']?></td>
                        <td><?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']?></td>
                    </tr>
                    <?}?>
                    <?if(!empty($arResult['PROPERTIES']['TIP_SVETILNIKA']['VALUE'])){?>
                    <tr>
                        <td><?=$arResult['PROPERTIES']['TIP_SVETILNIKA']['NAME']?></td>
                        <td><?=$arResult['PROPERTIES']['TIP_SVETILNIKA']['VALUE']?></td>
                    </tr>
                    <?}?>
                    <?if(!empty($arResult['PROPERTIES']['STIL_SVETILNIKA']['VALUE'])){?>
                    <tr>
                        <td><?=$arResult['PROPERTIES']['STIL_SVETILNIKA']['NAME']?></td>
                        <td><?=$arResult['PROPERTIES']['STIL_SVETILNIKA']['VALUE']?></td>
                    </tr>
                    <?}?>
                        <tr>
                            <td><?=Loc::getMessage('CT_BCE_CATALOG_PROP_COUNTRY_TITLE');?></td>
                            <td><?=Loc::getMessage('CT_BCE_CATALOG_PROP_COUNTRY_VALUE');?></td>
                        </tr>


                    <?//Коллекция нет свойства
                    /*if(!empty($arResult['PROPERTIES']['']['VALUE'])){?>
                          <tr>
                            <td>Коллекция</td>
                            <td>123</td>
                         </tr>
                    <?}*/?>

                    <?if(!empty($arResult['PROPERTIES']['CML2_ARTICLE']['VALUE'])){?>
                        <tr>
                            <td><?=Loc::getMessage('CT_BCE_CATALOG_PROP_CODE_GOOD_TITLE')?></td>
                            <td><?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']?></td>
                        </tr>
                    <?}?>
                         <tr>
                            <td><?=Loc::getMessage('CT_BCE_CATALOG_PROP_GARANTY_TITLE')?></td>
                            <td><?=Loc::getMessage('CT_BCE_CATALOG_PROP_GARANTY_VALUE')?></td>
                        </tr>




                </table>
                <table id="table2" class="col-xs-12" cellpadding="0" cellspacing="0" width="90%" border="0">
                    <tr>
                        <td><?=Loc::getMessage('CT_BCE_CATALOG_PROP_GABARITES_TITLE')?>
                        <?
                        //echo("<pre>propz:
                        //     ");
                        //foreach($arResult['PROPERTIES'] as $kk => $vv){
                        //    echo($kk.":".$vv['VALUE']."\n\r");    
                        //}
                        ////print_r($arResult['PROPERTIES']['WIDTH']);
                        //
                        //echo Cutil::translit("ширина","ru",array('change_case'=>'L'));
                        //echo Cutil::translit("длина","ru",array('change_case'=>'L'));
                        //echo Cutil::translit("высота","ru",array('change_case'=>'L'));
                        //echo Cutil::translit("диаметр","ru",array('change_case'=>'L'));
                        //echo("</pre>");
                                                
                        ?>
                        </td>
                        <td>                            
                            <? echo("Длина:".$arResult['PROPERTIES']['WIDTH']['VALUE']."<BR size=test>"); ?>                        
                        <?=$arResult['PROPERTIES']['DIAMETR_SVETILNIKA']['VALUE']?>, <?=$arResult['PROPERTIES']['DLINA_SVETILNIKA']['VALUE']?>x<?=$arResult['PROPERTIES']['SHIRINA_SVETILNIKA']['VALUE']?>x<?=$arResult['PROPERTIES']['VYSOTA_SVETILNIKA']['VALUE']?></td>
                    </tr>
                    <?if(!empty($arResult['PROPERTIES']['TSVET_PLAFONA']['VALUE'])){?>
                        <tr>
                            <td><?=$arResult['PROPERTIES']['TSVET_PLAFONA']['NAME']?></td>
                            <td><?=$arResult['PROPERTIES']['TSVET_PLAFONA']['VALUE']?></td>
                        </tr>
                    <?}?>
                    <?if(!empty($arResult['PROPERTIES']['TSVET_ARMATURY']['VALUE'])){?>
                        <tr>
                            <td><?=$arResult['PROPERTIES']['TSVET_ARMATURY']['NAME']?></td>
                            <td><?=$arResult['PROPERTIES']['TSVET_ARMATURY']['VALUE']?></td>
                        </tr>
                    <?}?>
                    <?if(!empty($arResult['PROPERTIES']['MATERIAL_ARMATURY']['VALUE'])){?>
                        <tr>
                            <td><?=$arResult['PROPERTIES']['MATERIAL_ARMATURY']['NAME']?></td>
                            <td><?=$arResult['PROPERTIES']['MATERIAL_ARMATURY']['VALUE']?></td>
                        </tr>
                    <?}?>


                </table>
                <table id="table3" class="col-xs-12" cellpadding="0" cellspacing="0" width="90%" border="0">
                    <?if(!empty($arResult['PROPERTIES']['NAPRYAZHENIE']['VALUE'])){?>
                        <tr>
                            <td><?=$arResult['PROPERTIES']['NAPRYAZHENIE']['NAME']?></td>
                            <td><?=$arResult['PROPERTIES']['NAPRYAZHENIE']['VALUE']?></td>
                        </tr>
                    <?}?>
                    <?if(!empty($arResult['PROPERTIES']['MOSHCHNOST']['VALUE'])){?>
                        <tr>
                            <td><?=$arResult['PROPERTIES']['MOSHCHNOST']['NAME']?></td>
                            <td><?=$arResult['PROPERTIES']['MOSHCHNOST']['VALUE']?></td>
                        </tr>
                    <?}?>
                    <?if(!empty($arResult['PROPERTIES']['KOLICHESTVO_LAMP']['VALUE'])){?>
                        <tr>
                            <td><?=$arResult['PROPERTIES']['KOLICHESTVO_LAMP']['NAME']?></td>
                            <td><?=$arResult['PROPERTIES']['KOLICHESTVO_LAMP']['VALUE']?></td>
                        </tr>
                    <?}?>
                   

                    <?if(!empty($arResult['PROPERTIES']['TIP_LAMPY']['VALUE'])){?>
                        <tr>
                            <td><?=$arResult['PROPERTIES']['TIP_LAMPY']['NAME']?></td>
                            <td><?=$arResult['PROPERTIES']['TIP_LAMPY']['VALUE']?></td>
                        </tr>
                    <?}?>
                </table>
                <table id="table4" class="col-xs-12" cellpadding="0" cellspacing="0" width="90%" border="0">
                    <?if(!empty($arResult['PROPERTIES']['LAMPAVKOMPLEKTE']['VALUE'])){?>
                        <tr>
                            <td><?=$arResult['PROPERTIES']['LAMPAVKOMPLEKTE']['NAME']?></td>
                            <td><?=$arResult['PROPERTIES']['LAMPAVKOMPLEKTE']['VALUE']?></td>
                        </tr>
                    <?}?>
                                   

                </table>
                <table id="table5" class="col-xs-12" cellpadding="0" cellspacing="0" width="90%" border="0">

                    <tr>

                            <td>
                                <?
                                //foreach($arResult['PROPERTIES']['SERT_IMAGES']['VALUE'] as $imageTitle ){
                                //    echo('
                                //<a href="/images/sertificates/'.$imageTitle'.jpg" target="_blank">
                                //    <img src="/images/sertificates/'.$imageTitle.'jpg" alt="">
                                //</a>');
                                //}
                                ?>
                            </td>


                    </tr>
                </table>
                <!--<a href=""><?/*=Loc::getMessage('CT_BCE_CATALOG_DOP_PARAMETERS_TITLE')*/?></a>-->
            </div>
        </div>
        <div class="col-md-3 shopItem__delivery">
            <ul>
                <li class="col-xs-12">
                    <span><?=Loc::getMessage('CT_BCE_CATALOG_DELIVERY_INFO')?></span>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/detail_page/delivery_info.php"
                        )
                    );?>

                </li>
                <li class="col-xs-12">
                    <span><?=Loc::getMessage('CT_BCE_CATALOG_PAYMENT_INFO')?></span>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/detail_page/payment_info.php"
                        )
                    );?>
                </li>
                <li class="col-xs-12">
                    <span><?=Loc::getMessage('CT_BCE_CATALOG_RETURN_INFO')?></span>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/detail_page/return_info.php"
                        )
                    );?>
                </li>
            </ul>
        </div>
    </div>
    <hr>
<?if(!empty($arResult['DETAIL_TEXT'])){?>
    <div class="row">
        <div class="shopItem__description col-md-12">
            <span><?=Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TITLE');?> </span>
            <p>
                <?=$arResult['DETAIL_TEXT']?>
            </p>
        </div>
    </div>
<?}?>
<?

    $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
    if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties) {
        ?>
        <div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
            <?
            if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
                foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {
                    ?>
                    <input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                           value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
                    <?
                    if (isset($arResult['PRODUCT_PROPERTIES'][$propID]))
                        unset($arResult['PRODUCT_PROPERTIES'][$propID]);
                }
            }
            $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
            if (!$emptyProductProperties) {
                ?>
                <table>
                    <?
                    foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo) {
                        ?>
                        <tr>
                            <td><? echo $arResult['PROPERTIES'][$propID]['NAME']; ?></td>
                            <td>
                                <?
                                if (
                                    'L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE']
                                    && 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']
                                ) {
                                    foreach ($propInfo['VALUES'] as $valueID => $value) {
                                        ?><label><input type="radio"
                                                        name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                                                        value="<? echo $valueID; ?>" <? echo($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?>
                                        </label><br><?
                                    }
                                } else {
                                    ?><select
                                    name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                                    foreach ($propInfo['VALUES'] as $valueID => $value) {
                                        ?>
                                        <option
                                        value="<? echo $valueID; ?>" <? echo($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option><?
                                    }
                                    ?></select><?
                                }
                                ?>
                            </td>
                        </tr>
                        <?
                    }
                    ?>
                </table>
                <?
            }
            ?>
        </div>
        <?
    }
    if ($arResult['MIN_PRICE']['DISCOUNT_VALUE'] != $arResult['MIN_PRICE']['VALUE']) {
        $arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'];
        $arResult['MIN_BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arResult['MIN_BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'];
    }
    $arJSParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => (isset($arResult['MIN_PRICE']) && !empty($arResult['MIN_PRICE']) && is_array($arResult['MIN_PRICE'])),
            'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] == 'Y'),
            'SHOW_OLD_PRICE' => ($arParams['SHOW_OLD_PRICE'] == 'Y'),
            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
            'SHOW_BASIS_PRICE' => ($arParams['SHOW_BASIS_PRICE'] == 'Y'),
            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
            'USE_STICKERS' => true,
        ),
        'VISUAL' => array(
            'ID' => $arItemIDs['ID'],
        ),
        'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'PICT' => $arFirstPhoto,
            'NAME' => $arResult['~NAME'],
            'SUBSCRIPTION' => true,
            'PRICE' => $arResult['MIN_PRICE'],
            'BASIS_PRICE' => $arResult['MIN_BASIS_PRICE'],
            'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
            'SLIDER' => $arResult['MORE_PHOTO'],
            'CAN_BUY' => $arResult['CAN_BUY'],
            'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
            'QUANTITY_FLOAT' => is_double($arResult['CATALOG_MEASURE_RATIO']),
            'MAX_QUANTITY' => $arResult['CATALOG_QUANTITY'],
            'STEP_QUANTITY' => $arResult['CATALOG_MEASURE_RATIO'],
        ),
        'BASKET' => array(
            'ADD_PROPS' => ($arParams['ADD_PROPERTIES_TO_BASKET'] == 'Y'),
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
            'EMPTY_PROPS' => $emptyProductProperties,
            'BASKET_URL' => $arParams['BASKET_URL'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        )
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
    new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
    BX.message({
        ECONOMY_INFO_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO'); ?>',
        BASIS_PRICE_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_BASIS_PRICE') ?>',
        TITLE_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
        TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
        BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
        BTN_SEND_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
        BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
        BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE'); ?>',
        BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
        TITLE_SUCCESSFUL: '<? echo GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK'); ?>',
        COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
        COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
        COMPARE_TITLE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
        BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
        PRODUCT_GIFT_LABEL: '<? echo GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL') ?>',
        SITE_ID: '<? echo SITE_ID; ?>'
    });
</script>

<? //pp($arResult,true);?>

