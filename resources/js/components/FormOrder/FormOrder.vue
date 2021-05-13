<template>

    <div class="container-block-form">
        <button v-if="isBtModalClose" class="v-modal-close" @click="hide"></button>
        <div v-show="loader" class="loader-gif">
            <img src="/img/tpl_img/ajax.gif" class="ajax-loader"/>
        </div>


        <h2 class="container-block-form__title-block-form w-100 title-block-form">
            Узнайте глубину скважины<br> на вашем участке
        </h2>
        <h3 class="container-block-form__subtitle-block-form subtitle-block-form w-100">
            а так же получите точный расчет стоимости<br> и бесплатную консультацию специалиста
        </h3>

        <div class="container-block-form__title-form-send w-100 title-form-send">
            Введите адрес, координаты или кадастровый номер участка, где<br class="d-xl-none d-lg-none d-md-block d-sm-block d-block"> планируется бурение скважины.
        </div>

        <div v-html="message" class="container-block-form__message-form-order message-form-order"></div>


        <form @keydown="form.onKeydown($event)" ref="formOrder" method="post" @submit.prevent="submit" name="formOrder"
              class='form-order'>

            <div class="row form-order__wrapper-form-order-fields wrapper-form-order-fields">

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 col-address">

                    <ValidationProvider rules="required" v-slot="{ errors }">
                        <div v-bind:class="{'has-error' :  errors[0]}" class="form-group form-group-address">
                            <input v-bind:class="{'is-invalid' :  errors[0]}" v-model="form.address"
                                   class="form-control form-control-address"
                                   placeholder="Введите адрес"
                                   type="text" name="address">
                            <div v-show=" errors[0]" class="invalid-feedback">{{ errors[0] }}</div>
                            <!----------- Backend Validation ----------->
                            <div v-show="form.errors.address" class="invalid-feedback-validate">
                                <ul class="list-errors">
                                    <li class="item-error" v-for="error in form.errors.address">{{ error }}</li>
                                </ul>
                            </div>
                            <!----------- ENd Backend Validation ----------->
                        </div>
                    </ValidationProvider>

                </div>


                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 col-phone">

                    <ValidationProvider rules="required" v-slot="{ errors }">
                        <div v-bind:class="{'has-error' :  errors[0]}" class="form-group form-group-phone">
                            <input v-mask="'+7(###)#######'" v-bind:class="{'is-invalid' :  errors[0]}" placeholder="Введите телефон"
                                   v-model="form.phone" class="form-control form-control-phone" type="tel"
                                   name="phone">



                            <div v-show="errors[0]" class="invalid-feedback">{{ errors[0] }}</div>

                            <!----------- Backend Validation ----------->
                            <div v-show="form.errors.phone" class="invalid-feedback-validate">
                                <ul class="list-errors">
                                    <li class="item-error" v-for="error in form.errors.phone">{{ error }}</li>
                                </ul>
                            </div>
                            <!----------- ENd Backend Validation ----------->
                        </div>
                    </ValidationProvider>

                </div>


                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 col-name">

                    <ValidationProvider rules="required" v-slot="{ errors }">
                        <div v-bind:class="{'has-error' : errors[0]}" class="form-group form-group-name">

                            <input v-bind:class="{'is-invalid' :  errors[0]}" v-model="form.name"
                                   class="form-control form-control-name"
                                   placeholder="Ваше имя"
                                   type="text" name="name">
                            <div v-show="errors[0]" class="invalid-feedback">{{ errors[0] }}</div>
                            <!----------- Backend Validation ----------->
                            <div v-show="form.errors.name" class="invalid-feedback-validate">
                                <ul class="list-errors">
                                    <li class="item-error" v-for="error in form.errors.name">{{ error }}</li>
                                </ul>
                            </div>
                            <!----------- ENd Backend Validation ----------->
                        </div>
                    </ValidationProvider>

                </div>

            </div>


            <div class="w-100">
                <div class="form-group form-group-btn-send">
                    <button :disabled='!isValidate' type="submit" class="brn btn-primary btn-send-callback">
                        Отправить
                    </button>
                </div>
            </div>


        </form>
    </div>

</template>

<script>
import MaskedInput from 'vue-masked-input'
import {TheMask, mask} from 'vue-the-mask'

import {ValidationProvider, localize, ValidationObserver, extend} from 'vee-validate';
import {required, email} from 'vee-validate/dist/rules';
import ru from 'vee-validate/dist/locale/ru.json';
// Install Russian locales.
localize('ru', ru);

///Импортируем и создаем правила для полей
// No message specified.
extend('email', email);

// Override the default message.
extend('required', required);

import VeeValidateLaravel from 'vee-validate-laravel';
import axios from 'axios'
import VueAxios from 'vue-axios'


export default {
    name: "FormOrder",
    props: {
        btModalClose: String
    },

    directives: {mask},
    components: {
        ValidationProvider,
        ValidationObserver,
        VeeValidateLaravel,
        MaskedInput,
        TheMask,
        axios,
        VueAxios
    },
    computed: {
        isValidate() {
            return this.form.name && this.form.address && this.form.phone;
        }
    },
    data() {
        return {
            message: null,
            loader: false,
            isBtModalClose : this.btModalClose,
            form: {
                ///// Errors For backend Validation
                errors: {
                    name: null,
                    address: null,
                    phone: null
                },
                ///// End Errors For backend Validation
                name: null,
                address: null,
                phone: null
            },
        }
    },
    methods: {
        hide() {
            this.$modal.hide('modal-callback');
        },
        submit() {

            this.loader = true;
            //Отправляем введенные данные на сервер через библиотеку AXIOS
            axios.post('/saveformorder', this.form)
                .then(res => {
                    this.message = res.data.message;
                    this.status = res.data.success;
                    this.form.errors = res.data.errors;


                    // console.log(this.errors);

                    if (this.status) {
                        //Чистим поля формы после успешной отправки
                        this.$refs.formOrder.reset();



                    } else {

                    }
                    console.log(res);


                }).catch(err => {
                this.message = "Произошла ошибка при отправке формы!";
                this.loader = false;

                console.log(err);


            })
                .finally(() => (this.loader = false));


        }
    }
}
</script>

<style scoped>

</style>
