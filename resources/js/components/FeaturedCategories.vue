<template>
    <div class="d-flex justify-content-center align-items-center mb-5 mt-3">
        <h3 class="fs-1 fw-bold text-center">{{ $t('Our Top') }} <span class="text-primary">{{ $t('Categories')
                }}</span></h3>
    </div>

    <div class="row g-3 mb-4 d-flex justify-content-center">
        <router-link :to="'/courses?category_id=' + category.id" class="col-sm-6 col-lg-4 col-xl-3 text-decoration-none"
            v-for="(category, index) in featuredCategories" :key="category.id">
            <div class="category-card" :style="{
                '--hover-color': `${category.color}50`
            }">
                <div class="category-icon" :style="{ backgroundColor: `${category.color}35` }">
                    <img :src="category.image" :alt="category.title" width="40">
                </div>
                <div class="category-content">
                    <h5 class="fw-bold text-dark text-wrap">
                        {{ category.title.slice(0, 25) + (category.title.length > 25 ? '...' : '') }}
                    </h5>
                    <p>
                        {{ category.course_count }} {{ $t('Courses') }}
                    </p>
                    <span class="category-arrow">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </div>
            </div>
        </router-link>
    </div>

</template>

<style lang="scss" scoped>
.category-card {
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: all 0.3s ease-in-out;
    cursor: pointer;
    background: #fff;
    width: 100%;
    height: 100%;
    position: relative;
}

.category-card:hover {
    box-shadow: 0px 6px 18px var(--hover-color);
    transform: translateY(-4px);
}

.category-icon {
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30%;
    margin-right: 15px;
}

.category-icon img {
    padding: 10px;
    box-sizing: border-box;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.category-content {
    width: 70%;
}

.category-card h5 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 14px;
}

.category-card p {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.75rem;
    margin: 0;
    color: #6b7280;
}

.category-arrow {
    position: absolute;
    bottom: 25px;
    right: 20px;
    margin-left: auto;
    font-size: 1rem;
    color: #6b7280;
}
</style>

<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";

const swiperOptions = {
    breakpoints: {
        320: { slidesPerView: 1.5, spaceBetween: 10 }, // Extra-small devices
        576: { slidesPerView: 2.5, spaceBetween: 15 }, // Small devices
        768: { slidesPerView: 3.5, spaceBetween: 15 }, // Medium devices
        992: { slidesPerView: 4.5, spaceBetween: 20 }, // Large devices
        1200: { slidesPerView: 5.5, spaceBetween: 20 }, // Extra-large devices
    },
};

let featuredCategories = ref([]);

// Fetch featured categories
const fetchFeaturedCategories = async () => {
    try {
        const response = await axios.get(`/categories`, {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            params: {
                is_featured: true,
                items_per_page: 20,
                page_number: 1,
            },
        });
        featuredCategories.value = response.data.data.categories;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

// Call the function when the component is mounted
onMounted(() => {
    fetchFeaturedCategories();
});
</script>
