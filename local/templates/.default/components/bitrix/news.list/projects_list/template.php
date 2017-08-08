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
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$i++;
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<div class="col-md-6">
		<div class="projects__project" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="">
			<div class="projects__project-name"><?=$arItem['NAME']?></div>
			<div class="projects__project-date"><?=$arItem['ACTIVE_FROM']?></div>
			<div class="projects__project-info">
				<?=$arItem['PREVIEW_TEXT']?>
			</div>
		</div>
	</div>
<?endforeach;?>
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
