<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? $APPLICATION->IncludeComponent(
    "bitrix:iblock.element.add.form",
    "feedback_form_popup",
    array(
        "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
        "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
        "CUSTOM_TITLE_DETAIL_PICTURE" => "",
        "CUSTOM_TITLE_DETAIL_TEXT" => "",
        "CUSTOM_TITLE_IBLOCK_SECTION" => "",
        "CUSTOM_TITLE_NAME" => "Ваше имя",
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
            1 => "NAME",
        ),
        "PROPERTY_CODES_REQUIRED" => array(
            0 => "156",
            1 => "NAME",
        ),
        "RESIZE_IMAGES" => "N",
        "SEF_MODE" => "N",
        "STATUS" => "ANY",
        "STATUS_NEW" => "N",
        "USER_MESSAGE_ADD" => "Спасибо, Ваше сообщение принято.",
        "USER_MESSAGE_EDIT" => "",
        "USE_CAPTCHA" => "N",
        "COMPONENT_TEMPLATE" => "feedback_form_popup",
        "AJAX_MODE" => "Y",  // режим AJAX
        "AJAX_OPTION_SHADOW" => "N", // затемнять область
        "AJAX_OPTION_JUMP" => "N", // скроллить страницу до компонента
        "AJAX_OPTION_STYLE" => "Y", // подключать стили
        "AJAX_OPTION_HISTORY" => "Y",
    ),
    false
); ?>