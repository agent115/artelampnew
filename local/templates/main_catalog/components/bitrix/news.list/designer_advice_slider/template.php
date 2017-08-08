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

<div class="swiper-container swiper-container2">
<div class="swiper-wrapper">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$i++;
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<div class="swiper-slide">
		<div class="col-xs-12">
			<div class="col-xs-4 col-xs-offset-1">
				<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="">
			</div>
			<div class="col-xs-4">
				<span><?=Loc::getMessage('EL_ADVICE')?></span>
				<p>№<?=$arItem['NAME']?></p>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="shop__advice-title">
				<?=$arItem['PROPERTIES']['SECOND_TITLE']['VALUE']?>
			</div>
		</div>
		<div class="col-xs-12">
			<em>
				<?=$arItem['PREVIEW_TEXT']?>
			</em>
		</div>
	</div>
<?endforeach;?>
</div>

<div class="swiper-pagination swiper-pagination2"></div>
</div>
<div class="shop__advice-btn"><a href="/articles/"><?=Loc::getMessage('EL_DESIGNER_ADVICE')?></a></div>
