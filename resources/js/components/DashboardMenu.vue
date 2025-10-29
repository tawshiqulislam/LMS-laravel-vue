<template>
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <router-link :to="{ name: 'dashboard' }" class="nav-link">
            <i class="bi bi-columns-gap me-3"></i>{{ $t('Dashboard') }}
        </router-link>
        <router-link :to="{ name: 'myProfile' }" class="nav-link">
            <i class="bi bi-person me-3"></i>{{ $t('Profile') }}
        </router-link>
        <router-link :to="{ name: 'myCourse' }" class="nav-link">
            <i class="bi bi-book me-3"></i>{{ $t('My Courses') }}
        </router-link>
        <router-link :to="{ name: 'myCertificate' }" class="nav-link">
            <i class="bi bi-award me-3"></i>{{ $t('My Certificate') }}
        </router-link>
        <router-link :to="{ name: 'myPaymentHistory' }" class="nav-link">
            <i class="bi bi-receipt me-3"></i>{{ $t('Payment History') }}
        </router-link>
        <router-link :to="{ name: 'myPlanPaymentHistory' }" class="nav-link">
            <i class="bi bi-coin me-3"></i>{{ $t('Plan & Payment') }}
        </router-link>
    </div>
    <div class="nav flex-column nav-pills">
        <button type="button" @click="logout()" class="nav-link" style="color: #FF0B55; border: 1px solid #FF0B55;">
            <i class="bi bi-box-arrow-right me-3"></i>{{ $t('Sign out') }}
        </button>
    </div>
</template>

<style lang="scss" scoped>
.nav {
    .nav-link {
        color: #000;
        text-align: left;
        border-radius: .3rem;
        margin-bottom: .5rem;
        ;
    }

    .nav-link.router-link-active {
        color: white;
        background-color: var(--bs-nav-pills-link-active-bg);
    }
}
</style>

<script setup>
import Swal from 'sweetalert2'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const router = useRouter()
const authStore = useAuthStore()

function logout() {
    Swal.fire({
        title: t("Are you sure?"),
        text: t("Do you want to log out?"),
        icon: t("warning"),
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, log out!"
    }).then((result) => {
        if (result.isConfirmed) {
            authStore.clearAuthData()
            Swal.fire({
                title: t("Logged Out!"),
                text: t("Log out successful."),
                showConfirmButton: false,
                icon: "success",
                timer: 1500
            });
            router.push('/');
        }
    });
}
</script>
