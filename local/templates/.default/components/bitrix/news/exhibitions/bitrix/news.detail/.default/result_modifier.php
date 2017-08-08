<?
//картинки для видео
foreach($arResult['DISPLAY_PROPERTIES']['PHOTO_VIDEO']['VALUE'] as $key=>$value) {
    $img = CFile::GetFileArray($value);
    if (is_array($img)){
        $arResult['DISPLAY_PROPERTIES']['PHOTO_VIDEO']['VALUE'][$key]=$img;

    }
}
