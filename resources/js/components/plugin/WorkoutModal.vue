<template>
   <div class="modal fade plugin-modal workout-modal" id="workout" tabindex="-1" role="dialog"
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
            <h4 class="plugin-modal__title">
               Новые тренировочные планы для зала и дома
            </h4>
         </div>
         <div class="workout-checkboxes">
            <label class="workout-checkbox__label" v-for="(locations, index) in locations" :key="index">
               <input class="check__input" type="radio" :id="locations.title" :value="locations" v-model="selected_location">
               <div class="workout-checkbox">
                   {{ locations.title  }}
               </div>
            </label>
         </div>
         <h6 class="plugin-modal-form__subtitle">
            Выберите новый тренировочный план
         </h6>
         <p class="plugin-modal__txt">
           Чем выше уровень, тем сложнее тренировочный план
         </p>
         <form class="plugin-modal-form" v-if="activeStep === 1">
            <div class="plugin-checkboxes">
               <label class="plugin-checkbox__label" v-for="(workout, index) in workouts" :key="index">
                  <input class="check__input" type="radio" :id="workout.level" :value="workout" v-model="selected_workout">
                  <div class="plugin-checkbox">
                     <div class="plugin-checkbox__number">
                        {{ workout.level  }}
                     </div>
                     <div class="plugin-checkbox__txt plugin-modal__txt">
                        Уровень {{ workout.level }}
                        <b>
                           {{ workout.price }} р.
                        </b>
                     </div>
                  </div>
               </label>
            </div>
            <p class="plugin-modal__txt-small">
               Доступ к тренировочному плану предоставляется на 30 календарных дней
            </p>
            <button v-if="selected_workout!=null&&selected_location!=null" type="button" class="plugin-modal-form__btn btn-none" @click.prevent="next()">оплатить</button>
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
         locations_list: [],
         workouts_list: [],
         activeStep: 1,
         formSteps: [],
         selected_location:null,
         selected_workout:null,
      }),
      mounted(){
         this.$store.dispatch('fetchTrainingLocations');
         this.$store.dispatch('fetchTrainings');
      },
      computed:{
         locations(){
            this.locations_list = [];
            let locs = this.$store.getters.GetTrainingLocations;
            if(!locs)
               return [];
            locs.forEach(element=>{
               this.locations_list.push(
                  {
                     value: false,
                     title: element.name,
                     id : element.id
                  }
               )
            });
            return this.locations_list;
         },
         workouts(){
            this.workouts_list = [];
            let works = this.$store.getters.GetTrainings;
            if(!works)
               return [];
            works.forEach(element=>{
               this.workouts_list.push(
                  {
                     value: false,
                     level: element.level,
                     price: element.training_price,
                     id : element.id
                  }
               )
            });
            return this.workouts_list;
         }
      },
      methods: {
         prev() {
            this.activeStep--;
         },
         next() {
            this.activeStep++;
         },
          initializeStripePayment() {
              let formData = new FormData();
              formData.append('training_location_id', this.selected_location.id);
              formData.append('training_id', this.selected_workout.id);
              axios.post('/initialize-checkout/stripe-for-training', formData)
                .then(() => {
                    window.location.href = '/open-checkout/stripe-for-training';
                })
                .catch((error) => {
                    console.log(error.response);
                })
          },
          initializeTinkoffPayment() {
              let formData = new FormData();
              formData.append('training_location_id', this.selected_location.id);
              formData.append('training_id', this.selected_workout.id);
              axios.post('/initialize-checkout/tinkoff-for-training', formData)
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
