<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$frame = $this->createFrame()->begin("");
if (!empty($arResult['ITEMS'])) { ?>
    <div class="vertical_slider col-xs-12">
        Последние<br>просмотренные<br>товары
        <div class="col-xs-12 swiper-container swiper-vertical">
            <div class="swiper-wrapper">
                <? foreach ($arResult['ITEMS'] as $key => $arItem): ?>
                    <div class="swiper-slide">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?$arItem['PREVIEW_PICTURE']['SRC']:$arItem['DETAIL_PICTURE ']['SRC'];?>" alt="<?=$arItem['NAME']?>">
                        </a>
                    </div>
                <?endforeach; ?>
            </div>
        </div>
        <div class="swiper-button-next arrow_up"></div>
        <div class="swiper-button-prev arrow_down"></div>
    </div>
<?
} ?>

<? $frame->end();
