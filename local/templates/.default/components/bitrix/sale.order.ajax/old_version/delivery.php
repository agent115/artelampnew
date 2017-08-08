<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<script type="text/javascript">
	function fShowStore(id, showImages, formWidth, siteId)
	{
		var strUrl = '<?=$templateFolder?>' + '/map.php';
		var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId;

		var storeForm = new BX.CDialog({
					'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
					head: '',
					'content_url': strUrl,
					'content_post': strUrlPost,
					'width': formWidth,
					'height':450,
					'resizable':false,
					'draggable':false
				});

		var button = [
				{
					title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
					id: 'crmOk',
					'action': function ()
					{
						GetBuyerStore();
						BX.WindowManager.Get().Close();
					}
				},
				BX.CDialog.btnCancel
			];
		storeForm.ClearButtons();
		storeForm.SetButtons(button);
		storeForm.Show();
	}

	function GetBuyerStore()
	{
		BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
		//BX('ORDER_DESCRIPTION').value = '<?=GetMessage("SOA_ORDER_GIVE_TITLE")?>: '+BX('POPUP_STORE_NAME').value;
		BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
		BX.show(BX('select_store'));
	}

	function showExtraParamsDialog(deliveryId)
	{
		var strUrl = '<?=$templateFolder?>' + '/delivery_extra_params.php';
		var formName = 'extra_params_form';
		var strUrlPost = 'deliveryId=' + deliveryId + '&formName=' + formName;

		if(window.BX.SaleDeliveryExtraParams)
		{
			for(var i in window.BX.SaleDeliveryExtraParams)
			{
				strUrlPost += '&'+encodeURI(i)+'='+encodeURI(window.BX.SaleDeliveryExtraParams[i]);
			}
		}

		var paramsDialog = new BX.CDialog({
			'title': '<?=GetMessage('SOA_ORDER_DELIVERY_EXTRA_PARAMS')?>',
			head: '',
			'content_url': strUrl,
			'content_post': strUrlPost,
			'width': 500,
			'height':200,
			'resizable':true,
			'draggable':false
		});

		var button = [
			{
				title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
				id: 'saleDeliveryExtraParamsOk',
				'action': function ()
				{
					insertParamsToForm(deliveryId, formName);
					BX.WindowManager.Get().Close();
				}
			},
			BX.CDialog.btnCancel
		];

		paramsDialog.ClearButtons();
		paramsDialog.SetButtons(button);
		//paramsDialog.adjustSizeEx();
		paramsDialog.Show();
	}

	function insertParamsToForm(deliveryId, paramsFormName)
	{
		var orderForm = BX("ORDER_FORM"),
			paramsForm = BX(paramsFormName);
			wrapDivId = deliveryId + "_extra_params";

		var wrapDiv = BX(wrapDivId);
		window.BX.SaleDeliveryExtraParams = {};

		if(wrapDiv)
			wrapDiv.parentNode.removeChild(wrapDiv);

		wrapDiv = BX.create('div', {props: { id: wrapDivId}});

		for(var i = paramsForm.elements.length-1; i >= 0; i--)
		{
			var input = BX.create('input', {
				props: {
					type: 'hidden',
					name: 'DELIVERY_EXTRA['+deliveryId+']['+paramsForm.elements[i].name+']',
					value: paramsForm.elements[i].value
					}
				}
			);

			window.BX.SaleDeliveryExtraParams[paramsForm.elements[i].name] = paramsForm.elements[i].value;

			wrapDiv.appendChild(input);
		}

		orderForm.appendChild(wrapDiv);

		BX.onCustomEvent('onSaleDeliveryGetExtraParams',[window.BX.SaleDeliveryExtraParams]);
	}

	if(typeof submitForm === 'function')
		BX.addCustomEvent('onDeliveryExtraServiceValueChange', function(){ submitForm(); });

</script>

<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>" />
<fieldset class="standart__radio col-xs-12">
	<div class="desc">Способ доставки</div>
	<?
	if(!empty($arResult["DELIVERY"]))
	{
		$width = ($arParams["SHOW_STORES_IMAGES"] == "Y") ? 850 : 700;
		?>

		<?

		foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery)
		{

			if($arDelivery["ISNEEDEXTRAINFO"] == "Y")
				$extraParams = "showExtraParamsDialog('".$delivery_id."');";
			else
				$extraParams = "";

			if (count($arDelivery["STORE"]) > 0)
				$clickHandler = "onClick = \"fShowStore('".$arDelivery["ID"]."','".$arParams["SHOW_STORES_IMAGES"]."','".$width."','".SITE_ID."')\";";
			else
				$clickHandler = "onClick = \"BX('ID_DELIVERY_ID_".$arDelivery["ID"]."').checked=true;".$extraParams."submitForm();\"";

			?>
			<div class="col-xs-12 col-md-6">



					<input type="radio"
						id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"
						name="<?=htmlspecialcharsbx($arDelivery["FIELD_NAME"])?>"
						value="<?= $arDelivery["ID"] ?>"<?if ($arDelivery["CHECKED"]=="Y") echo " checked";?>
						onclick="submitForm();"
						/>

					<label for="ID_DELIVERY_ID_<?=$arDelivery["ID"]?>">

						<span><?=$arDelivery['NAME']?><br></span>
					</label>
					<?if ($arDelivery['CHECKED'] == 'Y'):?>
						<table class="delivery_extra_services">
							<?foreach ($arDelivery['EXTRA_SERVICES'] as $extraServiceId => $extraService):?>
								<?if(!$extraService->canUserEditValue()) continue;?>
								<tr>
									<td class="name">
										<?=$extraService->getName()?>
									</td>
									<td class="control">
										<?=$extraService->getEditControl('DELIVERY_EXTRA_SERVICES['.$arDelivery['ID'].']['.$extraServiceId.']')	?>
									</td>
									<td rowspan="2" class="price">
										<?

										if ($price = $extraService->getPrice())
										{
											echo GetMessage('SOA_TEMPL_SUM_PRICE').': ';
											echo '<strong>'.SaleFormatCurrency($price, $arResult['BASE_LANG_CURRENCY']).'</strong>';
										}

										?>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="description">
										<?=$extraService->getDescription()?>
									</td>
								</tr>
							<?endforeach?>
						</table>
					<?endif?>

				</div>
			<?
		}
	}
?>

</fieldset>