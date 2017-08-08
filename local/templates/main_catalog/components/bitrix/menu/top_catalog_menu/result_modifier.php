<?php

$preparedLinksData = array();
$currentIndex = -1; // Потому что так надо

foreach ($arResult as $itemMenu)
{
    if($itemMenu['DEPTH_LEVEL'] == 1)
    {
        $currentIndex++;
        $preparedLinksData[$currentIndex] = $itemMenu;
        $preparedLinksData[$currentIndex]['CHILDS'] = array();
        $itemMenu['TEXT'] = "ВСЕ ".$itemMenu['TEXT'];
        $preparedLinksData[$currentIndex]['CHILDS'][] = $itemMenu;
    }
    else
    {
        $preparedLinksData[$currentIndex]['CHILDS'][] = $itemMenu;
    }
}

$arResult = $preparedLinksData;