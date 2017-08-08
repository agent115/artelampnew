<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?><section class="contacts">
<div class="container">
	<div class="row">
		<hr>
		<div class="text-center">
			<div class="contacts__title">
				 Контакты
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 contacts__data">
			<div class="col-md-4 contacts__phones">
				 Контактный телефон:
				<div class="contacts__phone">
					 +7 (495) 796-70-46
				</div>
				<div class="contacts__phone">
					 +7 (800) 770-79-87 <br>
					(по России бесплатно)
				</div>
				<p>
					 Если у вас возникли вопросы, вы можете задать их нам, заполнив форму обратной связи
				</p>
			</div>
			<div class="col-md-7 col-md-offset-1 contacts__form">
				<div class="form">
					 <?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form",
	"contacts_form",
	Array(
		"COMPONENT_TEMPLATE" => "contacts_form",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "Имя соискателя",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array(0=>"2",),
		"IBLOCK_ID" => "16",
		"IBLOCK_TYPE" => "form_result",
		"LEVEL_LAST" => "N",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(0=>"161",1=>"162",2=>"NAME",),
		"PROPERTY_CODES_REQUIRED" => array(0=>"161",1=>"162",2=>"NAME",),
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "Спасибо, Ваше резюме принято.",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "Y"
	)
);?>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<hr>
	<div class="row">
		<div class="col-md-12 contacts__address">
			 Наш адрес:
			<p>
				 142771 г. Москва, поселение Мосрентген, поселок Завода Мосрентген
			</p>
		</div>
		<div class="col-md-12 contacts__map">
			 <script data-skip-moving="true" type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=e-JhhhGhTojquWvSXqS1inPbLUoMddg_&width=100%&height=247&lang=ru_RU&sourceType=constructor&scroll=true"></script>
		</div>
	</div>
</div>
 </section> <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>