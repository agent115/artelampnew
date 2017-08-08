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
$this->setFrameMode(true);
//$this->addExternalCss("/bitrix/css/main/bootstrap.css");

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME'],
	'CURRENCIES' => CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true)
);
$curJsId = $this->randString();
?>

	<div id="bx-set-const-<?=$curJsId?>" class="row shopItem__set hidden-xs hidden-sm">
		<div class="col-md-12 shopItem__set-title">Купить набор</div>
		<div class="col-md-12 shopItem__set-list" data-role="set-items">
			<?//первый элемент набора сам товар  ?>


			<div class="col-md-2">
				<div class="col-md-6 shopItem__set-item">
					<?if ($arResult["ELEMENT"]["DETAIL_PICTURE"]["src"]):?>
						<img src="<?=$arResult["ELEMENT"]["DETAIL_PICTURE"]["src"]?>" alt="">
					<?else:?>
						<img src="<?=$this->GetFolder().'/images/no_foto.png'?>" alt="">
					<?endif?>
				</div>
				<p class="col-md-6">
					<?=$arResult["ELEMENT"]["NAME"]?> <br>
					<span><?=$arResult["ELEMENT"]["PRICE_PRINT_DISCOUNT_VALUE"]?></span>
				</p>
			</div>
			<div class="col-md-1"><em>+</em></div>

			<?$countEls=count($arResult["SET_ITEMS"]["DEFAULT"]);?>
			<?foreach($arResult["SET_ITEMS"]["DEFAULT"] as $key => $arItem):?>
			<div class="col-md-2"
				 data-id="<?=$arItem["ID"]?>"
				 data-img="<?=$arItem["DETAIL_PICTURE"]["src"]?>"
				 data-url="<?=$arItem["DETAIL_PAGE_URL"]?>"
				 data-name="<?=$arItem["NAME"]?>"
				 data-price="<?=$arItem["PRICE_DISCOUNT_VALUE"]?>"
				 data-print-price="<?=$arItem["PRICE_PRINT_DISCOUNT_VALUE"]?>"
				 data-old-price="<?=$arItem["PRICE_VALUE"]?>"
				 data-print-old-price="<?=$arItem["PRICE_PRINT_VALUE"]?>"
				 data-diff-price="<?=$arItem["PRICE_DISCOUNT_DIFFERENCE_VALUE"]?>"
				 data-measure="<?=$arItem["MEASURE"]["SYMBOL_RUS"]; ?>"
				 data-quantity="<?=$arItem["BASKET_QUANTITY"]; ?>"
			>
				<div class="col-md-6 shopItem__set-item">
					<?if ($arItem["DETAIL_PICTURE"]["src"]):?>
						<img src="<?=$arItem["DETAIL_PICTURE"]["src"]?>">
					<?else:?>
						<img src="<?=$this->GetFolder().'/images/no_foto.png'?>">
					<?endif?>
				</div>
				<p class="col-md-6">
					<?=$arItem["NAME"]?><br>
					<span><?= $arItem["PRICE_PRINT_DISCOUNT_VALUE"]?></span>
				</p>

			</div>
			<?if($key!=($countEls-1)){?>
				<div class="col-md-1"><em>+</em></div>
			<?}?>

			<?endforeach;?>
			<div class="col-md-1"><em>=</em></div>
			<div class="col-md-2">
				<div class="col-md-12">
					<div class="total-price" >
						<?=$arResult["TOTAL_PRICE"]?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="">
						<a href="javascript:void(0)" data-role="set-buy-btn" class="shopItem__set-btn  btn-add "><?=GetMessage("CATALOG_SET_BUY")?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?
$arJsParams = array(
	"numSliderItems" => count($arResult["SET_ITEMS"]["OTHER"]),
	"numSetItems" => count($arResult["SET_ITEMS"]["DEFAULT"]),
	"jsId" => $curJsId,
	"parentContId" => "bx-set-const-".$curJsId,
	"ajaxPath" => $this->GetFolder().'/ajax.php',
	"currency" => $arResult["ELEMENT"]["PRICE_CURRENCY"],
	"mainElementPrice" => $arResult["ELEMENT"]["PRICE_DISCOUNT_VALUE"],
	"mainElementOldPrice" => $arResult["ELEMENT"]["PRICE_VALUE"],
	"mainElementDiffPrice" => $arResult["ELEMENT"]["PRICE_DISCOUNT_DIFFERENCE_VALUE"],
	"mainElementBasketQuantity" => $arResult["ELEMENT"]["BASKET_QUANTITY"],
	"lid" => SITE_ID,
	"iblockId" => $arParams["IBLOCK_ID"],
	"basketUrl" => $arParams["BASKET_URL"],
	"setIds" => $arResult["DEFAULT_SET_IDS"],
	"offersCartProps" => $arParams["OFFERS_CART_PROPERTIES"],
	"itemsRatio" => $arResult["BASKET_QUANTITY"],
	"noFotoSrc" => $this->GetFolder().'/images/no_foto.png',
	"messages" => array(
		"EMPTY_SET" => GetMessage('CT_BCE_CATALOG_MESS_EMPTY_SET'),
		"ADD_BUTTON" => GetMessage("CATALOG_SET_BUTTON_ADD")
	)
);
?>
<script type="text/javascript">
	BX.ready(function(){
		new BX.Catalog.SetConstructor(<?=CUtil::PhpToJSObject($arJsParams, false, true, true)?>);
	});
</script>
<?//pp($arResult,true);?>