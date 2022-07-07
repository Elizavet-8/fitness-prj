<template>
    <div>
        <div class="modal fade plugin-modal diet-modal" id="diet" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog plugin-modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content plugin-modal__content">
                    <button v-on:click="activeStep=1" class="plugin-modal__btn-close btn-none" data-dismiss="modal">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.351379" y="22.4548" width="31.0238" height="3.20936"
                                  transform="rotate(-45 0.351379 22.4548)" fill="#BB01DA"/>
                            <rect x="2.62067" y="0.518066" width="31.0238" height="3.20936"
                                  transform="rotate(45 2.62067 0.518066)" fill="#BB01DA"/>
                        </svg>
                    </button>
                    <h6 class="plugin-modal-form__subtitle">
                        Выберите новый план питания
                    </h6>
                    <p class="plugin-modal__txt">
                        Каждый план идеально сбалансирован и прекрасно подходит для активной жизни
                    </p>
                    <form class="plugin-modal-form" v-if="activeStep === 1">
                        <div class="plugin-checkboxes">
                            <label class="plugin-checkbox__label" v-for="(diet, index) in diets" :key="diet.index">
                                <input class="check__input" type="radio" :id="diet.menu" :value="diet"
                                       v-model="selected_diet">
                                <div class="plugin-checkbox">
                                    <div class="plugin-checkbox__number">
                                        <sub>№</sub>{{ index + 1 }}
                                    </div>
                                    <div class="plugin-checkbox__txt plugin-modal__txt">
                                        {{ diet.menu }}
                                        <b>
                                            {{ diet.price }} р.
                                        </b>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <button v-if="disableBtn()" type="button" class="plugin-modal-form__btn btn-none"
                                @click.prevent="next()">оплатить
                        </button>
                        <button v-else type="button" class="plugin-modal-form__btn btn-none" disabled>оплатить</button>
                        <p class="plugin-modal__txt-small center">
                            Нажимая “Оплатить”, я принимаю условия Политики обработки персональных данный и условия
                            Оферты
                        </p>
                    </form>
                    <div class="buy-form__loading d-flex flex-column" v-if="activeStep === 2">
                        <div class="row d-flex w-100">
                            <span>Спасибо! Заказ оформлен. Пожалуйста, подождите. Идет переход к оплате...</span>
                        </div>
                        <div class="row d-flex w-100">
                            <div class="col-6">
                                <button class="button-green" @click="initializeStripeCheckout">stripe</button>
                            </div>
                            <div class="col-6">
                                <button class="button-green" @click="initializeTinkoffCheckout">tinkoff</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        disabledBtn: false,
        calorics_list: [],
        diets_list: [],
        activeStep: 1,
        formSteps: [],
        selected_diet: null,
    }),
    mounted() {
        this.$store.dispatch('fetchMenuCalories');
        this.$store.dispatch('fetchMenus');
    },
    computed: {
        calorics() {
            this.calorics_list = [];
            let cals = this.$store.getters.GetMenuCalories;
            if (!cals)
                return [];
            cals.forEach(element => {
                this.calorics_list.push(
                    {
                        value: false,
                        title: element.name,
                    }
                )
            });
            return this.calorics_list;
        },
        diets() {
            this.diets_list = [];
            let diets = this.$store.getters.GetMenus;
            if (!diets)
                return [];
            diets.forEach(element => {
                let tmp = {
                    value: false,
                    menu_id : element.id,
                    menu: element.menu_content,
                    price: element.menu_price,
                    stripe_id : element.stripe_id,
                    menu_type_id : element.menu_type_id
                }
                if (!this.diets_list.some(e => e.menu == tmp.menu && e.price == tmp.price))
                    this.diets_list.push(tmp);
            });
            return this.diets_list;
        }
    },
    methods: {
        prev() {
            this.activeStep--;
        },
        next() {
            this.activeStep++;
        },
        disableBtn() {
            return this.selected_diet != null;
        },
        initializeStripeCheckout() {
            let formData = new FormData();
            formData.append('menu_id', this.selected_diet.menu_id);
            formData.append('menu_type_id', this.selected_diet.menu_type_id);
            axios.post('/initialize-checkout/stripe-for-diet', formData)
                .then(() => {
                    window.location.href = '/open-checkout/stripe-for-diet';
                })
                .catch((error) => {
                    console.log(error.response);
                })
        },
        initializeTinkoffCheckout() {
            let formData = new FormData();
            formData.append('menu_id', this.selected_diet.menu_id);
            formData.append('menu_type_id', this.selected_diet.menu_type_id);
            axios.post('/initialize-checkout/tinkoff-for-diet', formData)
                .then((response) => {
                    window.location.href = response.data.paymentUrl;
                })
                .catch((error) => {
                    console.log(error.response);
                })
        }
    },
};
</script>
