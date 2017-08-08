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
<div class="col-md-4 desktopNews__list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
	<ul>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	if ($arParams['ELEMENT_ID']== 0){
		$arParams['ELEMENT_ID'] = $arItem['ID'];
	}
	?>
	<li <?if($arParams['ELEMENT_ID'] == $arItem['ID']):?>class="active"<?endif;?> id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<div class="desktopNews__list-date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
		<?endif?>

		<div class="desktopNews__list-title"><?echo $arItem["NAME"]?></div>
		<div class="desktopNews__list-content">
			<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="140" height="120" alt="">
			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
				<?echo $arItem["PREVIEW_TEXT"];?>
			<?endif;?>
		</div>
		<form class='form_to_click' action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
			<input type="hidden" name="DETAIL_ELEMENT" value="<?=$arItem['ID']?>">
		</form>
			
	</li>
<?endforeach;?>
</ul>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>