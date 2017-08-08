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
$templateData['ID_BTN_EL'] = $arResult['TOLEFT']['ID'];
?>
<div class="col-md-7 col-md-offset-1">
	<div class="desktopNews__show">
		<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
			<div class="desktopNews__show-date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
		<?endif;?>

		<div class="desktopNews__show-title"><?=$arResult["NAME"]?></div>
		<div class="desktopNews__show-content">
			<?echo $arResult["DETAIL_TEXT"];?>
		</div>
		<?if(isset($arResult['TOLEFT']['ID'])):?>
		<form id='new_btn_form' action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
			<input type="hidden" name="DETAIL_ELEMENT" value="<?=$arResult['TOLEFT']['ID']?>">
			<button type="submit" class="desktopNews__show-btn">
				<?if($arResult['IBLOCK_ID']==1){
					echo GetMessage('NEXT_NEWS_BUTTON');
				}else{
					echo GetMessage('NEXT_ARTICLE_BUTTON');
				}?>

			</button>
		</form>
		<?endif;?>

	</div>
</div>