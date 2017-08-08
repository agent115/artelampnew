<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$bDefaultColumns = $arResult["GRID"]["DEFAULT_COLUMNS"];
$colspan = ($bDefaultColumns) ? count($arResult["GRID"]["HEADERS"]) : count($arResult["GRID"]["HEADERS"]) - 1;
$bPropsColumn = false;
$bUseDiscount = false;
$bPriceType = false;
$bShowNameWithPicture = ($bDefaultColumns) ? true : false; // flat to show name and picture column in one column
?>
<div class="col-xs-12 col-md-5 col-md-offset-2 yourOrder">
	<div class="yourOrder__title"><?=GetMessage("SALE_PRODUCTS_SUMMARY");?></div>

	<table class="yourOrder__list" width="100%" cellspacing="0" cellpadding="0" border="0">
		<?foreach ($arResult["GRID"]["ROWS"] as $k => $arData):?>
		<tr>
			<td>
				<a href=""><?=$arData["data"]['NAME']?></a>
				<div class="yourOrder__list-img">
					<img src="<?=$arData["data"]['DETAIL_PICTURE_SRC']?>" alt="">
				</div>
			</td>
			<td class="yourOrder__var"><?=$arData["data"]["SUM"]?></td>
		</tr>
		<?endforeach;?>
	</table>
	<table class="yourOrder__summ" width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td>Товаров на сумму:</td>
			<td><span class="yourOrder__varSumm"><?=$arResult["ORDER_PRICE_FORMATED"]?></span></td>
		</tr>
		<tr class="develiry">
			<td>
                <?foreach ($arResult["DELIVERY"] as $del):?>
                    <?if($del["CHECKED"] == "Y"):?>
                        <?=$del["NAME"]?>
                        <?continue?>
                    <?endif;?>
                <?endforeach;?>

				<p>
					Адрес доставки: <span class="city"></span> <br><span class="address"><?=$arResult['ORDER_DATA']['ORDER_PROP'][7]?></span>
				</p>
			</td>
			<td><span class="yourOrder__var4"><?=$arResult["DELIVERY_PRICE_FORMATED"]?></span></td>
		</tr>
	</table>
	<table class="yourOrder__payment" width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td>К оплате:</td>
			<td><span class="yourOrder__allSumm"><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></span></td>
		</tr>
		<tr>
			<td>Оплата:</td>
			<td>
				<span class="pay">
					<?foreach($arResult['PAY_SYSTEM'] as $arPaysystem):?>
						<?if($arPaysystem['CHECKED']=="Y"):?>
							<?=$arPaysystem['NAME'];?>
						<?endif;?>
					<?endforeach;?>
				</span>
			</td>
		</tr>
	</table>
</div>
