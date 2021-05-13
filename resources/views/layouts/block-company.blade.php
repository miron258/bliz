<div id="block-company" class="block-company">

    <div class="container">

        <div class="block-company-container">
            <h2 class="block-company__block-company-title block-company-title">
                @isset($page)
                    {!!$page->name!!}
                @endisset
            </h2>


            <div class="block-company__block-company-description block-company-description">


                <div class="block-company-description__block-text block-text">
                    @isset($page)
                        {!!$page->html!!}
                    @endisset
                </div>


                <!------------------ LIST BENEFITS ---------------------->
                <div class="block-company-description__list-benefits row list-benefits">

                    <!----------------- BOX BENEFITS ----------------->
                    <div
                        class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4 list-benefits__box-benefits box-benefits box-benefits1">

                        <div class="box-benefits__inner-box-benefits inner-box-benefits">
                            <div class="box-benefits__wrapper-icon-benefits wrapper-icon-benefits">
                                <img
                                    class="wrapper-icon-benefits__icon-benefits img-fluid icon-benefits"
                                    alt="более 10 лет опыта"
                                    src="{{asset('img/tpl_img/icons_company/icon1.png')}}">
                            </div>


                            <div class="box-benefits__title-benefits title-benefits">
                                более 10 лет опыта
                            </div>
                        </div>

                    </div>
                    <!----------------- END BOX BENEFITS ----------------->


                    <!----------------- BOX BENEFITS ----------------->
                    <div
                        class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4 list-benefits__box-benefits box-benefits box-benefits2">
                        <div class="box-benefits__inner-box-benefits inner-box-benefits">
                            <div class="box-benefits__wrapper-icon-benefits wrapper-icon-benefits">
                                <img
                                    class="img-fluid wrapper-icon-benefits__icon-benefits img-fluid icon-benefits"
                                    alt="без предоплаты"
                                    src="{{asset('img/tpl_img/icons_company/icon2.png')}}">
                            </div>

                            <div class="box-benefits__title-benefits title-benefits">
                                без предоплаты
                            </div>
                        </div>

                    </div>
                    <!----------------- END BOX BENEFITS ----------------->


                    <!----------------- BOX BENEFITS ----------------->
                    <div
                        class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4 list-benefits__box-benefits box-benefits box-benefits3">
                        <div class="box-benefits__inner-box-benefits inner-box-benefits">
                            <div class="box-benefits__wrapper-icon-benefits wrapper-icon-benefits">
                                <img
                                    class="wrapper-icon-benefits__icon-benefits icon-benefits img-fluid"
                                    alt="собственная техника"
                                    src="{{asset('img/tpl_img/icons_company/icon3.png')}}">
                            </div>


                            <div class="box-benefits__title-benefits title-benefits">
                                собственная техника
                            </div>
                        </div>

                    </div>
                    <!----------------- END BOX BENEFITS ----------------->


                    <!----------------- BOX BENEFITS ----------------->
                    <div
                        class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4 list-benefits__box-benefits box-benefits box-benefits4">
                        <div class="box-benefits__inner-box-benefits inner-box-benefits">
                            <div class="box-benefits__wrapper-icon-benefits wrapper-icon-benefits">
                                <img
                                    class="wrapper-icon-benefits__icon-benefits icon-benefits img-fluid"
                                    alt="гарантия 2 года"
                                    src="{{asset('img/tpl_img/icons_company/icon4.png')}}">
                            </div>


                            <div class="box-benefits__title-benefits title-benefits">
                                гарантия <br>2 года
                            </div>
                        </div>

                    </div>
                    <!----------------- END BOX BENEFITS ----------------->


                    <!----------------- BOX BENEFITS ----------------->
                    <div
                        class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4 list-benefits__box-benefits box-benefits box-benefits5">
                        <div class="box-benefits__inner-box-benefits inner-box-benefits">
                            <div class="box-benefits__wrapper-icon-benefits wrapper-icon-benefits">
                                <img
                                    class="wrapper-icon-benefits__icon-benefits img-fluid icon-benefits"
                                    alt="паспорт на скважину"
                                    src="{{asset('img/tpl_img/icons_company/icon5.png')}}">
                            </div>


                            <div class="box-benefits__title-benefits title-benefits">
                                паспорт <br>на скважину
                            </div>
                        </div>
                    </div>
                    <!----------------- END BOX BENEFITS ----------------->

                </div>
                <!------------------ END LIST BENEFITS ---------------------->

            </div>


        </div>

    </div>


</div>
