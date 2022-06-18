<template>
  <main class="main account-main">
    <header class="account-header workout">
      <MenuOffice page='workout'></MenuOffice>
    </header>
    <section id="account-head" class="workout">
      <Logout></Logout>
    </section>
    <section v-if="User && checkActivity()" id="progress" class="workout">
      <div class="account-container">
          <div class="progress__container">
            <div class="progress__col-first">
                <div class="progress__row">
                  <div class="progress-level">
                      <div class="progress-level__title">
                        {{User.user.name}}
                        <div v-if="UserTrainings" class="progress-level__mob">{{UserTrainings.training.level}} уровень</div>
                      </div>
                      <div class="level__chart">
                        <svg class="radial-progress" :data-percentage="findPercent()" viewBox="0 0 86 86">
                            <defs>
                              <linearGradient id="linear" x1="46.2954" y1="0" x2="46.2954" y2="99.0139"
                                  gradientUnits="userSpaceOnUse">
                                  <stop stop-color="#A697FF" />
                                  <stop offset="1" stop-color="#573DFF" />
                              </linearGradient>
                            </defs>
                            <circle class="incomplete" cx="43" cy="43" r="35"></circle>
                            <circle class="complete" cx="43" cy="43" r="35" stroke="url(#linear)"></circle>
                            <circle class="incomplete incomplete-mob" cx="43" cy="43" r="35"></circle>
                            <circle class="complete complete-mob" cx="43" cy="43" r="35" stroke="url(#linear)">
                            </circle>
                        </svg>
                        <div class="progress-level__chart-txt">
                            <p v-if="UserTrainings" class="progress-level__chart-level">{{UserTrainings.training.level}} уровень</p>
                            <div class="progress-level__current"></div>
                        </div>
                      </div>
                  </div>
                  <div class="progress-result">
                      <div v-if="Physics!=null" class="progress-result__title">
                        {{Physics.current_weight - Physics.weight}} кг
                      </div>
                      <div v-else class="progress-result__title">-0 кг</div>
                      <div class="progress-result__caption">
                        <span>Мой</span> результат
                        <p v-if="UserTrainings" class="progress-level__chart-level progress-level__chart-level-mob">
                            {{UserTrainings.training.level}} уровень
                        </p>
                      </div>
                  </div>
                </div>
                <div class="calendar workout">
                  <div class="calendar__container">
                    <div v-if="TrainingTitleAndDays.length>0" class="calendar__slider-workout calendar__slider-account">
                      <div class="swiper-wrapper">
                        <div class="swiper-slide" v-for="(tabs, index) in TrainingTitleAndDays" :key="index">
                          <div class="calendar__title">
                            <span>Календарь активности</span> <h5>Уровень № {{ tabs.level }}</h5>
                          </div>
                          <div class="calendar__days">
                            <div
                            class="calendar__day"
                            v-for="(tab, index) in tabs.days"
                            :key="index"
                            v-on:click = "changeTabSelection(tab.title)"
                            :class="changeTabStyle(tab.title)"
                            >
                            <span>{{ tab.title }}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="calendar__slider-workout-pagination">
                        <div class="swiper-button-next workout-swiper" v-on:click="setNextActiveTraining()"></div>
                        <div class="swiper-button-prev workout-swiper" v-on:click="setPrevActiveTraining()"></div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="progress__col-second">
                <div>
                  <div class="progress-block">
                      <div class="progress-block__svg-elem">
                        <svg width="280" height="322" viewBox="0 0 280 322" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <ellipse opacity="0.13" rx="164.341" ry="156.191"
                              transform="matrix(-0.969532 -0.244963 0.273341 -0.961917 202.027 131.5)"
                              fill="white" />
                            <ellipse opacity="0.13" rx="138.392" ry="131.529"
                              transform="matrix(-0.969532 -0.244963 0.273341 -0.961917 220.71 114.066)"
                              fill="white" />
                        </svg>
                      </div>
                      <div class="progress-block__head">
                        <h5 class="progress-block__title">Тренировки</h5>
                        <div v-on:click="show_location()" class="select__wrap select-workout__wrap">
                            <ul v-if="current_location" class="default__option">
                              <li class="option selected">Для {{current_location.name}}а</li>
                            </ul>
                            <ul :style="show_select_location? 'display: block !important': 'display: none !important'" class="select__ul">
                              <li v-on:click = "changeLocation(location)" v-for="(location, id) in Available_locations" :key="id">
                                Для {{location.name}}а
                              </li>
                              <li v-show="false" v-for="(location, id) in Disabled_locations" :key="id" class="disabled">
                                Для {{location.name}}а
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
                  </div>
                  <WorkoutVideo v-if="current_location" :day="selectedTab" :trainingId="selectedTrainingId" :locationId="current_location.id"></WorkoutVideo>
                </div>
            </div>
          </div>
      </div>
    </section>
  </main>
</template>
<script>

//current_training => save

import WorkoutVideo from "./WorkoutVideo.vue";
import Logout from "../general/Logout.vue";
import MenuOffice from "../general/Menu.vue";

export default {
  components: {
    WorkoutVideo,
    MenuOffice,
    Logout
  },
  data: () => ({
    slider: [],
    selectedTab: null,
    selectedTrainingId: null,
    current_location: null,
    show_select_location:false,
    available_locations:[],
    disabled_locations:[],
    start_index: 0,
  }),
  computed:{
    User(){
      return this.$store.getters.GetPersonalAccount;
    },
    UserTrainings(){
      //console.log("GetTrainingUsers:",this.$store.getters.GetTrainingUsers);
      //console.log("this.selectedTrainingId:",this.selectedTrainingId);
      if(this.selectedTrainingId && this.current_location && this.selectedTrainingId.training_user){
        return this.$store.getters.GetTrainingUsers.find(element => parseInt(element.training_id) === parseInt(this.selectedTrainingId.training_user.training_id) && element.training_location_id === this.current_location.id);
      }
    },
    UserActiveCallendar(){
      //console.log("UserActiveCallendar:",this.$store.getters.GetActivityCalendars.find(element=>parseInt(element.is_active)==1))
      let current = this.$store.getters.GetActivityCalendars.find(element=>parseInt(element.is_active)==1);
      if(current != undefined && current.training_user != undefined)
        this.current_location = this.$store.getters.GetTrainingLocations.find(element=>element.id === current.training_user.training_location_id);
      return current;
    },
    TrainingTitleAndDays(){
      let tmp = this.$store.getters.GetTrainingUsers;
      if(!tmp||tmp.length<1)
        return this.slider;

      if(this.$store.getters.GetActivityCalendars!=null)
      {
        console.log("this.UserActiveCallendar:",this.UserActiveCallendar);
        this.selectedTrainingId = this.$store.getters.GetActivityCalendars.find(element => element.is_active==1);
      }
      else
      {
        console.log("Default this.selectedTrainingId")
        this.selectedTrainingId = null;
      }

      if(this.selectedTrainingId)
        this.selectedTab = this.selectedTrainingId.day.toString();
      else
        this.selectedTab = "1";

      this.slider = [];
      if(this.selectedTrainingId)
        for (let index = 0; index < tmp.length; index++){
          let days=[];
          //console.log("typeof tmp[index].days:",typeof tmp[index].days);
          for (const item of Object.values(tmp[index].days)) {
            if(this.current_location && item.training_location_id === this.current_location.id)
              days.push({title: item.day_number});
          }
          let active = false;
          if(tmp[index].training_id == this.selectedTrainingId.training_user.training_id && tmp[index].training_location_id == this.selectedTrainingId.training_user.training_location_id)
          {
            active = true;
          }
          if(tmp[index].training_location.id === this.selectedTrainingId.training_user.training_location_id)
            this.slider.push({
              training_user_id: tmp[index].id,
              menutitle: tmp[index].training.name,
              location: tmp[index].training_location.name,
              level: tmp[index].training.level,
              days: days,
              is_active: active
            });
        };
      this.activateSwiper();
      console.log("this.slider: ",this.slider);
      //console.log("this.selectedTrainingId:",this.selectedTrainingId);
      return this.slider;
    },
    Physics(){
      if(this.UserActiveCallendar){
            let tmp = this.$store.getters.GetPhysicsParameters.filter(element => element.training_id == this.UserActiveCallendar.training_user.training_id);
            console.log(tmp);
            if(tmp){
               var updated_at = new Date(Date.parse(this.UserActiveCallendar.training_user.created_at));
               var today = new Date();
               let res = null;

               updated_at.setDate(updated_at.getDate() + 10)
               console.log(updated_at);

               if(updated_at<today)
                  res = tmp[tmp.length-1];

               updated_at = new Date(Date.parse(this.UserActiveCallendar.training_user.created_at));
               updated_at.setDate(updated_at.getDate() + 20)
               console.log(updated_at);

               if(updated_at<today)
                  res = tmp[tmp.length-2];

               updated_at = new Date(Date.parse(this.UserActiveCallendar.training_user.created_at));
               updated_at.setDate(updated_at.getDate() + 29)
               console.log(updated_at);

               if(updated_at<today)
                  res = tmp[0];

               return res;
            }
         }
    },
    Available_locations(){
      let tmp_locs = this.$store.getters.GetTrainingLocations;
      let trainings = undefined;
      if(this.selectedTrainingId)
        trainings = this.$store.getters.GetTrainingUsers.filter(element => parseInt(element.training_id) === parseInt(this.selectedTrainingId.training_user.training_id));

      if(trainings!=undefined){
        trainings.forEach(element=>{
          if(tmp_locs!=undefined)
            tmp_locs.forEach(element1=>{
              if(element.training_location_id == element1.id){
                if(!this.available_locations.includes(element1))
                  this.available_locations.push(element1);
              } else {
                if(!this.disabled_locations.includes(element1))
                  this.disabled_locations.push(element1);
              }
            });
        });
      }
      if(this.available_locations.length>0)
        this.$loading(false);
      return this.available_locations;
    },
    Disabled_locations(){
      return this.disabled_locations;
    },
    AccessHistory(){
      return this.$store.getters.GetAccessHistory;
    },
  },
  mounted(){
    this.$loading(true);
    if (userInfo){
      this.$store.dispatch('fetchPersonalAccount');
      this.$store.dispatch('fetchPhysicsParameters');
      this.$store.dispatch('fetchTrainingUsers');
      this.$store.dispatch('fetchActivityCalendars');
      this.$store.dispatch('fetchTrainingLocations');
      this.$store.dispatch('fetchAccessHistory');
    }

  },
  methods: {
    findPercent()
    {
      if(this.UserTrainings==null)
        return 0;
      var date1 = new Date(this.UserTrainings.created_at);
      var date2 = new Date();
      var Difference_In_Time = date2.getTime() - date1.getTime();
      var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
      var percent = (Difference_In_Days*100)/30;
      return Math.min(percent, 100);
    },
    changeTabSelection(tabTitle){
      this.$loading(true);
      this.$store.dispatch('setActivityCalendar',{
        id: this.UserActiveCallendar.id,
        training_user_id: this.UserActiveCallendar.training_user_id,
        day: parseInt(tabTitle),
        is_active: this.UserActiveCallendar.is_active
        });

      this.selectedTab = tabTitle;

      this.$store.dispatch('fetchActivityCalendars');
    },
    changeTabStyle(tabTitle){
      if(this.selectedTab!=null&&this.selectedTab.toString()==tabTitle)
        return 'active';
    },
    show_location(){
      this.show_select_location=!this.show_select_location;
    },
    changeLocation(location){
      this.$loading(true);
      this.current_location = location;

      this.$store.dispatch('setActivityCalendar',{
        id: this.UserActiveCallendar.id,
        training_user_id: this.UserActiveCallendar.training_user_id,
        day: this.UserActiveCallendar.day,
        is_active: false
      });

      let new_active = this.$store.getters.GetActivityCalendars.find(element => element.training_user.training_id === this.UserActiveCallendar.training_user.training_id && element.training_user.training_location_id != this.UserActiveCallendar.training_user.training_location_id);

      this.$store.dispatch('setActivityCalendar',{
        id: new_active.id,
        training_user_id: new_active.training_user_id,
        day: new_active.day,
        is_active: true
      });

      this.$store.dispatch('fetchActivityCalendars');
    },
    activateSwiper(){
      for(let i = 0; i<this.slider.length; i++){
        if(this.slider[i].is_active)
          this.start_index = i;
      }

      var swiperWorkout = new Swiper(".calendar__slider-workout", {
        spaceBetween: 0,
        slidesPerView: 1,
        initialSlide : this.start_index,
        navigation: {
            nextEl: ".swiper-button-next.workout-swiper",
            prevEl: ".swiper-button-prev.workout-swiper",
        },
        allowTouchMove: false,
      });

      console.log("swiperWorkout:",swiperWorkout);
    },
    setNextActiveTraining()
    {
      if(this.start_index<this.slider.length-1)
      {
        this.$loading(true);

        this.$store.dispatch('setActivityCalendar',{
          id: this.UserActiveCallendar.id,
          training_user_id: this.UserActiveCallendar.training_user_id,
          day: this.UserActiveCallendar.day,
          is_active: false
        });

        let new_active = this.$store.getters.GetActivityCalendars.find(element => element.training_user_id === this.slider[this.start_index+1].training_user_id);

        this.$store.dispatch('setActivityCalendar',{
          id: new_active.id,
          training_user_id: new_active.training_user_id,
          day: new_active.day,
          is_active: true
        });

        this.$store.dispatch('fetchActivityCalendars');
      }
    },
    setPrevActiveTraining()
    {
      if(this.start_index>0)
      {
        this.$loading(true);

        this.$store.dispatch('setActivityCalendar',{
          id: this.UserActiveCallendar.id,
          training_user_id: this.UserActiveCallendar.training_user_id,
          day: this.UserActiveCallendar.day,
          is_active: false
        });

        let new_active = this.$store.getters.GetActivityCalendars.find(element => element.training_user_id === this.slider[this.start_index-1].training_user_id);

        this.$store.dispatch('setActivityCalendar',{
          id: new_active.id,
          training_user_id: new_active.training_user_id,
          day: new_active.day,
          is_active: true
        });

        this.$store.dispatch('fetchActivityCalendars');
      }
    },
    checkActivity(){
      if(this.AccessHistory==null)
        false;
      var date1 = new Date(this.AccessHistory.deactivation_date);
      var date2 = new Date();
      if(date1>date2)
        return true;
      window.location.href = `/plugin`;
    },
  },
};
</script>
<style lang="css">

</style>
