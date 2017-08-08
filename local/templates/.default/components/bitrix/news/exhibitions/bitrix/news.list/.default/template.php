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

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
	<ul>
		<?$i=0;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$i++;
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<?if(($i % 3 == 0) || $i==1 ) {?>
		<li>
		<?}?>

	<a href="<?=$arItem['DETAIL_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div  class="participation__item participation__item--1 col-xs-12 col-sm-6 col-md-4" style="background: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>') no-repeat">
			<div class="participation__item-name"><?=$arItem['NAME']?></div>
			<div class="participation__item-date"><?=$arItem['DISPLAY_PROPERTIES']['DATE']['VALUE']?></div>
			<div class="participation__item-city"><?=Loc::getMessage('CT_BNL_ELEMENT_CITY_LETTER')?> <?=$arItem['DISPLAY_PROPERTIES']['CITY']['VALUE']?></div>
		</div>
	</a>




			<?if(($i % 3 == 0)  ) {?>
		</li>
			<?}?>
<?endforeach;?>
</ul>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

