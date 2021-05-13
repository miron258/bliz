<template>
    <modal :name="name"
           :adaptive="adaptive"
           :classes="classes"
           :height="height"
           :minHeight="minHeight"
           :width="width"
           :maxWidth="maxWidth"
           :minWidth="minWidth"
           :focusTrap="focusTrap"
           :scrollable="scrollable"
           :draggable="draggable"
           :resizable="resizable"
           :reset="reset"
           :clickToClose="clickToClose">


        <div class="block-form block-form-callback">
            <div class="container">
                <!--------------- FORM ORDER ------------------->
                <form-order :bt-modal-close="true"></form-order>
                <!--------------- END FORM ORDER ------------------->
            </div>
        </div>

    </modal>
</template>

<script type="module">
import VModal from 'vue-js-modal'
import FormOrder from '../FormOrder/FormOrder.vue'

Vue.use(VModal, {dialog: true});


export default {
    name: "ModalCallback",
    // props: ['minHeight', 'maxWidth', 'minWidth'],
    components: {
        FormOrder
    },
    mounted() {


        console.log(this.minHeight, this.maxWidth);

    },
    data() {
        return {
            name: "modal-callback", //String required Обязательно для заполнения свойство
            classes: "v-modal-callback", //String | Array
            minWidth: "320",
            scrollable: true, //Boolean
            focusTrap: true, //Boolean
            draggable: false, //Boolean
            resizable: false, //Boolean
            reset: true, //Boolean Resets position and size before showing
            clickToClose: true, //Boolean If set to false, it will not be possible to close modal by clicking on the background or by pressing Esc key.
            minHeight: "950",
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
            this.$modal.show('modal-callback');
        },
        hide() {
            this.$modal.hide('modal-callback');
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

.vm--modal.v-modal-callback {
    overflow: initial;
    width: max-content;
    height: max-content;
    border-radius: 40px;
    position: relative;
    z-index: 20;


    //Перезапись стилей по умолчанию для формы заказа
    //////////// Block Form Callback
    .block-form.block-form-callback {
        margin-top: 0;
        position: relative;
        z-index: 20;

        .container {
            padding-left: 0px;
            padding-right: 0px;

            .container-block-form {
                position: relative;

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
            }

        }

    }

    //////////// End Block Form Callback


}

/////// MEDIA QUERY MOBILE STYLE
@media (max-width: 600px) {
    .vm--modal.v-modal-callback {
        left: 0;
        border-radius: 0px;

        .block-form.block-form-callback {
            margin-top: 30px;

            .container {


                .container-block-form {


                    .v-modal-close {
                        right: 10px;
                        top: -36px;
                    }
                }
            }
        }
    }
}

/////// END MEDIA QUERY MOBILE STYLE

</style>
