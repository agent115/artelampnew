<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
use \Bitrix\Main\Localization\Loc;
?>
<div class="participation-1__title"><?=$arResult['DISPLAY_PROPERTIES']['DATE']['VALUE']?>, <?=Loc::getMessage('CITY_LETTER');?> <?=$arResult['DISPLAY_PROPERTIES']['CITY']['VALUE']?></div>
<div class="participation-1__subtitle"><?=$arResult['NAME']?></div>
<div class="participation-1__slider">
	<div class="swiper-container gallery-top">
		<div class="swiper-wrapper">
			<?foreach($arResult['DISPLAY_PROPERTIES']['VIDEO_HREF']['VALUE'] as $video):?>
			<div class="swiper-slide">
				<iframe src="<?=$video?>" height="800" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>

			<?endforeach;?>
		</div>
	</div>
	<div class="swiper-container gallery-thumbs">
		<div class="swiper-wrapper">
			<?foreach($arResult['DISPLAY_PROPERTIES']['PHOTO_VIDEO']['VALUE'] as $key=>$value):?>
			<div class="swiper-slide">
				<img src="<?=$value['SRC']?>" alt="">
				
			</div>
			<?endforeach;?>
		</div>
	</div>
</div>



