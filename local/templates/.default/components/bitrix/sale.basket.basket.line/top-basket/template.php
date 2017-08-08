<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$cartId = "bx_basket".$component->getNextNumber();
$arParams['cartId'] = $cartId;

?>

<script>
	var <?=$cartId?> = new BitrixSmallCart;
</script>

	<div  id="<?=$cartId?>" >
	<? $frame = $this->createFrame($cartId, false)->begin();?>
	<span>В корзине товаров <?=$arResult['NUM_PRODUCTS']?>
		<p class="active">
			На сумму  <?=$arResult['TOTAL_PRICE']?><br>
			<a class="price" href="<?=$arParams['PATH_TO_BASKET']?>">Оформить заказ</a>
		</p>

	<?$frame->end(); ?>
		</div>

<script>
	<?=$cartId?>.siteId       = '<?=SITE_ID?>';
	<?=$cartId?>.cartId       = '<?=$cartId?>';
	<?=$cartId?>.ajaxPath     = '<?=$componentPath?>/ajax.php';
	<?=$cartId?>.templateName = '<?=$templateName?>';
	<?=$cartId?>.arParams     =  <?=CUtil::PhpToJSObject ($arParams)?>; // TODO \Bitrix\Main\Web\Json::encode
	<?=$cartId?>.closeMessage = '<?=GetMessage('TSB1_COLLAPSE')?>';
	<?=$cartId?>.openMessage  = '<?=GetMessage('TSB1_EXPAND')?>';
	<?=$cartId?>.activate();
</script>
