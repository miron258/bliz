<template>
    <div>
        <div class="nav-arrows"></div>
        <div class="nav-dots"></div>
        <Slick v-if="isReviewsLoaded" ref="slick" :options="settings" v-bind:class="classSlickCarousel">

            <!---------------------------- BOX REVIEWER ------------------------------->
            <div v-for="review in listReviews" class="block-list-reviews__box-review box-review">


                <!---------------- Block Reviewer ---------------->
                <div class="block-reviewer">

                    <!-------------------- Description Reviewer ------------------->
                    <div class="block-reviewer__description-reviewer d-flex description-reviewer">

                        <!---------------- Img Reviewer ---------------->
                        <div v-if="review.img" class="description-reviewer__img-reviewer img-reviewer">
                            <img  class="img-circle" :alt="review.name" :src="review.path">
                        </div>
                        <!---------------- End Img Reviewer ---------------->


                        <div v-bind:class="{'indent-left' : review.img}" class="description-reviewer__block-info-reviewer block-info-reviewer">
                            <div class="block-info-reviewer__name-reviewer name-reviewer">{{ review.name }}</div>
                            <div v-html="review.text_order" class="block-info-reviewer__text-order text-order"></div>
                            <div class="block-info-reviewer__location-reviewer location-reviewer">{{ review.address }}
                            </div>
                        </div>
                    </div>
                    <!-------------------- End Description Reviewer ------------------->
                    <!------------------ Text Review --------------------->
                    <div v-html="review.text" class="box-review__text-review text-review"></div>
                    <!------------------ End Text Review --------------------->
                </div>
                <!---------------- End Block Reviewer ---------------->

            </div>
            <!---------------------------- END BOX REVIEWER ------------------------------->


        </Slick>
    </div>
</template>

<script>
import Slick from 'vue-slick'
import axios from "axios"
import VueAxios from 'vue-axios'


//Хуки жизненнго цикла в компоненте Vue
// created — экземпляр компонента создан
// mounted — экземпляр компонента cмонтирован
// updated — виртуальный DOM был обновлён из-за изменения данных
// destroyed — экземпляр компонента уничтожен


export default {
    name: 'SlickCarouselReviews',
    computed: {
        listReviews() {
            return this.reviews.map(function (review) {
                review.path = "/storage/" + review.img;
                return review;
            });
        }

    },
    mounted() {

        axios.get('/api/v1/reviews')
            .then(res => {
                let status = res.data.success;

                if (status) {
                    this.reviews = res.data.reviews;
                } else {
                    this.reviews = res.data.reviews;
                }


            }).catch(err => {


            console.log(err);


        })
            .finally(() => {
                this.isReviewsLoaded = true;
            });
    },

    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            reviews: null,
            isReviewsLoaded: false,
            classSlickCarousel: 'slick-carousel-reviews',
            settings: {
                method: {},
                dots: true,
                // enabled: false,
                infinite: false,
                speed: 300,
                event: {
                    init: function () {


                    }
                },
                appendDots: '.nav-dots',
                appendArrows: '.nav-arrows',
                nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                slidesToShow: 2,
                centerPadding: '50px', //default 50px
                slidesToScroll: 1,
                rows: 0,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            arrows: false,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            arrows: true,
                            nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                            prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            appendArrows: '.nav-arrows',
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

        }
    ,
    components: {
        Slick,
        axios,
        VueAxios
    }
}
</script>
