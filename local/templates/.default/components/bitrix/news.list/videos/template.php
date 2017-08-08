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
?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<div class="row">
	<div class="col-md-12 info__content">

			<?$i=-1;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$i++;
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<div class="info__slider <?if ($i%2 == 0){?>col-md-5<?}else{?>col-md-5 col-md-offset-1<?}?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="swiper-container gallery-top<?if($i>0):?><?=$i?><?endif;?>">
			<div class="swiper-wrapper">
			<?foreach($arItem['DISPLAY_PROPERTIES']['VIDEO_HREF']['VALUE'] as $video):?>
				<div class="swiper-slide">
					<iframe src="<?=$video?>" height="278" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>
			<?endforeach?>
			</div>
		</div>
		<div class="swiper-container gallery-thumbs<?if($i>0):?><?=$i?><?endif;?>">
			<div class="swiper-wrapper">
			<?foreach($arItem['DISPLAY_PROPERTIES']['PHOTO_VIDEO']['VALUE'] as $key=>$value):?>
				<div class="swiper-slide">
					<img src="<?=$value['SRC']?>" alt="">
				</div>
			<?endforeach;?>
			</div>
		</div>
		<div class="info__slider-name"><?=$arItem['NAME']?></div>
		<p>
			<?=$arItem['PREVIEW_TEXT']?>
		</p>
	</div>


<?endforeach;?>

	</div>
</div>
<hr>
<hr>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
<div class="row">
	<div class="col-md-4 col-md-offset-8">
		<div class="projects__pagination">
			<?=$arResult["NAV_STRING"]?>
		</div>
	</div>
</div>
<?endif;?>
<?//pp($arResult,true);?>