<template>
   <main v-if="User && checkActivity()" class="main account-main">
      <header class="account-header home">
         <MenuOffice page='home'></MenuOffice>
      </header>
      <section id="account-head">
         <Logout></Logout>
      </section>
      <section id="progress" class="home">
         <div v-if="User" class="account-container">
            <div class="progress__container">
               <div class="progress__col-first">
                  <div class="progress__row">
                     <div class="progress-level">
                        <div class="progress-level__title">
                           {{User.user.name}}
                           <div v-if="selectedTraining!=null" class="progress-level__mob">
                              {{selectedTraining.training.level}} уровень
                           </div>
                        </div>
                        <div v-if="Physics!=null" class="level__chart">
                           <svg class="radial-progress" :data-percentage="find_percentage()" viewBox="0 0 86 86">
                              <defs>
                                 <linearGradient id="linear" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#FF7E83" />
                                    <stop offset="100%" stop-color="#FF144A" />
                                 </linearGradient>
                              </defs>
                              <circle class="incomplete" cx="43" cy="43" r="35"></circle>
                              <circle class="complete" cx="43" cy="43" r="35" stroke="url(#linear)"></circle>
                           </svg>
                           <div class="progress-level__chart-txt">
                              <p v-if="selectedTraining!=null" class="progress-level__chart-level">
                                 {{selectedTraining.training.level}} уровень
                              </p>
                              <div class="progress-level__current"></div>
                           </div>
                        </div>
                        <div v-else class="level__chart">
                           <svg class="radial-progress" :data-percentage="0" viewBox="0 0 86 86">
                              <defs>
                                 <linearGradient id="linear" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#FF7E83" />
                                    <stop offset="100%" stop-color="#FF144A" />
                                 </linearGradient>
                              </defs>
                              <circle class="incomplete" cx="43" cy="43" r="35"></circle>
                              <circle class="complete" cx="43" cy="43" r="35" stroke="url(#linear)"></circle>
                           </svg>
                           <div class="progress-level__chart-txt">
                              <p v-if="selectedTraining!=null" class="progress-level__chart-level">
                                 {{selectedTraining.training.level}} уровень
                              </p>
                              <div class="progress-level__current"></div>
                           </div>
                        </div>
                     </div>
                     <div class="progress-result">
                        <div v-if="Physics!=null" class="progress-result__title">
                           {{Physics.current_weight - Physics.weight}} кг
                        </div>
                        <div v-else class="progress-result__title">
                           -0 кг
                        </div>
                        <div class="progress-result__caption">
                           <span>Мой</span> результат
                           <p v-if="selectedTraining!=null" class="progress-level__chart-level progress-level__chart-level-mob">
                              {{selectedTraining.training.level}} уровень
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="workout-info__txt-block home">
                     <div class="workout-info__img">
                        <img src="/images/luba.png" />  alt="" />
                     </div>
                     <p>
                         Каждые 10 дней тебе нужно заполнять свои параметры и фото в разделе "Мой прогресс" это поможет нам отслеживать результаты и будет отлично мотивировать тебя! А для ещё большего контроля в проекте есть общая группа с <b>дневниками</b> для ежедневных отчётов. Я систематически проверяю все дневники, подсказываю, исправляю ошибки, ставлю оценки. Многих это очень дисциплинирует! Плюс наличие коллектива девочек с одинаковыми целями, очень мотивирует.
                     </p>
                     <p>
                        Дневник будет открыт 30 дней и доступен для участников марафона!
                     </p>
                     <a href="#" class="workout-info__link">Заполнить дневник</a>
                  </div>
               </div>
               <div class="progress__col-second">
                  <div class="progress-block">
                     <div class="progress-block__svg-elem">
                        <svg width="280" height="322" viewBox="0 0 280 322" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <ellipse opacity="0.13" rx="164.341" ry="156.191" transform="matrix(-0.969532 -0.244963 0.273341 -0.961917 202.027 131.5)" fill="white"/>
                           <ellipse opacity="0.13" rx="138.392" ry="131.529" transform="matrix(-0.969532 -0.244963 0.273341 -0.961917 220.71 114.066)" fill="white"/>
                        </svg>
                     </div>
                     <div class="progress-block__head">
                        <h5 class="progress-block__title">
                           Мой прогресс
                        </h5>
                        <div v-on:click="show_level()" class="select__wrap">
                           <ul class="default__option">
                              <li v-if="selectedTraining" class="option selected">
                                 {{selectedTraining.training.level}} уровень
                              </li>
                           </ul>
                           <ul :style="show_select_level? 'display: block !important': 'display: none !important'" class="select__ul">
                              <li v-on:click="changeTraining(level)" v-for="(level) in Available_levels" :key="level">
                                 {{level}}
                              </li>
                              <li href="/plugin" class="disabled" v-for="(level) in Disabled_levels" :key="level">
                                 {{level}} уровень
                                 <svg class="icon" width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                       <path
                                          d="M10.9375 14H3.0625C2.33917 14 1.75 13.4114 1.75 12.6875V6.5625C1.75 5.83858 2.33917 5.25 3.0625 5.25H10.9375C11.6608 5.25 12.25 5.83858 12.25 6.5625V12.6875C12.25 13.4114 11.6608 14 10.9375 14ZM3.0625 6.125C2.82158 6.125 2.625 6.321 2.625 6.5625V12.6875C2.625 12.929 2.82158 13.125 3.0625 13.125H10.9375C11.1784 13.125 11.375 12.929 11.375 12.6875V6.5625C11.375 6.321 11.1784 6.125 10.9375 6.125H3.0625Z"
                                          fill="#BEBEBE" />
                                       <path
                                          d="M10.0625 6.125C9.821 6.125 9.625 5.929 9.625 5.6875V3.5C9.625 2.05275 8.44725 0.875 7 0.875C5.55275 0.875 4.375 2.05275 4.375 3.5V5.6875C4.375 5.929 4.179 6.125 3.9375 6.125C3.696 6.125 3.5 5.929 3.5 5.6875V3.5C3.5 1.56975 5.06975 0 7 0C8.93025 0 10.5 1.56975 10.5 3.5V5.6875C10.5 5.929 10.304 6.125 10.0625 6.125Z"
                                          fill="#BEBEBE" />
                                       <path
                                          d="M6.99992 9.91665C6.3565 9.91665 5.83325 9.3934 5.83325 8.74998C5.83325 8.10656 6.3565 7.58331 6.99992 7.58331C7.64334 7.58331 8.16659 8.10656 8.16659 8.74998C8.16659 9.3934 7.64334 9.91665 6.99992 9.91665ZM6.99992 8.45831C6.83951 8.45831 6.70826 8.58898 6.70826 8.74998C6.70826 8.91098 6.83951 9.04165 6.99992 9.04165C7.16034 9.04165 7.29159 8.91098 7.29159 8.74998C7.29159 8.58898 7.16034 8.45831 6.99992 8.45831Z"
                                          fill="#BEBEBE" />
                                       <path
                                          d="M7 11.6667C6.7585 11.6667 6.5625 11.4707 6.5625 11.2292V9.625C6.5625 9.3835 6.7585 9.1875 7 9.1875C7.2415 9.1875 7.4375 9.3835 7.4375 9.625V11.2292C7.4375 11.4707 7.2415 11.6667 7 11.6667Z"
                                          fill="#BEBEBE" />
                                    </g>
                                    <defs>
                                       <clipPath id="clip0">
                                          <rect width="14" height="14" fill="white" />
                                       </clipPath>
                                    </defs>
                                 </svg>
                              </li>
                           </ul>
                           <svg class="select__svg" width="17" height="9" viewBox="0 0 17 9" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                 d="M16.0543 0.602247C16.0544 0.681312 16.0388 0.759609 16.0086 0.832666C15.9783 0.905724 15.934 0.97211 15.878 1.02804L8.45314 8.44784C8.34019 8.56069 8.18701 8.62408 8.02729 8.62408C7.86757 8.62408 7.71439 8.56069 7.60143 8.44784L0.176538 1.02804C0.120587 0.972146 0.0761993 0.905792 0.0459089 0.832759C0.0156185 0.759727 1.86629e-05 0.681447 1.67352e-08 0.602389C-1.86294e-05 0.523332 0.0155444 0.445045 0.0458003 0.371998C0.0760563 0.298951 0.120413 0.232574 0.176337 0.176659C0.232261 0.120743 0.298658 0.0763845 0.371737 0.046113C0.444816 0.0158415 0.523145 0.000250816 0.602253 0.000231743C0.68136 0.000213623 0.759697 0.0157671 0.83279 0.0460043C0.905883 0.0762405 0.972301 0.120569 1.02825 0.176458L8.02709 7.17087L15.0259 0.176458C15.1102 0.0922174 15.2175 0.0348415 15.3344 0.0115919C15.4513 -0.0116568 15.5724 0.000263214 15.6825 0.0458469C15.7926 0.0914307 15.8867 0.16863 15.9529 0.267672C16.0191 0.366714 16.0544 0.48315 16.0543 0.602247Z"
                                 fill="white" />
                           </svg>
                        </div>
                     </div>
                     <ul class="progress-block__steps">
                        <li v-on:click="change_show_tab(1)"
                        :class="['progress-block__step', show(1)]"
                        >
                           1 Этап
                        </li>
                        <li v-on:click="change_show_tab(2)"
                        :class="['progress-block__step', show(2)]"
                        >
                           2 Этап
                        </li>
                        <li v-on:click="change_show_tab(3)"
                        :class="['progress-block__step', show(3)]"
                        >
                           3 Этап
                        </li>
                     </ul>
                  </div>
                  <HomeData v-if="selectedTraining!=null" :phase_number=selectedTab :training_id=selectedTraining.training_id></HomeData>
               </div>
            </div>
         </div>
      </section>
   </main>
</template>
<script>
import HomeData from "./HomeData.vue";
import MenuOffice from "../general/Menu.vue";
import Logout from "../general/Logout.vue";

export default {
   components: {
      HomeData,
      MenuOffice,
      Logout
   },
   data: () => ({
      tabs: [
         {
         title: "1",
         },
         {
         title: "2",
         },
         {
         title: "3",
         },
      ],
      selectedTab: "1",
      show_select_level:false,
      available_levels: [],
      disabled_levels: []
   }),
   computed:{
      User(){
         return this.$store.getters.GetPersonalAccount;
      },
      selectedTraining(){
         let activeTraining = this.$store.getters.GetActivityCalendars.find(element=>parseInt(element.is_active)==1)
         if(activeTraining){
            let tmp = this.$store.getters.GetTrainingUsers.find(element => parseInt(element.training_id) === parseInt(activeTraining.training_user.training_id));
            return tmp;
         }
         return null;
      },
      TrainingLevel(){
         if(this.selectedTraining)
            return this.selectedTraining.training.level;
      },
      Available_levels(){
         this.available_levels=[];
         if(this.selectedTraining&&this.$store.getters.GetTrainingUsers){
            this.$store.getters.GetTrainingUsers.forEach(element => {
               let tmp = this.available_levels.find(element2 => element2 === element.training.level+" уровень");
               if(tmp==null)
                  this.available_levels.push(element.training.level+" уровень");
            });
            return this.available_levels;
         }
      },
      Disabled_levels(){
         this.disabled_levels=[];
         if(this.selectedTraining&&this.$store.getters.GetTrainingUsers){
            this.$store.getters.GetTrainings.forEach(element1 =>{
               let tmp = this.available_levels.find(element2=>parseInt(element2)==parseInt(element1.level));
               if(!tmp)
                  this.disabled_levels.push(element1.level);
            });
            return this.disabled_levels;
         }
      },
      Physics(){
         if(this.selectedTraining){
            let tmp = this.$store.getters.GetPhysicsParameters.filter(element => element.training_id == this.selectedTraining.training_id);
            if(tmp){
               var updated_at = new Date(Date.parse(this.selectedTraining.created_at));
               var today = new Date();
               let res = null;

               updated_at.setDate(updated_at.getDate() + 10)

               if(updated_at<today)
                  res = tmp[tmp.length-1];

               updated_at = new Date(Date.parse(this.selectedTraining.created_at));
               updated_at.setDate(updated_at.getDate() + 20)

               if(updated_at<today)
                  res = tmp[tmp.length-2];

               updated_at = new Date(Date.parse(this.selectedTraining.created_at));
               updated_at.setDate(updated_at.getDate() + 29)

               if(updated_at<today)
                  res = tmp[0];

               this.$loading(false);
               return res;
            }
         }
      },
      AccessHistory(){
         return this.$store.getters.GetAccessHistory;
      },
   },
   mounted(){
      this.$loading(true);
      if (userInfo){
         this.$store.dispatch('fetchPhysicsParameters');
         this.$store.dispatch('fetchPersonalAccount');
         this.$store.dispatch('fetchTrainingUsers');
         this.$store.dispatch('fetchActivityCalendars');
         this.$store.dispatch('fetchTrainings');
         this.$store.dispatch('fetchTrainings');
         this.$store.dispatch('fetchAccessHistory');
      }
   },
   methods: {
      find_percentage(){
         if(this.selectedTraining==null)
            return 0;
         var date1 = new Date(this.selectedTraining.created_at);
         var date2 = new Date();
         var Difference_In_Time = date2.getTime() - date1.getTime();
         var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
         var percent = (Difference_In_Days*100)/30;
         return parseInt(percent);
      },
      show(item){
         if(parseInt(item) == parseInt(this.selectedTab))
            return 'progress-block__step active';
         return 'progress-block__step';
      },
      change_show_tab(item){
         if(this.selectedTraining!=null)
         {
            var updated_at = new Date(Date.parse(this.selectedTraining.created_at));
            var today = new Date();

            if(parseInt(item)==1){
               updated_at.setDate(updated_at.getDate() + 10)
               console.log(updated_at);
               if(updated_at<today){
                  this.selectedTab = item;
                  return true;
               }
               return false;
            }
            if(parseInt(item)==2){
               updated_at.setDate(updated_at.getDate() + 20)
               console.log(updated_at);
               if(updated_at<today){
                  this.selectedTab = item;
                  return true;
               }
               return false;
            }
            if(parseInt(item)==3){
               updated_at.setDate(updated_at.getDate() + 29)
               console.log(updated_at);
               if(updated_at<today){
                  this.selectedTab = item;
                  return true;
               }
               return false;
            }
         }
      },
      show_level(){
         this.show_select_level=!this.show_select_level;
      },
      changeTraining(level){
         this.$loading(true);
         level = parseInt(level.charAt(0));
         if(this.$store.getters.GetTrainingUsers){
            this.$store.getters.GetTrainingUsers.forEach(element => {
               if(this.selectedTraining.training.problem_zone_id == element.training.problem_zone_id&&
                  element.training.level == level){
                     this.changeActiveTraining(element)
                  }
            });
            return this.available_levels;
         }
      },
      changeActiveTraining(training){
         let selected = this.$store.getters.GetActivityCalendars.find(element=>parseInt(element.is_active)==1);
         let new_one = this.$store.getters.GetActivityCalendars.find(element=>element.training_user.training_id==training.training_id);
         console.log(this.$store.getters.GetActivityCalendars,training,selected,new_one);
         this.$store.dispatch('setActivityCalendar',{
            id: selected.id,
            training_user_id: selected.training_user_id,
            day: selected.day,
            is_active: 0
         });
         this.$store.dispatch('setActivityCalendar',{
            id: new_one.id,
            training_user_id: new_one.training_user_id,
            day: new_one.day,
            is_active: 1
         });
         this.selectedTab = "1";
         this.$store.dispatch('fetchActivityCalendars');
      },
      checkActivity(){
         if(this.AccessHistory==null)
            return false;
         var date1 = new Date(this.AccessHistory.deactivation_date);
         var date2 = new Date();
         if(date1>date2)
            return true;
         window.location.href = `/plugin`;
      },
   },
};
</script>
<style>
   .progress-block__steps {
      z-index: 1;
   }
</style>
