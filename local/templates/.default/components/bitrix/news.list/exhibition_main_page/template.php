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
//$APPLICATION->AddHeadScript('/local/js/blueimp/js/blueimp-gallery.min.js', true);
//$APPLICATION->SetAdditionalCSS('/local/js/blueimp/css/blueimp-gallery.css');
//$APPLICATION->SetAdditionalCSS('/local/js/blueimp/css/blueimp-gallery-indicator.css');
//$APPLICATION->SetAdditionalCSS('/local/js/blueimp/css/blueimp-gallery-video.css');
?>

<div id="blueimp-video-carousel" class="blueimp-gallery blueimp-gallery-controls blueimp-gallery-carousel">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <!--a class="play-pause"></a-->
    <ol class="indicator"></ol>
</div>
<!--
<?
	$arrYoutube = array();
	$count = 0;
	
	$arItem = $arResult["ITEMS"][0];
	
	//foreach($arResult["ITEMS"] as $arItem) {
			echo('arrYoutube');
						
			$count = 0;
			foreach($arItem['DISPLAY_PROPERTIES']['VIDEO_HREF']['VALUE'] as $video) {
						$arrYoutube[$count]['video'] = $video;						
						$count++;
			}
			
			$count = 0;
			foreach($arItem['DISPLAY_PROPERTIES']['VIDEO_HREF']['DESCRIPTION'] as $descr) {
						$arrYoutube[$count]['descr'] = $descr;						
						$count++;
			}
			
			
			$count = 0;
			foreach($arItem['DISPLAY_PROPERTIES']['PHOTO_VIDEO']['VALUE'] as $key=>$value) {
						$arrYoutube[$count]['photo'] = $value['SRC'];
						$count++;
			}
			
			$strBlueimp = "";
			foreach ($arrYoutube as $key=>$value){
				$code = substr(strstr($value['video'], '='),1);
				$strBlueimp .= "
	{
        title: '".$value['descr']."',
        href: '".$value['video']."',
        type: 'text/html',
        youtube: '".$code."',
        poster: '".$value['photo']."'
    },";
			}
			
			$strBlueimp = substr($strBlueimp,0, -1);
			
			
	//}
?>
-->
<script src="/local/js/blueimp/js/blueimp-gallery.min.js"></script>
<script>
blueimp.Gallery([
<? echo($strBlueimp); ?>
], {
    container: '#blueimp-video-carousel',
    carousel: true,
	youTubeClickToPlay: false,
    startSlideshow: false,
    indicatorContainer: 'ol',
    
    activeIndicatorClass: 'active',
    thumbnailProperty: 'thumbnail',
    thumbnailIndicators: true
  });
</script>
<??>

