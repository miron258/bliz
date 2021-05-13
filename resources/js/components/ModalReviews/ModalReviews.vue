<template>
    <modal :name="name"
           :height="height"
           :minHeight="minHeight"
           :width="width"
           :maxWidth="maxWidth"
           :minWidth="minWidth"
           :adaptive="adaptive"
           :classes="classes"
           :focusTrap="focusTrap"
           :scrollable="scrollable"
           :draggable="draggable"
           :resizable="resizable"
           :reset="reset"
           :clickToClose="clickToClose">

        <!--------------- FORM ADD REVIEW ------------------->
        <div class="block-form-add-review">
            <button v-if="isBtModalClose" class="v-modal-close" @click="hide"></button>
            <div class="container">
                <h2 class="block-form-add-review__title-review title-review">
                    Уже воспользовались нашими услугами?<br>
                    Поделитесь отзывом.
                </h2>

                    <form-add-review></form-add-review>

            </div>
        </div>
        <!--------------- END FORM ADD REVIEW ------------------->


    </modal>
</template>

<script type="module">
import VModal from 'vue-js-modal'
import FormAddReview from "../FormAddReview/FormAddReview";

Vue.use(VModal, {dialog: true});


export default {
    name: "ModalReviews",
    props: {
        btModalClose: String
    },
    components: {
        FormAddReview
    },
    mounted() {

    },
    data() {
        return {
            isBtModalClose: this.btModalClose,
            name: "modal-reviews", //String required Обязательно для заполнения свойство
            classes: "v-modal-reviews", //String | Array
            minWidth: "320",
            scrollable: true, //Boolean
            focusTrap: true, //Boolean
            draggable: false, //Boolean
            resizable: false, //Boolean
            reset: true, //Boolean Resets position and size before showing
            clickToClose: true, //Boolean If set to false, it will not be possible to close modal by clicking on the background or by pressing Esc key.
            minHeight: "500",
            maxWidth: "1140",
            maxHeight: "",
            width: "100%",
            height: "auto",
            styles: "", //String | Array | Object
            adaptive: true
        }
    },
    computed: {},
    methods: {
        show() {
            this.$modal.show('modal-reviews');
        },
        hide() {
            this.$modal.hide('modal-reviews');
        },
        //Access Events
        beforeOpen(event) {
            console.log('Opening...')
        },
        beforeClose(event) {
            console.log('Closing...')

        }
    }
}
</script>

<style lang="scss">
.vm--container {
    .vm--overlay {
        background: rgba(11, 25, 31, 0.8);

        .vm--top-right-slot {

        }
    }
}

.vm--modal.v-modal-reviews {
    overflow: initial;
    width: max-content;
    height: max-content;
    border-radius: 40px;
    position: relative;
    background: #F3F9FB;

    //Перезапись стилей по умолчанию для формы добавления отзыва
    //////////// Block Form Add Review
    .block-form-add-review {
        margin-top: 0;
        position: relative;
        padding-top: 5rem;
        padding-bottom: 2rem;
        .v-modal-close {
            position: absolute;
            border: none;
            outline: none;
            width: 44px;
            right: -40px;
            top: -35px;
            height: 44px;
            background: url('/img/tpl_img/close_modal.png') no-repeat;
        }

        &:before {
            content: "";
            display: block;
            position: absolute;
            width: 100%;
            top: 38px;
            height: 22px;
            background: linear-gradient(90.24deg, #0B729A 0.48%, #3AB0DE 27.43%, #0B729A 50.24%, #369DC6 73.05%, #0B729A 97.41%), #0B729A;
        }

        .title-review {
            font-family: Montserrat Alternates;
            font-style: normal;
            font-weight: 600;
            font-size: 34px;
            line-height: 41px;
            text-align: center;
            margin: 0 auto;
            color: #000000;
        }

        .container {


            @import "./resources/sass/desktop/page/layouts/form_add_review";

            .container-block-form-reviews {

                /****************** AJAX LOADER *******************/
                .loader-gif {

                    background-color: #F3F9FB;


                    .ajax-loader {

                    }
                }

                /****************** END AJAX LOADER *******************/




                ////// Form Add Review
                .form-reviews {
                    .form-group.form-group-btn-review{
                        margin-top: 1rem;
                        .btn-send-review {

                        }
                    }
                    .wrapper-form-reviews-fields {
                        padding-top: 2rem;
                        padding-left: 2rem;
                        padding-right: 2rem;
                        .form-group {
                            input.form-control {
                                width: 100%;
                            }
                            textarea.form-control {
                                width: 100%;
                                height: 183px;
                            }
                        }

                        .leftblock-form {
                            left: 0px;
                            margin-top: 0px;
                        }

                        .rightblock-form {
                            right: 0px;
                            margin-top: 0px;
                            .form-group-review{
                                margin-top: 0px;
                            }
                        }
                    }

                }

                ////// End Form Add Review


            }

        }

    }

    //////////// End Block Form Add Review


    /////// TABLET STYLE


    /////// END TABLET STYLE


    /////// MOBILE STYLE


    /////// END MOBILE STYLE
}
@media (max-width: 600px) {
    .vm--modal.v-modal-reviews {
        left: 0;
        border-radius: 0px;

        .block-form-add-review {
            margin-top: 30px;
            padding-bottom: 8rem;
            .v-modal-close {
                right: 10px;
                top: -36px;
            }

            &:before {

            }

            .title-review {
                font-family: Montserrat Alternates;
                font-style: normal;
                font-weight: 600;
                font-size: 24px;
                line-height: 22px;
                color: #000000;
            }

            .container {


                @import "./resources/sass/desktop/page/layouts/form_add_review";

                .container-block-form-reviews {

                    .message-reviews{
                        font-size: 13px;
                        top: 5px;
                    }

                    /****************** AJAX LOADER *******************/
                    .loader-gif {

                        background-color: #F3F9FB;


                        .ajax-loader {

                        }
                    }

                    /****************** END AJAX LOADER *******************/


                    ////// Form Add Review
                    .form-reviews {
                        height: max-content;
                        padding-bottom: 2rem;
                        .form-group.form-group-btn-review {
                            margin-top: 0.7rem;

                            .btn-send-review {
                                font-size: 16px;
                                height: 35.53px;
                                line-height: 35.53px;
                            }
                        }

                        .wrapper-form-reviews-fields {


                            .form-group {

                                .invalid-feedback{
                                    margin-top: 0.05rem;
                                    font-size: 10px;
                                }

                                input.form-control {
                                    width: 100%;
                                }

                                textarea.form-control {
                                    width: 100%;
                                    height: 123px;
                                }
                            }

                            .leftblock-form {
                                left: 0px;
                                margin-top: 0px;
                            }

                            .rightblock-form {
                                right: 0px;
                                margin-top: 10px;

                                .form-group-review {
                                    margin-top: 0px;
                                }
                            }
                        }

                    }

                    ////// End Form Add Review


                }

            }

        }

    }
}

</style>
