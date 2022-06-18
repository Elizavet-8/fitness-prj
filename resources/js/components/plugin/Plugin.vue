<template>
   <main class="main account-main">
      <header class="account-header plugin">
         <MenuOffice page='plugin'></MenuOffice>
      </header>
      <section id="account-head" class="plugin">
         <Logout></Logout>
      </section>
      <section id="progress" class="plugin">
         <div class="account-container">
            <div class="plugin__container">
               <div class="plugin__row">
                  <div v-if="User && AccessHistory" class="progress-block plugin-progress__block">
                     <div class="progress-block__head">
                        <h4 class="plugin-progress__title">
                           Подписка
                        </h4>
                        <h6 v-if="checkActivity()" class="plugin-progress__status">
                           Активна
                        </h6>
                        <h6 v-else class="plugin-progress__status">
                           Неактивна
                        </h6>
                     </div>
                     <button class="plugin-progress__btn btn-none" type="button" data-toggle="modal"
                        data-target="#subscription">
                        Управлять
                     </button>
                     <img class="plugin-progress__img" src="/images/program.png" alt="">
                     <div class="plugin-progress__svg">
                        <svg width="519" height="426" viewBox="0 0 519 426" fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                           <ellipse opacity="0.13" rx="258.295" ry="245.486"
                              transform="matrix(-0.969532 -0.244963 0.273341 -0.961917 259.527 181.408)"
                              fill="white" />
                        </svg>
                        <svg width="438" height="360" viewBox="0 0 438 360" fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                           <ellipse opacity="0.13" rx="217.512" ry="206.725"
                              transform="matrix(-0.969532 -0.244963 0.273341 -0.961917 218.891 154.008)"
                              fill="white" />
                        </svg>
                     </div>
                  </div>
                  <div v-if="User" class="progress-level plugin-progress__level">
                     <div class="progress-level__title">
                        {{User.user.name}}
                        <div v-if="selectedTraining" class="progress-level__mob">
                           {{selectedTraining.training.level}} уровень
                        </div>
                     </div>
                     <div class="level__chart">
                        <svg class="radial-progress" :data-percentage="find_percentage()" viewBox="0 0 86 86">
                           <defs>
                              <linearGradient id="linear" x1="107" y1="0" x2="107" y2="223.469"
                                 gradientUnits="userSpaceOnUse">
                                 <stop stop-color="#AB8EFC" />
                                 <stop offset="0.598958" stop-color="#BB00DA" />
                              </linearGradient>
                           </defs>
                           <circle class="incomplete" cx="43" cy="43" r="35"></circle>
                           <circle class="complete" cx="43" cy="43" r="35" stroke="url(#linear)"></circle>
                        </svg>
                        <div class="progress-level__chart-txt">
                           <p v-if="selectedTraining" class="progress-level__chart-level">
                              {{selectedTraining.training.level}} уровень
                           </p>
                           <div class="progress-level__current"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="plugin-block__list">
                  <div v-if="User && checkActivity()" class="plugin-block__item">
                     <h5 class="plugin-block__title-caps">
                        {{daysLeft()}} дней
                     </h5>
                     <p class="plugin-block__prg">
                        До отключения <br>доступа
                     </p>
                  </div>
                  <div v-else class="plugin-block__item">
                     <h5 class="plugin-block__title-caps">
                        0 дней
                     </h5>
                     <p class="plugin-block__prg">
                        Доступ отключен
                     </p>
                  </div>
                  <div class="plugin-block__item">
                     <div class="plugin-block__border"></div>
                     <div class="plugin-block__back">
                        <h5 class="plugin-block__title">
                           Попробуй <br> новое меню
                        </h5>
                        <button type="button" data-toggle="modal" data-target="#diet"
                           class="plugin-block__btn btn-none">
                           Подробнее
                        </button>
                     </div>
                     <svg class="plugin-block__svg" width="87" height="219" viewBox="0 0 87 219" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M42.917 0H37.3022L38.9774 58.5069H32.2318V0H27.2923V58.8684H21.7117V0L16.2552 0.0116631V58.8801H9.62877L11.5248 0H6.38107L0.164193 49.8011C0.164193 49.8011 0 51.6758 0 52.393C0 60.0599 3.59369 66.926 9.18604 71.3858C27.6275 92.0948 15.0344 113.232 15.0462 118.257C15.0569 123.801 15.0569 209.335 15.0569 209.335C15.0687 209.402 15.0344 209.447 15.0462 209.526C15.0569 214.766 19.3152 219 24.5792 219C29.848 219 34.1288 214.742 34.1288 209.526C34.1171 209.447 34.1063 209.402 34.0946 209.335H34.1171C34.1171 209.335 34.1171 124.874 34.1288 118.448C34.1288 112.6 23.4885 88.3172 41.2653 70.2448C41.2771 70.2225 41.3162 70.1661 41.3504 70.1379C45.6878 66.0455 48.5553 60.4049 48.9756 54.0704C49.0098 53.6302 48.9981 52.4951 48.9981 52.4951L42.917 0Z"
                           fill="#BB01DA" fill-opacity="0.05" />
                        <path
                           d="M86.3205 141.239C86.3296 135.592 86.1753 0.0116643 86.1753 0.0116643L83.5338 0C83.5338 0 62 14.2351 62 119.873C78.5411 125.191 71.5813 146.377 70.3286 149.075C70.3286 154.451 70.6853 209.694 70.6853 209.694L70.7426 209.66C70.7235 209.74 70.7044 209.786 70.7044 209.853C70.6853 214.923 74.2038 219.045 78.512 219C82.8203 219.022 86.3387 214.9 86.3196 209.853C86.3379 209.786 86.3379 209.74 86.3196 209.694L86.3288 209.649C86.3296 209.65 86.3296 147.439 86.3205 141.239Z"
                           fill="#BB01DA" fill-opacity="0.05" />
                     </svg>
                  </div>
                  <div class="plugin-block__item">
                     <div class="plugin-block__border"></div>
                     <div class="plugin-block__back">
                        <h5 class="plugin-block__title">
                           Прокачай свои <br> тренировки
                        </h5>
                        <button type="button" data-toggle="modal" data-target="#workout"
                           class="plugin-block__btn btn-none">
                           Подробнее
                        </button>
                        <img class="plugin-block__img" src="/images/plugin/plugin.png" alt="">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <SubscriptionModal></SubscriptionModal>
      <WorkoutModal></WorkoutModal>
      <DietModalSimple></DietModalSimple>
      <DietModal></DietModal>
   </main>
</template>
<script>
import SubscriptionModal from "./SubscriptionModal.vue";
import WorkoutModal from "./WorkoutModal.vue";
import DietModal from "./DietModal.vue";
import DietModalSimple from "./DietModalSimple.vue";
import Logout from "../general/Logout.vue";
import MenuOffice from "../general/Menu.vue";

export default {
   components: {
      SubscriptionModal,
      WorkoutModal,
      DietModal,
      DietModalSimple,
      MenuOffice,
      Logout
   },
   computed:{
      User(){
         return this.$store.getters.GetPersonalAccount;
      },
      AccessHistory(){
         return this.$store.getters.GetAccessHistory;
      },
      selectedTraining(){
         let activeTraining = this.$store.getters.GetActivityCalendars.find(element=>parseInt(element.is_active)==1)
         if(activeTraining){
            this.$loading(false);
            return this.$store.getters.GetTrainingUsers.find(element => parseInt(element.training_id) === parseInt(activeTraining.training_user.training_id));;
         }
         //this.$loading(false);
         //return this.$store.getters.GetTrainingUsers[0];
      },
   },
   mounted(){
      this.$loading(true);
      if (userInfo){
         this.$store.dispatch('fetchPersonalAccount');
         this.$store.dispatch('fetchTrainingUsers');
         this.$store.dispatch('fetchActivityCalendars');
         this.$store.dispatch('fetchAccessHistory');
      }
   },
   methods:{
      find_percentage(){
         if(this.selectedTraining==null)
            return 0;
         var date1 = new Date(this.selectedTraining.created_at);
         var date2 = new Date();
         var Difference_In_Time = date2.getTime() - date1.getTime();
         var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
         var percent = (Difference_In_Days*100)/30;
         return Math.min(percent, 100);
      },
      checkActivity(){
         if(this.AccessHistory==null)
            return false;
         var date1 = new Date(this.AccessHistory.deactivation_date);
         var date2 = new Date();
         if(date1>date2)
            return true;
         return false;
      },
      daysLeft(){
         if(this.AccessHistory==null)
            return 0;
         var date1 = new Date(this.AccessHistory.deactivation_date);
         var date2 = new Date();
         var Difference_In_Date = Math.ceil((Math.abs(date1 - date2))/ (1000 * 60 * 60 * 24));
         if(Difference_In_Date<0)
            return 0;
         return Difference_In_Date;
      }
   }
};
</script>
