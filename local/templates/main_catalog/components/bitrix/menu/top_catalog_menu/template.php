<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?use \Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);?>

<?if (!empty($arResult)):?>
    <nav class="navbar navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li <?if ($APPLICATION->GetCurPage(false) === '/catalog/'):?>class="active"<?endif;?>><a href="/catalog/"><?=Loc::getMessage('MENU_CATALOG_TEXT')?></a></li>
                    <?foreach($arResult as $arItem):?>

                            <li class="<?if($arItem["SELECTED"]):?>active<?endif?> <?if($arItem['CHILDS']):?>dropdown visible-sm visible-md visible-lg hidden-xs<?endif?>">
                                <a href="<?=$arItem["LINK"]?>" <?if($arItem['CHILDS']):?>class="dropdown-toggle" data-toggle="dropdown"<?endif?>>
                                    <?=$arItem["TEXT"]?>
                                    <?if($arItem['CHILDS']):?>
                                        <b class="caret"></b>
                                    <?endif?>
                                </a>

                                <?if($arItem['CHILDS']):?>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <? foreach ($arItem['CHILDS'] as $nestedItem): ?>
                                                <a href="<?=$nestedItem['LINK']?>" class="<?if($nestedItem["SELECTED"]):?>active<?endif?>">
                                                    <?=$nestedItem['TEXT']?>
                                                </a>
                                            <? endforeach ?>
                                        </li>
                                    </ul>
                                <?endif?>
                            </li>

                    <?endforeach?>
                </ul>
            </div>
        </div>
    </nav>
<?endif;?>