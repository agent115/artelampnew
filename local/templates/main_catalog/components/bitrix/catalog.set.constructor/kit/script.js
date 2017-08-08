BX.namespace("BX.Catalog.SetConstructor");

BX.Catalog.SetConstructor = (function () {
    var SetConstructor = function (params) {


        this.ajaxPath = params.ajaxPath || "";

        this.lid = params.lid || "";
        this.iblockId = params.iblockId || "";
        this.basketUrl = params.basketUrl || "";
        this.setIds = params.setIds || null;
        this.offersCartProps = params.offersCartProps || null;
        this.itemsRatio = params.itemsRatio || null;
        this.parentCont = BX(params.parentContId) || null;
        var buyButton = this.parentCont.querySelector("[data-role='set-buy-btn']");
        BX.bind(buyButton, "click", BX.proxy(this.addToBasket, this));

    };


    SetConstructor.prototype.addToBasket = function () {
        var target = BX.proxy_context;

        BX.showWait(target.parentNode);

        BX.ajax.post(
            this.ajaxPath,
            {
                sessid: BX.bitrix_sessid(),
                action: 'catalogSetAdd2Basket',
                set_ids: this.setIds,
                lid: this.lid,
                iblockId: this.iblockId,
                setOffersCartProps: this.offersCartProps,
                itemsRatio: this.itemsRatio
            },
            BX.proxy(function (result) {
                BX.closeWait();
                document.location.href = this.basketUrl;
            }, this)
        );
    };

    return SetConstructor;
})();