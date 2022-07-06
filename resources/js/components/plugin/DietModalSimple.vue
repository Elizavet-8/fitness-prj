<template>
 <div class="modal fade plugin-modal diet-modal" id="diet-simple" tabindex="-1" role="dialog"
   aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog plugin-modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content plugin-modal__content">
         <button v-on:click="activeStep=1" class="plugin-modal__btn-close btn-none" data-dismiss="modal">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
               <rect x="0.351379" y="22.4548" width="31.0238" height="3.20936"
                  transform="rotate(-45 0.351379 22.4548)" fill="#BB01DA" />
               <rect x="2.62067" y="0.518066" width="31.0238" height="3.20936"
                  transform="rotate(45 2.62067 0.518066)" fill="#BB01DA" />
            </svg>
         </button>
         <h6 class="plugin-modal-form__subtitle">
         Выберите новый план питания
         </h6>
         <p class="plugin-modal__txt">
           Программы питания для Вас, только с еще более простыми блюдами. Когда нет ни минуты, можно смело брать на вооружение!
         </p>
         <form class="plugin-modal-form" v-if="activeStep === 1">
            <div class="plugin-checkboxes">
               <label class="plugin-checkbox__label" v-for="(dietsimple, index) in dietssimple" :key="dietsimple.index">
                  <input class="check__input" type="radio" :id="dietsimple.menu" :value="dietsimple.menu" v-model="selected_dietsimple">
                  <div class="plugin-checkbox">
                     <div class="plugin-checkbox__number">
                        {{ index + 1 }}
                     </div>
                     <div class="plugin-checkbox__txt plugin-modal__txt">
                        {{ dietsimple.menu }}
                        <b>
                           {{ dietsimple.price }}
                        </b>
                     </div>
                  </div>
               </label>
               <div class="plugin-checkbox__label plugin-checkbox__modal"  data-toggle="modal" data-target="#diet">
                  <div class="plugin-checkbox">
                     <div class="plugin-checkbox__number">
                       5
                     </div>
                     <div class="plugin-checkbox__txt plugin-modal__txt">
                        <b>
                           Разнообразное<br> меню
                        </b>
                     </div>
                  </div>
               </div>
            </div>
            <button v-if="selected_dietsimple!=null" type="button" class="plugin-modal-form__btn btn-none" @click.prevent="next()">оплатить</button>
            <button v-else type="button" class="plugin-modal-form__btn btn-none">оплатить</button>
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
                      <button class="button-green" @click="initializeStripePayment">stripe</button>
                  </div>
                  <div class="col-6">
                      <button class="button-green" @click="initializeTinkoffPayment">tinkoff</button>
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
      disabled: false,
      dietssimple: [
         {
            value: false,
            menu: 'Меню на 1300-1400',
            price: '2 000 р.',
         },
         {
            value: false,
            menu: 'Меню на 1500-1600',
            price: '2 000 р.',
         },
             {
            value: false,
            menu: 'Меню на 1800-1900',
            price: '2 000 р.',
         },
         {
            value: false,
            menu: 'Меню на 2000-2100',
            price: '2 000 р.',
         }
      ],
      activeStep: 1,
      formSteps: [],
      selected_dietsimple:null,
   }),
   methods: {
      prev() {
      this.activeStep--;
      },
      next() {
      this.activeStep++;
      },
   },
   };
</script>
