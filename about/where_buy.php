<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Где купить?");
?>
	<section class="buy">
		<div class="container">
			<div class="row">
				<hr>
				<div class="text-center">
					<div class="participation__title">Где купить?</div>
				</div>
			</div>
			<div class="row">
				<form id="choose_shop_form">
					<div class="col-md-12 buy__menu">
						<div class="col-md-3 text-center">
							<select class="selectpicker" data-live-search="true" name="city">
								<option value="choose_city">Выберите город</option>
								<?//олучаем список городов
								$arSort = array("SORT" => "ASC");
								$arFilter = array("IBLOCK_ID" => 17, "DEPTH_LEVEL" => 1);
								$rsSections = CIBlockSection::GetList($arSort, $arFilter);
								while ($arSection = $rsSections->GetNext()) {?>
									<option value="<?=$arSection['ID']?>" <?if($_GET['city']==$arSection['ID']):?>selected<?endif;?>><?=$arSection['NAME']?></option>
								<?	}
								?>

							</select>
						</div>
						<div class="col-md-9 text-center">
							<div class="col-md-3">
								<label for="all-shop" class="buy__menu-btn <?if($_GET['type-mag']=='all-shop' || !isset($_GET['type-mag'])):?>active<?endif;?>">Все магазины</label>
								<input type="radio" <?if($_GET['type-mag']=='all-shop' || !isset($_GET['type-mag'])):?>checked<?endif;?> id="all-shop" name="type-mag" class="map-radio-input" value="all-shop">
							</div>
							<div class="col-md-3">
								<label for="internet-shop" class="buy__menu-btn <?if($_GET['type-mag']=='20'):?>active<?endif;?>">Интернет-магазины</label>
								<input type="radio" <?if($_GET['type-mag']=='20'):?>checked<?endif;?>  id="internet-shop" name="type-mag" class="map-radio-input" value="20">
							</div>
							<div class="col-md-3">
								<label for="net-shop" class="buy__menu-btn <?if($_GET['type-mag']=='21'):?>active<?endif;?>">Сетевые магазины</label>
								<input type="radio" id="net-shop" name="type-mag" class="map-radio-input" <?if($_GET['type-mag']=='21'):?>checked<?endif;?> value="21">
							</div>
							<div class="col-md-3">
								<label for="hyper-shop" class="buy__menu-btn <?if($_GET['type-mag']=='22'):?>active<?endif;?>">Гипермаркеты</label>
								<input type="radio" <?if($_GET['type-mag']=='22'):?>checked<?endif;?> id="hyper-shop" name="type-mag" class="map-radio-input" value="22">
							</div>
						</div>
					</div>
					
				</form>
			</div>

			<div class="row">
				<div class="col-md-12">
					<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	"map", 
	array(
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "SMALLZOOM",
			2 => "MINIMAP",
			3 => "TYPECONTROL",
			4 => "SCALELINE",
			5 => "SEARCH",
		),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:3:{s:10:\"yandex_lat\";s:7:\"55.7383\";s:10:\"yandex_lon\";s:7:\"37.5946\";s:12:\"yandex_scale\";i:10;}",
		"MAP_HEIGHT" => "900",
		"MAP_ID" => "",
		"MAP_WIDTH" => "",
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_RIGHT_MAGNIFIER",
			3 => "ENABLE_DRAGGING",
		),
		"COMPONENT_TEMPLATE" => "map"
	),
	false
);?>
				</div>
			</div>
		</div>
	</section>
<script>

		console.log( "ready!" );
		$('.selectpicker, .map-radio-input').on('change',function(){

			if($(this).val()!='choose_city'){
				$('#choose_shop_form').submit();
			}

		});


</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>