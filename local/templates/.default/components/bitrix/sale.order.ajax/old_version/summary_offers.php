<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="row order__items">
	<ul class="col-xs-12 col-md-12">
		<?foreach ($arResult["GRID"]["ROWS"] as $k => $arData):?>
		<li class="basket__item col-xs-12 col-md-12">
			<div class="col-xs-5 col-md-2">
				<img src="<?=$arData["data"]["PREVIEW_PICTURE_SRC"]?>" class="preview-img" alt="">
			</div>
			<div class="col-xs-5 col-md-5 basket__item-cena">
				<span><?=$arData["data"]["NAME"]?></span>
				<p><?=$arData["data"]["PREVIEW_TEXT"]?></p>
				<em>
					<?if($arData["data"]["BASE_PRICE"]>$arData["data"]["PRICE"]):?>
						<del><?=$arData["data"]["BASE_PRICE_FORMATED"]?></del>
					<?endif;?>
					<i><?=$arData["data"]["PRICE_FORMATED"]?></i>
				</em>
			</div>
			<div class="col-xs-2 col-md-1">
				<div class="basket__item-price">
					<?=$arData["data"]["SUM"]?>
				</div>
			</div>
		</li>

		<?endforeach;?>
	</ul>
</div>
<div class="row">
	<hr>
	<div class="text-center">
		<div class="order__title"><?=GetMessage("SOA_TEMPL_SUM_SUMMARY")?><span><?=$arResult["ORDER_PRICE_FORMATED"]?></span></div>
	</div>
</div>
