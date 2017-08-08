<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('iblock');

$element=CIBlockElement::GetByID($_POST['ELEMENT_ID']);
if($arElement = $element->GetNext())

$arFields = Array(

);
$arFields = Array(
    "NAME"=>$arElement["NAME"],
    "LINK"=>"http://".$_SERVER["HTTP_HOST"].$arElement['DETAIL_PAGE_URL'],
    "USER_NAME"=>$_POST['NAME'],
    "USER_PHONE"=>$_POST['PHONE'],


);

////отправка почты
$event = new CEvent;
$event->Send("ONECLICK_ORDER_FORM", SITE_ID, $arFields, "N");
if($event){?>
    <div class="overlay">
        <div class="popup text-center" id="thx">
            <div class="popup__close"></div>
            <div class="popup__title">Сообщение успешно<br>отправленно</div>
            <div class="popup__subtitle">В ближайшее время с Вами свяжется наш менеджер</div>
            <div class="popup__btn popup__btn-ok">ОК</div>
        </div>
    </div>
<?}

?>