<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?$this->setFrameMode(true);?>
<? if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0): ?>
<div class="swiper-container swiper-container1">
	<div class="swiper-wrapper">
		<? foreach ($arResult['ITEMS'] as $arItem): ?>
			<div class="swiper-slide" style="background:url('<?=$arItem['UF_PICTURE']['SRC']?>')"></div>
		<? endforeach; ?>
	</div>
	<div class="swiper-pagination swiper-pagination1"></div>
	</div>
<? endif; ?>



