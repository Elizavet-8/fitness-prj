<template>
   <div class="modal fade plugin-modal" id="subscription" tabindex="-1" role="dialog"
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
         <div class="plugin-modal__head">
            <h4 class="plugin-modal__title">Управление подпиской</h4>
            <h5 class="plugin-modal__subtitle">Подписка истекает</h5>
            <p v-if='deactivationDate' class="plugin-modal__txt red">
               {{deactivationDate}} будет отключена.
            </p>
            <p class="plugin-modal__txt red">
               Для продления подписки оплатите дальнейший доступ к сервису.
            </p>
         </div>
         <h6 class="plugin-modal-form__subtitle">
            Изменить период списания и продлить подписку
         </h6>
         <p class="plugin-modal__txt">
            Выберите период для продления.Чем больше срок, тем больше выгода.
         </p>
         <form class="plugin-modal-form" v-if="activeStep === 1">
            <div class="plugin-checkboxes">
               <!-- <label class="plugin-checkbox__label" v-for="(checkbox, i) in checkboxes" :key="checkbox.i"> -->
               <label class="plugin-checkbox__label" v-for="checkbox in Pricings" :key="checkbox.number">
                  <input class="check__input" type="radio" :id="checkbox.number" :value="checkbox.number" v-model="selected_checkbox">
                  <div class="plugin-checkbox">
                     <div class="plugin-checkbox__discount">
                        -{{ checkbox.discount }}%
                     </div>
                     <div class="plugin-checkbox__number">
                        {{ checkbox.number }}
                     </div>
                     <div class="plugin-checkbox__txt plugin-modal__txt">
                        {{ checkbox.month }}
                        <b>
                           {{ checkbox.price }} р.
                        </b>
                     </div>
                  </div>
               </label>
            </div>
            <p class="plugin-modal__txt-small">
               1 месяц равен 30 календарным дням
            </p>
            <button v-if="selected_checkbox!=null" type="button" class="plugin-modal-form__btn btn-none" @click.prevent="next()">оплатить</button>
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
      checkboxes: [],
      activeStep: 1,
      formSteps: [],
      selected_checkbox:null,
   }),
   computed:{
      Pricings(){
         this.checkboxes = this.$store.getters.GetPricings;
         for(let i = 0; i < this.checkboxes.length; i++)
         {
            this.checkboxes[i]['value'] = false;
         }

         return this.checkboxes;
      },
      deactivationDate()
      {
         var tmp = this.$store.getters.GetAccessHistory;
         let options = {
            month: "long",
            day: "numeric"
         }
         if(tmp)
         {
            var date = new Date(tmp.deactivation_date)
            return date.toLocaleDateString('ru-RU', options)
         }
         return null;
      },
   },
   mounted(){
      if(userInfo){
         this.$store.dispatch('fetchPricings');
         this.$store.dispatch('fetchAccessHistory');
      }
   },
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
