<template>
    <div class="nav-arrows">
        <slot name="navigation">
            <button :class="!prevArrow? 'slick-disabled':''" @click="prevSlider()" class="slick-carousel-control-prev slick-arrow"></button>
            <button :class="!nextArrow? 'slick-disabled':''" @click="nextSlider()" class="slick-carousel-control-next slick-arrow"></button>
        </slot>
    </div>
</template>

<script>

export default {
    name: "NavSlickCarousel",
    props: ["nextArrow", "prevArrow"],
    data() {
        return {

        }
    },
    methods:{
        nextSlider() {
            this.$emit('nextSlider')
        },
        prevSlider() {
            this.$emit('prevSlider')
        }
    }
}
</script>

<style scoped>

</style>
