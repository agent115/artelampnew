<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?if($_POST['NAME'] && $_POST['PHONE']){
    CModule::IncludeModule("sale");

    $arID = array();

    $arBasketItems = array();

    $dbBasketItems = CSaleBasket::GetList(
        array(
            "NAME" => "ASC",
            "ID" => "ASC"
        ),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL"
        ),
        false,
        false,
        array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS")
    );
    while ($arItems = $dbBasketItems->Fetch())
    {
        if ('' != $arItems['PRODUCT_PROVIDER_CLASS'] || '' != $arItems["CALLBACK_FUNC"])
        {
            CSaleBasket::UpdatePrice($arItems["ID"],
                $arItems["CALLBACK_FUNC"],
                $arItems["MODULE"],
                $arItems["PRODUCT_ID"],
                $arItems["QUANTITY"],
                "N",
                $arItems["PRODUCT_PROVIDER_CLASS"]
            );
            $arID[] = $arItems["ID"];
        }
    }
    if (!empty($arID))
    {
        $dbBasketItems = CSaleBasket::GetList(
            array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
            array(
                "ID" => $arID,
                "ORDER_ID" => "NULL"
            ),
            false,
            false,
            array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT", "PRODUCT_PROVIDER_CLASS", "NAME","DETAIL_PAGE_URL")
        );
        while ($arItems = $dbBasketItems->Fetch())
        {
            $arBasketItems[] = $arItems;
        }
    }


    $orderlist='<table><tr><td>Название</td><td>Количесвто</td><td>Стоимость</td><tr>';
    foreach($arBasketItems as $item){
        $orderlist.='<tr>'.'<td><a href="'.$_SERVER['HTTP_HOST'].$item['DETAIL_PAGE_URL'].'">'.$item['NAME'].'</a></td>'.'<td>'.$item['QUANTITY'].'</td>'.'<td>'.$item['PRICE'].'</td>'.'</tr>';
    }
    $orderlist.='</table>';


    $arEventFields = array(
       'NAME'=>$_POST['NAME'],
       'PHONE'=>$_POST['PHONE'],
        'ORDER_LIST'=>$orderlist
    );

   CEvent::Send("FAST_ORDER_ORDER", 's1', $arEventFields);

}