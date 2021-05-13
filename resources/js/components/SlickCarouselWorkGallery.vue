<template>
    <div v-bind:class="classWrapperSlickCarousel">
        <div class="nav-dots"></div>
        <div class="nav-arrows"></div>
        <Slick ref="slick" :options="settings" v-bind:class="classSlickCarousel">
            <img v-for="(n, i) in countSlides" class="img-gallery img-fluid" alt="наши работы"
                 :src="getPathImg(n)">
        </Slick>
    </div>
</template>

<script>
import Slick from 'vue-slick'


export default {
    name: 'SlickCarouselWorkGallery',
    props: {
        //Номер выводимой галереи
        numGallery: {
            type: Number,
            required: true
        },
        //Кол-во слайдов в галерее
        countSlides:{
            type: Number,
            required: true
        }
    },
    computed: {


    },
    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            classSlickCarousel: 'slick-carousel-work-gallery slick-carousel-work-gallery-num'+this.numGallery,
            classWrapperSlickCarousel: 'wrapper-slick wrapper-slick-num'+this.numGallery,
            settings: {
                method: {},
                arrows: false,
                dots: true,
                infinite: true,
                speed: 300,
                // appendDots: '.nav-dots',
                // appendArrows: '.nav-arrows',
                // nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                // prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                slidesToShow: 1,
                centerPadding: '50px', //default 50px
                slidesToScroll: 1,
                rows: 0,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            // appendArrows: '.nav-arrows',
                            nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                            prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            infinite: true,
                            arrows: false,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            // appendArrows: '.nav-arrows',
                            nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                            prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            infinite: true,
                            arrows: false,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            // appendArrows: '.nav-arrows',
                            nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                            prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
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
            getPathImg(num){
                return "/img/usr_img/page_our_work/gallery"+this.numGallery+"/slide"+num+".jpg";
            },
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
