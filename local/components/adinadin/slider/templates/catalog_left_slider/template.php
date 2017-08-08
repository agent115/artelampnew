<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?$this->setFrameMode(true);?>
<? if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0): ?>
<div class="col-xs-12 swiper-container swiper-container4">
	<div class="swiper-wrapper">
		<? foreach ($arResult['ITEMS'] as $arItem): ?>
		<div class="swiper-slide">
			<div class="indexCatalog__item--reklama">
				<a href="<?=$arItem['UF_HREF']?>" style="background:url('<?=$arItem['UF_PICTURE']['SRC']?>')  50% no-repeat; background-size: contain;"></a>
			</div>
		</div>
		<? endforeach; ?>
	</div>
	<div class="swiper-pagination swiper-pagination4"></div>
	</div>
<? endif; ?>





