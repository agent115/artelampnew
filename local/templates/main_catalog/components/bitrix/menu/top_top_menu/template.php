<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if (!empty($arResult)):?>
	<ul>
		<li class="col-sm-1 hidden-md hidden-lg"></li>
		<?
		foreach($arResult as $arItem):
			if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;
			?>

			<?if($arItem['TEXT']=='Доставка и оплата'){
				$class='col-sm-2 col-md-4';
			}else{
			$class='col-sm-2 col-md-2';
			}
			?>
			<?if($arItem["SELECTED"]):?>
			<li class="<?=$class?>"><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li class="<?=$class?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?endif?>

		<?endforeach?>
		<li class="col-sm-1 hidden-md hidden-lg"></li>
	</ul>
<?endif?>