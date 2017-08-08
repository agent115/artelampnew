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

<div class="col-md-12 lastNews__list flex-between">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="lastNews__list-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="lastNews__list-image" style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>')"></div>
		<div class="lastNews__list-date"><?= $arItem["DISPLAY_ACTIVE_FROM"]?></div>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="lastNews__list-name"><?echo $arItem["NAME"]?></a>
		<p><?echo $arItem["PREVIEW_TEXT"];?></p>
	</div>
	
<?endforeach;?>
</div>