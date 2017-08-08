<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? IncludeTemplateLangFile(__FILE__);
\Bitrix\Main\Loader::includeModule('adinadin.artelamp');
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
global $arCurPage, $arCurUser, $APPLICATION;
$obMain = AdinAdin\Artelamp\Main::getInstance();
$obMain->setCurrentPage();
$obMain->setCurrentUser();
$curDir = $APPLICATION->GetCurDir();
CUtil::InitJSCore();
CJSCore::Init(array('jquery2'));
?>
	<!DOCTYPE html>
	<html>
	<head lang="<?= LANGUAGE_ID ?>">
		<meta name="viewport" content="width=device-width">
		<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
		<? $APPLICATION->ShowHead(); ?>
		<title><? $APPLICATION->ShowTitle(); ?></title>
		<?
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/normalize.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/bootstrap-theme.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/bootstrap.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/swiper.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/styles.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/custom.css');?>

		<link href='https://fonts.googleapis.com/css?family=Noto+Serif:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
		<?
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/bootstrap.min.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/bootstrap-select.js');

		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/swiper.jquery.min.js');
		$APPLICATION->AddHeadScript('http://vk.com/js/api/openapi.js?121');

		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH .'/js/app.js');
		$APPLICATION->AddHeadString('<link href="/local/js/blueimp/css/blueimp-gallery.css" type="text/css" rel="stylesheet" />',true);
		$APPLICATION->AddHeadString('<link href="/local/js/blueimp/css/blueimp-gallery-indicator.css" type="text/css" rel="stylesheet" />',true);
		$APPLICATION->AddHeadString('<link href="/local/js/blueimp/css/blueimp-gallery-video.css" type="text/css" rel="stylesheet" />',true);
		?>
<? $APPLICATION->AddHeadString("<!-- Google Tag Manager -->
<script data-skip-moving='true'>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N6JQQSR');</script>
<!-- End Google Tag Manager -->",false)?>
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">
	</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N6JQQSR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div id="panel">
		<? $APPLICATION->ShowPanel() ?>
	</div>
	<header class="header">
		<div class="container">
			<div class="row">
				<a href="/" class="col-lg-2 col-md-2 col-sm-1 col-xs-1 col-xs-offset-1 col-sm-offset-0 header__logo-arte"></a>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xs-offset-1 header__title">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/header_text.php"
						)
					);?>

				</div>
				<div class="hidden-xs hidden-sm hidden-md col-lg-1 col-lg-1 header__lang text-center">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/header_links_lang.php"
						)
					);?>
				</div>
				<div class="col-xs-3 col-offset-1 col-sm-4 col-md-2 col-lg-2 col-sm-offset-1 col-lg-offset-0 header__search">
					<label for="search">
<?$APPLICATION->IncludeComponent(
										"bitrix:search.title", 
										"top_search", 
										array(
											"CATEGORY_0" => array(
												0 => "iblock_catalog",
											),
											"CATEGORY_0_TITLE" => "",
											"CHECK_DATES" => "N",
											"CONTAINER_ID" => "title-search",
											"INPUT_ID" => "title-search-input",
											"NUM_CATEGORIES" => "1",
											"ORDER" => "date",
											"PAGE" => "#SITE_DIR#catalog/search/index.php",
											"SHOW_INPUT" => "Y",
											"SHOW_OTHERS" => "N",
											"TOP_COUNT" => "5",
											"USE_LANGUAGE_GUESS" => "Y",
											"COMPONENT_TEMPLATE" => "top_search",
											"CATEGORY_0_iblock_catalog" => array(
												0 => "all",
											)
										),
										false
									);?>
									
					<?/*$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"top_search", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_news",
		),
		"CATEGORY_0_TITLE" => "",
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"COMPONENT_TEMPLATE" => "top_search",
		"CATEGORY_0_iblock_catalog" => array(
			0 => "all"
		),
		"CATEGORY_0_iblock_news" => array(
			0 => "1",
			1 => "4",
			2 => "5",
			3 => "6",
			4 => "7",
			5 => "8",
			6 => "11",
			7 => "12",
			8 => "17",
			9 => "18",
		)
	),
	false
);*/?>

						
					</label>
				</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/header_catalog_link.php"
					)
				);?>

				<?/*<div class="hidden-xs hidden-sm col-md-1 col-lg-1 header__logo"></div>*/?>
			</div>
		</div>
	</header>
<section class="menu">
	<div class="container">
		<div class="row">
		<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "N",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "top_menu"
	),
	false
);?>

		</div>
	</div>
</section>
	<section class="slider">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<?$APPLICATION->IncludeComponent(
						"adinadin:slider",
						"mainSlider",
						array(
							"BLOCK_ID" => "3",
							"COUNT_ON_PAGE" => "",
							"FIELDS" => array(
								0 => "UF_ACTIVE",
								1 => "UF_HREF",
								2 => "UF_PICTURE",
								3 => "UF_NAME",
								4 => "",
							),
							"FILTER_NAME" => "arrMainSliderFilter",
							"IMAGE_FIELD" => "UF_PICTURE",
							"IMG_HEIGHT" => "0",
							"IMG_JPG_QUANTITY" => "95",
							"IMG_RESIZE_METHOD" => "1",
							"IMG_WIDTH" => "0",
							"COMPONENT_TEMPLATE" => "mainSlider"
						),
						false
					);?>
				</div>
			</div>
		</div>
	</section>
	<?if(!$arCurPage['IS_INDEX']):?>
	<section class="wrapper">
	<div class="container">
		<div class="row">
	<?endif;?>