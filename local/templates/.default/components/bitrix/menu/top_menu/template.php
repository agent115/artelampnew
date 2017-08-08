<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?$this->setFrameMode(true);?>
<? if (!empty($arResult)): ?>
    <nav class="menu__navbar navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">

                <?
                $previousLevel = 0;
                foreach($arResult as $arItem):?>

                <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                    <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                <?endif?>

                <?if ($arItem["IS_PARENT"]):?>

                <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    <ul>
                        <?else:?>
                        <li class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                            <ul>
                <?endif?>

                <?else:?>

                    <?if ($arItem["PERMISSION"] > "D"):?>

                        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                            <?if($arItem['TEXT']=='Интернет-магазин'){?>

                                <li class="visible-sm visible-md visible-lg hidden-xs <?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                                    <li class="dropdown hidden-sm hidden-md hidden-lg visible-xs <?if ($arItem["SELECTED"]):?>active<?endif?>">
                                     <a href="<?=$arItem["LINK"]?>" class="dropdown-toggle" data-toggle="dropdown"><?=$arItem["TEXT"]?> <b class="caret"></b></a>
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:menu",
                                            "top_mob_mag_menu",
                                            array(
                                                "ALLOW_MULTI_SELECT" => "N",
                                                "CHILD_MENU_TYPE" => "left",
                                                "DELAY" => "N",
                                                "MAX_LEVEL" => "1",
                                                "MENU_CACHE_GET_VARS" => array(
                                                ),
                                                "MENU_CACHE_TIME" => "3600",
                                                "MENU_CACHE_TYPE" => "N",
                                                "MENU_CACHE_USE_GROUPS" => "N",
                                                "ROOT_MENU_TYPE" => "left",
                                                "USE_EXT" => "Y",
                                                "COMPONENT_TEMPLATE" => "footer_menu",
                                                "MENU_THEME" => "site"
                                            ),
                                            false
                                        );?>

                                </li>

                             <?}else{?>
                            <li  class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>" ><?=$arItem["TEXT"]?></a></li>
                            <?}?>
                        <?else:?>
                            <li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                        <?endif?>

                    <?else:?>

                        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                            <li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
                        <?else:?>
                            <li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
                        <?endif?>

                    <?endif?>

                <?endif?>

                <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

                <?endforeach?>

                <?if ($previousLevel > 1)://close last item tags?>
                    <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
                <?endif?>


            </div>
        </div>
    </nav>
<? endif ?>
