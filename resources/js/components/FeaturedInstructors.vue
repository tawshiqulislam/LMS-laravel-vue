<template>
    <swiper :modules="[Navigation, Pagination, Autoplay]" :space-between="15" :breakpoints="swiperOptions.breakpoints"
        navigation pagination autoplay loop :class="instructors.length < 4 ? 'instructorReviewSlider' : ''">
        <swiper-slide v-for="(instructor, index) in instructors" :key="index" class="mb-5 py-4">
            <div class="instructor-card card py-4">
                <div class="card-body text-center p-0">
                    <router-link :to="'/instructor/' + instructor.id" class="text-decoration-none text-dark">
                        <div class="text-center pb-3 d-flex flex-column align-items-center gap-3">
                            <div class="position-relative img-border" style="width: 125px; height: 125px;">
                                <img :src="instructor.profile_picture" alt="Instructor" />
                                <span
                                    class="instructor-badge position-absolute top-75 badge rounded-circle bg-white text-warning theme-shadow p-2"><i
                                        class="bi bi-star-fill fs-4"></i></span>
                            </div>
                            <h2 class="fs-6 fw-bold m-0">
                                {{ instructor.name }}
                            </h2>
                            <small
                                class="height-meature d-flex justify-content-center align-items-center text-muted px-2">
                                {{ instructor.title }}
                            </small>
                        </div>

                        <div class="d-flex mb-3 py-2" style="background: #F8FAFC;">
                            <div class="col text-end border-end pe-3">
                                <small class="d-inline d-md-block d-lg-inline">
                                    {{ instructor.course_count }} {{ $t('Courses') }}
                                </small>
                            </div>
                            <div class="col text-start ps-3">
                                <small>
                                    {{ instructor.student_count }} {{ $t('Enrolled') }}
                                </small>
                            </div>
                        </div>

                        <span>
                            {{ $t('View Profile') }}
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </router-link>
                </div>
            </div>
        </swiper-slide>
    </swiper>
</template>

<style>
.instructorReviewSlider .swiper-wrapper {
    justify-content: center;
}

@media (max-width: 767px) {
    .instructorReviewSlider .swiper-wrapper {
        justify-content: flex-start;
    }
}
</style>

<style lang="scss" scoped>
.height-meature {
    width: 100%;
    height: 20px;
}

.instructor-card {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    border: 2px solid #00000014;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.instructor-badge {
    position: absolute;
    bottom: 0;
    right: 0;
}

.img-border {
    position: relative;
    border-radius: 12px;
    border: 2px solid #00000014;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 50%;
}

.img-border img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    padding: 4px;
}

.img-border::before {
    content: "";
    position: absolute;
    inset: 0;
    padding: 2px;
    border-radius: 50%;
    background: linear-gradient(90deg,
            #ff00cc,
            #3333ff,
            #00ffcc,
            #ff00cc);
    background-size: 300% 100%;
    opacity: 0;
    /* hidden initially */
    transition: opacity 0.2s ease;
    -webkit-mask:
        linear-gradient(#fff 0 0) content-box,
        linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    pointer-events: none;
}

.instructor-card:hover {
    transform: translateY(-10px);
}

/* Gradient border effect (hidden by default) */
.instructor-card::before {
    content: "";
    position: absolute;
    inset: 0;
    padding: 2px;
    /* border thickness */
    border-radius: 12px;
    background: linear-gradient(90deg,
            #ff00cc,
            #3333ff,
            #00ffcc,
            #ff00cc);
    background-size: 300% 100%;
    opacity: 0;
    /* hidden initially */
    transition: opacity 0.2s ease;
    -webkit-mask:
        linear-gradient(#fff 0 0) content-box,
        linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    pointer-events: none;
}

/* Trigger one-time animation on hover */
.instructor-card:hover::before {
    opacity: 1;
    animation: gradientOnce 2s linear forwards;
}

.instructor-card:hover .img-border::before {
    opacity: 1;
    animation: gradientOnce 2s linear forwards;
}

/* Move gradient left → right only once */
@keyframes gradientOnce {
    0% {
        background-position: 0% 50%;
    }

    100% {
        background-position: 300% 50%;
    }
}
</style>

<script setup>
import { ref, onMounted } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Pagination, Autoplay } from "swiper/modules";

const swiperOptions = {
    breakpoints: {
        320: { slidesPerView: 1, spaceBetween: 10 }, // Extra-small devices
        576: { slidesPerView: 2, spaceBetween: 15 }, // Small devices
        768: { slidesPerView: 2, spaceBetween: 15 }, // Medium devices
        992: { slidesPerView: 3, spaceBetween: 20 }, // Large devices
        1200: { slidesPerView: 4, spaceBetween: 20 }, // Extra-large devices
    },
};

const instructors = ref([]);

const fetchInstructors = async () => {
    try {
        const response = await axios.get(`/instructor/list`, {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            params: {
                items_per_page: 15,
                page_number: 1,
                is_featured: true,
            },
        });
        instructors.value = response.data.data.instructors;
    } catch (error) {
        console.error("Error fetching featured instructors:", error);
    }
};

onMounted(() => {
    fetchInstructors();
});

</script>
