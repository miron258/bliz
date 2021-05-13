<template>
    <modal :name="name"
           :adaptive="adaptive"
           :classes="classes"
           :width="modalWidth"
           :height="height"
           :dialog=true
           :focusTrap="focusTrap"
           :scrollable="scrollable"
           :draggable="draggable"
           :resizable="resizable"
           :reset="reset"
           :clickToClose="clickToClose">
<!--        <div slot="top-right">-->
<!--            <button class="v-modal-close" @click="$modal.hide('modal-video')"></button>-->
<!--        </div>-->
<div class="dialog-content">
        <iframe src="https://vk.com/video_ext.php?oid=-148977597&id=456239026&hash=8de003662568db07" width="640" height="360" frameborder="0" allowfullscreen></iframe>
</div>
        <div  @click="$modal.hide('modal-video')" class="vue-dialog-buttons"><button type="button" class="vue-dialog-button">ЗАКРЫТЬ</button></div>

    </modal>
</template>

<script type="module">
import VModal from 'vue-js-modal'
import 'vue-js-modal/dist/styles.css'

Vue.use(VModal);
const MODAL_WIDTH = 640

export default {
    name: "ModalVideo",
    // props: ['minHeight', 'maxWidth', 'minWidth'],
    mounted() {




    },
    created() {
        this.modalWidth =
            window.innerWidth < MODAL_WIDTH ? MODAL_WIDTH / 2 : MODAL_WIDTH
    },
    data() {
        return {
            modalWidth: MODAL_WIDTH,
            name: "modal-video", //String required Обязательно для заполнения свойство
            classes: "v-modal-video", //String | Array
            scrollable: true, //Boolean
            focusTrap: true, //Boolean
            draggable: false, //Boolean
            resizable: false, //Boolean
            reset: true, //Boolean Resets position and size before showing
            clickToClose: true, //Boolean If set to false, it will not be possible to close modal by clicking on the background or by pressing Esc key.
            maxHeight: "",
            height: "auto",
            styles: "", //String | Array | Object
            adaptive: true
        }
    },
    computed: {},
    methods: {
        show() {

            // this.$modal.show('dialog', {
            //     title: 'The standard Lorem Ipsum passage',
            //     text: 'Lorem ipsum dolor sit amet, ...',
            //     buttons: [
            //         {
            //             title: 'Cancel',
            //             handler: () => {
            //                 this.$modal.hide('dialog')
            //             }
            //         },
            //         {
            //             title: 'Like',
            //             handler: () => {
            //                 alert('Like action')
            //             }
            //         },
            //         {
            //             title: 'Repost',
            //             handler: () => {
            //                 alert('Repost action')
            //             }
            //         }
            //     ]
            // });




            this.$modal.show('modal-video');
        },
        hide() {
            this.$modal.hide('modal-video');
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
            position: relative;
            .v-modal-close {
                position: absolute;
                border: none;
                outline: none;
                width: 44px;
                right: 30%;
                top: 30%;
                height: 44px;
                background: url('/img/tpl_img/close_modal.png') no-repeat;
            }
        }
    }
}

.vm--modal.v-modal-video {



.vue-dialog-buttons{
    .vue-dialog-button{
        outline: none;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 12px;
        width: 100%;
        font-family: Montserrat;
    }
}


}


</style>
