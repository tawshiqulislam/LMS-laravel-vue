<template>
    <!-- Registration 4 - Bootstrap Brain Component -->


    <section class="p-0">
        <div class="container">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden bg-white rounded-4 my-4">
                <div class="row g-0">
                    <!-- Left Side (Form) -->
                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-center"
                        style="height: calc(100vh - 170px);">

                        <!-- Logo / Brand -->
                        <div class="mb-4 text-center">
                            <img :src="masterStore?.masterData?.logo" width="220" height="auto">
                        </div>

                        <!-- Contact Form -->
                        <div class="card border p-4 rounded-4 w-75">
                            <h4 class="mb-3 text-center">{{ $t('Connect with us') }}!!</h4>
                            <p class="text-muted text-center small">{{ $t("We’d love to hear from you") }}</p>

                            <form action="#!">
                                <div class="row g-3">
                                    <div class="col-6 form-floating">
                                        <input type="text" class="form-control" id="firstName" placeholder="Full Name"
                                            v-model="form.name" required>
                                        <label for="firstName">{{ $t('Full Name') }} *</label>
                                    </div>
                                    <div class="col-6 form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Email"
                                            v-model="form.email" required>
                                        <label for="email">{{ $t('Email') }} *</label>
                                    </div>
                                    <div class="col-12 form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject"
                                            v-model="form.subject" required>
                                        <label for="subject">{{ $t('Subject') }} *</label>
                                    </div>
                                    <div class="col-12 form-floating">
                                        <textarea class="form-control" id="message" placeholder="Message" rows="5"
                                            v-model="form.message" required></textarea>
                                        <label for="message">{{ $t('Message') }} *</label>
                                    </div>
                                    <div class="col-12 mt-5 text-center">
                                        <button type="button" class="btn btn-outline-primary btn-lg px-5 py-2 shadow-sm"
                                            @click="submitForm">
                                            {{ $t('Connect Now') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- Social buttons -->
                            <div class="text-center mt-4">
                                <p class="text-muted mb-3 small"
                                    v-if="masterStore?.masterData?.footer_social_icons != ''">{{
                                        $t('Follow us on social media') }}
                                </p>
                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                    <a class="btn btn-outline-dark rounded-pill btn-sm px-3"
                                        v-for="social in masterStore?.masterData?.footer_social_icons" :key="social"
                                        :href="social.url" target="_blank">
                                        <i :class="social?.icon"></i> {{ social?.title }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side (Image + Highlight cards) -->
                    <div class="col-lg-5 d-none d-lg-block position-relative">
                        <img src="/public/assets/website/support.png" class="w-100 h-100 object-fit-contain"
                            alt="Contact Us Image">

                        <!-- Overlay Card 1 -->
                        <a v-if="masterStore?.masterData?.whatsapp_support_number"
                            :href="masterStore?.masterData?.whatsapp_support_number" target="_blank"
                            class="position-absolute top-3 start-50 border border-primary translate-middle-x bg-white shadow-sm rounded-pill px-3 py-1 mt-4 text-decoration-none">
                            <span class="small fw-semibold text-dark">
                                <i class="bi bi-telephone-plus me-1"></i>
                                {{ masterStore?.masterData?.whatsapp_contact_us }}
                            </span>
                        </a>

                        <!-- Overlay Card 2 -->
                        <div class="position-absolute bottom-0 start-50 translate-middle-x bg-white shadow-sm rounded-4 p-3 mb-4 text-center"
                            style="width: 250px;">
                            <h6 class="fw-bold mb-1">{{ $t('Customer Support') }}</h6>
                            <p class="small text-muted mb-0">{{ $t('We reply within 24 hours') }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>


<script setup>
import { ref, onMounted } from "vue";
import Swal from "sweetalert2";
import { useMasterStore } from "@/stores/master";
import axios from "axios";
import { useI18n } from "vue-i18n";
const { t } = useI18n();

const masterStore = useMasterStore(); let form = ref({
    name: "", email: "",
    subject: "", message: "",
});
const resetForm = () => {
    form.value = {
        name: "",
        email: "",
        subject: "",
        message: "",
    };
};

const submitForm = async () => {

    try {
        const response = await axios.post(`/contact/submit`, form.value, {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });

        if (response.status === 201) {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: t("Your inquiry has been submitted"),
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    title: "swal-title",
                },
            });
            resetForm();
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: `Error submitting form:, ${error.response?.data?.message}`,
            showConfirmButton: false,
            timer: 3500,
            customClass: {
                title: "swal-title",
            },
        });
        console.error("Error submitting form:", error);
    }
};
</script>

<style scoped>
.bg-purple {
    background-color: #5c4ac7;
    /* Dark purple background */
}

body {
    background-color: #f4f4f4;
    /* Light gray background */
}

.btn-light {
    background-color: #ffffff;
    color: #5c4ac7;
    /* Match the dark purple theme */
}

.swal-title {
    font-size: 1rem;
    /* Adjust font size as needed */
    font-weight: bold;
    /* Optional: Make it bold */
}

.card-body input:focus,
.card-body textarea:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25);
}

.object-fit-cover {
    object-fit: cover;
    min-height: 100%;
}

@media (max-width: 767px) {
    .card {
        border-radius: 1rem;
    }
}

@media (max-width: 768px) {
    .bg-purple {
        padding: 20px;
    }
}
</style>
