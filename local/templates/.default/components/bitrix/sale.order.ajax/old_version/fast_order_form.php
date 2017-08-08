<div class="buyInOneClick col-xs-12 col-md-5">
    <div class="buyInOneClick__title">Оформить заказ</div>
    <div class="form fast_order_form">
        <input type="hidden" value="<?=$templateFolder?>" id="ajax_fast_order_url">
        <fieldset>
        <div class="desc">Ваше имя</div>
        <label for="" class="name required"><input type="text" class="name_fast_order" name="name_fast_order"></label>
            <div class="form__error">Введите имя</div>
        </fieldset>
        <fieldset>
            <div class="desc">Контактный телефон</div>
            <label for="" class="phone required"><input type="text" class="phone_fast_order" name="phone_fast_order"></label>
            <div class="form__error">Введите телефон</div>
        </fieldset>
        <div class="form__btn fast_order_btn col-xs-12 col-md-5" role="thx">Быстрый заказ</div>
        <div class="col-xs-12 col-md-6 col-md-offset-1">
            <p>
                Наш менеджер свяжется<br>
                с вами в течение 15 минут<br>
                для продолжения оформления заказа
            </p>
    </div>

    </div>
</div>
<script>
    $('.fast_order_btn').on('click',function(e) {
        e.preventDefault();

        var parent = $('.fast_order_form'),
            ajax_url = $('#ajax_fast_order_url').val(),
            name_fast_order_val = parent.find('.name_fast_order').val(),
            phone_fast_order_val = parent.find('.phone_fast_order').val(),
            name_fast_order = parent.find('.name_fast_order'),
            phone_fast_order = parent.find('.phone_fast_order');

        if (!name_fast_order_val) {
            name_fast_order.closest('fieldset').find('label').addClass('red');
            name_fast_order.closest('fieldset').find('.form__error').css('opacity', '1');
        }

        if (!phone_fast_order_val) {
            phone_fast_order.closest('fieldset').find('label').addClass('red');
            phone_fast_order.closest('fieldset').find('.form__error').css('opacity', '1');
        }

        if (name_fast_order_val) {
            name_fast_order.closest('fieldset').find('label').removeClass('red');
            name_fast_order.closest('fieldset').find('.form__error').css('opacity', '0');
        }

        if (phone_fast_order_val) {
            phone_fast_order.closest('fieldset').find('label').removeClass('red');
            phone_fast_order.closest('fieldset').find('.form__error').css('opacity', '0');
        }

        if (phone_fast_order_val && name_fast_order_val) {
            var data = 'NAME=' + name_fast_order_val + '&PHONE=' + phone_fast_order_val;

            $.ajax({
                url: ajax_url + '/ajax_fast_order.php',
                type: "POST",
                data: data,
                success: function (res) {

                    $(".popup").remove(), $(".overlay").remove();

                    $.ajax({
                        url: ajax_url + '/success_fast_order.php',
                        type: "get",
                        dataType: "html",
                        data: "1",
                        success: function (e) {
                            $(".shopHeader").before(e);
                            
                        }
                    });
                }
            });
        }

    });
</script>