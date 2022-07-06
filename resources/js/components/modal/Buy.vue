<template>
    <div
        class="modal modal-custom fade modal-buy"
        id="buy"
        tabindex="-1"
        role="dialog"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-custom__content">
                <button
                    type="button"
                    class="modal__close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <svg
                        width="18"
                        height="18"
                        viewBox="0 0 18 18"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <rect
                            y="16.3125"
                            width="23.0694"
                            height="2.38648"
                            transform="rotate(-45 0 16.3125)"
                            fill="#9180FF"
                        />
                        <rect
                            x="1.68752"
                            width="23.0694"
                            height="2.38648"
                            transform="rotate(45 1.68752 0)"
                            fill="#9180FF"
                        />
                    </svg>
                </button>

                <h5 class="modal__title">ВАШ ЗАКАЗ</h5>
                <p class="buy-head__prg">
                    <b>ВАЖНО! Внимательно вводите ваш электронный адрес без ошибок.</b>
                </p>
                <div class="buy__label buy-head__txt-small">
                    Логин/пароль придёт на указанную Вами электронную почту в течении
                    суток после оплаты - эти данные используйте для входа в Личный
                    кабинет.
                </div>
                <form class="buy-form" v-if="activeStep === 1" @submit.prevent="next">
                    <div class="buy-form__row buy-form__row-three">
                        <div class="buy__group" v-for="(info, index) in users" :key="index">
                            <label :for="info.id" class="buy__label">
                                {{ info.name }}
                            </label>
                            <input
                                required
                                :id="info.id"
                                :type="info.type"
                                class="buy__input"
                                :placeholder="info.placeholder"
                                v-model="info.value"
                            />
                        </div>
                    </div>
                    <div class="buy-form__row">
                        <Myselect
                            :select="selects[0]"
                            :list="GetLifeStyles.data"
                            v-on:result="result"
                        ></Myselect>
                        <Myselect
                            :select="selects[1]"
                            :list="GetProblemZones.data"
                            v-on:result="result"
                        ></Myselect>
                        <Myselect
                            :select="selects[2]"
                            :list="GetTrainingLocations"
                            v-on:result="result"
                        ></Myselect>
                        <Myselect
                            :select="selects[3]"
                            :list="GetMenuCalories"
                            v-on:result="result"
                        ></Myselect>
                    </div>
                    <div class="buy__price">Сумма: 5 000р.</div>
                    <button type="submit" class="button buy-form__btn">
                        ОПЛАТИТЬ И ЗАРЕГИСТРИРОВАТЬСЯ
                    </button>
                </form>
                <div  v-if="activeStep === 2">
                    <div class="buy-form__loading d-flex flex-column">
                        <div class="row d-flex w-100">
                        <span>Спасибо! Заказ оформлен. Пожалуйста, подождите. Идет переход к оплате...</span>
                        </div>
                        <div class="row d-flex w-100">
                            <div class="col-6">
                                <button class="button-green" @click="initializeStripePayment">stripe</button>
                            </div>
                            <div class="col-6">
                                <button class="button-green" @click="initializeTinkoffPayment">tinkoff</button>
                            </div>
                        </div>
                    </div>
                    <button class="button-back" @click="prev">Назад</button>
                </div>
                <div class="buy-form__prg">
                    Нажимая “Оплатить и зарегестрироваться”, я принимаю условия
                    <span>Политики обработки персональных данный и условия Оферты </span>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import Myselect from "../general/Select.vue";
import {mapGetters} from "vuex";
export default {
  components: {
    Myselect,
  },
    mounted() {
        this.$store.dispatch('fetchLifeStyles');
        this.$store.dispatch('fetchMenuCalories');
        this.$store.dispatch('fetchProblemZones');
        this.$store.dispatch('fetchTrainingLocations');
    },
    data: () => ({
    disabled: false,
    errors:[],
    activeStep: 1,
    deletepackage: false,
    returnpackage: true,
    users: [
      {
          id: "name",
          name: "Имя",
          placeholder: "Любовь Мишанкова",
          value: "",
          type: "text"
      },
      {
          id: "age",
          name: "Ваш возраст",
          placeholder: "25 лет",
          value: "",
          type: "number"
      },
      {
          id: "email",
          name: "Ваш Email",
          placeholder: "Email",
          value: "",
          type: "email"
      },
      {
          id: "weight",
          name: "Ваш вес",
          placeholder: "60 кг",
          value: "",
          type: "number"
      },
      {
          id: "tall",
          name: "Ваш рост",
          placeholder: "165 см",
          value: "",
          type: "number"
      },
      {
          id: "required_weight",
          name: "Желаемый вес",
          placeholder: "55 кг",
          value: "",
          type: "number"
      },
    ],
    additionValues: {
        'training_location_id' : 1,
        'life_style_id' : 1,
        'problem_zone_id' : 1,
        'menu_calories_id' : 1
    },
    selects: [
      {
        id : "life_style_id",
        label: "Выберите Ваш образ жизни: ",
        value: "Ваш образ жизни"
      },
      {
        id : "problem_zone_id",
        label: "Выберите проблемные зоны: ",
        value: "Руки"
      },
      {
        id : "training_location_id",
        label: "Тренировки для: ",
        value: "Дома"
      },
      {
        id : "menu_calories_id",
        label: "Желаемая каллорийность меню: ",
        value: "1300-1400"
      },
    ],
  }),
    computed: {
        ...mapGetters(['GetLifeStyles']),
        ...mapGetters(['GetMenuCalories']),
        ...mapGetters(['GetProblemZones']),
        ...mapGetters(['GetTrainingLocations'])
    },
  methods: {
    toggleDelete() {
      this.deletepackage = !this.deletepackage;
    },
    result(item, id) {
        this.additionValues[id] = item;
    },
    prev() {
      this.activeStep--;
    },
    next() {
      this.activeStep++;
    },
      initializeStripePayment() {
        let user = {
            "name" : this.users[0].value,
            "age" : this.users[1].value,
            "email" : this.users[2].value,
            "weight" : this.users[3].value,
            "tall" : this.users[4].value,
            "required_weight" : this.users[5].value,
            "training_location_id" : this.additionValues.training_location_id,
            "menu_calories_id" : this.additionValues.menu_calories_id,
            "problem_zone_id" : this.additionValues.problem_zone_id,
            "life_style_id" : this.additionValues.life_style_id,
            "product_name" : localStorage.getItem('name'),
            "price" : localStorage.getItem('price'),
            "stripe_id" : localStorage.getItem('stripe_id'),
            "menu_id" : localStorage.getItem('menu_id'),
            "training_id" : localStorage.getItem('training_id')
        }
        let formData = new FormData();
        formData.append('user_info', JSON.stringify(user));
        axios.post('/initialize-checkout/stripe', formData)
          .then(() => {
              localStorage.removeItem('name');
              localStorage.removeItem('price');
              localStorage.removeItem('stripe_id');
              localStorage.removeItem('menu_id');
              localStorage.removeItem('training_id');
              window.location.href = '/open-checkout/stripe';
          })
          .catch((error) => {
              console.log(error.response);
          })
      },
      initializeTinkoffPayment() {
          let user = {
              "name" : this.users[0].value,
              "age" : this.users[1].value,
              "email" : this.users[2].value,
              "weight" : this.users[3].value,
              "tall" : this.users[4].value,
              "required_weight" : this.users[5].value,
              "training_location_id" : this.additionValues.training_location_id,
              "menu_calories_id" : this.additionValues.menu_calories_id,
              "problem_zone_id" : this.additionValues.problem_zone_id,
              "life_style_id" : this.additionValues.life_style_id,
              "product_name" : localStorage.getItem('name'),
              "price" : localStorage.getItem('price'),
              "stripe_id" : localStorage.getItem('stripe_id'),
              "menu_id" : localStorage.getItem('menu_id'),
              "training_id" : localStorage.getItem('training_id')
          }
          let formData = new FormData();
          formData.append('user_info', JSON.stringify(user));
          axios.post('/initialize-checkout/tinkoff', formData)
              .then((response) => {
                  localStorage.removeItem('name');
                  localStorage.removeItem('price');
                  localStorage.removeItem('stripe_id');
                  localStorage.removeItem('menu_id');
                  localStorage.removeItem('training_id');
                  window.location.href = response.data.paymentUrl;
              })
              .catch((error) => {
                  console.log(error.response);
              })
      }
  },
};
</script>
