<template>

    <Slick ref="slick" :options="settings" v-bind:class="classSlickCarousel">

        <!---------------- Box Casing Option -------------------->
        <div
            class="list-casing-options__box-casing-option box-casing-option box-casing-option1">

            <img class="img-casing-option"
                 src="/img/usr_img/page_our_work/img_casing_options/img1.png">

            <div class="box-casing-option__name-casing-option name-casing-option">
                Стальная обсадная труба<br>диаметром Ø133мм
            </div>
        </div>
        <!---------------- End Box Casing Option -------------------->

        <!---------------- Box Casing Option -------------------->
        <div
            class="list-casing-options__box-casing-option box-casing-option box-casing-option2">

            <img class="img-casing-option"
                 src="/img/usr_img/page_our_work/img_casing_options/img2.png">

            <div class="box-casing-option__name-casing-option name-casing-option">
                Стальная обсадная труба<br>диметром Ø159мм
            </div>
        </div>
        <!---------------- End Box Casing Option -------------------->


        <!---------------- Box Casing Option -------------------->
        <div
            class="list-casing-options__box-casing-option box-casing-option box-casing-option3">

            <img class="img-casing-option"
                 src="/img/usr_img/page_our_work/img_casing_options/img3.png">

            <div class="box-casing-option__name-casing-option name-casing-option">
                Стальная обсадная труба<br>диаметром Ø133мм + <br>обсадная питьевая ПНД<br> труба диметром Ø117
                мм
            </div>
        </div>
        <!---------------- End Box Casing Option -------------------->


        <!---------------- Box Casing Option -------------------->
        <div
            class="list-casing-options__box-casing-option box-casing-option box-casing-option4">

            <img class="img-casing-option"
                 src="/img/usr_img/page_our_work/img_casing_options/img4.png">

            <div class="box-casing-option__name-casing-option name-casing-option">
                Стальная обсадная труба<br> диаметром Ø159мм + <br>обсадная питьевая НПВХ<br> труба диаметром
                Ø125 мм
            </div>
        </div>
        <!---------------- End Box Casing Option -------------------->





    </Slick>

</template>

<script>
import Slick from 'vue-slick'


export default {
    name: 'SlickCarouselCasingOptions',
    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            classSlickCarousel: 'slick-carousel-casing-options row',

            settings: {
                draggable: false,
                method: {},
                dots: false,
                infinite: true,
                speed: 300,
                arrows: false,
                slidesToShow: 4,
                centerPadding: '50px', //default 50px
                slidesToScroll: 1,
                rows: 0,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            arrows: true,
                            nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                            prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: false,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            arrows: true,
                            infinite: false,
                            nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                            prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: true,
                            nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                            prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: false
                        }
                    }
                ]

            },


        }
    },

    // All slick methods can be used too, example here
    methods:
        {
            next() {
                this.$refs.slick.next()
            },
            prev() {
                this.$refs.slick.prev()
            },
            reInit() {
                // Helpful if you have to deal with v-for to update dynamic lists
                this.$refs.slick.reSlick()
            }

        },
    components: {
        Slick
    }
}
</script>
