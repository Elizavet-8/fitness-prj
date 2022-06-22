<template>
    <div>
        <div class="form-group row">
            <div class="form-group col-md-5">
                <label class="col-form-label">{{content.name}}</label>
                <div>
                    <input class="form-control" type="text" v-model="new_food.name">
                </div>
            </div>
            <div class="form-group col-md-5">
                <label class="col-form-label">Граммовки</label>
                <div>
                    <input class="form-control" type="text" v-model="new_food.amount">
                </div>
            </div>
            <div class="form-group col-md-2">
                <small class="form-text text-muted">{{ "Продуктов: " + content.foods.length }}</small>
                <div class="btn btn-outline-primary" @click="add_food">Добавить</div>
            </div>
        </div>
        <div class="col-md-12 edit-chips">
            <div class="badge badge-pill badge-secondary"
                 @food_done="delete_food(index)" :key="index" v-for="(food,index) in content.foods"
            >
                {{ food.name }} / {{ food.amount }}
                <span class="badge badge-light" @click="delete_food(index)">x</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["infos", "content"],
    data: () => ({
        new_food: {
            name: '',
            amount: '',
        },
        foods: [],
    }),
    methods: {
        food_done() {
            this.$emit('food_done')
        },
        add_food() {
            if (this.new_food.name != '', this.new_food.amount != '') {
                this.content.foods.push({
                    name: this.new_food.name,
                    amount: this.new_food.amount,
                });
                this.new_food.name = '';
                this.new_food.amount = '';
            }
            console.log(this.content.foods);
        },
        delete_food(index) {
            this.content.foods.splice(index, 1);
            console.log(this.content.foods);
        },
    }
}
</script>
