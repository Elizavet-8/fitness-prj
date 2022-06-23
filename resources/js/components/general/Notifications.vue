<template>
   <div>
    <div @click="readNotifications" v-bind:class="{ active: open }" class="sidebar__notifications">
      <svg class="account-head__notifications-svg"  width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path
            d="M6.69964 15.066C7.62084 15.066 8.37455 14.3706 8.37455 13.5208H5.02473C5.02473 14.3706 5.77844 15.066 6.69964 15.066ZM11.7244 10.4303V6.56723C11.7244 4.1953 10.3593 2.20968 7.95582 1.6843V1.15892C7.95582 0.517652 7.39473 0 6.69964 0C6.00455 0 5.44346 0.517652 5.44346 1.15892V1.6843C3.04834 2.20968 1.67491 4.18757 1.67491 6.56723V10.4303L0 11.9755V12.7481H13.3993V11.9755L11.7244 10.4303ZM10.0495 11.2029H3.34982V6.56723C3.34982 4.65114 4.61438 3.09046 6.69964 3.09046C8.78491 3.09046 10.0495 4.65114 10.0495 6.56723V11.2029Z"
            fill="white" />
      </svg>
      <svg class="account-head__mob-svg" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M8.89373 20C9.28933 20 9.66167 19.9034 9.98439 19.7345C11.0724 19.1651 10.1217 17.9487 8.89373 17.9487C7.66576 17.9487 6.71509 19.1651 7.80306 19.7345C8.12578 19.9034 8.49812 20 8.89373 20ZM16.6757 14.8718C15.9671 14.218 15.564 13.2978 15.564 12.3336V8.71795C15.564 5.79802 14.0057 3.31909 11.2348 2.41808C10.8476 2.29217 10.5613 1.94565 10.5613 1.53846C10.5613 0.68718 9.81645 0 8.89373 0C7.971 0 7.22615 0.68718 7.22615 1.53846C7.22615 1.94571 6.94 2.29236 6.5528 2.41856C3.79059 3.31887 2.22343 5.78919 2.22343 8.71795V12.3336C2.22343 13.2978 1.82036 14.218 1.11172 14.8718L0.229607 15.6856C0.0832471 15.8206 0 16.0107 0 16.2098C0 16.6037 0.319331 16.9231 0.713245 16.9231H17.0742C17.4681 16.9231 17.7875 16.6037 17.7875 16.2098C17.7875 16.0107 17.7042 15.8206 17.5578 15.6856L16.6757 14.8718ZM13.3406 10.4249C13.3406 12.8809 11.3497 14.8718 8.89373 14.8718C6.43779 14.8718 4.44686 12.8809 4.44686 10.4249V8.71795C4.44686 6.17436 6.12555 4.10256 8.89373 4.10256C11.6619 4.10256 13.3406 6.17436 13.3406 8.71795V10.4249Z" fill="#FF144A"/>
      </svg>
      <div v-if="Notifications != null && Notifications.length > 0" class="notifications__elem" v-bind:class="{ none: open }">
         {{Notifications.length}}
      </div>
   </div>
   <transition name="fade">
      <div v-if="open" class="notifications__block">
         <Accardion></Accardion>
          <div class="overflow" @click="open = !open"></div>
      </div>
   </transition>
</div>
</template>
<script>
import Accardion from "./Accardion.vue";
export default {
   components: {
      Accardion
   },
   data: () => ({
      open: false,
   }),
    methods: {
        readNotifications() {
            if (!this.open) {
                if (this.Notifications.length === 0)
                    return;
                this.open = true;
                let currentDate = new Date();
                let expiration = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() + 1, 0, 0, 0);
                let expires = '; expires=' + expiration.toUTCString() + '; path=/';
                document.cookie = 'viewed=true' + expires;
                return;
            }
            this.open = false;
        },
        wasNotificationsRead() {
            let readState = this.readCookie('viewed');
            return readState !== null;
        },
        readCookie(name) {
            let cookName = name + "=";
            let cookList = document.cookie.split(";");
            for (let i = 0; i < cookList.length; i++) {
                let c = cookList[i];
                while (c.charAt(0) === " ") {
                    c = c.substring(1, c.length);
                }
                if (c.indexOf(cookName) === 0) {
                    return c.substring(cookName.length, c.length);
                }
            }
            return null;
        }
    },
   mounted(){
      if (userInfo){
         this.$store.dispatch('fetchAccessHistory');
         this.$store.dispatch('fetchNotifications');
      }
   },
   computed:{
      Notifications(){
         let access_history = this.$store.getters.GetAccessHistory;
         let notifications = this.$store.getters.GetNotifications;

         if(access_history && notifications)
         {
             if (this.wasNotificationsRead())
                 return [];
             var date1 = new Date(access_history.activation_date);
             var date2 = new Date();
             let day_number = Math.ceil((Math.abs(date2 - date1))/ (1000 * 60 * 60 * 24)) + 1;
             return notifications.filter(element => element.day === day_number);
         }

         return null;
      },
   },
}
</script>
<style>
.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .2s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active до версии 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
