<?
//картинки для видео
foreach($arResult['ITEMS'] as $keyItem=>$arItem) {
    foreach ($arItem['DISPLAY_PROPERTIES']['PHOTO_VIDEO']['VALUE'] as $key => $value) {
        $img = CFile::GetFileArray($value);
        if (is_array($img)) {
            $arResult['ITEMS'][$keyItem]['DISPLAY_PROPERTIES']['PHOTO_VIDEO']['VALUE'][$key] = $img;

        }
    }
}