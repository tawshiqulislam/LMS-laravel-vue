<template>
    <aside class="w-100 px-1 py-2 d-flex flex-column align-items-center justify-content-start" style="height: 100%;">
        <!-- <div class="top-auth-wrapper">
            <img :src="authStore.userData?.profile_picture" class="auth-img" />
            <div class="d-flex flex-column align-items-start content-wrapper">
                <h5 class="">{{ authStore.userData?.name }}</h5>
                <p>{{ authStore.userData?.email ?? authStore.userData?.phone }}</p>
            </div>
        </div> -->
        <div class="top-auth-wrapper">
            <img :src="authStore.userData?.profile_picture" class="auth-img" />
            <div class="d-flex flex-column align-items-start content-wrapper">
                <h5>{{ authStore.userData?.name }}</h5>
                <p>{{ authStore.userData?.email ?? authStore.userData?.phone }}</p>
            </div>
            <i class="bi bi-chevron-right ms-auto arrow-icon"></i>
        </div>
        <div class="w-100 d-flex flex-column h-100">
            <DashboardMenu />
        </div>
    </aside>
</template>

<script setup>
import { useAuthStore } from "@/stores/auth";
import DashboardMenu from "./DashboardMenu.vue";
const authStore = useAuthStore();
</script>

<style scoped>
.top-auth-wrapper {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 0.9rem;
    padding: 14px 16px;
    background: #ffffff;
    border: 2px solid #e2e8f0;
    margin-bottom: 22px;
    border-radius: 14px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease-in-out;
    cursor: pointer;
}

.top-auth-wrapper:hover {
    transform: translateY(-2px);
    border-color: #9e4aed;
    background: #faf5ff;
    box-shadow: 0 4px 12px rgba(158, 74, 237, 0.15);
}

.top-auth-wrapper img.auth-img {
    width: 66px;
    height: 66px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #9e4aed;
    padding: 2px;
    background: #fff;
    transition: 0.3s;
}

.top-auth-wrapper:hover img.auth-img {
    border-color: #64748B;
}

.top-auth-wrapper h5 {
    font-size: 15px;
    font-weight: 600;
    line-height: 22px;
    color: #1e293b;
    margin-bottom: 2px;
}

.top-auth-wrapper p {
    color: #64748B;
    font-size: 13px;
    font-weight: 400;
    margin: 0;
}

.arrow-icon {
    font-size: 16px;
    color: #9e4aed;
    transition: transform 0.2s ease;
}

.top-auth-wrapper:hover .arrow-icon {
    transform: translateX(4px);
}

.auth-img {
    border-radius: 50%;
    width: 80px;
    height: 80px;
    border: 2px solid #f2f2f2;
    object-fit: cover;
    background: #ffffff;
    box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25);
}


@media(max-width: 1600px) {
    .top-auth-wrapper {
        flex-direction: column;
        align-items: center;
    }

    .auth-img {
        width: 60px;
        height: 60px;
    }

    .content-wrapper {
        align-items: center !important;
    }

    .top-auth-wrapper .content-wrapper h5 {
        font-size: 14px;
    }

    .top-auth-wrapper .content-wrapper p {
        font-size: 12px;
    }
}
</style>
