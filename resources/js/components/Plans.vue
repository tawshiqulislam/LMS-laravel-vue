<template>
    <div class="row gap-3 gap-md-0 g-3 g-lg-4 justify-content-center mb-5">

        <!-- Pro Plan -->
        <div class="col-lg-4 col-md-6 col-sm-6 col-12" v-for="(plan, index) in plans" :key="plan.id">
            <div class="pricing-card text-center" :class="plan.is_featured == true ? 'active' : ''">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>{{ plan.title }}</h5>
                </div>
                <ul class="text-start">
                    <li>
                        <i class="bi bi-check2"></i>
                        {{ $t('Select') }} {{ plan.course_limit }} {{ $t('courses of your choice') }}
                    </li>
                    <li>
                        <i class="bi bi-check2"></i>
                        {{ $t('Enjoy') }}
                        {{ plan.plan_type == 'monthly' ? plan.duration + ' ' + 'days' : plan.duration + ' '
                            + 'year' }}
                        {{ $t('of learning') }}
                    </li>
                    <li v-for="(feature, index) in plan.features" :key="index">
                        <i class="bi bi-check2"></i>
                        {{ feature }}
                    </li>
                </ul>
                <div class="mt-auto">
                    <div class="price">{{ setCurrency(plan.price) }}<span class="fs-6">/ {{ plan.plan_type }}</span>
                    </div>
                    <button type="button" @click="checkout(plan.id)" class="btn btn-try mt-3">{{ $t('Purchase Now')
                    }}</button>
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>
.pricing-card {
    background-color: #ffffff;
    color: #181059;
    border-radius: 20px;
    padding: 30px 25px;
    margin: 20px auto;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    transition: all 0.5s ease-in-out;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    height: 100%;
}


.pricing-card:hover {
    color: #ffffff;
    background-color: #181059;
    transform: translateY(-10px);
}

.pricing-card.active {
    color: #ffffff;
    background-color: #181059;
    transform: scale(1.03);
    z-index: 1;
}

.pricing-card h5 {
    font-size: 2rem;
    font-weight: 600;
}

.save-badge {
    background-color: #6d4aff;
    color: #fff;
    font-size: 0.8rem;
    padding: 4px 10px;
    border-radius: 12px;
    margin-left: 10px;
}

.pricing-card ul {
    list-style: none;
    padding: 0;
    margin-top: 20px;
}

.pricing-card ul li {
    width: 100%;
    margin-bottom: 12px;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
}

.pricing-card ul li i {
    margin-right: 10px;
    color: #181059;
    font-size: 1.2rem;
}

.pricing-card:hover ul li i {
    color: #fff;
}

.pricing-card.active ul li i {
    color: #fff;
}

.pricing-card ul li.disabled {
    color: rgba(255, 255, 255, 0.4);
    text-decoration: line-through;
}

.price {
    text-align: start;
    font-size: 2.5rem;
    font-weight: 700;
}

.btn-try {
    background-color: #F8F4FF;
    border: none;
    color: #8b54e8;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 600;
    transition: 0.3s;
    width: 100%;
}

.btn-try:hover {
    background-color: #8b54e8;
    color: #ffffff;
}

.pricing-card:hover .btn-try {
    background-color: #8b54e8;
    color: #ffffff;
}

@media (max-width: 768px) {
    .pricing-card h5 {
        font-size: 1.5rem;
    }

    .pricing-card ul li {
        font-size: 0.75rem;
    }

    .price {
        font-size: 1.25rem;
    }
}
</style>


<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useMasterStore } from '@/stores/master';

const plans = ref([]);
const router = useRouter();
const masterStore = useMasterStore();


onMounted(() => {
    axios.get(`/plan/list`, {
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    })
        .then((res) => {
            plans.value = res.data.data;
        })
        .catch((error) => {
            console.error("Error fetching courses:", error);
        });
})

const setCurrency = (price) => {
    return masterStore.masterData.currency_symbol + price;
}

const checkout = (id) => {
    router.push({
        name: 'plan_checkout',
        query: {
            id: id
        }
    })
}
</script>
