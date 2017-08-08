<?
AddEventHandler('iblock', 'OnAfterIBlockElementAdd', 'IBElementCreateAfterHandlerResume');
function IBElementCreateAfterHandlerResume(&$arFields) {

// при тправки формы резюме
    if($arFields['IBLOCK_ID'] == 13) {
    CModule::IncludeModule("iblock");
    $EVENT_TYPE = 'RESUME_FORM'; // тип почтового шаблона

        $arMailFields['NAME'] = $arFields['NAME'];
        $arMailFields['PHONE'] = $arFields['PROPERTY_VALUES'][152];
        $arMailFields['MAIL'] = $arFields['PROPERTY_VALUES'][153];
        $arMailFields['APPONTMENT'] = $arFields['PROPERTY_VALUES'][154];

        CEvent::Send($EVENT_TYPE, 's1', $arMailFields);
    }

}

AddEventHandler('iblock', 'OnAfterIBlockElementAdd', 'IBElementCreateAfterHandlerFeedback');
function IBElementCreateAfterHandlerFeedback(&$arFields) {

// при тправки формы обратной связи
    if($arFields['IBLOCK_ID'] == 14) {
        CModule::IncludeModule("iblock");
        $EVENT_TYPE = 'FEEDBACK_FORM'; // тип почтового шаблона

        $arMailFields['NAME'] = $arFields['NAME'];
        $arMailFields['PHONE'] = $arFields['PROPERTY_VALUES'][156];
        $arMailFields['MAIL'] = $arFields['PROPERTY_VALUES'][157];


        CEvent::Send($EVENT_TYPE, 's1', $arMailFields);
    }

}

AddEventHandler('iblock', 'OnAfterIBlockElementAdd', 'IBElementCreateAfterHandlePartners');
function IBElementCreateAfterHandlePartners(&$arFields) {

// при отправки формы обратной связи партнеров
    if($arFields['IBLOCK_ID'] == 15) {
        CModule::IncludeModule("iblock");
        $EVENT_TYPE = 'PARTNERS_FORM'; // тип почтового шаблона
        //AddMessage2Log(print_r($arFields,true),'partners');

        $arMailFields['NAME'] = $arFields['NAME'];
        $arMailFields['PHONE'] = $arFields['PROPERTY_VALUES'][158];
        $arMailFields['MAIL'] = $arFields['PROPERTY_VALUES'][159];
        //тип партнера
        $db_props = CIBlockElement::GetProperty($arFields['IBLOCK_ID'], $arFields['ID'], "sort", "asc", Array("CODE"=>"TYPE"));
        $type="";
        while($ar_props = $db_props->Fetch()) {
            $type = $type . " " . $ar_props['VALUE_ENUM'];
        }
        $arMailFields['TYPE']=$type;
        CEvent::Send($EVENT_TYPE, 's1', $arMailFields);
    }

}

AddEventHandler('iblock', 'OnAfterIBlockElementAdd', 'IBElementCreateAfterHandlerContacts');
function IBElementCreateAfterHandlerContacts(&$arFields) {

// при тправки формы обратной связи контакты
    if($arFields['IBLOCK_ID'] == 16) {
        CModule::IncludeModule("iblock");
        $EVENT_TYPE = 'CONTACTS_FORM'; // тип почтового шаблона

        $arMailFields['NAME'] = $arFields['NAME'];
        $arMailFields['PHONE'] = $arFields['PROPERTY_VALUES'][161];
        $arMailFields['MAIL'] = $arFields['PROPERTY_VALUES'][162];


        CEvent::Send($EVENT_TYPE, 's1', $arMailFields);
    }

}
?>