<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
use Bitrix\Sale\DiscountCouponsManager;

if (!empty($arResult["ERROR_MESSAGE"]))
	ShowError($arResult["ERROR_MESSAGE"]);

$bDelayColumn  = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn  = false;
$bPriceType    = false;

if ($normalCount > 0):
?><div id="basket_items_list">
	<div class="bx_ordercart_order_table_container">
		<div id="basket_items">
			<div>
				<div class="table_headers">
					<div class="margin"></div>
					<?
					foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
						$arHeader["name"] = (isset($arHeader["name"]) ? (string)$arHeader["name"] : '');
						if ($arHeader["name"] == '')
							$arHeader["name"] = GetMessage("SALE_".$arHeader["id"]);
						$arHeaders[] = $arHeader["id"];

						// remember which values should be shown not in the separate columns, but inside other columns
						if (in_array($arHeader["id"], array("TYPE")))
						{
							$bPriceType = true;
							continue;
						}
						elseif ($arHeader["id"] == "PROPS")
						{
							$bPropsColumn = true;
							continue;
						}
						elseif ($arHeader["id"] == "DELAY")
						{
							$bDelayColumn = true;
							continue;
						}
						elseif ($arHeader["id"] == "DELETE")
						{
							$bDeleteColumn = true;
							continue;
						}
						elseif ($arHeader["id"] == "WEIGHT")
						{
							$bWeightColumn = true;
						}

						if ($arHeader["id"] == "NAME"):
						?>
							<div class="item" colspan="2" id="col_<?=$arHeader["id"];?>">
						<?
						elseif ($arHeader["id"] == "PRICE"):
						?>
							<div class="price" id="col_<?=$arHeader["id"];?>">
						<?
						else:
						?>
							<div class="custom" id="col_<?=$arHeader["id"];?>">
						<?
						endif;
						?>
							<?=$arHeader["name"];?>
							</div>
					<?
					endforeach;

					if ($bDeleteColumn || $bDelayColumn):
					?>
						<div class="custom"></div>
					<?
					endif;
					?>
						<div class="margin"></div>
				</div>
			</div>


				<?
				foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):

					if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y"):
				?>
				<ul id="<?=$arItem["ID"]?>" class="col-xs-12 col-md-12 tr">
				

				<li class="basket__item col-md-12">

					<div class="col-md-2">
					<?if (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
											$url = $arItem["PREVIEW_PICTURE_SRC"];
										elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
											$url = $arItem["DETAIL_PICTURE_SRC"];
										else:
											$url = $templateFolder."/images/no_photo.png";
										endif;?>
						<a href="<?=$arItem[DETAIL_PAGE_URL]?>"><img src="<?=$url?>" alt=""></a>
					</div>
					<div class="col-md-4 basket__item-cena">
						<span><?
$productTitle = $arItem["NAME"]; 

$productTitle = preg_replace_callback("/(.*)([^\s]+)\s([a-zA-Z0-9_\-]+)$/Uis", function ($matches) {
            return $matches[1].ucfirst($matches[2])." ".ToUpper($matches[3]);
        }, $productTitle);

echo("<a href=".$arItem[DETAIL_PAGE_URL].">".$productTitle."</a>");
?></span>
						<p><?=$arItem["PREVIEW_TEXT"]?></p>
						<em>
						<?if (floatval($arItem["DISCOUNT_PRICE_PERCENT"]) > 0):?>
							<del id="old_price_<?=$arItem["ID"]?>"><?=$arItem["FULL_PRICE_FORMATED"]?></del>
						<?endif;?>
						<i  id="current_price_<?=$arItem["ID"]?>"><?=$arItem["PRICE_FORMATED"]?></i>
						</em>
					</div>
					<div class="col-md-2">
							<?
							$ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0;
							$max = isset($arItem["AVAILABLE_QUANTITY"]) ? "max=\"".$arItem["AVAILABLE_QUANTITY"]."\"" : "";
							$useFloatQuantity = ($arParams["QUANTITY_FLOAT"] == "Y") ? true : false;
							$useFloatQuantityJS = ($useFloatQuantity ? "true" : "false");
							?>

						<div class="basket__item-counter" >
						<?
							if (!isset($arItem["MEASURE_RATIO"]))
							{
								$arItem["MEASURE_RATIO"] = 1;
							}

							if (
								floatval($arItem["MEASURE_RATIO"]) != 0
							):
							?>
							<span class="basket__item-minus" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'down', <?=$useFloatQuantityJS?>);">-</span>
							<span class="basket__item-var">
							<input
							class="basket_quantity_inp"
								type="text"
								size="3"
								id="QUANTITY_INPUT_<?=$arItem["ID"]?>"
								name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
								size="2"
								maxlength="18"
								min="0"
								<?=$max?>
								step="<?=$ratio?>"
								style="max-width: 50px"
								value="<?=$arItem["QUANTITY"]?>"
								onchange="updateQuantity('QUANTITY_INPUT_<?=$arItem["ID"]?>', '<?=$arItem["ID"]?>', <?=$ratio?>, <?=$useFloatQuantityJS?>)"
								>
								</span>
								<span class="basket__item-pluss" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'up', <?=$useFloatQuantityJS?>);">+</span>

							<input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />
							<?endif;?>
						</div>
					</div>
					<div class="col-md-1">
						<div class="basket__item-price">

									<?
									if ($arHeader["id"] == "SUM"):
									?>
										<div id="sum_<?=$arItem["ID"]?>">
									<?
									endif;

									echo $arItem[$arHeader["id"]];

									if ($arHeader["id"] == "SUM"):
									?>
										</div>
									<?
									endif;
									?>

						</div>
					</div>
					<div class="col-md-2">
					    <?if($arItem['AVAILABLE_QUANTITY']):?>
						    <div class="basket__item-ok">В наличии</div>
						<?endif;?>
					</div>

					<div class="basket__item-delete">
						<a href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delete"])?>"></a>
					</div>
				</li>
			</ul>
			<div >
           
			<?$APPLICATION->ShowViewContent('basket-item-'.$arItem['ID']);?>
			</div>

					<?
					endif;
				endforeach;
				?>

		</div>
	</div>
	<input type="hidden" id="column_headers" value="<?=CUtil::JSEscape(implode($arHeaders, ","))?>" />
	<input type="hidden" id="offers_props" value="<?=CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ","))?>" />
	<input type="hidden" id="action_var" value="<?=CUtil::JSEscape($arParams["ACTION_VARIABLE"])?>" />
	<input type="hidden" id="quantity_float" value="<?=$arParams["QUANTITY_FLOAT"]?>" />
	<input type="hidden" id="count_discount_4_all_quantity" value="<?=($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="auto_calculation" value="<?=($arParams["AUTO_CALCULATION"] == "N") ? "N" : "Y"?>" />

	<div class="bx_ordercart_order_pay">

		<div class="bx_ordercart_order_pay_left" id="coupons_block">
		<?
		if ($arParams["HIDE_COUPON"] != "Y")
		{
		?>
			<div class="bx_ordercart_coupon">
				<span><?=GetMessage("STB_COUPON_PROMT")?></span><input type="text" id="coupon" name="COUPON" value="" onchange="enterCoupon();">&nbsp;<a class="bx_bt_button bx_big" href="javascript:void(0)" onclick="enterCoupon();" title="<?=GetMessage('SALE_COUPON_APPLY_TITLE'); ?>"><?=GetMessage('SALE_COUPON_APPLY'); ?></a>
			</div><?
				if (!empty($arResult['COUPON_LIST']))
				{
					foreach ($arResult['COUPON_LIST'] as $oneCoupon)
					{
						$couponClass = 'disabled';
						switch ($oneCoupon['STATUS'])
						{
							case DiscountCouponsManager::STATUS_NOT_FOUND:
							case DiscountCouponsManager::STATUS_FREEZE:
								$couponClass = 'bad';
								break;
							case DiscountCouponsManager::STATUS_APPLYED:
								$couponClass = 'good';
								break;
						}
						?><div class="bx_ordercart_coupon"><input disabled readonly type="text" name="OLD_COUPON[]" value="<?=htmlspecialcharsbx($oneCoupon['COUPON']);?>" class="<? echo $couponClass; ?>"><span class="<? echo $couponClass; ?>" data-coupon="<? echo htmlspecialcharsbx($oneCoupon['COUPON']); ?>"></span><div class="bx_ordercart_coupon_notes"><?
						if (isset($oneCoupon['CHECK_CODE_TEXT']))
						{
							echo (is_array($oneCoupon['CHECK_CODE_TEXT']) ? implode('<br>', $oneCoupon['CHECK_CODE_TEXT']) : $oneCoupon['CHECK_CODE_TEXT']);
						}
						?></div></div><?
					}
					unset($couponClass, $oneCoupon);
				}
		}
		else
		{
			?>&nbsp;<?
		}
?>
		</div>
		<div class="bx_ordercart_order_pay_right">
			<table class="bx_ordercart_order_sum">
				<?if ($bWeightColumn && floatval($arResult['allWeight']) > 0):?>
					<tr>
						<td class="custom_t1"><?=GetMessage("SALE_TOTAL_WEIGHT")?></td>
						<td class="custom_t2" id="allWeight_FORMATED"><?=$arResult["allWeight_FORMATED"]?>
						</td>
					</tr>
				<?endif;?>
				<?if ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y"):?>
					<tr>
						<td><?echo GetMessage('SALE_VAT_EXCLUDED')?></td>
						<td id="allSum_wVAT_FORMATED"><?=$arResult["allSum_wVAT_FORMATED"]?></td>
					</tr>
					<?if (floatval($arResult["DISCOUNT_PRICE_ALL"]) > 0):?>
						<tr>
							<td class="custom_t1"></td>
							<td class="custom_t2" style="text-decoration:line-through; color:#828282;" id="PRICE_WITHOUT_DISCOUNT">
								<?=$arResult["PRICE_WITHOUT_DISCOUNT"]?>
							</td>
						</tr>
					<?endif;?>
					<?
					if (floatval($arResult['allVATSum']) > 0):
						?>
						<tr>
							<td><?echo GetMessage('SALE_VAT')?></td>
							<td id="allVATSum_FORMATED"><?=$arResult["allVATSum_FORMATED"]?></td>
						</tr>
						<?
					endif;
					?>
				<?endif;?>
					<tr>
						<td class="fwb"><?=GetMessage("SALE_TOTAL")?></td>
						<td class="fwb" id="allSum_FORMATED"><?=str_replace(" ", "&nbsp;", $arResult["allSum_FORMATED"])?></td>
					</tr>


			</table>
			<div style="clear:both;"></div>
		</div>
		<div style="clear:both;"></div>
		<div class="bx_ordercart_order_pay_center">

			<?if ($arParams["USE_PREPAYMENT"] == "Y" && strlen($arResult["PREPAY_BUTTON"]) > 0):?>
				<?=$arResult["PREPAY_BUTTON"]?>
				<span><?=GetMessage("SALE_OR")?></span>
			<?endif;?>
			<?
			if ($arParams["AUTO_CALCULATION"] != "Y")
			{
				?>
				<a href="javascript:void(0)" onclick="updateBasket();" class="checkout refresh"><?=GetMessage("SALE_REFRESH")?></a>
				<?
			}
			?>

		</div>
		<div class="col-xs-12 col-md-3 col-md-offset-9 basket__btn"><a href="javascript:void(0)" onclick="checkOut();" class="checkout"><?=GetMessage("SALE_ORDER")?></a></div>
	</div>
</div>
<?
else:
?>
<div id="basket_items_list">
	<table>
		<tbody>
			<tr>
				<td style="text-align:center">
					<div class=""><?=GetMessage("SALE_NO_ITEMS");?></div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?
endif;
?>