<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?use \Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);?>
<?if (!empty($arResult)):?>
	<ul class="flex-between">
		<?foreach($arResult as $arItem):?>
			<?if($arItem["SELECTED"]):?>
				<li class="active"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>
		<?endforeach?>
	</ul>
<?endif;?>


