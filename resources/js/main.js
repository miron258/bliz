
document.addEventListener(
    "DOMContentLoaded", () => {
        new Mhead( "#mhead-tablet", {
            unpin: 700,
            pin: 10
        });


    }
);


// document.addEventListener(
//     "DOMContentLoaded", () => {
//
//
//         //Mmenu Tablet
//         new Mmenu("#menu", {
//             wrappers: ["bootstrap"],
//             // "dropdown": true,
//             navbar: {
//                 add: false,
//                 // "sticky": false,
//                 title: ""
//             },
//             extensions: [
//                 // "position-bottom",
//                 "fullscreen",
//                 "popup"
//                 // "position-right",
//                 // "position-front"
//             ],
//             "autoHeight": true,
//             "iconbar": {
//                 "use": true,
//                 "position": "right",
//                 "top": [
//                     "<span class='menu-requisites'>ИП Иванов С.В. ИНН 0000000000<br> ОГРНИП 00000000000000</span>",
//                     "<a class='link-icon-phone d-lg-block d-md-block d-sm-none d-none' href='tel:+79616223344'></a>",
//                     "<a target='_blank' class='link-icon-vk' href='https://vk.com/burenie57'></a>"
//                 ]
//             }
//
//
//             // "navbars": [
//             //
//             //     {
//             //         title: "",
//             //         position: "bottom",
//             //         content: [
//             //             "<a target='_blank' class='link-icon-vk' href='https://vk.com/burenie57'></a>"
//             //         ]
//             //     },
//             //     {
//             //         title: "",
//             //         position: "bottom",
//             //         content: [
//             //             "<span class='menu-requisites'>ИП Иванов С.В. ИНН 0000000000<br> ОГРНИП 00000000000000</span>"
//             //
//             //         ]
//             //     }
//             // ]
//
//
//         });
//
//         let panelMenu = $('#panel-mmenu').html();
//         $('.main-menu').after(panelMenu);
//
//
//     }
// );


$(document).ready(function () {

    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";

    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 768px)").matches) {
            $dropdown.hover(
                function() {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function() {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });


    // $.pixlayout({
    //     clip: true,
    //     src: "/img/mobile.png",
    //
    //     show: true,
    //     opacity: 0.3,
    //     center: true,
    //     fixed: false,
    //     left: -27,
    //     right: -27,
    //     top: -47
    // });

    //
    // $(window).scroll(function () {
    //     var top = $(document).scrollTop();
    //     if (top < 300) {
    //         $(".header-block-navigation").css({top: '0', position: 'relative'});
    //     } else {
    //         $(".header-block-navigation").css({top: '64px', position: 'fixed'});
    //     }
    // });


    //////// POWER LIGHTCASE JS
    // $('a[data-rel^=lightcase]').lightcase({
    //     swipe: true
    // });
    //////// END POWER LIGHTCASE JS

    // var elementClick = $('.header .header-leftblock .block-left-menu-navigation .left-menu-nav .item-left-menu-nav .link-item-left-menu-nav, .header .header-rightblock .block-right-menu-navigation .right-menu-nav .item-right-menu-nav .link-item-right-menu-nav');
    //
    // elementClick.click(
    //     function (event) {
    //         let hash = $(this).attr('href').split('#')[1];
    //         let destination = $("#" + hash).offset().top;
    //         $('body,html').animate({scrollTop: destination}, 1000);
    //         return false;
    //     });


    // $('.arrow-chevron').on('click', function (e) {
    //     e.preventDefault();
    //     var target = $(this).attr('data-block'),
    //         destination = $(target).offset().top;
    //
    //     $('body,html').animate({scrollTop: destination}, 1000);
    // });


//     $('#menu').mmenu({
//         navbar: {
//             title: ""
//         }
// //         "navbars": [
// //
// //             {
// //                 title: "",
// //                 position: "bottom",
// //                 content: [
// //                     "<a class='link-menu-phone' href='tel:+74957664703'>+7 (495) 766-47-03</a>"
// //                 ]
// //             },
// // //            {
// // //                title: "",
// // //                position: "bottom",
// // //                content: [
// // //                    "<div class='block-menu-address block-menu-address-top'><div class='header-address header-address-top'>Адрес площадки</div><a target='_blank' class='link-address link-address-top' href='https://yandex.ru/maps/213/moscow/?l=sat%2Cskl&ll=37.432205%2C55.754400&mode=search&oid=224259165876&ol=biz&z=18'>г. Москва, улица Крылатская,<br> дом 5, Гребной канал</a></div>"
// // //
// // //                ]
// // //            },
// //             {
// //                 title: "",
// //                 position: "bottom",
// //                 content: [
// //                     "<div class='block-menu-address block-menu-address-bottom'><div class='header-address header-address-bottom'>Адрес мотосервиса</div><a target='_blank' class='link-address link-address-bottom' href='https://yandex.ru/maps/213/moscow/?ll=37.519171%2C55.788940&mode=search&oid=1484362205&ol=biz&sctx=ZAAAAAgBEAAaKAoSCSujkc8rCEJAEVD%2B7h01fEpAEhIJ%2FmDgufdwzz8R98jmqnmOwj8iBQABAgQFKAAwATj7h9zo6p6H%2BfoBQApIAVXNzMw%2BWABiJG1pZGRsZV9hc2tfZGlyZWN0X3F1ZXJ5X3R5cGVzPXJ1YnJpY2IQcmVsZXZfbm9xdW9ydW09MGIobWlkZGxlX2luZmxhdGVfZGlyZWN0X2ZpbHRlcl93aW5kb3c9NTAwMGIScmVsZXZfZHJ1Z19ib29zdD0xYkRtaWRkbGVfZGlyZWN0X3NuaXBwZXRzPXBob3Rvcy8yLngsYnVzaW5lc3NyYXRpbmcvMi54LG1hc3N0cmFuc2l0LzEueGI0bWlkZGxlX3dpemV4dHJhPXRyYXZlbF9jbGFzc2lmaWVyX3ZhbHVlPTAuMzc3NzgzOTU0MWInbWlkZGxlX3dpemV4dHJhPWFwcGx5X2ZlYXR1cmVfZmlsdGVycz0xYihtaWRkbGVfd2l6ZXh0cmE9b3JnbW5fd2FuZF90aHJlc2hvbGQ9MC45YiltaWRkbGVfd2l6ZXh0cmE9cmVxdWVzdF9zb2Z0X3RpbWVvdXQ9MC4wNWIjbWlkZGxlX3dpemV4dHJhPXRyYW5zaXRfYWxsb3dfZ2VvPTFiPm1pZGRsZV93aXpleHRyYT10cmF2ZWxfY2xhc3NpZmllcl9vcmdtYW55X3ZhbHVlPTAuMDA5NzMyMDgyNDg2YiptaWRkbGVfaW5mbGF0ZV9kaXJlY3RfcmVxdWVzdF93aW5kb3c9MTAwMDBiHm1pZGRsZV9hc2tfZGlyZWN0X3Blcm1hbGlua3M9MWIdcmVsZXZfZmlsdGVyX2d3a2luZHM9MC4zLDAuNDViKXJlYXJyPXNjaGVtZV9Mb2NhbC9HZW8vQWxsb3dUcmF2ZWxCb29zdD0xYjFyZWFycj1zY2hlbWVfTG9jYWwvR2VvdXBwZXIvZmVhdHVyZXNGcm9tT2JqZWN0cz0xYi9yZWFycj1zY2hlbWVfTG9jYWwvR2VvL1Bvc3RmaWx0ZXIvQWJzVGhyZXNoPTAuMmIpcmVhcnI9c2NoZW1lX0xvY2FsL0dlby9DdXRBZmlzaGFTbmlwcGV0PTFiNXJlYXJyPXNjaGVtZV9Mb2NhbC9HZW8vSG90ZWxCb29zdD1tZWFuX2NvbnZlcnNpb25fMTJ3YilyZWFycj1zY2hlbWVfTG9jYWwvR2VvL1VzZUdlb1RyYXZlbFJ1bGU9MWoCcnVwAZUBAAAAAJ0BzcxMPqABAagBAL0B6A5TssIBBd2j5sMF0gFA0L%2FRgNC%2B0LXQt9C0INCx0LXRgNC10LfQvtCy0L4HKNC5Bykg0YDQvtGJ0LggMTAg0LrQsNC30LDQutC%2B0YTRhNgBkE4%3D&sll=37.519171%2C55.788940&source=wizbiz_new_map_single&text=проезд%20березовой%20рощи%2010%20казакофф&z=14'>Проезд Березовой Рощи дом 10</a></div>"
// //
// //                 ]
// //             },
// //
// //             {
// //                 title: "",
// //                 position: "bottom",
// //                 content: [
// //                     '<div class="list-social-icon"><a rel="nofollow" target="_blank" class="item__item-link item-link" href="https://vk.com/public36588859"> <img alt="Мы в Контакте" title="Мы в Контакте" src="/img/tpl_img/mobile/social_icon/vk.png"> </a><a rel="nofollow" target="_blank" class="item__item-link item-link" href="https://www.facebook.com/groups/371914162843244"> <img alt="Мы на Facebook" title="Мы на Facebook" src="/img/tpl_img/mobile/social_icon/facebook.png"> </a><a rel="nofollow" target="_blank" class="item__item-link item-link" href="https://www.youtube.com/channel/UCGH42q0LFfl12N2qWUb2v3gg"> <img alt="Мы на Youtube" title="Мы на Youtube" src="/img/tpl_img/mobile/social_icon/youtube.png"> </a></div>'
// //                 ]
// //             }
// //         ]
//     }); //Init mobile menu


});
