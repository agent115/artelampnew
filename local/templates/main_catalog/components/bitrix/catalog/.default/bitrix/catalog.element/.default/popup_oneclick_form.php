<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<div class="overlay">
    <div class="popup" id="buyInOneClick">
       
        <div class="popup__close"></div>
        <div class="popup__title">Оформить заказ</div>
        <div class="form">
            <form action="">
                <input type="hidden" value="<?=$_POST['ELEMENT_ID']?>" id="oneclick_element_id">
                <fieldset>
                    <div class="desc">Ваше имя</div>
                    <label for="" class="name required"><input type="text" name="name" id="oneclick_name"></label>
                    <div class="form__error">Введите имя правильно</div>
                </fieldset>
                <fieldset>
                    <div class="desc">Контактный телефон</div>
                    <label for="" class="phone required"><input type="text" name="phone" id="oneclick_phone"></label>
                    <div class="form__error">Введите телефон правильно</div>
                </fieldset>
                <div class="form__btn col-xs-12 col-md-5" id="oneclick_btn_submit">Отправить быстрый заказ</div>
                <div class="col-xs-12 col-md-6 col-md-offset-1">
                    <p>
                        Наш менеджер свяжется<br>
                        с вами в течение 15 минут<br>
                        для продолжения оформления заказа
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>