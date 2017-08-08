<?use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);?>
<?if(!$arCurPage['IS_INDEX']):?>
</div>
</div>
</section>
<?endif;?>
<section class="footer">
	<div class="container">
		<div class="row footer__menu">
			<div class="hidden-xs hidden-sm col-md-2">
				<span><?=Loc::getMessage('FOOTER_MENU_TYPE_TITLE')?></span>
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"footer_menu",
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
			<div class="hidden-xs hidden-sm col-md-2">
				<span><?=Loc::getMessage('FOOTER_MENU_SERIES_TITLE')?></span>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/footer_series_menu.php"
					)
				);?>
				
			</div>
			<div class="hidden-xs hidden-sm col-md-2">
				<span><?=Loc::getMessage('FOOTER_MENU_ARTELAMP_TITLE')?></span>
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"footer_menu",
					array(
						"ALLOW_MULTI_SELECT" => "N",
						"CHILD_MENU_TYPE" => "bottom",
						"DELAY" => "N",
						"MAX_LEVEL" => "1",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_USE_GROUPS" => "N",
						"ROOT_MENU_TYPE" => "bottom",
						"USE_EXT" => "N",
						"COMPONENT_TEMPLATE" => "footer_menu"
					),
					false
				);?>
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="footer__line">
					<div class="hidden-xs hidden-sm col-md-3 col-lg-5">
						<span><?=Loc::getMessage('FOOTER_SEARCH_TITLE')?></span>
						<label for="search">
							<?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"footer_search", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_TITLE" => "",
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "title-search-footer",
		"INPUT_ID" => "title-search-input-footer",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#catalog/search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"COMPONENT_TEMPLATE" => "footer_search",
		"CATEGORY_0_iblock_catalog" => array(
			0 => "all",
		)
	),
	false
);?>
						</label>
					</div>
					<div class="col-xs-12 col-md-9 col-lg-7">
						<span class="hidden-xs"><?=Loc::getMessage('FOOTER_MENU_SUBSCRIBE_NEWS_TITLE')?></span>
						<span class="hidden-sm hiddem-md hidden-lg"><?=Loc::getMessage('FOOTER_MENU_SUBSCRIBE_NEWS_TITLE_MOBILE')?></span>
						<div class="footer_subscribe_container">
						<?$APPLICATION->IncludeComponent(
							"bitrix:sender.subscribe",
							"footer_subscribe",
							array(
								"AJAX_MODE" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"AJAX_OPTION_HISTORY" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"CACHE_TIME" => "3600",
								"CACHE_TYPE" => "A",
								"CONFIRMATION" => "N",
								"SET_TITLE" => "N",
								"SHOW_HIDDEN" => "N",
								"USE_PERSONALIZATION" => "Y",
								"COMPONENT_TEMPLATE" => ".default"
							),
							false
						);?>
						</div>
					</div>
				</div>
				<div class="footer__line">
					<div class="col-md-5">
						<strong><?=Loc::getMessage('FOOTER_MENU_PHONE_TITLE')?></strong>

							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/footer_phones.php"
								)
							);?>

					</div>
					<div class="col-md-5">
						<strong><?=Loc::getMessage('FOOTER_MENU_ADDRESS_TITLE')?></strong>

							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/include/footer_address.php"
								)
							);?>

					</div>
					<div class="hidden-xs hidden-sm col-md-2 text-center">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/footer_catalog_link.php"
							)
						);?>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<footer class="copy">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 copy__copyright">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/footer_copyright.php"
					)
				);?>
			</div>
		</div>
	</div>
</footer>

</body>
</html>