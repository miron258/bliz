//Registered Components Vue JS
window.Vue = require('vue/dist/vue.min.js');
/// Vue Scripts Site
Vue.config.devtools = true;

const app = new Vue({
    el: '#app',
    components: {
        'slick-carousel-services': require('./SlickCarouselServices.vue').default,
        'slick-carousel-price': require('./SlickCarouselPrice.vue').default,
        'form-order': require('./FormOrder/FormOrder.vue').default,
        'form-add-review': require('./FormAddReview/FormAddReview.vue').default,
        'slick-carousel-reviews': require('./SlickCarouselReviews/SlickCarouselReviews.vue').default,
        'slick-carousel-certificates': require('./SlickCarouselCertificates.vue').default,
        'slick-carousel-casing-options': require('./SlickCarouselCasingOptions.vue').default,
        'slick-carousel-work-gallery': require('./SlickCarouselWorkGallery.vue').default,
        'mmenu-mobile': require('./MmenuMobile').default,
        'modal-callback': require('./ModalCallback/ModalCallback.vue').default,
        'modal-video': require('./ModalVideo/ModalVideo.vue').default,
        'modal-reviews': require('./ModalReviews/ModalReviews.vue').default
    },

}).$mount('#app');
window.__VUE_DEVTOOLS_GLOBAL_HOOK__.Vue = app.constructor;

// import renderVueComponentToString from 'vue-server-renderer/basic';


// renderVueComponentToString(app, (err, html) => {
//     if (err) {
//         throw new Error(err);
//     }
//
//     dispatch(html);
// });

// Шаг 2: Создаём рендерер
// const renderer = require('vue-server-renderer').createRenderer()

// Шаг 3: Рендерим экземпляр Vue в HTML
// renderer.renderToString(app, (err, html) => {
//     if (err) throw err
//     console.log(html)
//     // => <div data-server-rendered="true">Hello World</div>
// })

// с версии 2.5.0+, возвращает Promise если коллбэк не указан:
// renderer.renderToString(app).then(html => {
//     console.log(html)
// }).catch(err => {
//     console.error(err)
// })

console.log(app);
/// End Vue Scripts Site
