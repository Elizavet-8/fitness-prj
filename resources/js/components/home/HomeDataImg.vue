<template>
   <div class="progres-data__item-photo progres-data__item">
      <input
        name="file"
        type="file"
        @change="previewImage"
        accept="image/*"
      />
      <img v-if="changeImg" class="preview" :src="imageData"  alt="#"/>
   </div>
</template>
<script>
export default {
  props: ["img"],
  data: () => ({
    imageData: "",
    changeImg: false,
  }),
  methods: {
    previewImage: function (event) {
      this.$emit('changed', this.imageData)
      this.changeImg=true;
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.imageData = e.target.result;
          this.activeStep++;
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    saveImg(){

    }
  },
};
</script>
