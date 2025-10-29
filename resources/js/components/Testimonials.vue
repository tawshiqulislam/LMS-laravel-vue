<template>
    <div class="container my-2 position-relative">
        <swiper :slides-per-view="3" :space-between="20" :breakpoints="swiperOptions.breakpoints" @swiper="onSwiper"
            class="category-slider">
            <swiper-slide v-for="(testimonial, index) in testimonials" :key="testimonial.id" class="pt-5 pb-3 px-2">
                <div class="testimonial-card">
                    <div class="quote-icon">
                        <FontAwesomeIcon :icon="faQuoteRight" />
                    </div>
                    <p class="card-text">
                        {{ testimonial.description }}
                    </p>
                    <div class="d-flex align-items-center justify-content-start gap-2 border-top pt-3">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="rating-circle">
                                <img :src="testimonial.image" class="bg-white" />
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-1 align-items-start">
                            <div class="d-flex align-items-center mt-2 mt-sm-0" style="font-size: 12px;">
                                <i v-for="i in 5" :key="i"
                                    :class="i <= testimonial.rating ? 'bi bi-star-fill text-warning me-1' : 'bi bi-star text-muted me-1'"></i>
                                <strong class="ms-1">{{ testimonial.rating }}</strong>
                            </div>
                            <h5 class="card-title m-0">{{ testimonial.name }}</h5>
                            <p class="card-subtitle m-0">{{ testimonial.designation }}</p>
                        </div>
                    </div>
                </div>
            </swiper-slide>
        </swiper>

        <div class="testimonial-button-container" v-if="testimonials.length > 3">
            <button @click="swiperPrevSlide" class="prev-button">
                <FontAwesomeIcon :icon="faAngleDoubleLeft" />
            </button>
            <button @click="swiperNextSlide" class="next-button">
                <FontAwesomeIcon :icon="faAngleDoubleRight" />
            </button>
        </div>

    </div>
</template>


<style scoped lang="scss">
.prev-button {
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    background-color: #d6aeff;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: #ffffff;
    font-size: 18px;
    font-weight: 800;
    border: none;
    z-index: 1;
}

.next-button {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    background-color: #d6aeff;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: #ffffff;
    font-size: 18px;
    font-weight: 800;
    border: none;
    z-index: 1;
}

.testimonial-card {
    position: relative;
    max-width: 500px;
    margin: 0 auto;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    background-color: #ffffff;
    padding: 30px;
    padding-bottom: 15px !important;
    text-align: justify;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

.quote-icon {
    position: absolute;
    top: -20px;
    right: 20px;
    background-color: #d6aeff;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: #ffffff;
    font-size: 18px;
    font-weight: 800;
}

.card-text {
    font-size: 16px;
    color: #333;
    line-height: 1.6;
    margin-bottom: 20px;
    height: auto;
    overflow: hidden;
}

.card-title {
    font-size: 14px;
    font-weight: bold;
    color: #212529;
    margin-bottom: 5px;
}

.card-subtitle {
    font-size: 12px;
    color: #6c757d;
}

.rating-circle {
    background-color: #e0e0e0;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    color: #212529;
    font-weight: bold;
}

.rating-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%
}
</style>

<script setup>
import { ref, onMounted } from "vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Pagination, Autoplay } from "swiper/modules";
import { faQuoteRight, faAngleDoubleLeft, faAngleDoubleRight } from "@fortawesome/free-solid-svg-icons";

const swiperInstance = ref();
function onSwiper(swiper) {
    swiperInstance.value = swiper;
}

const swiperNextSlide = () => {
    swiperInstance.value.slideNext();
};
const swiperPrevSlide = () => {
    swiperInstance.value.slidePrev();
};

const swiperOptions = {
    breakpoints: {
        320: { slidesPerView: 1, spaceBetween: 10 }, // Extra-small devices
        576: { slidesPerView: 1, spaceBetween: 15 }, // Small devices
        768: { slidesPerView: 2, spaceBetween: 15 }, // Medium devices
        992: { slidesPerView: 3, spaceBetween: 20 }, // Large devices
        1200: { slidesPerView: 3, spaceBetween: 20 }, // Extra-large devices
    },
};

let testimonials = ref([]);

onMounted(async () => {
    const response = await axios.get(`/testimonial/list`);
    testimonials.value = response.data.data?.testimonials;
});
</script>
