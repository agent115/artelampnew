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
CJSCore::Init(array("ajax"));
?>
	<!DOCTYPE html>
	<html>
	<head lang="<?= LANGUAGE_ID ?>">
		<meta name="snus" content="done">
		<meta name="viewport" content="width=device-width">
		<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
		<? $APPLICATION->ShowHead(); ?>
		<title><? $APPLICATION->ShowTitle(); ?></title>
		<?
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/normalize.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/bootstrap-theme.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/bootstrap.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/swiper.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/ninja-slider.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/thumbnail-slider.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/jquery.fancybox.css');

		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/styles.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/custom.css');?>

		<link href='https://fonts.googleapis.com/css?family=Noto+Serif:400,700,700italic,400italic' rel='stylesheet' type='text/css'>

		<?
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/ion.rangeSlider.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/swiper.jquery.min.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/bootstrap.min.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/bootstrap-slider.min.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/jquery.mCustomScrollbar.concat.min.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/bootstrap-select.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/ninja-slider.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/thumbnail-slider.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/jquery.fancybox.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lib/bootstrap-select.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH .'/js/app.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH .'/js/custom.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH .'/js/lib/range.js');
		?>
			
<? $APPLICATION->AddHeadString("<!-- Google Tag Manager -->
<script data-skip-moving='true'>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N6JQQSR');</script>
<!-- End Google Tag Manager -->",true)?>

	</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N6JQQSR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div id="panel">
		<? $APPLICATION->ShowPanel() ?>
	</div>
	<section class="shopHeader">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-2">
					<a href="/"><img src="<?=SITE_TEMPLATE_PATH?>/img/ARTE.png" alt=""></a>
				</div>
				<div class="col-sm-12 col-md-10">
					<div class="row">
						<div class="col-sm-12 col-md-8">
							<?$APPLICATION->IncludeComponent(
								"bitrix:menu",
								"top_top_menu",
								array(
									"ALLOW_MULTI_SELECT" => "N",
									"CHILD_MENU_TYPE" => "left",
									"DELAY" => "N",
									"MAX_LEVEL" => "1",
									"MENU_CACHE_GET_VARS" => array(),
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_USE_GROUPS" => "N",
									"ROOT_MENU_TYPE" => "top2",
									"USE_EXT" => "N",
									"COMPONENT_TEMPLATE" => "top_top_menu"
								),
								false
							); ?>
							
						</div>
						<div class="col-sm-5 col-sm-offset-1 col-md-offset-0 col-lg-offset-0 col-md-4 hidden-xs">
							<div class="header__search">
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
								</label>
							</div>
						</div>
						<div class="col-sm-4 col-md-2 shopHeader__catalog">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/main_catalog_template/header_catalog_link.php"
								)
							);?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 col-sm-offset-1 col-md-offset-0 col-lg-offset-0 col-md-4">
							<div class="shopHeader__phones">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => "/include/main_catalog_template/header_phone_rus.php"
									)
								);?>
							</div>
						</div>
						<div class="col-sm-3 col-sm-offset-1 col-md-offset-0 col-lg-offset-0 col-md-4">
							<div class="shopHeader__phones">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => "/include/main_catalog_template/header_phone_moscow.php"
									)
								);?>
							</div>
						</div>
						<div class="col-sm-3 col-md-3">
							<div class="shopHeader__btn " role="callback"><?=Loc::getMessage('HEADER_CALLBACK_LINK')?></div>
						</div>
						<div class="col-sm-12 col-md-3">
							<div class="shopHeader__basket">
							<?$APPLICATION->IncludeComponent(
								"bitrix:sale.basket.basket.line",
								"top-basket",
								array(
									"COMPONENT_TEMPLATE" => "top-basket",
									"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
									"PATH_TO_PERSONAL" => SITE_DIR."personal/",
									"PATH_TO_PROFILE" => SITE_DIR."personal/",
									"PATH_TO_REGISTER" => SITE_DIR."login/",
									"POSITION_FIXED" => "N",
									"SHOW_AUTHOR" => "N",
									"SHOW_EMPTY_VALUES" => "Y",
									"SHOW_NUM_PRODUCTS" => "Y",
									"SHOW_PERSONAL_LINK" => "N",
									"SHOW_PRODUCTS" => "N",
									"SHOW_TOTAL_PRICE" => "Y",
									"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
									"HIDE_ON_BASKET_PAGES" => "N"
								),
								false
							);?>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="shopMenu">
		<div class="container">
			<div class="row">
				<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_catalog_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "Y",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "N",
		"ROOT_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "top_catalog_menu"
	),
	false
);?>
			</div>
		</div>
	</section>

<?if($arCurPage['PAGE']=='catalog'):?>
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
<?endif;?>
	<?if(!$arCurPage['IS_INDEX']):?>
	<section class="wrapper">
	<div class="container">
		<div class="row">
	<?endif;?>