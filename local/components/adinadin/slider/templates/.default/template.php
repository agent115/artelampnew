<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?$this->setFrameMode(true);?>
<? if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0): ?>
	<div id="carousel">
		<? foreach ($arResult['ITEMS'] as $arItem): ?>
			<div class="item"><a href="<?=$arItem['UF_HREF']?>"><img src="<?=$arItem['UF_PICTURE']['SRC']?>" alt="" /></a></div>
		<? endforeach; ?>
	</div>
<? endif; ?>


