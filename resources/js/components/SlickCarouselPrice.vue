<template>
    <div>

        <div class="nav-dots-price"></div>
        <Slick ref="slick" :options="settings" v-bind:class="classSlickCarousel">

            <!----------------- BOX PRICE TOP --------------------->
            <div
                class="block-box-price__box-price box-price col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 box-price-left">
                <div class="box-price__title-box-price title-box-price">
                    Бурение скважин<br>
                    на сухую
                </div>
                <div class="box-price__text-box-price text-box-price">
                    предполагает бурение шнеками по<br>
                    мягким породам, а по скальным -<br>
                    бурение колонковым методом.<br>
                    Бурение скважин глубиной до 30<br>
                    метров.
                </div>
                <div class="box-price__block-box-price block-box-price block-box-price-left">
                    от 2 400 руб./м
                </div>
            </div>
            <!----------------- END BOX PRICE TOP --------------------->



            <!----------------- BOX PRICE BOTTOM --------------------->
            <div
                class="block-box-price__box-price box-price col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 box-price-right">
                <div class="box-price__title-box-price title-box-price">
                    Бурение скважины<br>
                    с промывкой
                </div>
                <div class="box-price__text-box-price text-box-price">
                    все виды пород разрушаются <br>
                    шарошечными долотьями, а<br>
                    разрушенный шлам вымывается<br>
                    вместе с буровым раствором.
                </div>
                <div class="box-price__block-box-price block-box-price block-box-price-right">
                    от 2 400 руб./м
                </div>
            </div>
            <!----------------- END BOX PRICE BOTTOM --------------------->

        </Slick>
    </div>
</template>

<script>
import Slick from 'vue-slick'


export default {
    name: 'SlickCarouselPrice',
    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            classSlickCarousel: 'slick-carousel-price row',

            settings: {
                draggable: false,
                dots: false,
                arrows: false,
                infinite: true,
                speed: 300,
                appendDots: '.nav-dots-price',
                // appendArrows: '.nav-arrows',
                // nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                // prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                slidesToShow: 2,
                centerPadding: '70px', //default 50px
                slidesToScroll: 1,
                rows: 0,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            arrows: true,
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
                            arrows: false,
                            nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                            prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true
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
