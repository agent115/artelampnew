<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

<?if (!empty($arResult)):?>
	<div class="col-md-2"></div>
<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
	<div class="col-md-2 text-center">
		<div class="info__btn active"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></div>
	</div>
	<div class="col-md-1"></div>

	<?else:?>
	<div class="col-md-2 text-center">
		<div class="info__btn"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></div>
	</div>
	<div class="col-md-1"></div>
	<?endif?>
	<!-- hrognir -->
	
<?endforeach?>

	<div class="col-md-2"></div>
<?endif?>