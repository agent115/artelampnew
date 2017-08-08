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
use \Bitrix\Main\Localization\loc;
?>

<div class="company__workers col-md-12 text-center">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$i++;
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="company__worker col-md-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>');">
		<div class="company__worker-name"><?=$arItem['NAME']?></div>
		<div class="company__worker-spec"><?=$arItem['DISPLAY_PROPERTIES']['APPOITNMENT']['VALUE']?></div>
		<div class="company__worker-mail"><?=Loc::getMessage('CT_BNL_ELEMENT_WORKERS_MAIL')?>: <?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE']?></div>
		<div class="company__worker-phone"><?=Loc::getMessage('CT_BNL_ELEMENT_WORKERS_PHONE')?> <?=$arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']?></div>
	</div>



<?endforeach;?>
</div>

