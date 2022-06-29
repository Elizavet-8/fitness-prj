<template>
  <div class="buy__selector">
    <label class="buy__label">
      {{ select.label }}
    </label>
    <div class="buy__input" @click="toggle()">
      <div class="label" v-if="!label">
        <span>{{ select.value }}</span>
      </div>
      <div class="label"  v-else>
        <span> {{ label }}</span>
      </div>

      <div class="arrow">
        <svg
          width="26"
          height="26"
          viewBox="0 0 26 26"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M17.9258 22.8515C17.8257 22.8515 17.7266 22.8319 17.6342 22.7936C17.5418 22.7553 17.4577 22.6993 17.387 22.6285L7.99805 13.2391C7.85525 13.0962 7.77502 12.9025 7.77502 12.7006C7.77502 12.4986 7.85525 12.3049 7.99805 12.162L17.387 2.77256C17.4577 2.70181 17.5417 2.64568 17.6341 2.60737C17.7265 2.56907 17.8256 2.54934 17.9256 2.54932C18.0256 2.54929 18.1247 2.56897 18.2171 2.60724C18.3096 2.6455 18.3935 2.70159 18.4643 2.77231C18.5351 2.84303 18.5912 2.927 18.6295 3.01941C18.6678 3.11183 18.6875 3.21088 18.6876 3.31092C18.6876 3.41096 18.6679 3.51002 18.6296 3.60246C18.5914 3.69489 18.5353 3.77888 18.4646 3.84963L9.6139 12.7003L18.4646 21.551C18.5712 21.6575 18.6438 21.7932 18.6732 21.9411C18.7026 22.0889 18.6875 22.2421 18.6298 22.3813C18.5722 22.5205 18.4745 22.6395 18.3491 22.7232C18.2238 22.8069 18.0765 22.8515 17.9258 22.8515Z"
            fill="#9180FF"
          />
        </svg>
      </div>
      <div>
        <ul :class="{ hidden: !visible, visible }">
          <li v-for="(item, i) in list" @click="selectItem(item)" :key="i">
            {{ item.name }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["select", "list"],
  data: () => ({
    visible: false,
    label: null,
    value: null
  }),
  methods: {
    toggle() {
      this.visible = !this.visible;
    },
    selectItem(item) {
      this.label = item.name;
      this.value = item.id;
      this.$emit("result", this.value, this.select.id);
    },
  },
};
</script>
