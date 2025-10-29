<template>
    <footer :class="{ 'homepage-footer': $route.path === '/' }" class="container-fluid text-white mt-5" :style="{
        backgroundImage: masterStore?.masterData?.footer_bg_thumbnail
            ? `url(${masterStore.masterData.footer_bg_thumbnail})`
            : 'url(/assets/website/footer-bg-2.png)',
        backgroundRepeat: 'no-repeat',
        backgroundPosition: 'center',
    }">
        <section class="container footer-container">
            <div class="row">
                <div class="col-md-8 col-lg-4 mb-5 mb-lg-0 mx-0">
                    <img class="mb-3 object-fit-contain" :src="masterStore?.masterData?.footer" width="150px"
                        height="60px" />
                    <p class="small text-light col-xl-8">
                        {{ masterStore?.masterData?.footer_description }}
                    </p>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a :href="`tel:${masterStore?.masterData?.footer_contact}`" class="text-decoration-none">
                                <i class="bi bi-telephone me-3"></i>
                                {{ masterStore?.masterData?.footer_contact }}
                            </a>
                        </li>
                        <li class="mb-3">
                            <a :href="masterStore?.masterData?.footer_email
                                ? `mailto:${masterStore?.masterData?.footer_email}`
                                : ''
                                " class="text-decoration-none">
                                <i class="bi bi-envelope me-3"></i>
                                {{ masterStore?.masterData?.footer_email }}
                            </a>
                        </li>
                    </ul>

                    <div class="d-flex mt-3 align-items-center gap-3">
                        <div v-for="social in masterStore?.masterData
                            ?.footer_social_icons" :key="social.name">
                            <a :href="social?.url" target="_blank"><i :class="social?.icon"></i></a>
                        </div>
                    </div>
                </div>
                <div
                    class="col-md-4 col-lg-2 mb-5 mb-lg-0 d-md-flex d-lg-block flex-column align-items-end justify-content-start">
                    <h4 class="text-light-primary fs-6 fw-bold mb-3">{{ $t('Quick Links') }}</h4>
                    <ul class="list-unstyled d-md-flex d-lg-block flex-column align-items-end justify-content-start">
                        <li class="mb-3">
                            <router-link to="/courses" class="text-decoration-none">{{ $t('All Courses') }}</router-link>
                        </li>
                        <li class="mb-3">
                            <router-link to="/page/about_us" class="text-decoration-none">{{ $t('About Us')
                                }}</router-link>
                        </li>
                        <li class="mb-3">
                            <router-link to="/faq" class="text-decoration-none">{{ $t('FAQ') }}</router-link>
                        </li>
                        <li class="mb-3">
                            <a href="/admin/register" class="text-decoration-none">{{ $t('Become a Teacher') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-3 mb-5 mb-lg-0">
                    <h4 class="text-light-primary fs-6 fw-bold mb-3">
                        {{ $t('Help & Support') }}
                    </h4>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <router-link to="/contact-us" class="text-decoration-none">
                                {{ $t('Contact Us')}}</router-link>
                        </li>
                        <li class="mb-3">
                            <router-link to="/page/terms_and_conditions" class="text-decoration-none">
                                {{ $t('Terms & Conditions') }}
                            </router-link>
                        </li>
                        <li class="mb-3">
                            <router-link to="/page/privacy_policy" class="text-decoration-none">
                                {{ $t('Privacy Policy') }}
                            </router-link>
                        </li>
                        <li class="mb-3">
                            <a href="/admin/login" target="_blank" class="text-decoration-none">
                                {{ $t('Login to Admin') }}
                            </a>
                        </li>
                        <li class="mb-3 w-75">
                            <h6 class="pb-2">{{ $t('Subscribe to Newsletter') }}</h6>
                            <form class="" @submit.prevent="newsletter()">
                                <div class="input-group">
                                    <span class="input-group-text px-2 bg-white border-0 d-flex align-items-center">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control px-2" :placeholder="$t('Enter your email')"
                                        v-model="suscribeEmail" required />

                                    <button type="submit" class="btn btn-primary btn-sm newsletter-btn">
                                        <span class="d-sm-inline px-2">
                                            <i class="bi bi-send-fill"></i>
                                        </span>
                                    </button>
                                </div>
                                <div class="form-text mt-2">
                                    {{ $t('No spam. Unsubscribe anytime.') }}
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <div
                    class="col-md-8 col-lg-3 col-xl-3 d-md-flex d-lg-block flex-column align-items-end justify-content-end">
                    <h4 class="text-light-primary fs-6 fw-bold mb-3">
                        {{ $t('Download Our App') }}
                    </h4>
                    <div class="d-flex">
                        <div class="bg-white rounded p-1 mb-3">
                            <img :src="masterStore?.masterData?.scaner ??
                                'https://quickchart.io/qr?text=' +
                                baseUrl +
                                '/download_app&margin=2&size=110'
                                " class="d-block" alt="Scan QR code" style="width: 150px; height: 120px" />
                            <small class="text-dark d-block text-center">{{ $t('Scan the QR code') }}</small>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 align-items-center">
                        <a :href="masterStore?.masterData?.footer_apple_link" target="_blank"><img
                                :src="'/assets/images/website/app-store.png'" alt="App Store" class="me-3" /></a>
                        <a :href="masterStore?.masterData?.footer_google_link" target="_blank"><img
                                :src="'/assets/images/website/play-store.png'" alt="Play Store" /></a>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center text-light py-4">
            <small>{{ masterStore?.masterData?.credit_text }}</small>
        </div>
    </footer>
</template>

<style lang="scss" scoped>
footer {
    // background: url("/public/assets/website/footer-bg-2.png") no-repeat center;
    background-size: cover;

    .footer-container {
        padding-top: 3rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.16);
    }

    a {
        color: #fff;
        transition: color 0.2s ease-out;

        &:hover {
            color: #9e4aed;
        }
    }
}

.input-group input {
    padding: 8px 0.75rem !important;
}

.input-group-text {
    padding: 0px 0.75rem !important;
    border-radius: 4px 0 0 4px !important;
}

.newsletter-btn {
    border-radius: 0 4px 4px 0 !important;
}

// .homepage-footer {
//     clip-path: ellipse(90% 88% at 50% 100%);
//     margin-top: -13rem;
//     padding-top: 12rem;
// }

@media (max-width: 1200px) {
    .homepage-footer {
        margin-top: -12rem;
    }
}
</style>

<script setup>
import { useMasterStore } from "@/stores/master";
import { ref } from "vue";
import Swal from "sweetalert2";

const masterStore = useMasterStore();
const masterData = ref(masterStore.masterData);
const suscribeEmail = ref("");
import { useI18n } from "vue-i18n";
const { t } = useI18n();

const baseUrl = import.meta.env.VITE_APP_URL;


const newsletter = () => {

    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailRegex.test(suscribeEmail.value)) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "error",
            title: "Invalid email address"
        });
        return;
    }

    axios.post("/newslatter/subscribe", {
        email: suscribeEmail.value
    })
        .then((response) => {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: t("Thank you for subscribing to our newsletter")
            });
        }).catch((error) => {
            console.log(error);

        })
    suscribeEmail.value = "";
};
</script>
