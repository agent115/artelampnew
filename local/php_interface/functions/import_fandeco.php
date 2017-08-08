<?
CModule::IncludeModule('sale');
CModule::IncludeModule('catalog');
CModule::IncludeModule('iblock');

Class IMPORTFAMDECO
{
    static private $arSection = array();
    static private $IBLOCK_ID = 25;
    static private $PRICE_TYPE_ID = 2;
    function SectionUpdate($section,$arSectonXml){
        if($section['parentId']!="")
            IMPORTFAMDECO::SectionUpdate($arSectonXml[$section['parentId']],$arSectonXml);
        if(is_array(self::$arSection[$section["id"]])){
            if( self::$arSection[$section["id"]]["value"] != $section["value"] || self::$arSection[$section["id"]]["parentId"] != $section["parentId"]){
                $bs = new CIBlockSection;
                $arFields = Array(
                    "IBLOCK_SECTION_ID" => self::$arSection[$section["parentId"]]["id"],
                    "IBLOCK_ID" => self::$IBLOCK_ID,
                    "NAME" =>  $section["value"],
                    "CODE" => Cutil::translit($section["value"],"ru",array('change_case'=>'L')),
                    "ACTIVE" => "Y",

                );

                if(self::$arSection[$section["id"]]["id"] > 0)
                {
                    $bs->Update(self::$arSection[$section["id"]]["id"], $arFields);
                    self::$arSection[$section["id"]] = array("value"=>$arFields["NAME"],"parentId"=>$arFields["IBLOCK_SECTION_ID"],'id'=>self::$arSection[$section["id"]]["id"]);
                }
            }
        }
        else{
            $bs = new CIBlockSection;
            $arFields = Array(
                "IBLOCK_SECTION_ID" => self::$arSection[$section["parentId"]]["id"],
                "IBLOCK_ID" => self::$IBLOCK_ID,
                "NAME" =>  $section["value"],
                "XML_ID" => $section["id"],
                "CODE" => Cutil::translit($section["value"],"ru",array('change_case'=>'L')),
                "ACTIVE" => "Y",

            );
            $id= $bs->Add($arFields);
            self::$arSection[$section["id"]] =
                array("value"=>$arFields["NAME"],"parentId"=>$arFields["IBLOCK_SECTION_ID"],'id'=>$id);

        }
        self::$arSection[$section["id"]]['FLAG'] = 'Y';
    }

    function SectionDeactivation(){
        $ar =  self::$arSection;
        $bs = new CIBlockSection;

        foreach ($ar as $section){
            if($section["FLAG"] == "Y") continue;
            $bs->Update($section["id"], array("ACTIVE" => "N"));
        }
    }

    function to_array(&$input)
    {    //Переделаем все элементы из объектов в массивы
        if (is_object($input)) $input = (array)$input;
        foreach ($input AS $key => $value) {
            if (is_object($value)) $input[$key] = (array)$value;
            if (is_array($input[$key])) IMPORTFAMDECO::to_array($input[$key]);
        }
    }
    function section_to_array(&$input)
    {
        $ar = array();
        $i = 0;
        foreach ($input as $key=>$value) {
            $arr = array();
            foreach ($value->attributes() as $a => $b)
                $arr[$a] = (string)$b;

            $ar[$arr['id']] = array('value' => (string)$value,'id'=>$arr['id'],'parentId'=>$arr["parentId"]);
            $i++;
        }
        $input = $ar;
    }

    function addProperty($name){
        $trans = Cutil::translit($name,"ru",array('change_case'=>'U'));
        $arFields = Array(
            "NAME" => $name,
            "ACTIVE" => "Y",
            "SORT" => "500",
            "CODE" => $trans,
            "PROPERTY_TYPE" => "S",
            "IBLOCK_ID" => self::$IBLOCK_ID,

        );
        $iblockproperty = new CIBlockProperty;
        $PropertyID = $iblockproperty->Add($arFields);
        return $arFields;
    }

    function property_to_array(&$arProp){
        $ar = array();
        $i = 0;
        foreach ($arProp as $key=>$value) {
            $arr = array();
            foreach ($value->attributes() as $a => $b)
                $arr[$a] = (string)$b;

            $ar[$arr['name']] = array('value' => (string)$value,'name'=>$arr['name']);
            $i++;
        }
        return $ar;
    }
    function Import_Fandeco()
    {

        $xml = file_get_contents('https://fandeco.ru/media/xml_export/for_us.xml');
        $data = new SimpleXMLElement($xml);
        $el = new CIBlockElement;


        // секции
        $arSectonXml = $data->shop->categories->category;
        IMPORTFAMDECO::section_to_array($arSectonXml);
        $res = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>self::$IBLOCK_ID),false,array("ID","NAME","XML_ID","IBLOCK_SECTION_ID"));
        while ($ar = $res->GetNext()){
            self::$arSection[$ar['XML_ID']] = array("id"=>$ar['ID'],'value'=>$ar['NAME'],'parentId'=>$ar["IBLOCK_SECTION_ID"]);
        }


        foreach ($arSectonXml as $section) {
            IMPORTFAMDECO::SectionUpdate($section, $arSectonXml);
        }

        IMPORTFAMDECO::SectionDeactivation();




        $arSections = array();
        $res = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>self::$IBLOCK_ID),false,array("ID","XML_ID"));
        while ($arSec =  $res->GetNext())
            $arSections[$arSec["XML_ID"]] = $arSec["ID"];

        $arPropeties = array();
        $properties = CIBlockProperty::GetList(Array(), Array("IBLOCK_ID"=>self::$IBLOCK_ID));
        while ($prop_fields = $properties->GetNext())
        {
            $arPropeties[$prop_fields["NAME"]] = $prop_fields;

        }


        $arElementCatalog = array();
        $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>self::$IBLOCK_ID),false,false,
            array("ID","IBLOCK_SECTION_ID","NAME","PROPERTY_HASH_PIC","PROPERTY_HASH_PROPERTIES","PROPERTY_HASH_PRICE","XML_ID","ACTIVE","IBLOCK_ID"));
        while ($ar = $res->GetNext())
        {
            $arElementCatalog[$ar["XML_ID"]] = $ar;
        }

        foreach ($data->shop->offers->offer as $arItem){

            if($arItem->vendor != 'arte_lamp') continue;

            $atr = array();
            foreach ($arItem->attributes() as $a => $b)
                $atr[$a] = (string)$b;


            $arProp = IMPORTFAMDECO::property_to_array($arItem->param);
            $str_hash='';
            foreach ($arProp as $prop){
                $str_hash.= $prop['value'];
                if(is_array($arPropeties[$prop['name']])){ continue;}
                    $arPropeties[$prop["name"]] = IMPORTFAMDECO::addProperty($prop["name"]);
            }
            $str_hash = md5($str_hash);

            if(is_array($arElementCatalog[$atr['id']])){
                $arLoadProductArray = Array();
                $arPropertiesUpdate = array();

                if($arElementCatalog[$atr['id']]['PROPERTY_HASH_PRICE_VALUE'] !=(string)$arItem->price ){
                    $arprice = Array(
                        "PRODUCT_ID" => $arElementCatalog[$atr['id']]['ID'],
                        "CATALOG_GROUP_ID" => self::$PRICE_TYPE_ID,
                        "PRICE" =>(string)$arItem->price ,
                        "CURRENCY" => "RUB",
                    );
                    $res = CPrice::GetList(array(), array("PRODUCT_ID" => $arElementCatalog[$atr['id']]['ID'], "CATALOG_GROUP_ID" => self::$PRICE_TYPE_ID));
                    if ($arrP = $res->Fetch())
                        CPrice::Update($arrP["ID"], $arprice);
                    else
                        CPrice::Add($arprice);

                    $arPropertiesUpdate['HASH_PRICE'] = (string)$arItem->price;
                }

                if($arElementCatalog[$atr['id']]['PROPERTY_HASH_PROPERTIES_VALUE'] != $str_hash){

                    foreach ($arProp as $prop){
                        $arPropertiesUpdate[$arPropeties[$prop["name"]]["ID"]] = $prop["value"];
                    }
                    $arPropertiesUpdate['HASH_PROPERTIES'] = $str_hash;
                }

                if($arElementCatalog[$atr['id']]['PROPERTY_HASH_PIC_VALUE'] != (string)$arItem->picture){
                    $arLoadProductArray["PREVIEW_PICTURE"] = CFile::MakeFileArray((string)$arItem->picture);
                    $arPropertiesUpdate['HASH_PIC'] = (string)$arItem->picture;
                }

                if($arElementCatalog[$atr['id']]['IBLOCK_SECTION_ID'] != $arSections[(string)$arItem->categoryId])
                    $arLoadProductArray['IBLOCK_SECTION_ID'] = $arSections[(string)$arItem->categoryId];


                if($arElementCatalog[$atr['id']]['NAME'] != (string)$arItem->name)
                    $arLoadProductArray['NAME'] = (string)$arItem->name;
                if($arElementCatalog[$atr['id']]['ACTIVE'] != 'Y')
                    $arLoadProductArray['ACTIVE'] = 'Y';

                if(count($arPropertiesUpdate) > 0) {
                    echo("Updating, id:".$atr['id'].", ".join(", <br>".PHP_EOL,$arPropertiesUpdate)."<br>".PHP_EOL);
                    CIBlockElement::SetPropertyValuesEx($arElementCatalog[$atr['id']]['ID'], self::$IBLOCK_ID, $arPropertiesUpdate);
                }

                if(count($arLoadProductArray) > 0) {
                    $arLoadProductArray["IBLOCK_ID"] = self::$IBLOCK_ID;
                    $el->Update($arElementCatalog[$atr['id']]['ID'], $arLoadProductArray);
                }
                unset($arElementCatalog[$atr['id']]);
            }
            else{
                $arPropAdd = array();
                foreach ($arProp as $prop){
                    $arPropAdd[$arPropeties[$prop["name"]]["ID"]] = $prop["value"];
                }
                $arPropAdd['HASH_PRICE'] = (string)$arItem->price;
                $arPropAdd['HASH_PROPERTIES'] = $str_hash;
                $arPropAdd['HASH_PIC'] = (string)$arItem->picture;


                $arLoadProductArray = Array(
                    "IBLOCK_SECTION_ID" => $arSections[(string)$arItem->categoryId],          // элемент лежит в корне раздела
                    "IBLOCK_ID"      => self::$IBLOCK_ID,
                    "CODE"           => Cutil::translit((string)$arItem->name,"ru",array('change_case'=>'L')),
                    "PROPERTY_VALUES"=> $arPropAdd,
                    "NAME"           => (string)$arItem->name,
                    "XML_ID"         => $atr['id'],
                    "ACTIVE"         => "Y",            // активен
                    "PREVIEW_PICTURE" => CFile::MakeFileArray((string)$arItem->picture)
                );

                if($PRODUCT_ID = $el->Add($arLoadProductArray)){
                    echo("Added, id:".$atr['id'].", ".(string)$arItem->name."<br>".PHP_EOL);
                    CCatalogProduct::Add(array('ID'=>$PRODUCT_ID,'QUANTITY_TRACE'=>'D','CAN_BUY_ZERO'=>'D','SUBSCRIBE'=>'D'));
                        $arprice = Array(
                            "PRODUCT_ID" => $PRODUCT_ID,
                            "CATALOG_GROUP_ID" => self::$PRICE_TYPE_ID,
                            "PRICE" => $arPropAdd['HASH_PRICE'],
                            "CURRENCY" => "RUB",
                        );
                       CPrice::Add($arprice);
                }
            }
        }
        foreach ($arElementCatalog as $arItem)
        {
            $el->Update($arItem['ID'], array('ACTIVE'=>'N'));
        }
    }
}