<template>
    <div class="block-certificates__slider-certificates slider-certificates">
        <div class="nav-arrows"></div>

        <Slick ref="slick" :options="settings" v-bind:class="classSlickCarousel">

            <!--------------- box certificate 1 ---------------->
            <div class="box-certificate box-certificate1">
                <div class="box-certificate__name-certificate name-certificate">
                    Свидетельство ОГРН
                </div>


                <a href="" :key="index" :visible="visibleLocal" @hide="handleHide" :index="index" @click.prevent="showMultiple(0)" class="box-certificate__link-certificate link-certificate">
                    <img  :alt="images[0].alt" :class="classImgLightbox"
                          :src="images[0].src">
                </a>

            </div>
            <!--------------- end box certificate 1 ---------------->


            <!--------------- box certificate 2 ---------------->
            <div class="box-certificate box-certificate2">
                <div class="box-certificate__name-certificate name-certificate">
                    Свидетельство ИНН
                </div>
                <a href="" :key="index" :visible="visibleLocal" @hide="handleHide" :index="index" @click.prevent="showMultiple(1)" class="box-certificate__link-certificate link-certificate">
                    <img  :alt="images[1].alt" :class="classImgLightbox"
                          :src="images[1].src">
                </a>
            </div>
            <!--------------- end box certificate 2 ---------------->


            <!--------------- box certificate 3 ---------------->
            <div class="box-certificate box-certificate3">
                <div class="box-certificate__name-certificate name-certificate">
                    Сертификат качества
                </div>
                <a href="" :key="index" :visible="visibleLocal" @hide="handleHide" :index="index" @click.prevent="showMultiple(2)" class="box-certificate__link-certificate link-certificate">
                    <img  :alt="images[2].alt" :class="classImgLightbox"
                          :src="images[2].src">
                </a>
            </div>
            <!--------------- end box certificate 3 ---------------->


            <!--------------- box certificate 4 ---------------->
            <div class="box-certificate box-certificate4">
                <div class="box-certificate__name-certificate name-certificate">
                    Сертификат соответствия
                </div>


                <a href="" :key="index" :visible="visibleLocal" @hide="handleHide" :index="index" @click.prevent="showMultiple(3)" class="box-certificate__link-certificate link-certificate">
                    <img  :alt="images[3].alt" :class="classImgLightbox"
                          :src="images[3].src">
                </a>
            </div>
            <!--------------- end box certificate 4 ---------------->


            <!--------------- box certificate 5 ---------------->
            <div class="box-certificate box-certificate5">
                <div class="box-certificate__name-certificate name-certificate">
                    Свидетельство<br> о государственной регистрации
                </div>
                <a href="" :key="index" :visible="visibleLocal" @hide="handleHide" :index="index" @click.prevent="showMultiple(4)" class="box-certificate__link-certificate link-certificate">
                    <img  :alt="images[4].alt" :class="classImgLightbox"
                          :src="images[4].src">
                </a>
            </div>
            <!--------------- end box certificate 5 ---------------->


            <!--------------- box certificate 6 ---------------->
            <div class="box-certificate box-certificate6">
                <div class="box-certificate__name-certificate name-certificate">
                    Сертификат соответствия
                </div>
                <a href="" :key="index" :visible="visibleLocal" @hide="handleHide" :index="index" @click.prevent="showMultiple(5)" class="box-certificate__link-certificate link-certificate">
                    <img  :alt="images[5].alt" :class="classImgLightbox"
                          :src="images[5].src">
                </a>
            </div>
            <!--------------- end box certificate 5 ---------------->


        </Slick>
        <vue-easy-lightbox
            :visible="visibleLocal"
            :imgs='imgs'
            :index="index"
            @hide="handleHide"
        ></vue-easy-lightbox>
    </div>
</template>

<script>
import Slick from 'vue-slick'
import VueEasyLightbox from 'vue-easy-lightbox'

Vue.use(VueEasyLightbox)

export default {
    name: 'SlickCarouselCertificates',
    props: ['visible'],
    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            classSlickCarousel: 'slick-carousel-certificates row',
            visibleLocal: this.visible,
            index: 0,
            classImgLightbox: 'link-certificate__img-certificate img-certificate img-fluid',
            imgs: null,
            images: [
                {
                    alt: "Свидетельство ОГРН",
                    title: "Свидетельство ОГРН",
                    src: "/img/usr_img/certificates/sert1.jpg",
                    class: "box-certificate__link-certificate link-certificate"
                },
                {
                    alt: "Свидетельство ИНН",
                    title: "Свидетельство ИНН",
                    src: "/img/usr_img/certificates/sert2.jpg",
                    class: "link-certificate__img-certificate img-certificate img-fluid"
                },
                {
                    alt: "Сертификат качества",
                    title: "Сертификат качества",
                    src: "/img/usr_img/certificates/sert3.jpg",
                    class: "link-certificate__img-certificate img-certificate img-fluid"
                },
                {
                    alt: "Сертификат сответсвия",
                    title: "Сертификат сответсвия",
                    src: "/img/usr_img/certificates/sert4.jpg",
                    class: "link-certificate__img-certificate img-certificate img-fluid"
                },
                {
                    alt: "Свидетельство о государственной регистрации",
                    title: "Свидетельство о государственной регистрации",
                    src: "/img/usr_img/certificates/sert5.jpg",
                    class: "link-certificate__img-certificate img-certificate img-fluid"
                },
                {
                    alt: "Сертификат соответствия",
                    title: "Сертификат соответствия",
                    src: "/img/usr_img/certificates/sert6.jpg",
                    class: "link-certificate__img-certificate img-certificate img-fluid"
                }
            ],
            settings: {
                draggable: false,
                method: {},
                dots: false,
                infinite: false,
                speed: 300,
                // appendDots: '.nav-dots',
                appendArrows: '.nav-arrows',
                nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                slidesToShow: 3,
                centerPadding: '70px', //default 50px
                slidesToScroll: 1,
                rows: 0,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
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
            },
            showImg(index) {
                console.log(this.images[index]);
                this.imgs = this.images[index].src
                this.index = index
                this.show()
            },
            showMultiple(index) {
                this.imgs = this.images
                this.index = index
                this.show()
            },
            show() {
                this.visibleLocal = true
            },
            handleHide() {
                this.visibleLocal = false
            }

        },
    components: {
        Slick
    }
}
</script>
