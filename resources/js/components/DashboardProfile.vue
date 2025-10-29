<template>
    <section class="my-2">
        <span class="d-block mb-2 mb-lg-3 fs-4 fw-bold">{{ $t('Home') }}/{{ $t('Profile') }}</span>
        <form @submit.prevent="updateProfile" class="row">
            <div class="bg-white rounded-2 p-2 theme-shadow col-8 mx-auto">
                <!-- Profile Picture & Verified -->
                <div class="text-center mb-4 rounded-2 p-4 position-relative" style="background: #F1F5F9;">
                    <div class="position-relative d-inline-block">
                        <img :src="profilePhoto ? profilePhoto : authStore.userData.profile_picture"
                            alt="Profile picture" height="120" width="120"
                            class="rounded-circle border border-3 border-primary object-fit-cover" />
                        <input id="upload-pp" type="file" class="d-none" @change="changeProfilePhoto" />
                        <label for="upload-pp" class="px-5 py-2 w-100 mt-3" style="border: 2px dashed #9e4aed; cursor: pointer;">
                            {{ $t('Change Photo') }}
                        </label>
                    </div>
                    <div class="mt-2 virified-badge">
                        <span v-if=" authStore.userData?.email_verified" class="badge bg-success px-3 py-2">✔ {{ $t('Verified') }}</span>
                        <span v-else class="badge bg-danger px-3 py-2">✘ {{ $t('Not Verified') }}</span>
                    </div>
                    <p v-if="errors?.profile_picture" class="my-2 text-danger">
                        {{ errors?.profile_picture[0] }}
                    </p>
                </div>

                <!-- Profile Form -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fs-6">{{ $t('Name') }}</label>
                        <input type="text" class="form-control bg-light border" v-model="form.name"
                            :placeholder="$t('Full Name')" />
                        <p v-if="errors?.name" class="my-1 text-danger">{{ errors?.name[0] }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fs-6">{{ $t('Mobile Number') }}</label>
                        <input type="tel" class="form-control bg-light border" v-model="form.phone"
                            placeholder="+8801XXXXXXXXX" />
                        <p v-if="errors?.phone" class="my-1 text-danger">{{ errors?.phone[0] }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fs-6">{{ $t('Email Address') }}</label>
                        <input type="email" class="form-control bg-light border" v-model="form.email"
                            placeholder="user@example.com" />
                        <p v-if="errors?.email" class="my-1 text-danger">{{ errors?.email[0] }}</p>
                    </div>

                    <!-- Password Section -->
                    <div class="col-md-6">
                        <label class="form-label fs-6">{{ $t('Current Password') }}</label>
                        <input type="password" class="form-control bg-light border" v-model="form.current_password"
                            :placeholder="$t('Enter current password to change')" />
                        <p v-if="current_passwordError" class="my-1 text-danger">{{ current_passwordError }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fs-6">{{ $t('New Password') }}</label>
                        <input type="password" class="form-control bg-light border" v-model="form.password"
                            :placeholder="$t('Enter new password')" />
                        <p v-if="errors?.password" class="my-1 text-danger">{{ errors?.password[0] }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fs-6">{{ $t('Confirm Password') }}</label>
                        <input type="password" class="form-control bg-light border" v-model="form.password_confirmation"
                            :placeholder="$t('Confirm new password')" />
                    </div>
                </div>

                <!-- Submit -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-100 py-2 fs-5">
                        {{ $t('Update Profile') }}
                    </button>
                </div>
            </div>
        </form>

    </section>
</template>

<style lang="scss" scoped>
.upload-pp-btn {
    border-style: dashed;
}

.virified-badge {
    position: absolute;
    top: 0;
    right: 5PX;
}
</style>

<script setup>
import { useAuthStore } from "@/stores/auth";
import { ref, watch } from "vue";
import Swal from "sweetalert2";

// validation errors
let errors = ref("");

const authStore = useAuthStore();
let current_passwordError = ref("");

// Initialize form data
const form = ref({
    name: authStore.userData.name,
    phone: authStore.userData.phone,
    email: authStore.userData.email,
    current_password: null,
    password: null,
    password_confirmation: null,
    profile_picture: null,
});

watch(
    () => form.value.name,
    (newName) => {
        if (newName) {
            errors.value.name = "";
        }
    }
);
watch(
    () => form.value.email,
    (newEmail) => {
        if (newEmail) {
            errors.value.email = "";
        }
    }
);
watch(
    () => form.value.phone,
    (newPhone) => {
        if (newPhone) {
            errors.value.phone = "";
        }
    }
);
watch(
    () => form.value.password,
    (newPassword) => {
        if (newPassword) {
            errors.value.password = "";
        }
    }
);
watch(
    () => form.value.current_password,
    (newPassword) => {
        if (newPassword) {
            current_passwordError.value = "";
        }
    }
);

// Handle form submission
const updateProfile = async () => {
    try {
        let formData = new FormData();
        formData.append("name", form.value.name);
        formData.append("phone", form.value.phone);

        if (form.value.profile_picture)
            formData.append("profile_picture", form.value.profile_picture);
        if (
            form.value.current_password ||
            form.value.password ||
            form.value.password_confirmation
        ) {
            formData.append("current_password", form.value.current_password);
            formData.append("password", form.value.password);
            formData.append(
                "password_confirmation",
                form.value.password_confirmation
            );
        }

        if (form.value.email) formData.append("email", form.value.email);

        // API request to update the profile
        const response = await axios.post(`/profile/update`, formData, {
            headers: {
                Accept: "application/json",
                Authorization: "Bearer " + authStore.authToken,
            },
        });

        // Update user data in state
        authStore.setAuthData(
            response.data.data.token,
            response.data.data.user
        );

        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Profile updated successfully",
            showConfirmButton: false,
            timer: 1500,
        });
    } catch (error) {
        if (error?.response?.data?.data?.current_password_error) {
            current_passwordError.value =
                error?.response?.data?.data?.current_password_error;
        }

        errors.value = error?.response?.data?.errors;


        Swal.fire({
            icon: "error",
            title: "Error",
            text: error.response.data.message,
            showConfirmButton: false,
            timer: 1500,
        });

        if (error?.response?.data?.access_denied) {
            Swal.fire({
                icon: "error",
                title: "Access Denied",
                text: error?.response?.data?.access_denied,
                showConfirmButton: false,
                timer: 3500,
            });
        }
    }
};

const profilePhoto = ref(false);
let changeProfile = ref(false);

const changeProfilePhoto = (event) => {
    profilePhoto.value = URL.createObjectURL(event.target.files[0]);
    form.value.profile_picture = event.target.files[0];
    changeProfile.value = true;
};
</script>
