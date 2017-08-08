<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$frame = $this->createFrame()->begin("");

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
    'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME']
);

$injectId = 'bigdata_recommeded_products_' . rand();

?>

    <script type="text/javascript">
        BX.cookie_prefix = '<?=CUtil::JSEscape(COption::GetOptionString("main", "cookie_name", "BITRIX_SM"))?>';
        BX.cookie_domain = '<?=$APPLICATION->GetCookieDomain()?>';
        BX.current_server_time = '<?=time()?>';

        BX.ready(function () {
            bx_rcm_recommendation_event_attaching(BX('<?=$injectId?>_items'));
        });

    </script>

<?

if (isset($arResult['REQUEST_ITEMS'])) {
    CJSCore::Init(array('ajax'));

    // component parameters
    $signer = new \Bitrix\Main\Security\Sign\Signer;
    $signedParameters = $signer->sign(
        base64_encode(serialize($arResult['_ORIGINAL_PARAMS'])),
        'bx.bd.products.recommendation'
    );
    $signedTemplate = $signer->sign($arResult['RCM_TEMPLATE'], 'bx.bd.products.recommendation');

    ?>

    <span id="<?=$injectId?>" class="bigdata_recommended_products_container"></span>

    <script type="text/javascript">
        BX.ready(function () {
            bx_rcm_get_from_cloud(
                '<?=CUtil::JSEscape($injectId)?>',
                <?=CUtil::PhpToJSObject($arResult['RCM_PARAMS'])?>,
                {
                    'parameters': '<?=CUtil::JSEscape($signedParameters)?>',
                    'template': '<?=CUtil::JSEscape($signedTemplate)?>',
                    'site_id': '<?=CUtil::JSEscape(SITE_ID)?>',
                    'rcm': 'yes'
                }
            );
        });
    </script>

    <?
    $frame->end();

    return;
}

if (!empty($arResult['ITEMS']))
{
    ?>
    <script type="text/javascript">
        BX.message({
            CBD_MESS_BTN_BUY: '<? echo('' !=
            $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CVP_TPL_MESS_BTN_BUY')); ?>',
            CBD_MESS_BTN_ADD_TO_BASKET: '<? echo('' !=
            $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CVP_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',

            CBD_MESS_BTN_DETAIL: '<? echo('' !=
            $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('CVP_TPL_MESS_BTN_DETAIL')); ?>',

            CBD_MESS_NOT_AVAILABLE: '<? echo('' !=
            $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('CVP_TPL_MESS_BTN_DETAIL')); ?>',
            CBD_BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
            BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
            CBD_ADD_TO_BASKET_OK: '<? echo GetMessageJS('CVP_ADD_TO_BASKET_OK'); ?>',
            CBD_TITLE_ERROR: '<? echo GetMessageJS('CVP_CATALOG_TITLE_ERROR') ?>',
            CBD_TITLE_BASKET_PROPS: '<? echo GetMessageJS('CVP_CATALOG_TITLE_BASKET_PROPS') ?>',
            CBD_TITLE_SUCCESSFUL: '<? echo GetMessageJS('CVP_ADD_TO_BASKET_OK'); ?>',
            CBD_BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CVP_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
            CBD_BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
            CBD_BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_CLOSE') ?>'
        });
    </script>
    <span id="<?=$injectId?>_items" class="bigdata_recommended_products_items">
	<input type="hidden" name="bigdata_recommendation_id" value="<?=htmlspecialcharsbx($arResult['RID'])?>">
        <div class="row" style="margin-top: 20px">
            <div class="shopItem__collection">
                <div class="shopItem__collection-title">Вся коллекция</div>
                    <div class="swiper-container swiper-container3">
                        <div class="shopItem__items swiper-wrapper recommended_products_container">
                    <?

                    //echo '<pre>', print_r($arResult, true), '</pre>';
                    foreach ($arResult['ITEMS'] as $key => $arItem) {
                        $strMainID = $this->GetEditAreaId($arItem['ID'] . $key);
                        $arItemIDs = array(
                            'ID' => $strMainID,
                            'PICT' => $strMainID . '_pict',
                            'SECOND_PICT' => $strMainID . '_secondpict',
                            'MAIN_PROPS' => $strMainID . '_main_props',

                            'QUANTITY' => $strMainID . '_quantity',
                            'QUANTITY_DOWN' => $strMainID . '_quant_down',
                            'QUANTITY_UP' => $strMainID . '_quant_up',
                            'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                            'BUY_LINK' => $strMainID . '_buy_link',
                            'BASKET_ACTIONS' => $strMainID . '_basket_actions',
                            'NOT_AVAILABLE_MESS' => $strMainID . '_not_avail',
                            'SUBSCRIBE_LINK' => $strMainID . '_subscribe',

                            'PRICE' => $strMainID . '_price',
                            'DSC_PERC' => $strMainID . '_dsc_perc',
                            'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',

                            'PROP_DIV' => $strMainID . '_sku_tree',
                            'PROP' => $strMainID . '_prop_',
                            'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                            'BASKET_PROP_DIV' => $strMainID . '_basket_prop'
                        );

                        $strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

                        $strTitle = (
                        isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) &&
                        '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
                            ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
                            : $arItem['NAME']
                        );
                        $showImgClass = $arParams['SHOW_IMAGE'] != "Y" ? "no-imgs" : "";

                        ?>
                        <div class="swiper-slide col-xs-12 col-md-3 shopItem__items-item " id="<? echo $strMainID; ?>"
                             data-product-id="<?=$arItem['ID']?>"
                             style="background-image: url('<? echo($arParams['SHOW_IMAGE'] ==
                             "Y" ? $arItem['PREVIEW_PICTURE']['SRC'] : ""); ?>')">
                            <div id="<? echo $arItemIDs['PICT']; ?>"></div>
                            <p><a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"
                                  class=" shopItem__items-name"><? echo $arItem['NAME']; ?></a></p>
                            <div class="shopItem__items-price">
                                <div class="col-xs-12 text-center" id="<? echo $arItemIDs['PRICE']; ?>">
                                    <? if ($arItem['MIN_PRICE']['DISCOUNT_VALUE'] < $arItem['MIN_PRICE']['VALUE']):?>
                                        <del><?=$arItem['MIN_PRICE']['PRINT_VALUE'];?></del>
                                    <?endif; ?>
                                    <span><?=$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];?></span>
                                </div>
                                <a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="col-xs-10 shopItem__items-btn"
                                   href="javascript:void(0)" rel="nofollow"><?
                                    echo('' !=
                                    $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCS_TPL_MESS_BTN_BUY'));
                                    ?></a>

                            </div>
                            <div class="shopItem__items-bage shopItem__items-bage--order"></div>
                        </div>




                           <?
                    if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS'])) // Simple Product
                    {

                    $arJSParams = array(
                        'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
                        'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
                        'SHOW_ADD_BASKET_BTN' => false,
                        'SHOW_BUY_BTN' => true,
                        'SHOW_ABSENT' => true,
                        'PRODUCT' => array(
                            'ID' => $arItem['ID'],
                            'NAME' => $arItem['~NAME'],
                            'PICT' => $arItem['PREVIEW_PICTURE'],
                            //('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
                            'CAN_BUY' => $arItem["CAN_BUY"],
                            'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
                            'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
                            'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
                            'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
                            'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
                            'ADD_URL' => $arItem['~ADD_URL'],
                            'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL']
                        ),
                        'BASKET' => array(
                            'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
                            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                            'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
                            'EMPTY_PROPS' => $emptyProductProperties
                        ),
                        'VISUAL' => array(
                            'ID' => $arItemIDs['ID'],
                            'PICT_ID' => $arItemIDs['PICT'],
                            // ('Y' == $arItem['SECOND_PICT'] ? $arItemIDs['SECOND_PICT'] : $arItemIDs['PICT']),
                            'QUANTITY_ID' => $arItemIDs['QUANTITY'],
                            'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
                            'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
                            'PRICE_ID' => $arItemIDs['PRICE'],
                            'BUY_ID' => $arItemIDs['BUY_LINK'],
                            'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV']
                        ),
                        'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
                    );
                    ?>

						<script type="text/javascript">
                                    var <? echo $strObName; ?> =
                                    new JCCatalogBigdataProducts(<? echo CUtil::PhpToJSObject($arJSParams,
                                        false,
                                        true); ?>);
                                </script><?
                    }

                        ?><?
                    }
                    ?>

                        </div>
                    </div>

            </div>
        </div>
	</span>
    <script>
        //var href_collection = $('.collection_link').attr('href');
        //if (href_collection) {
        //	$('.recommend_collection_link').attr('href', href_collection);
        //}

    </script>
    <?
}

$frame->end();
