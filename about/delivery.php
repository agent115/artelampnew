<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//require($_SERVER["DOCUMENT_ROOT"]."/local/templates/main_catalog/header.php");

$APPLICATION->SetTitle("Доставка и оплата");
?>
<?$APPLICATION->IncludeComponent(
								"bitrix:menu",
								"top_top_menu",
								array(
									"ALLOW_MULTI_SELECT" => "N",
									"CHILD_MENU_TYPE" => "left",
									"DELAY" => "N",
									"MAX_LEVEL" => "1",
									"MENU_CACHE_GET_VARS" => array(),
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_USE_GROUPS" => "N",
									"ROOT_MENU_TYPE" => "top2",
									"USE_EXT" => "N",
									"COMPONENT_TEMPLATE" => "top_top_menu"
								),
								false
							); ?>
<section class="delivery"> 
  <div class="container"> 
    <div class="row"> 
      <ol class="breadcrumb"> 
        <li> 					<a href="/" >Главная</a> </li>
       
        <li class="active">Доставка и оплата</li>
       </ol>
     </div>
   
    <div class="row"> 
      <div class="col-md-6 delivery__del"> <span>Доставка</span> 
        <p> Доставка товара осуществляется со склада ArteLamp В Москве по всей территории России (более 10 000 населенных пунктов!), а также в страны СНГ, за исключением труднодоступных регионов. Интернет-магазин оказывает услуги по продаже товаров на территории Российской Федерации и стран СНГ. </p>
       <strong>Стоимость доставки</strong> 
        <div class="panel-group" id="accordion"> 
          <div class="panel panel-default"> 
            <div class="panel-heading"> 
              <h4 class="panel-title"> <a href="#collapseOne" data-toggle="collapse" data-parent="#accordion"> Курьером по Москве и Подмосковью </a> </h4>
             </div>
           
            <div id="collapseOne" class="panel-collapse collapse in"> 
              <div class="panel-body"> Москва в пределах МКАД – <strong>300 руб.,</strong> 
                <br />
               при заказе от 6 000 рублей - <strong>Бесплатно</strong> 
                <br />
               МО за пределами МКАД – <strong>30 р/км.</strong> 
                <br />
               <em>Оплата производится курьеру наличными средствами. Выдается кассовый чек.</em></div>
             </div>
           </div>
         
          <div class="panel panel-default"> 
            <div id="collapseTwo" class="panel-collapse collapse"> </div>
           </div>
         
          <div class="panel panel-default"> 
            <div class="panel-heading"> 
              <h4 class="panel-title"> <a href="#collapseThree" data-toggle="collapse" data-parent="#accordion"> Самовывоз </a> </h4>
             </div>
           
            <div id="collapseThree" class="panel-collapse collapse"> 
              <div class="panel-body"> Ваш город: <select class="form-control"> <option value="">Москва</option> <option value="">Санкт-Петербург</option> </select> <em> При выборе данного способа доставки необходимо дождаться звонка оператора для подтверждения срока готовности Вашего заказа. Обращаем Ваше внимание, что срок хранения заказа в пункте самовывоза курьерской службы – 7 дней </em> </div>
             </div>
           </div>
         
          <div class="panel panel-default"> 
            <div class="panel-heading"> 
              <h4 class="panel-title"> <a href="#collapseFour" data-toggle="collapse" data-parent="#accordion"> Доставка по России транспортной 
                  <br />
                 компанией </a> </h4>
             </div>
           
            <div id="collapseFour" class="panel-collapse collapse"> 
              <div class="panel-body"> Доставка по России транспортной компанией осуществляется за счет покупателя.</div>
             </div>
           </div>
         </div>
       </div>
     
      <div class="col-md-6 delivery__pay"> <span>Оплата</span> 
        <p> При переходе к оплате Вы подтверждаете свое согласие с Условиями продажи товаров компанией Technolight. Способ оплаты любого заказа Вы выбираете при его оформлении. Вы можете выбрать один из следующих вариантов: </p>
       
        <div class="panel-group" id="accordion2"> 
          <div class="panel panel-default"> 
            <div class="panel-heading"> 
              <h4 class="panel-title"> <a href="#payOne" data-toggle="collapse" data-parent="#accordion2" aria-expanded="true"> Оплата наличными при доставке </a> </h4>
             </div>
           
            <div id="payOne" class="panel-collapse collapse in"> 
              <div class="panel-body"> Оплата наличными</div>
             </div>
           </div>
         
          <div class="panel panel-default"> 
            <div id="payTwo" class="panel-collapse collapse"> </div>
           </div>
         
          <div class="panel panel-default"> 
            <div class="panel-heading"> 
              <h4 class="panel-title"> <a href="#payThree" data-toggle="collapse" data-parent="#accordion2" aria-expanded="true"> Оплата картой при получении </a> </h4>
             </div>
           
            <div id="payThree" class="panel-collapse collapse"> 
              <div class="panel-body"> Оплата картой при получении. Данный способ оплаты доступен для жителей Москвы и ближайшего Подмосковья.</div>
             </div>
           </div>
         
          <div class="panel panel-default"> 
            <div class="panel-heading"> 
              <h4 class="panel-title"> <a href="#payFour" data-toggle="collapse" data-parent="#accordion2" aria-expanded="true"> Оплата банковским переводом </a> </h4>
             </div>
           
            <div id="payFour" class="panel-collapse collapse"> 
              <div class="panel-body"> Оплата банковским переводом </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   <hr> <hr> 
    <div class="row hidden-xs"> 
      <div class="col-md-12"> 
        <div class="delivery__title">Общие условия</div>
       
        <div class="row"> 
          <ul class="delivery__conditions"> 
            <li>Бесплатная доставка по России при заказе от 30 000 рублей.</li>
           
            <li>Полная гарантия на все изделия 1 год.</li>
           
            <li>Возврат и обмен товара по желанию клиента в течение 7 дней с момента получения.</li>
           
            <li>Возможность приобретения комплектующих (например, если во время использования разобьется плафон).</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </section> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>