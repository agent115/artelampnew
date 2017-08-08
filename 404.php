<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена"); ?>
	<div id="content">
		<style>
			h1 {
				display: none;
			}
			
			.page_not_found {
				margin-top: 70px
			}
			
			.page_not_found td {
				vertical-align: top
			}
			
			.page_not_found td.image {
				width: 60%
			}
			
			.page_not_found td.image img {
				max-width: 100%;
				background: #484848;
			}
			
			.page_not_found td.description {
				text-align: center;
				padding-top: 40px
			}
			
			.page_not_found td.description .title404 {
				font-size: 44px;
				line-height: 48px
			}
			
			.page_not_found td.description .subtitle404 {
				text-transform: uppercase;
				font-size: 18px;
				line-height: 24px
			}
			
			.page_not_found td.description .back404, .page_not_found td.description .back404 a {
				font-size: 12px
			}
			
			.page_not_found td.description .back404 a {
				text-decoration: underline;
				cursor:pointer;
			}
			
			.page_not_found td.description .descr_text404 {
				font-size: 13px;
				line-height: 20px;
				margin-top: 20px
			}
			
			.page_not_found td.description .subtitle404, .page_not_found td.description .descr_text404, .page_not_found td.description .back404, .page_not_found td.description .back404 a {
				font-family: Ubuntu, Verdana, Arial, Helvetica, sans-serif
			}
			
			.page_not_found td.description .btn_big {
				margin-top: 20px
			}
			
			.page_not_found td.description .back404 {
				margin-top: 5px
			}
		</style>
		<table class="page_not_found" width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody>
			<tr>
				<td class="image"><img
						src="/404.png"
						alt="404" title=":-("></td>
				<td class="description">
					<div class="title404">Ошибка 404</div>
					<div class="subtitle404">Страница не найдена</div>
					<div class="descr_text404">Неправильно набран адрес или такой<br>страницы не существует</div>
					<br>
					<a class="button big_btn" href="/"><span>Перейти на главную</span></a>
					<div class="back404">или <a onclick="history.back()">вернуться назад</a></div>
				</td>
			</tr>
			</tbody>
		</table>
	</div>

<? /*<div class="bx-404-container">
		<div class="bx-404-block"><img src="<?=SITE_DIR?>images/404.png" alt=""></div>
		<div class="bx-404-text-block">Неправильно набран адрес, <br>или такой страницы на сайте больше не существует.</div>
		<div class="">Вернитесь на <a href="<?=SITE_DIR?>">главную</a> или воспользуйтесь картой сайта.</div>
	</div>
	<?/*<div class="map-columns row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="bx-maps-title">Карта сайта:</div>
		</div>
	</div>
	
	<div class="col-sm-offset-2 col-sm-4">
		<div class="bx-map-title"><i class="fa fa-leanpub"></i> Каталог</div>
		<? $APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"tree",
			array(
				"COMPONENT_TEMPLATE" => "tree",
				"IBLOCK_TYPE" => "catalog",
				"IBLOCK_ID" => "9",
				"SECTION_ID" => '',
				"SECTION_CODE" => "",
				"COUNT_ELEMENTS" => "Y",
				"TOP_DEPTH" => "1",
				"SECTION_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"SECTION_USER_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"SECTION_URL" => "",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_GROUPS" => "Y",
				"ADD_SECTIONS_CHAIN" => "Y"
			),
			false
		);
		?>
	</div>
	
	<div class="col-sm-offset-1 col-sm-4">
		<div class="bx-map-title"><i class="fa fa-info-circle"></i> О магазине</div>
		<?
		$APPLICATION->IncludeComponent(
			"bitrix:main.map",
			".default",
			array(
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"SET_TITLE" => "N",
				"LEVEL" => "3",
				"COL_NUM" => "2",
				"SHOW_DESCRIPTION" => "Y",
				"COMPONENT_TEMPLATE" => ".default"
			),
			false
		); ?>
	</div>*/ ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>