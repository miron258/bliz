<template>
    <nav class="mobile-menu" id="menu">
        <div class="wrapper-mmenu" v-html="mMenuHtml"></div>

        <ul id="panel-mmenu" class="panel-mmenu-bottom d-xl-none d-lg-none d-md-none d-sm-block d-block">
            <li class="panel-mmenu-bottom__item-panel item-panel item-panel-vk">
                <a target='_blank' class="item-panel__item-panel-link item-panel-link item-panel-link-vk" href=""></a>
            </li>
            <li class="panel-mmenu-bottom__item-panel item-panel item-panel-requisites">
                <span class='menu-requisites'>ООО "БЛИЦ"  ИНН 5722004356<br> ОГРН 1165749055823</span>
            </li>
        </ul>

    </nav>
</template>

<script>
import 'mmenu-js/dist/mmenu.css'
import 'mmenu-js/dist/mmenu.js'


export default {
    name: "MmenuMobile",
    props: {
        //Сформированное динамическое в виде JSON
        mMenu: {
            type: Object,
            required: true
        }
    },
    computed: {},
    components: {},
    mounted() {

        // console.log(this.mMenu['mmenu']);

        const panelMmenu = document.querySelector('#menu');
        const mMenu = new Mmenu("#menu", {
            // configuration
            panelNodetype: ["ul", "ol", "div", "section"],

            // wrappers: ["bootstrap"],
            // "dropdown": true,
            // "navbars": [
            //     {
            //         "position": "top",
            //         "content": [
            //             "breadcrumbs",
            //             "close"
            //         ]
            //     }
            // ],
            navbar: {
                add: true,
                "sticky": false,
                title: "wewewe"
            },


            extensions: [
                // "theme-dark",
                // "position-top",
                "fullscreen",
                // "popup",
                "position-right",
                "position-front"
            ],
            // "autoHeight": true,
            "iconbar": {
                "use": true,
                "position": "right",
                "top": [
                    "<span class='menu-requisites'>ООО \"БЛИЦ\"  ИНН 5722004356<br> ОГРН 1165749055823</span>",
                    "<a class='link-icon-phone d-lg-block d-md-block d-sm-none d-none' href='tel:+79616223344'></a>",
                    "<a target='_blank' class='link-icon-vk' href='https://vk.com/burenie57'></a>"
                ]
            }


            // "navbars": [
            //
            //     {
            //         title: "",
            //         position: "bottom",
            //         content: [
            //             "<a target='_blank' class='link-icon-vk' href='https://vk.com/burenie57'></a>"
            //         ]
            //     },
            //     {
            //         title: "",
            //         position: "bottom",
            //         content: [
            //             "<span class='menu-requisites'>ИП Иванов С.В. ИНН 0000000000<br> ОГРНИП 00000000000000</span>"
            //
            //         ]
            //     }
            // ]


        });


        const api = mMenu.API;
        let panelMenu = document.querySelector('#panel-mmenu').innerHTML;
        document.querySelector('.main-menu').insertAdjacentHTML('afterend', panelMenu);
        api.initPanel( panelMmenu );

        // let panelMenu = $('#panel-mmenu').html();
        // $('.main-menu').after(panelMenu);
    },
    data() {
        return {
            mMenuHtml: this.mMenu['mmenu']
        }
    },
    methods:
        {}
}
</script>

<style lang="scss">


</style>
