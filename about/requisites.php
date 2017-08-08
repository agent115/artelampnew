<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рекзивиты");
?>
<section class="requisites">
    <div class="container">
        <div class="row">
            <hr>
            <div class="text-center">
                <div class="requisites__title">Ревизиты</div>
            </div>
        </div>
        <div class="row pad-50">
            <div class="col-md-4">
                <span>Возникли вопросы?</span>
                <p>
                    Вы можете задать их нам, заполнив форму
                    обратной связи ниже.
                </p>
                <div class="form">
                    <? $APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form", 
	"feedback_form", 
	array(
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "Имя",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array(
			0 => "2",
		),
		"IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "form_result",
		"LEVEL_LAST" => "N",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(
			0 => "156",
			1 => "157",
			2 => "NAME",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "156",
			1 => "157",
			2 => "NAME",
		),
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "Спасибо, Ваше сообщение принято.",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "Y",
		"COMPONENT_TEMPLATE" => "feedback_form"
	),
	false
); ?>
                </div>
            </div>
            <div class="col-md-7 col-md-offset-1">
                <div class="requisites__data">
                    <div class="requisites__data-name">Общество с ограниченной ответственностью<br>«Лион»  (ООО «Лион»)</div>
                    <p>
                        <b>ИНН</b> 7751003086<br>
                        <b>КПП</b> 775101001
                    </p>
                    <p><b>ОГРН</b> 1157746243930</p>
                    <p><b>Юридический адрес:</b><br>142771 г. Москва, поселение Мосрентген, поселок Завода Мосрентген, ул. Героя России Соломатина д.4</p>
                    <p><b>Фактический адрес:</b><br>142771 г. Москва, поселение Мосрентген, поселок Завода Мосрентген, ул. Героя России Соломатина д.4</p>
                    <p><b>Расчетный счет</b> №  40702810700000048566<br>В ВТБ 24 (ПАО)</p>
                    <p><b>Корр. Счет</b> 30101810100000000716</p>
                    <p><b>БИК</b> 044525716</p>
                    <p>
                        <b>Генеральный директор: Лобачев Илья Алексеевич<br>
                            Главный бухгалтер: Мочалова Елена Ивановна</b>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>