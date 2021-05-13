<!--noindex-->
<modal-callback ref="modalCallback"></modal-callback>
<modal-video ref="modalVideo"></modal-video>
<mmenu-mobile v-bind:m-menu='@json($menu['mainmenujson']) '></mmenu-mobile>

<div
    class="header-mobile @if($headerMini) header-mobile-inner-page @endif d-xl-none d-lg-none d-md-block d-sm-block d-block">

    <div id="mhead-tablet" class="header-mobile__mobile-tablet-header mobile-tablet-header d-xl-none d-lg-none d-md-block d-sm-block d-block">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-6 mobile-tablet-header__block-logo block-logo">
                    <a class="block-logo__link-block-logo link-block-logo" href="/">
                        <img alt="Бурение скважин в Орле ООО Блиц" class="link-block-logo__img-logo d-md-block d-sm-block d-none img-logo img-fluid"
                             src="{{asset('img/tpl_img/tablet/logo_tablet.png')}}">
                        <img alt="Бурение скважин в Орле ООО Блиц" class="link-block-logo__img-logo d-md-none d-sm-none d-block img-logo img-fluid"
                             src="{{asset('img/tpl_img/mobile/logo_mobile.png')}}">
                    </a>
                </div>
                <div class="col-md-4 col-sm-4 col-6 mobile-tablet-header__block-header-phone block-header-phone">
                    <a href="tel:+79616223344" class="block-header-phone__link-phone link-phone">8-961-622-33-44</a>
                </div>

                <!----------- Button Mburger ------------>
                <a href="#menu" class="d-xl-none d-lg-none d-md-block d-sm-block d-none mburger">
                    <b></b>
                    <b></b>
                    <b></b>
                </a>
                <!----------- End Button Mburger ------------>


            </div>

        </div>
    </div>





</div>
<!--/noindex-->

<!--noindex-->

<div class="block-mmenu d-xl-none d-lg-none d-md-none d-sm-block d-block">

    <ul class="block-mmenu__mobile-mmenu-burger row mobile-mmenu-burger">
        <li class="mobile-menu-burger__item-mmenu item-mmenu item-mmenu-mburger col-4">
            <a href="#menu" class="mburger link-item-mmenu">
                <b></b>
                <b></b>
                <b></b>
            </a>
            <span class="text-burger">меню</span>
        </li>

        <li class="mobile-menu-burger__item-mmenu item-mmenu item-mmenu-mail col-4">
            <a class="item-mmenu__link-item-mmenu link-item-mmenu" href="mailto:">
                <span class="text-link">оставить заявку</span></a>
        </li>

        <li class="mobile-menu-burger__item-mmenu item-mmenu item-mmenu-phone col-4">
            <a class="item-mmenu__link-item-mmenu link-item-mmenu" href=""> <span class="text-link">позвонить</span></a>
        </li>
    </ul>


</div>


<!--/noindex-->


<div class="header d-xl-block d-lg-block d-md-none d-sm-none d-none @if($headerMini) header-inner-page @endif">


    <!----------------------- HEADER TOP BLOCK -------------------->
    <div class="container-fluid header__header-top-block header-top-block">

        <div class="container">
            <div class="row">

                <div class="col-xl-auto col-lg-auto header-top-block__header-block-logo header-block-logo">
                    <a class="header-block-logo__link-logo link-logo" href="/">
                        <img class="img-fluid" alt="Бурение скважин в Орле ООО Блиц"
                             src="{{asset('img/tpl_img/logo.png')}}">
                    </a>
                </div>

                <div class="col-xl-auto col-lg-auto header-top-block__header-slogan header-slogan">
                    <h2 class="header-slogan__title-header-slogan title-header-slogan">Воду в каждый дом!</h2>
                </div>


                <div class="col-xl-auto col-lg-auto header-top-block__header-block-callback header-block-callback">
                    <button @click="$refs.modalCallback.show()" class="header-block-callback__bt-callback bt-callback">
                        Заказать
                        звонок
                    </button>

                </div>

                <div class="col-xl-auto col-lg-auto header-top-block__header-block-phone header-block-phone">
                    <a href="tel:+79616223344" class="header-block-phone__link-phone link-phone">8-961-622-33-44</a>
                </div>


            </div>
        </div>
    </div>
    <!-----------------------/ END HEADER TOP BLOCK -------------------->


    <!-------------------- HEADER BLOCK TITLE ---------------->
    <div class="container header__header-block-title header-block-title">
        <div class="w-100">
            <h1 class="header-block-title__header-title header-title">Профессиональное<br>
                бурение и обустройство<br>
                скважин на воду</h1>
        </div>
    </div>
    <!-------------------- END HEADER BLOCK TITLE ---------------->



    <!-------------------- HEADER BLOCK NAVIGATION ---------------->
    <div class="container header__header-block-navigation header-block-navigation">

        <div class="header-block-navigation__wrapper-main-menu d-flex align-items-center wrapper-main-menu">
        <!----------------- TOP NAVIGATION ------------------>
            {{$menu['mainmenu']}}
        <!----------------- END TOP NAVIGATION ------------------>
        </div>

    </div>
    <!-------------------- HEADER BLOCK NAVIGATION ---------------->

</div>

