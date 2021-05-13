<div class="block-reviews block-reviews-main-page">

    <div class="container">

        <div class="block-reviews__container-block-reviews container-block-reviews">

            <h2 class="container-block-reviews__title-block-reviews w-100 title-block-reviews">
                Отзывы
            </h2>


            <!------------------ LIST REVIEWS ---------------------->
            <div class="container-block-reviews__block-list-reviews block-list-reviews">
                <slick-carousel-reviews></slick-carousel-reviews>
            </div>
            <!------------------ END LIST REVIEWS ---------------------->


            <!------------- BUTTON ADD REVIEWS --------------->
            <div class="w-100 wrapper-bt-add-reviews d-xl-block d-lg-block d-md-block d-sm-block d-block">
                <button @click="$refs.modalReviews.show()" class="container-block-reviews__bt-add-reviews bt-add-reviews">Оставить отзыв</button>
                <modal-reviews :bt-modal-close="true" ref="modalReviews"></modal-reviews>
            </div>
            <!------------- BUTTON ADD REVIEWS --------------->

        </div>


    </div>


</div>

