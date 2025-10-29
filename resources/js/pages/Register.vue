<template>
    <section class="register-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-5 py-5 my-auto mx-md-auto">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div v-if="masterStore?.masterData?.mode == 'local'" class="version-badge">v{{
                            masterStore?.masterData?.version }}
                        </div>
                        <div v-if="masterStore?.masterData?.mode == 'local'" class="powerBy">Developed by
                            Md Tawshiqul Islam Rafi &copy;{{ new Date().getFullYear() }}
                        </div>
                        <div class="card-body" :class="masterStore?.masterData?.mode == 'local' ? 'pb-5' : 'pb-0'">
                            <div class="text-start logo-img mb-2">
                                <router-link to="/"><img :src="masterStore?.masterData?.logo" class="object-fit-cover"
                                        alt="Login" /></router-link>
                            </div>
                            <div class="d-flex p-2 p-md-4">
                                <div class="my-auto w-100">
                                    <h3 class="fw-bold mb-2">{{ $t('Sign up') }}</h3>
                                    <span class="text-muted">{{ $t('Boost your skill always and forever') }}.</span>

                                    <form class="my-4" @submit.prevent="registerUser">
                                        <div class="mb-3">
                                            <input type="text" v-model="name" :class="errors?.name
                                                ? 'is-invalid form-control'
                                                : 'form-control'
                                                " class="form-control" :placeholder="$t('Full Name')" />
                                            <p v-if="errors?.name" class="my-2 text-danger">
                                                {{ errors?.name[0] }}
                                            </p>
                                        </div>
                                        <div class="d-block d-sm-flex gap-3 align-items-center justify-content-between">

                                            <div class="mb-3 register-input">
                                                <input type="tel" v-model="phone" :class="errors?.phone
                                                    ? 'is-invalid form-control'
                                                    : 'form-control'
                                                    " :placeholder="$t('Phone Number')" />
                                                <p v-if="errors?.phone" class="my-2 text-danger">
                                                    {{ errors?.phone[0] }}
                                                </p>
                                            </div>

                                            <div class="mb-3 register-input">
                                                <input type="email" v-model="email" :class="errors?.email
                                                    ? 'is-invalid form-control'
                                                    : 'form-control'
                                                    " :placeholder="$t('Email')" />
                                                <p v-if="errors?.email" class="my-2 text-danger">
                                                    {{ errors?.email[0] }}
                                                </p>
                                            </div>
                                        </div>


                                        <div class="d-block d-sm-flex gap-3 align-items-center justify-content-between">
                                            <div class="mb-3 position-relative register-input">
                                                <input :type="showPassword ? 'text' : 'password'" v-model="password"
                                                    :class="errors?.password
                                                        ? 'is-invalid form-control'
                                                        : 'form-control'
                                                        " :placeholder="$t('Create Password')" />
                                                <p v-if="errors?.password" class="my-2 text-danger">
                                                    {{ errors?.password[0] }}
                                                </p>
                                                <div class="eye-icon" @click="showPassword = !showPassword">
                                                    <FontAwesomeIcon :icon="showPassword ? faEye : faEyeSlash" />
                                                </div>
                                            </div>

                                            <div class="mb-3 position-relative register-input">
                                                <input :type="showConfirmPassword ? 'text' : 'password'"
                                                    v-model="passwordConfirm" class="form-control"
                                                    :placeholder="$t('Confirm Password')" />
                                                <div class="eye-icon"
                                                    @click="showConfirmPassword = !showConfirmPassword">
                                                    <FontAwesomeIcon :icon="showConfirmPassword ? faEye : faEyeSlash" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-2 mb-4 form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                                required />
                                            <label class="form-check-label text-muted" for="exampleCheck1"
                                                style="font-size: 14px;">
                                                {{ $t('I accept and agree to the') }}
                                                <button type="button" data-bs-toggle="modal" @click="terms"
                                                    data-bs-target="#termsModal"
                                                    class="text-decoration-none bg-transparent border-0 text-primary">
                                                    {{ $t('Terms & Condition') }}</button>
                                                {{ $t('and') }}
                                                <button type="button" @click="policy" data-bs-toggle="modal"
                                                    data-bs-target="#policyModal"
                                                    class="text-decoration-none bg-transparent border-0 text-primary">
                                                    {{ $t('Privacy Policy') }}</button>
                                                {{ $t('of') }} {{ masterStore?.masterData?.name }}
                                            </label>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 rounded-2">
                                            <span :class="{ 'loader': loader }">{{ signUpBtnText }}</span>
                                        </button>
                                    </form>

                                    <span>{{ $t('Already have an account') }}?
                                        <router-link to="/login">{{ $t('Log in') }}</router-link>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- policy Modal -->
    <div class="modal fade" id="policyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $t('Privacy Policy') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p v-html="termsPage?.content"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- terms Modal -->
    <div class="modal fade" id="termsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $t('Terms & Condition') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p v-html="policyPage?.content"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.register-section {
    background: url('/public/assets/website/authorization-page.png') no-repeat center;
    background-size: cover;
    height: 100vh;
    overflow-y: auto;
    display: flex;
    justify-content: center;
    align-items: center;
}

.register-input {
    width: 50%;
}

@media (max-width: 576px) {
    .register-section {
        height: 100% !important;
    }

    .register-input {
        width: 100% !important;
    }
}

.eye-icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
}

.logo-img {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #F9FBFF;
    padding: 1.5rem 0;
    border-radius: 1rem;

    img {
        max-width: 250px;
        max-height: 90px;
        object-fit: cover;
    }
}

@media (max-width: 576px) {
    .logo-img img {
        width: 100%;
        height: auto;
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
import { ref, watch, onMounted } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
import Swal from "sweetalert2";
import { useAuthStore } from "@/stores/auth";
import { useMasterStore } from "@/stores/master";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faArrowLeft, faEye, faEyeSlash } from "@fortawesome/free-solid-svg-icons";

const router = useRouter();
const authStore = useAuthStore();
const masterStore = useMasterStore();
const policyPage = ref(null);
const termsPage = ref(null);
let showPassword = ref(false);
let showConfirmPassword = ref(false);



const policy = () => {
    policyPage.value = masterStore.masterData.pages[0];
}
const terms = () => {
    termsPage.value = masterStore.masterData.pages[1];
}

const name = ref("");
const phone = ref("");
const email = ref("");
const password = ref("");
const passwordConfirm = ref("");

// Watchers to clear errors when user inputs data
watch(name, (newValue) => {
    errors.value.name = newValue ? "" : errors.value.name; // Only clear if there's a value
});
watch(phone, (newValue) => {
    errors.value.phone = newValue ? "" : errors.value.phone;
});
watch(email, (newValue) => {
    errors.value.email = newValue ? "" : errors.value.email;
});
watch(password, (newValue) => {
    errors.value.password = newValue ? "" : errors.value.password;
});
watch(passwordConfirm, (newValue) => {
    errors.value.password_confirmation = newValue
        ? ""
        : errors.value.password_confirmation;
});

// for errors
let errors = ref();

const signUpBtnText = ref("Sign up");
const loader = ref(false);

// Function to handle user registration
const registerUser = async () => {
    try {
        loader.value = true;
        signUpBtnText.value = "Signing up...";
        const response = await axios.post(`/register`, {
            name: name.value,
            phone: phone.value,
            email: email.value,
            password: password.value,
            password_confirmation: passwordConfirm.value,
        });
        // Store user data and auth token in Pinia store
        authStore.setAuthData(
            response.data.data.token,
            response.data.data.user
        );
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Registration successful",
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
        signUpBtnText.value = "Sign up";
        errors.value = error.response?.data?.errors;
    }
};

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
