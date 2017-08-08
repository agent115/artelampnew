<?require_once ($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/lib/custom_mails.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/functions/import_fandeco.php');


AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("MyClass", "OnBeforeIBlockElementAddHandler"));

class MyClass
{
    // ñîçäàåì îáðàáîò÷èê ñîáûòèÿ "OnBeforeIBlockElementAdd"
    function OnBeforeIBlockElementAddHandler(&$arFields)
    {
        file_put_contents($_SERVER["DOCUMENT_ROOT"]."/log_1_1.txt", print_r($arFields,true), FILE_APPEND | LOCK_EX);
    }
}





AddEventHandler("catalog", "OnStoreProductUpdate", Array("ClassUpdateActive", "OnStoreProductUpdate"));
AddEventHandler("catalog", "OnStoreProductDelete", Array("ClassUpdateActive", "OnStoreProductUpdate"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("ClassUpdateActive", "OnAfterIBlockElementUpdate"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("ClassUpdateActive", "OnAfterIBlockElementUpdate"));
AddEventHandler("main", "OnAfterEpilog", Array("ClassUpdateActive","UpdateProperty"));





class ClassUpdateActive
{
    function OnStoreProductUpdate(&$arFields)
    {
        $_SESSION["UPDATE_ELEMENT"][$arFields["PRODUCT_ID"]] = $arFields["PRODUCT_ID"];
    }
    function OnAfterIBlockElementUpdate(&$arFields)
    {
        if($arFields["IBLOCK_ID"] == "25")
             $_SESSION["UPDATE_ELEMENT"][$arFields["ID"]] = $arFields["ID"];
    }
    function UpdateProperty($a = array(),$b = array(), $c = ""){
        if(is_array($_SESSION["UPDATE_ELEMENT"]) && count($_SESSION["UPDATE_ELEMENT"])>0)
            $_SESSION["UPDATE_ELEMENT"] = array_diff($_SESSION["UPDATE_ELEMENT"], array(0, null));
        if(is_array($_SESSION["UPDATE_ELEMENT"]) && count($_SESSION["UPDATE_ELEMENT"])>0) {


            CModule::IncludeModule("iblock");
            $res = CIBlockElement::GetList(
                array(),
                array(
                    "IBLOCK_ID" => 25,
                    "ACTIVE" => "Y",
                    "ID"=>$_SESSION["UPDATE_ELEMENT"],
                    array(
                        "LOGIC" => "OR",
                        //array("<CATALOG_QUANTITY" => "1",),
                        array("CATALOG_AVAILABLE" => "N",),
                        array( "PREVIEW_PICTURE" => false, "DETAIL_PICTURE" => false),
                    ),
                ),
                false,
                false,
                array("ID", "IBLOCK_ID", "PREVIEW_PICTURE","DETAIL_PICTURE","CATALOG_QUANTITY"));
            
/////
//			$log = "#######".PHP_EOL;
//            $log .= "selecting: ".PHP_EOL;
//			ob_start();
//            print_r($res);
//			$callb = ob_get_contents();
//			ob_end_flush();
//			$log .= $callb.PHP_EOL;
//			$log .= "--------------".PHP_EOL;

////
            $el = new CIBlockElement;
            while($ar = $res->GetNext()){
                $el->Update($ar["ID"], array("ACTIVE"=>"N"));
            
                //$log .= "updating".$ar["ID"].": ".PHP_EOL;
                //ob_start();
                //print_r($el);
                //$callb = ob_get_contents();
                //ob_end_flush();
                //$log .= $callb.PHP_EOL;
                //$log .= '/update.'.PHP_EOL;
            }
            
            
            
            
            
		//	$myfile = file_put_contents('/home/i/interdecor/artenew/init_log.txt', $log , FILE_APPEND | LOCK_EX);            
        }
    }
}

if (!function_exists('pr')) {
    function pr($o, $showEveryone = false) {
        if (PHP_SAPI == 'cli') {
            print_r($o);
            return;
        }
        global $USER;
        if (!$USER->IsAdmin() and !$showEveryone) {
            return;
        }
        echo '<pre style="font-size: 10pt; background-color: #fff; color: #000; margin: 10px; padding: 10px; border: 1px solid red; text-align: left; max-width: 800px; max-height: 600px; overflow: scroll">';
        echo htmlspecialcharsEx(print_r($o, true));
        echo '</pre>';
    }
}

