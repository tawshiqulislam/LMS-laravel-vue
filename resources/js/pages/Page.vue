<template>
    <section class="container py-5">
        <article v-if="page">
            <h1 class="text-center mb-5 text-uppercase">{{ page?.title }}</h1>
            <div v-html="page?.content"></div>
        </article>
        <div v-else class="text-start">
            <div class="about-skeleton">
                <div class="skeleton heading"></div>

                <!-- Simulating inline text -->
                <div class="skeleton line short inline"></div>
                <div class="skeleton line medium inline"></div>

                <!-- Bullet list -->
                <ul class="list-unstyled">
                    <li v-for="i in 3" :key="i">
                        <div class="skeleton"></div>
                    </li>
                </ul>

                <!-- Paragraph lines -->
                <div class="skeleton line full"></div>
                <div class="skeleton line full"></div>
                <div class="skeleton line medium"></div>

                <!-- Link line -->
                <div class="skeleton line link"></div>

                <!-- More paragraphs -->
                <div class="skeleton line full"></div>
                <div class="skeleton line full"></div>
                <div class="skeleton line medium"></div>

                <!-- Bold paragraph -->
                <div class="skeleton line heading"></div>

                <!-- Large heading -->
                <div class="skeleton line title"></div>

                <!-- Sub text -->
                <div class="skeleton line small"></div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.about-skeleton {
    padding: 20px;
    margin: 0 auto;
}

.skeleton {
    background-color: #e2e2e2;
    position: relative;
    overflow: hidden;
    border-radius: 4px;
    margin-bottom: 12px;
    height: 14px;
}

.skeleton.heading {
    height: 100px;
    width: 400px;
    margin: 30px auto;
}

.skeleton::after {
    content: "";
    position: absolute;
    top: 0;
    left: -150px;
    height: 100%;
    width: 100px;
    background: linear-gradient(to right, transparent 0%, #f0f0f0 50%, transparent 100%);
    animation: shimmer 1.2s infinite;
}

@keyframes shimmer {
    100% {
        transform: translateX(1000px);
    }
}

/* Width variations */
.line.full {
    width: 100%;
}

.line.medium {
    width: 70%;
}

.line.short {
    width: 30%;
}

.line.small {
    width: 40%;
}

.line.link {
    width: 50%;
}

.line.inline {
    display: inline-block;
    margin-right: 10px;
}

.line.heading {
    height: 16px;
    width: 50%;
}

.line.title {
    height: 16px;
    width: 70%;
}
</style>

<script setup>
import { useRoute } from "vue-router";
import { useMasterStore } from "@/stores/master";
import { onMounted, ref, watchEffect } from "vue";

const route = useRoute();
const masterStore = useMasterStore();
const page = ref(null);

watchEffect(() => {
    const slug = route.params.slug;
    const pages = masterStore.masterData?.pages;

    if (slug && Array.isArray(pages)) {
        page.value = pages.find((p) => p.slug === slug);
        window.scrollTo(0, 0);
    }
});
</script>
