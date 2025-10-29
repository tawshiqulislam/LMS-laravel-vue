<template>
    <section class="login-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-5 py-5 my-auto mx-md-auto">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div v-if="masterStore?.masterData?.mode == 'local'" class="version-badge">v{{
                            masterStore?.masterData?.version }}
                        </div>
                        <div v-if="masterStore?.masterData?.mode == 'local'" class="powerBy">Powered by
                            RazinSoft &copy;{{ new Date().getFullYear() }}
                        </div>
                        <div class="card-body" :class="masterStore?.masterData?.mode == 'local' ? 'pb-5' : 'pb-0'">
                            <div class="text-start logo-img mb-2">
                                <router-link to="/"><img :src="masterStore?.masterData?.logo" class="object-fit-cover"
                                        alt="Login" /></router-link>
                            </div>
                            <div class="d-flex p-2 p-md-4">
                                <div class="my-auto w-100">
                                    <h3 class="fw-bold mb-3">{{ $t('Login') }}</h3>
                                    <span class="text-muted">{{ $t('Boost your skill always and forever') }}.</span>

                                    <form class="my-4" @submit.prevent="loginUser">
                                        <div class="mb-4">
                                            <input type="email" v-model="email" class="form-control"
                                                :placeholder="$t('Email Address')" />
                                            <p v-if="errors.email" class="text-danger fw-bold mt-2">
                                                {{ errors.email[0] }}
                                            </p>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <input :type="showPassword ? 'text' : 'password'" v-model="password"
                                                class="form-control" :placeholder="$t('Password')" />
                                            <p v-if="errors.password" class="text-danger fw-bold mt-2">
                                                {{ errors.password[0] }}
                                            </p>
                                            <div class="eye-icon" @click="showPassword = !showPassword">
                                                <FontAwesomeIcon :icon="showPassword ? faEye : faEyeSlash" />
                                            </div>
                                        </div>
                                        <router-link to="/reset_password"
                                            class="small d-block text-decoration-none mb-4">
                                            {{ $t('Forgot your password') }}?</router-link>
                                        <button type="submit" class="btn btn-primary w-100 rounded-2">
                                            <span :class="{ 'loader': loader }">{{ loginBtnText }}</span>
                                        </button>
                                    </form>

                                    <span>{{ $t("Don't have an account") }}?
                                        <router-link to="/register">
                                            {{ $t('Sign Up') }}
                                        </router-link>
                                    </span>


                                    <div v-if="masterStore?.masterData?.mode == 'local'"
                                        class="border p-3 d-flex flex-wrap gap-3 align-items-center justify-content-between rounded-4 my-3">
                                        <div>
                                            <strong>{{ $t('Email') }}:</strong> user@rightlearning.com <br>
                                            <strong>{{ $t('Password') }}:</strong> secret@123
                                        </div>
                                        <button @click="copyDemoCredentials('user@rightlearning.com', 'secret@123')"
                                            class="btn btn-sm btn-outline-primary small float-end">{{ $t('Copy')
                                            }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style lang="scss" scoped>
.login-section {
    background: url('/public/assets/website/authorization-page.png') no-repeat center;
    background-size: cover;
    height: 100vh;
    overflow-y: auto;
    display: flex;
    justify-content: center;
    align-items: center;
}

@media (max-width: 576px) {
   .login-section {
    height: 100% !important;
   }
}


.eye-icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
}

.login-wizard {
    border-radius: 2rem;

    .side-image {
        border-top-right-radius: 2rem;
        border-bottom-right-radius: 2rem;
    }
}

.logo-img {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 2rem;
    background: #F9FBFF;
    padding: 1.5rem 0;
    border-radius: 1rem;

    img {
        max-width: 250px;
        max-height: 90px;
        object-fit: cover;
    }
}

.loader {
    transition: 0.3s;
    position: relative;
    padding-right: 47px;
}

.loader::after {
    content: "";
    font-weight: bold;
    position: absolute;
    transform: translateY(-50%);
    top: 50%;
    right: 10px;
    width: 25px;
    height: 25px;
    vertical-align: text-bottom;
    border: 4px solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    -webkit-animation: spinner-loader 0.75s linear infinite;
    animation: spinner-loader 0.75s linear infinite;
    margin-left: 7px;
}

@keyframes spinner-loader {
    to {
        transform: translateY(-50%) rotate(360deg);
    }
}

@media (max-width: 576px) {
    .logo-img img {
        width: 100%;
        height: auto;
    }
}

.version-badge {
    position: absolute;
    top: 0px;
    right: 0px;
    background-color: #9e4aed;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    padding: 5px 20px;
    border-top-left-radius: 0px;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 0px;
    border-top-right-radius: 12px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.powerBy {
    position: absolute;
    bottom: 10px;
    right: 0px;
    color: #9e4aed;
    font-size: 14px;
    font-weight: bold;
    padding: 5px 20px;
    border-radius: 4px;
}
</style>

<script setup>
import axios from "axios";
import Swal from "sweetalert2";
import { onMounted, ref, watch } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { useMasterStore } from "@/stores/master";
import { useI18n } from "vue-i18n";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faArrowLeft, faEye, faEyeSlash } from "@fortawesome/free-solid-svg-icons";

let errors = ref("");
const loader = ref(false);

const router = useRouter();
const authStore = useAuthStore();
const masterStore = useMasterStore();

const email = ref("");
const password = ref("");
const loginBtnText = ref("Sign in");
const { t } = useI18n();
let showPassword = ref(false);

// Function to handle login
const loginUser = async () => {
    try {
        loader.value = true;
        loginBtnText.value = "Signing in...";
        const response = await axios.post(`/login`, {
            email: email.value,
            password: password.value,
        });

        // Store user data and auth token in state
        authStore.setAuthData(
            response.data.data.token,
            response.data.data.user
        );

        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Login successful",
            showConfirmButton: false,
            timer: 1500,
        });

        // Redirect to dashboard or other page
        if (localStorage.getItem("handle_course_id")) {
            router.push("/checkout/" + localStorage.getItem("handle_course_id"));
            localStorage.removeItem("handle_course_id");
        } else {
            router.push("/dashboard");
        }

    } catch (error) {
        loader.value = false;
        if (error?.response?.data.errors) {
            errors.value = error?.response?.data.errors;
        } else {
            errors.value = error?.response?.data.message;
        }

        loginBtnText.value = "Sign in";

        if (error?.response?.status === 403) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text:
                    error.response?.data?.message ||
                    "Login failed. Please try again.",
            });
        }
    }
};


const copyDemoCredentials = (demoEmail, demoPassword) => {
    email.value = demoEmail
    password.value = demoPassword

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
        title: t("Demo credentials copied Successfully!!")
    });
}


onMounted(async () => {
    if (!masterStore.data) {
        axios
            .get(`/master`, {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
            })
            .then((response) => {
                masterStore.setMasterData(response.data.data.master);
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });
    }
})

</script>
