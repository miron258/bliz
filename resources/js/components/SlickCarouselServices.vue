<template>
<div>
    <div class="nav-dots-services"></div>
    <Slick ref="slick" :options="settings" v-bind:class="classSlickCarousel">


        <!--------------- BOX SERVICE 1 ------------------>
        <div class="block-list-services__box-service box-service box-service1">

            <div class="box-service__block-img-service block-img-service">
                <img class="block-img-service__img-service img-service img-fluid" alt="Бурение скважин"
                     src="/img/tpl_img/img_services/img1.png">
                <div class="block-img-service__name-service name-service">Бурение <br>скважин</div>
            </div>

            <div class="box-service__block-text-service block-text-service">
                <div class="block-text-service__text-service text-service">
                    Бурение всех типов скважин, любой глубины. Как на сухую (шнековое), так и с промывкой.
                </div>

                <a class="block-text-service__link-service link-service" href="/page/burenie_skvazhin">Подробнее</a>
            </div>
        </div>
        <!--------------- END BOX SERVICE 1  ------------------>


        <!--------------- BOX SERVICE 3 ------------------>
        <div class="block-list-services__box-service box-service box-service2">

            <div class="box-service__block-img-service block-img-service">
                <img class="block-img-service__img-service img-service img-fluid" alt="Ремонт и чистка скважин"
                     src="/img/tpl_img/img_services/img2.png">
                <div class="block-img-service__name-service name-service">Ремонт и чистка <br>скважин</div>
            </div>

            <div class="box-service__block-text-service block-text-service">
                <div class="block-text-service__text-service text-service">
                    Выполним чистку скважины с предотвращением причины заиливания.
                    Выполним ремонт скважины
                    при его целесообразности.
                </div>

                <a class="block-text-service__link-service link-service" href="/page/remont_i_chistka_skvazhin">Подробнее</a>
            </div>
        </div>
        <!--------------- END BOX SERVICE 3 ------------------>



        <!--------------- BOX SERVICE 4 ------------------>
        <div class="block-list-services__box-service box-service box-service3">

            <div class="box-service__block-img-service block-img-service">
                <img class="block-img-service__img-service img-service img-fluid" alt="Обустройство скважин"
                     src="/img/tpl_img/img_services/img5.png">
                <div class="block-img-service__name-service name-service">Обустройство <br>скважин</div>
            </div>

            <div class="box-service__block-text-service block-text-service">
                <div class="block-text-service__text-service text-service">
                    Установим водоподъемное оборудование для вашей скважины, как в дачном варинте (использование
                    летом), так и для круглогодичного использования.
                </div>

                <a class="block-text-service__link-service link-service" href="/page/obustroistvo_skvazhin">Подробнее</a>
            </div>
        </div>
        <!--------------- END BOX SERVICE 4 ------------------>



        <!--------------- BOX SERVICE 2 ------------------>
        <div class="block-list-services__box-service box-service box-service4">

            <div class="box-service__block-img-service block-img-service">
                <img class="block-img-service__img-service img-service img-fluid" alt="Инженерные изыскания"
                     src="/img/tpl_img/img_services/img4.png">
                <div class="block-img-service__name-service name-service">Инженерные <br>изыскания</div>
            </div>

            <div class="box-service__block-text-service block-text-service">
                <div class="block-text-service__text-service text-service">
                    Выполним буровые работы под инженерные изыскания.
                    Шнековым и колонковым методами, с применением грунтоносов
                    и кернорвателей.
                </div>

                <a class="block-text-service__link-service link-service" href="/page/inzhenernie_iziskaniya">Подробнее</a>
            </div>
        </div>
        <!--------------- END BOX SERVICE 2  ------------------>






        <!--------------- BOX SERVICE 5 ------------------>
        <div class="block-list-services__box-service box-service box-service5">

            <div class="box-service__block-img-service block-img-service">
                <img class="block-img-service__img-service img-service img-fluid" alt="Извлечение насосов"
                     src="/img/tpl_img/img_services/img3.png">
                <div class="block-img-service__name-service name-service">Извлечение <br>насосов</div>
            </div>

            <div class="box-service__block-text-service block-text-service">
                <div class="block-text-service__text-service text-service">
                    Достанем насос из вашей
                    скважины при обрыве его от трубы
                    и страховочного троса.
                </div>

                <a class="block-text-service__link-service link-service" href="/page/izvlechenie_nasosov">Подробнее</a>
            </div>
        </div>
        <!--------------- END BOX SERVICE 5 ------------------>


    </Slick>
</div>
</template>

<script>
import Slick from 'vue-slick'


export default {
    name: 'SlickCarouselServices',
    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            classSlickCarousel: 'slick-carousel-services w-100',

            settings: {
                dots: false,
                infinite: false,
                arrows: false,
                speed: 300,
                // appendDots: '.nav-dots',
                // appendArrows: '.nav-arrows',
                // nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                // prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                slidesToShow: 3,

                slidesToScroll: 1,
              //  slidesPerRow: 3,
                rows: 2,
                // mobileFirst: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            arrows: true,
                            // appendArrows: '.nav-arrows',
                            nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                            prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                            slidesToShow: 2,
                            // slidesPerRow: 0,
                            rows: 1,
                            slidesToScroll: 1,
                            infinite: false,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            arrows: true,
                            // appendArrows: '.nav-arrows',
                            nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                            prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                            slidesToShow: 1,
                            // slidesPerRow: 0,
                            rows: 1,
                            infinite: false,
                            slidesToScroll: 1,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            appendDots: '.nav-dots-services',
                            // appendArrows: '.nav-arrows',
                            nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                            prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                            rows: 1,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true
                        }
                    }
                ]

            }
        }
    },

    // All slick methods can be used too, example here
    methods: {
        next() {
            this.$refs.slick.next()
        },
        prev() {
            this.$refs.slick.prev()
        },
        reInit() {
            // Helpful if you have to deal with v-for to update dynamic lists
            this.$refs.slick.reSlick()
        },
    },
    components: {Slick}
}
</script>
