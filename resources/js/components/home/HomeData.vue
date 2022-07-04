<template>
   <div v-if="Physics" class="progres-data__list">
      <div class="progres-data__item progres__group">
         <div class="progres__elem">
            <div class="progres__elem-contain">
               <p class="progres__elem-prg">
                  Вес
               </p>
               <input v-model.number="Physics.current_weight" type="number" min="0" class="progres-data__input" required>
            </div>
         </div>
         <div class="progres__elem">
            <div class="progres__elem-contain">
               <p class="progres__elem-prg">
                  Бёдра
               </p>
               <input v-model.number="Physics.hips_cm" type="number" min="0" class="progres-data__input" required>
            </div>
         </div>
         <div class="progres__elem">
            <div class="progres__elem-contain">
               <p class="progres__elem-prg">
                  Талия
               </p>
               <input v-model.number="Physics.waist_cm" type="number" min="0" class="progres-data__input" required>
            </div>
         </div>
         <div class="progres__elem">
            <div class="progres__elem-contain">
               <p class="progres__elem-prg">
                  Грудь
               </p>
               <input v-model.number="Physics.chest_cm" type="number" min="0" class="progres-data__input" required>
            </div>
         </div>
         <button v-if="Physics.updated_at==null" v-on:click="savePhysics()" type="submit" class="progres__btn-data">Сохранить</button>
      </div>
      <HomeDataImg v-if="Physics.photoes != null"
         v-for="(img, index) in Physics.photoes"
         :key="index" v-bind:img="img.img" @change="OnChangeChild"
      ></HomeDataImg>
      <HomeDataImg v-for="(img, index) in imgs"
         :key="index" v-bind:img="img.img" @change="OnChangeChild"></HomeDataImg>
   </div>
</template>
<script>
import HomeDataImg from "../home/HomeDataImg.vue";
export default {
   props: ["training_id", "phase_number", "can_edit"],
   components: {
      HomeDataImg
   },
   data: () => ({
      selectedTab: "1",
      imgs:[
         {
            "img":1
         },
         {
            "img":2
         },
         {
            "img":3
         }
      ],
   }),
   computed:{
      Physics(){
         console.log("this.phase_number:",this.phase_number);
         let physics = this.$store.getters.GetPhysicsParameters.find(element=>element.phase_number === parseInt(this.phase_number)&&element.training_id==parseInt(this.training_id));
         return physics ? physics : {
             "current_weight" : 0,
             "hips_cm" : 0,
             "waist_cm" : 0,
             "chest_cm" : 0,
             "photoes" : []
         }
      }
   },
   mounted(){
         if (userInfo){
            this.$store.dispatch('fetchPhysicsParameters');
         }
   },
   methods: {
      disabled(){
         if(this.can_edit != undefined )
            return !this.can_edit;
         return true;
      },
      savePhysics(){
         this.$store.dispatch('setPhysicsParameter',this.Physics);
         this.$store.dispatch('fetchPhysicsParameters');
      },
      OnChangeChild(value){
         console.log(value);
      }
   }
};
</script>

<style scoped>
    input.progres-data__input[type="number"] {
        -moz-appearance: textfield;
        -webkit-appearance: textfield;
        appearance: textfield;
    }
    input.progres-data__input[type="number"]::-webkit-outer-spin-button,
    input.progres-data__input[type="number"]::-webkit-inner-spin-button {
        display: none;
    }
</style>
