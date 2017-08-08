function order() {
    var e = [];
    // $(".yourOrder__list td.yourOrder__var").each(function (t, a) {
    //     e.push(parseInt($(this).text(), 10)), console.log(e);
    //     for (var i = 0, r = 0; r < e.length; r++)i += parseInt(e[r]);
    //     $(".yourOrder__varSumm, .order__title span").html(i + " Р.");
    //     var s = parseInt($(".yourOrder__var4").text(), 10), l = i + s;
    //     $(".yourOrder__allSumm").html(l + " Р.")
    // })
}
function address() {
    $("#address").keyup(function (e) {
        var t = $(this).val();
        $(".yourOrder__summ p .address").html(t)
    }), $("body").on("click", ".dropdown-menu li", function (e) {
        var t = $(this).children().children(".text").text();
        $(".yourOrder__summ p .city").html(t)
    }), $('input[name="radio1"]').click(function (e) {
        var t = $(this).siblings("label").children("span").text();
        $(".yourOrder__payment .pay").html(t)
    }), $('input[name="radio"]').click(function (e) {
        $("#samovivoz").is(":checked") ? $(".yourOrder__summ .develiry").hide() : $(".yourOrder__summ .develiry").show()
    })
}
$(document).ready(function () {
    $(".desktopNews__list li, .desktopNews__list li a").click(function (e) {
        e.preventDefault(), $(".desktopNews__list li").removeClass("active"), $(this).addClass("active")
    });
    var e = [];
    $(".shopItem__set-list span").each(function (t, a) {
        e.push($(this).text());
        for (var i = 0, r = 0; r < e.length; r++)i += parseInt(e[r]);
        $(".shopItem__set-price").html(i + " руб.")
    }), order(), address(), $(".standart__radio input").click(function (e) {
        $(".standart__radio input").removeClass("active"), $(this).addClass("active"), $("#courier").hasClass("active") ? ($(".standart__address--delivery").show(), $(".standart__address--map").hide()) : $("#samovivoz").hasClass("active") && ($(".standart__address--map").show(), $(".standart__address--delivery").hide())
    }), $("body").on("click", ".ajax-btn", function (e) {
        e.preventDefault(), $(".popup").remove(), $(".overlay").remove();
        var t = $(this).attr("role");
        $.ajax({
            url: "popups/" + t + ".html", type: "get", dataType: "html", data: "1", success: function (e) {
                $(".shopHeader").before(e)
            }
        })
    }), $(".basket__item-delete").click(function (e) {
        $(this).parent(".basket__item").remove()
    }), $("body").on("click", ".popup__close, .popup__btn-ok", function (e) {
        e.preventDefault(), $(".popup").remove(), $(".overlay").remove()
    }), $(".shopItem__table-menu li").click(function (e) {
        var t = $(this).attr("data-table");
        $(".shopItem__table-menu li").removeClass("active"), $(this).addClass("active"), $(".shopItem__characteristics table").hide(), $(".shopItem__characteristics table#table" + t).show()
    }), $(".indexCatalog__param-btn--apply").click(function (e) {
        $(".indexCatalog__param-popup").animate({opacity: 1}, 500)
    }), $(".indexCatalog__open").click(function (e) {
        $(this).toggleClass("indexCatalog__close")
    }), $(".basket__item-minus").click(function (e) {
        var t = parseInt($(this).siblings(".basket__item-var").text(), 10);
        if (t > 1) {
            var a = $(this).parent(".basket__item-counter").attr("data-price");
            t--, $(this).siblings(".basket__item-var").text(t), $(this).parents(".col-md-2").siblings(".col-md-1").find(".basket__item-price").html(a * t + " P.")
        }
    }), $(".basket__item-plus").click(function (e) {
        var t = parseInt($(this).siblings(".basket__item-var").text(), 10), a = $(this).parent(".basket__item-counter").attr("data-price");
        t++, $(this).siblings(".basket__item-var").text(t), $(this).parents(".col-md-2").siblings(".col-md-1").find(".basket__item-price").html(a * t + " P.")
    }), $("body").on("unbind, blur", 'input[name="name"], input[name="email"], input[name="phone"], input[name="captcha"]', function (e) {
        var t = $(this).attr("name"), a = $(this).val();
        switch (t) {
            case"name":
                var i = /^[a-zA-Zа-яА-Я]+$/;
                a.length > 2 && "" != a && i.test(a) ? ($(this).parent("label").removeClass("red"), $(this).parent("label").siblings(".form__error").animate({opacity: 0}, 400)) : ($(this).parent("label").addClass("red"), $(this).parent("label").siblings(".form__error").animate({opacity: 1}, 400));
                break;
            case"email":
                var r = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
                "" != a && r.test(a) ? ($(this).parent("label").removeClass("red"), $(this).parent("label").siblings(".form__error").animate({opacity: 0}, 400)) : ($(this).parent("label").addClass("red"), $(this).parent("label").siblings(".form__error").animate({opacity: 1}, 400));
                break;
            case"phone":
                var s = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
                "" != a && s.test(a) ? ($(this).parent("label").removeClass("red"), $(this).parent("label").siblings(".form__error").animate({opacity: 0}, 400)) : ($(this).parent("label").addClass("red"), $(this).parent("label").siblings(".form__error").animate({opacity: 1}, 400));
                break;
            case"captcha":
                var l = /^[a-zA-Zа-яА-Я0-9]+$/;
                "" != a && l.test(a) ? ($(this).parent("label").removeClass("red"), $(this).parent("label").siblings(".form__error").animate({opacity: 0}, 400)) : ($(this).parent("label").addClass("red"), $(this).parent("label").siblings(".form__error").animate({opacity: 1}, 400))
        }
    }), $(".sertificates__list img").click(function (e) {
        $(".sertificates__list .col-md-3").removeClass("active"), $(this).parent(".col-md-3").addClass("active"), e.preventDefault()
    }), $(document).click(function (e) {
        $(e.target).closest(".sertificates__list img").length || ($(".sertificates__list .col-md-3").removeClass("active"), e.stopPropagation())
    }), searchEffect(), $(function () {
        $("[data-toggle='tooltip']").tooltip()
    }), $('input[type="checkbox"]').click(function (e) {
        var t = $(this).attr("data-num");
        $(".sertificates__list .col-md-3").hide(), $("input").is(":checked") ? $('.sertificates__list .col-md-3[data-num="' + t + '"]').show() : $(".sertificates__list .col-md-3").hide()
    }), $(window).on("load", function () {
        $(".mCustomScrollbar").mCustomScrollbar()
    }), $(".selectpicker").selectpicker(), $("a.ns-img").fancybox()
});
var swiper = new Swiper(".swiper-container1", {
    pagination: ".swiper-pagination1",
    paginationClickable: !0
}), swiper2 = new Swiper(".swiper-container2", {
    pagination: ".swiper-pagination2",
    paginationClickable: !0
}), swiper3 = new Swiper(".swiper-container3", {
    pagination: ".swiper-pagination",
    slidesPerView: 4,
    paginationClickable: !0,
    spaceBetween: 1,
    breakpoints: {1e3: {slidesPerView: 2, spaceBetween: 10}, 768: {slidesPerView: 1, spaceBetween: 10}}
}), swiper4 = new Swiper(".swiper-container4", {
    pagination: ".swiper-pagination4",
    paginationClickable: !0
}), galleryTop = new Swiper(".gallery-top", {
    nextButton: ".swiper-button-next",
    prevButton: ".swiper-button-prev",
    spaceBetween: 10
}), galleryThumbs = new Swiper(".gallery-thumbs", {
    spaceBetween: 10,
    centeredSlides: !0,
    slidesPerView: "auto",
    touchRatio: .2,
    slideToClickedSlide: !0
}), galleryTop1 = new Swiper(".gallery-top1", {
    nextButton: ".swiper-button-next",
    prevButton: ".swiper-button-prev",
    spaceBetween: 10
}), galleryThumbs1 = new Swiper(".gallery-thumbs1", {
    spaceBetween: 10,
    centeredSlides: !0,
    slidesPerView: "auto",
    touchRatio: .2,
    slideToClickedSlide: !0
}), galleryTop2 = new Swiper(".gallery-top2", {
    nextButton: ".swiper-button-next",
    prevButton: ".swiper-button-prev",
    spaceBetween: 10
}), galleryThumbs2 = new Swiper(".gallery-thumbs2", {
    spaceBetween: 10,
    centeredSlides: !0,
    slidesPerView: "auto",
    touchRatio: .2,
    slideToClickedSlide: !0
}), galleryTop3 = new Swiper(".gallery-top3", {
    nextButton: ".swiper-button-next",
    prevButton: ".swiper-button-prev",
    spaceBetween: 10
}), galleryThumbs3 = new Swiper(".gallery-thumbs3", {
    spaceBetween: 10,
    centeredSlides: !0,
    slidesPerView: "auto",
    touchRatio: .2,
    slideToClickedSlide: !0
});
galleryTop.params.control = galleryThumbs, galleryThumbs.params.control = galleryTop, galleryTop1.params.control = galleryThumbs1, galleryThumbs1.params.control = galleryTop1, galleryTop2.params.control = galleryThumbs2, galleryThumbs2.params.control = galleryTop2, galleryTop3.params.control = galleryThumbs3, galleryThumbs3.params.control = galleryTop3;
var searchEffect = function () {
    $(".header__search label").hover(function () {
        $(this).addClass("big")
    }, function () {
        $(this).find(":text").is(":focus") || $(this).removeClass("big")
    }), $("body").on("blur", ".header__search label :text", function () {
        $(this).parents(".header__search label").removeClass("big")
    })
};