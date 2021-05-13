<template>

    <div class="container-block-form-reviews">

        <div v-show="loader" class="loader-gif">
            <img src="/img/tpl_img/ajax.gif" class="ajax-loader"/>
        </div>
        <div v-html="message" class="container-block-form-reviews__message-reviews message-reviews"></div>
        <form ref="formAddReview" @keydown="form.onKeydown($event)" @submit.prevent="submit" method="post" name="formReviews" class='form-reviews'>

            <div class="row form-reviews__wrapper-form-reviews-fields wrapper-form-reviews-fields">

                <div
                    class="col-xl-6 col-gl-6 col-md-12 col-sm-12 col-12 container-block-form-reviews__leftblock-form leftblock-form">

                    <div v-bind:class="{'has-error' : form.errors.has('name')}" class="form-group form-group-name">
                        <input :class="{ 'is-invalid': form.errors.has('name') }" v-model="form.name" class="form-control form-control-name"
                               placeholder="Введите ваше имя"
                               type="text" name="name">
                        <has-error :form="form" field="name"></has-error>
                    </div>


                    <div v-bind:class="{'has-error' : form.errors.has('phone')}" class="form-group form-group-phone">
                        <input v-mask="'+7(###)#######'" :class="{ 'is-invalid': form.errors.has('phone') }" v-model="form.phone" placeholder="Введите телефон" class="form-control form-control-phone" type="text"
                               name="phone">
                        <has-error :form="form" field="phone"></has-error>
                    </div>

                    <div v-bind:class="{'has-error' : form.errors.has('address')}" class="form-group form-group-address">
                        <input :class="{ 'is-invalid': form.errors.has('address') }" v-model="form.address" class="form-control form-control-address"
                               placeholder="Адрес бурения"
                               type="text" name="address">
                        <has-error :form="form" field="address"></has-error>
                    </div>
                </div>


                <div
                    class="col-xl-6 col-gl-6 col-md-12 col-sm-12 col-12 container-block-form-reviews__rightblock-form rightblock-form">

                    <div v-bind:class="{'has-error' : form.errors.has('review')}" class="form-group form-group-review">
                    <textarea :class="{ 'is-invalid': form.errors.has('review') }"  v-model="form.review" class="form-control form-control-review"
                              placeholder="Ваш отзыв"
                              name="text">
                    </textarea>
                        <has-error :form="form" field="review"></has-error>
                    </div>

                </div>

            </div>


            <div class="w-100">
                <div class="form-group form-group-btn-review">
                    <button type="submit" class="brn btn-primary btn-send-review">
                        Отправить
                    </button>
                </div>
            </div>


        </form>
    </div>


</template>

<script>
//Import v-from
import {Form,  HasError, AlertError, AlertErrors, AlertSuccess} from 'vform'
import {TheMask, mask} from 'vue-the-mask'
window.Form = Form;


export default {
    name: "FormAddReview",
    directives: {mask},
    components: {
        Form,
        HasError,
        TheMask,
        AlertError,
        AlertErrors,
        AlertSuccess
    },
    mounted() {

        console.log(this.form);

    },
    computed: {

    },
    data() {
        return {
            message: null,
            loader: false,
            form: new Form({
                name: '',
                address: '',
                phone: '',
                review: ''
            })
        }
    },
    methods: {
        hide() {
            this.$modal.hide('modal-reviews');
        },
        submit() {

            this.loader = true;
            //Отправляем введенные данные на сервер через библиотеку AXIOS
            this.form.post('/saveformreview')
                .then(res => {
                    this.message = res.data.message;
                    this.status = res.data.success;

                    if (this.status) {
                        //Чистим поля формы после успешной отправки
                        this.form.reset();
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
