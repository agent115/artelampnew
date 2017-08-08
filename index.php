<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Artelamp");
?>	<section class="secondmenu hidden-xs">
		<div class="container">
			<div class="row">
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"top_catalog_main_page_menu",
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
						"ROOT_MENU_TYPE" => "left",
						"USE_EXT" => "Y",
						"COMPONENT_TEMPLATE" => "footer_menu",
						"MENU_THEME" => "site"
					),
					false
				);?>
			</div>
		</div>
	</section>
<section class="hidden-xs light">
		<div class="container">
			<div class="row">
<?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"",
	Array(
		"TYPE" => "MAIN",
		"NOINDEX" => "N",
		"QUANTITY" => "1",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "0",
		"CACHE_NOTES" => ""
	),
false
);?>
			</div>
		</div>
	</section>
	<section class="hidden-xs light">
		<div class="container">
			<div class="row">
				<div class="light__suspension">
					<div class="col-md-1 col-lg-1"></div>
					<div class="col-md-4 col-lg-4">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/main_page/main_page_light_suspension_image.php"
							)
						);?>
						
					</div>
					<div class="col-md-6 col-lg-6 text-center">
						<div class="light__suspension-title">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/main_page/light_suspension_title.php"
								)
							);?>
						</div>
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/main_page/light_suspension_text.php"
							)
						);?>
						
						<div class="light__suspension-btns center-block">
							<div class="light__suspension-btn light__suspension-btn--gray"><a href="/upload/Catalog%20ARTE%202016-2017.compressed.pdf">В каталог</a></div>
							<div class="light__suspension-btn"><a href="/">Новинки</a></div>
						</div>
						<div class="light__suspension-tags">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/main_page/main_page_light_suspension_links.php"
								)
							);?>
							
						</div>
					</div>
					<div class="col-md-1 col-lg-1"></div>
				</div>
				<?GLOBAL $arrFilterNew;
				$arrFilterNew = array(
					'PROPERTY_ON_MAIN_PAGE' => 'да',
				);?>
				<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"main_page_section", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "shows",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilterNew",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "25",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "4",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "4",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
			1 => "Оптовая",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "IP",
			1 => "VYSOTA_KOROBKI",
			2 => "GRUPPA_TOVARA_AVS",
			3 => "DLINA_KOROBKI",
			4 => "KLASS_ENERGOEFFEKTIVNOSTI",
			5 => "KOLICHESTVO_LAMP",
			6 => "KOLICHESTVO_PATRONOV",
			7 => "LAMPAVKOMPLEKTE",
			8 => "MATERIAL_ARMATURY",
			9 => "MATERIAL_PLAFONA_DEKORA",
			10 => "MINIMALNOE_KOLICHESTVO_V_UPAKOVKE",
			11 => "MOSHCHNOST",
			12 => "NAPRYAZHENIE",
			13 => "PATRON",
			14 => "SVETOVOY_POTOK",
			15 => "STIL_SVETILNIKA",
			16 => "TIP_LAMPY",
			17 => "TREBUET_SERTIFIKATSII",
			18 => "TSVET_ARMATURY",
			19 => "TSVET_PLAFONA",
			20 => "SHIRINA_KOROBKI",
			21 => "BREND",
			22 => "VID_SVETILNIKA",
			23 => "VYGRUZHAT_NA_SAYT",
			24 => "BLOG_POST_ID",
			25 => "CML2_ARTICLE",
			26 => "CML2_BASE_UNIT",
			27 => "BLOG_COMMENTS_CNT",
			28 => "CML2_MANUFACTURER",
			29 => "CML2_TRAITS",
			30 => "CML2_TAXES",
			31 => "CML2_ATTRIBUTES",
			32 => "CML2_BAR_CODE",
			33 => "VYSOTA_SVETILNIKA",
			34 => "GRUPPA_NA_SAYTE",
			35 => "DIAMETR_SVETILNIKA",
			36 => "DLINA_SVETILNIKA",
			37 => "IZGOTOVITEL",
			38 => "INDEKS_MOSKVA",
			39 => "INDEKS_PITER",
			40 => "KOD_TAMOZHENNOY_GRUPPY",
			41 => "MATERIAL_DLYA_INVOYSA",
			42 => "NAIMENOVANIE_DLYA_SAYTA",
			43 => "NOVINKA",
			44 => "NOMER_SERTIFIKATA",
			45 => "NOMERBLANKASERTIFIKATA",
			46 => "ORGAN_PO_SERTIFIKATSII",
			47 => "PORYADOK_SORTIROVKI_NA_SAYTE",
			48 => "PRIMECHANIE",
			49 => "RASPRODAZHA",
			50 => "SEMEYSTVO",
			51 => "SENSORNOE_VKLYUCHENIE",
			52 => "SERIYA",
			53 => "SERTIFIKATDEYSTVITELENDO",
			54 => "SERTIFIKATDEYSTVITELENS",
			55 => "STEKLO",
			56 => "STRANITSAKATALOGARUS",
			57 => "TAMOZHENNAYA_GRUPPA",
			58 => "TIP_LAMPY_ANGLIYSKIY",
			59 => "TIP_SVETILNIKA",
			60 => "TIP_SVETILNIKA_ANGLIYSKIY",
			61 => "TIP_SVETILNIKA_UKRAINSKIY",
			62 => "TOVARNAYA_GRUPPA",
			63 => "TSVET_FONA_NA_SAYTE",
			64 => "SHIRINA_SVETILNIKA",
			65 => "VES_NETTO",
			66 => "V_KOROBKE_NESKOLKO_SHTUK",
			67 => "VYKLYUCHATEL_V_KOMPLEKTE",
			68 => "DLINATSEPIILISHNURA",
			69 => "KOMPLEKT_KOROBOK",
			70 => "KREPLENIE",
			71 => "MONTAZHNOE_OTVERSTIE",
			72 => "RAZDELNOE_VKLYUCHENIE",
			73 => "TOP_ASSORTIMENT",
			74 => "_3D_MODEL",
			75 => "DIAMETR_VREZNOGO_OTVERSTIYA_SM",
			76 => "_PRIMECHANIYA",
			77 => "_VID_IZDELIYA",
			78 => "_IZGOTOVITEL",
			79 => "_LAMPA",
			80 => "_MATERIAL",
			81 => "_RAZMERY",
			82 => "_TOVARINTERNETMAGAZINA",
			83 => "MATERIAL",
			84 => "NE_KONTROLIROVAT_UPAKOVKU",
			85 => "SROK_SLUZHBY",
			86 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => 25,
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "main_page_section"
	),
	false
);?>
				
			</div>
		</div>
	</section>
	<section class="worldArteLamp hidden-xs">
		<div class="container">
			<div class="row">
				<div class="worldArteLamp__title">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/main_page/world_artelamp_title.php"
						)
					);?>
				</div>
			</div>
			<div class="row pad-50">
				<div class="col-xs-12 col-md-6">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/main_page/world_artelamp_image.php"
						)
					);?>
					
				</div>
				<div class="col-xs-12 col-md-6 worldArteLamp__text">
					<div class="worldArteLamp__h1">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/main_page/world_artelamp_title2.php"
							)
						);?>
					</div>
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/main_page/world_artelamp_text.php"
						)
					);?>
					
					<div class="light__suspension-btns">
						<div class="light__suspension-btn"><a href="/about/">О бренде</a></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<hr>
	<hr>
	<section class="dressingRoom">
		<div class="container dressingRoom__bg">
			<div class="row text-center">
				<div class="dressingRoom__title dressingRoom__title-tooltip visible-xs visible-sm visible-md hidden-lg">
					<span data-toggle="tooltip" data-placement="bottom" title="Примерьте понравившийся вам светильник, настольню лампу, торшер или люстру в ваш интерьер, не выходя из дома!">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/main_page/dressroom_title.php"
							)
						);?>
					</span>
				</div>
				<div class="dressingRoom__title hidden-xs hidden-sm hidden-md visible-lg"><?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/main_page/dressroom_title.php"
						)
					);?>
				</div>
				<div class="dressingRoom__subtitle hidden-xs hidden-sm hidden-md">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/main_page/dressroom_text.php"
						)
					);?>
				</div>
			</div>
			<div class="row m-t90">
				<div class="hidden-xs hidden-sm hidden-md col-md-3 col-md-offset-9">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/main_page/dressroom_list.php"
						)
					);?>
					
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-lg-offset-9 dressingRoom__list-btns text-center">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/main_page/dressroom_apps.php"
						)
					);?>
					
				</div>
			</div>
		</div>
	</section>
	<section class="exhibitions hidden-xs hidden-sm">
		<div class="container">
			<hr>
			<hr>
			<div class="row">
				<div class="col-md-6">
					<ul class="exhibitions__list">
						<li class="text-center">
							<div class="exhibitions__list-title">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => "/include/main_page/exhibitions_title.php"
									)
								);?>
								</div>
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/main_page/exhibitions_text.php"
								)
							);?>
							
							<a href="/exhibitions/" class="exhibitions__list-btn">Выставки</a>
						</li>
						<li class="text-center">
							<div class="exhibitions__list-title">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => "/include/main_page/key_title.php"
									)
								);?>
								</div>
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/main_page/key_text.php"
								)
							);?>
							
							<a href="/projects/" class="exhibitions__list-btn">Проекты под ключ</a>
						</li>
					</ul>
				</div>
				<div class="col-md-5 col-md-offset-1">
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"exhibition_main_page",
						array(
							"COMPONENT_TEMPLATE" => "exhibition_main_page",
							"IBLOCK_TYPE" => "news",
							"IBLOCK_ID" => "8",
							"NEWS_COUNT" => "1",
							"SORT_BY1" => "ACTIVE_FROM",
							"SORT_ORDER1" => "DESC",
							"SORT_BY2" => "SORT",
							"SORT_ORDER2" => "ASC",
							"FILTER_NAME" => "",
							"FIELD_CODE" => array(
								0 => "",
								1 => "",
							),
							"PROPERTY_CODE" => array(
								0 => "VIDEO_HREF",
								1 => "PHOTO_VIDEO",
							),
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "36000000",
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "N",
							"PREVIEW_TRUNCATE_LEN" => "",
							"ACTIVE_DATE_FORMAT" => "j F Y",
							"SET_TITLE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_LAST_MODIFIED" => "N",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"ADD_SECTIONS_CHAIN" => "N",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"PARENT_SECTION" => "",
							"PARENT_SECTION_CODE" => "",
							"INCLUDE_SUBSECTIONS" => "N",
							"DISPLAY_DATE" => "Y",
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"PAGER_TEMPLATE" => "pagenavigation",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"PAGER_TITLE" => "Новости",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"SET_STATUS_404" => "N",
							"SHOW_404" => "N",
							"MESSAGE_404" => ""
						),
						false
					);?>
				</div>
			</div>
			<div class="row">
				<div class="hidden-xs hidde-sm col-md-12">
					<div class="exhibitions__fandeko">
						<div class="col-md-4">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/main_page/fandeko_image.php"
								)
							);?>
							
						</div>
						<div class="col-md-7 col-md-offset-hf">
							<div class="exhibitions__fandeko-title">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => "/include/main_page/fandeko_title.php"
									)
								);?>
								</div>
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/main_page/fandeko_text.php"
								)
							);?>

						</div>
						<div class="col-md-2 col-md-offset-10">
							<div class="exhibitions__fandeko-btn"><a href="/about/">О бренде</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="exhibitions__italy">
					<div class="exhibitions__italy-title">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/main_page/italy_title.php"
							)
						);?>
						</div>
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/main_page/italy_text.php"
						)
					);?>
				</div>


			</div>
			<hr>
			<hr>
		</div>
	</section>
	<section class="statisticts">
		<div class="container">
			<div class="row">
				<div class="hidden-xs hidden-sm col-md-12 text-center">
					<div class="col-md-3 statisticts__item">
						<span>
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/main_page/statistic1_title.php"
								)
							);?>
						</span>
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/main_page/statistic1_text.php"
							)
						);?>
						
					</div>
					<div class="col-md-3 statisticts__item">
						<span><?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/main_page/statistic2_title.php"
								)
							);?>
							</span>
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/main_page/statistic2_text.php"
							)
						);?>
						
					</div>
					<div class="col-md-3 statisticts__item">
						<span>
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/main_page/statistic3_title.php"
								)
							);?>
						</span>
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/main_page/statistic3_text.php"
							)
						);?>
						
					</div>
					<div class="col-md-3 statisticts__item">
						<span>
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/main_page/statistic4_title.php"
								)
							);?>
							</span>
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/main_page/statistic4_text.php"
							)
						);?>
						
					</div>
				</div>
			</div>
		</div>
		<div class="statisticts__italyBg hidden-xs hidden-sm">
			<img src="<?=SITE_TEMPLATE_PATH?>/img/italy.png" alt="">
		</div>
	</section>

	<section class="lastNews visible-md visible-lg hidden-xs">
		<div class="container">
			<div class="row">
				<div class="lastNews__title">Последние новости</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"last_news_list",
					array(
						"COMPONENT_TEMPLATE" => "last_news_list",
						"IBLOCK_TYPE" => "news",
						"IBLOCK_ID" => "1",
						"NEWS_COUNT" => "3",
						"SORT_BY1" => "ACTIVE_FROM",
						"SORT_ORDER1" => "DESC",
						"SORT_BY2" => "SORT",
						"SORT_ORDER2" => "ASC",
						"FILTER_NAME" => "",
						"FIELD_CODE" => array(
							0 => "",
							1 => "",
						),
						"PROPERTY_CODE" => array(
							0 => "",
							1 => "VIDEO_HREF",
							2 => "PHOTO_VIDEO",
							3 => "",
						),
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "N",
						"PREVIEW_TRUNCATE_LEN" => "",
						"ACTIVE_DATE_FORMAT" => "j F Y",
						"SET_TITLE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_LAST_MODIFIED" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"INCLUDE_SUBSECTIONS" => "N",
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"PAGER_TEMPLATE" => "pagenavigation",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "Новости",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"SET_STATUS_404" => "N",
						"SHOW_404" => "N",
						"MESSAGE_404" => ""
					),
					false
				);?>

			</div>
		</div>
	</section>

	<section class="social hidden-xs hidden-sm">
		<div class="container">
			<div class="row">
				<hr>
				<hr>
				<div class="social__title">ArteLamp в социальных сетях.</div>
				<div class="social__list flex-start">
					<div class="social__item">
						<div id="vk_groups"></div>
					</div>
					<div class="social__item">
						<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffandeko&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="290" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
					</div>
				</div>
			</div>
		</div>
	</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>