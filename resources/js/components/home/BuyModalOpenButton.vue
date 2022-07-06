<template>
    <button type="button" class="button" data-toggle="modal" data-target="#buy" @click="passData">
        хочу
    </button>
</template>

<script>
export default {
    name: "BuyModalOpenButton",
    props: ["name", "price", "stripe_id", "menu_id", "training_id", "is_marathon", "extended_stripe_id"],
    methods: {
        passData() {
            let serviceInfo = {
                'name' : this.name,
                'price' : this.price,
                'stripe_id' : this.stripe_id,
                'menu_id' : this.menu_id,
                'training_id' : this.training_id,
                'is_marathon' : this.is_marathon,
                'old_price' : this.price,
                'extended_stripe_id' : this.extended_stripe_id,
                'current_stripe_id' : this.stripe_id
            };
            console.log(serviceInfo);
            this.$store.dispatch('assignServiceInfo', serviceInfo);
        }
    }
}
</script>

<style scoped>

</style>
