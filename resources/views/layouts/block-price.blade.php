<div id="block-price" class="block-price">

    <div class="container">

        <div class="block-price__container-block-price container-block-price">

            <h2 class="container-block-price__block-price-title block-price-title w-100">
                Сколько будет стоить?
            </h2>


            <div class="container-block-price__block-box-price block-box-price">
                <slick-carousel-price></slick-carousel-price>
            </div>

            <button @click="$refs.modalCallback.show()" class="d-xl-none d-lg-none d-md-none d-sm-block d-block bt-calculate-price">Рассчитать стоимость
            </button>


            <!------------------- BLOCK LIST PAYMENT METHODS ----------------------->
            <div
                class="container-block-price__container-block-price-bottom-block d-xl-none d-lg-none d-md-block d-sm-block d-block container-block-price-bottom-block">

                <div class="container-block-price-bottom-block__title-payment-method title-payment-method">
                    Способы оплаты:
                </div>


                <div class="footer-top-block__block-list-payment-methods block-list-payment-methods">

                    <ul class="block-list-payment-methods__list-payment-methods list-payment-methods">
                        <li class="list-payment-methods__item-payment-method item-payment-method item-payment-method-cash">
                            наличными
                        </li>
                        <li class="list-payment-methods__item-payment-method item-payment-method item-payment-method-checking-account">
                            на <span class="word-tablet">раcчетный</span> <span class="word-mobile">р/с</span> счет
                        </li>
                        <li class="list-payment-methods__item-payment-method item-payment-method item-payment-method-installments">
                            в рассрочку
                        </li>
                    </ul>

                </div>


            </div>

            <!------------------- END BLOCK LIST PAYMENT METHODS ----------------------->

        </div>


    </div>


</div>

