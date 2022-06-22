<template>
    <div>
        <div :key="index" v-for="(content,index) in contents">
            <foods :content="content"></foods>
            <Videos :content="content"></Videos>
        </div>
        <input type="hidden" name="content[]" :value="prepareContents(contents)">
    </div>
</template>

<script>
import Foods from "../contents/Foods.vue";
import Videos from "../contents/Videos.vue";

export default {
    components: {
        Foods,
        Videos
    },
    data: () => ({
        new_task: {
            title: '',
            link: '',
        },
        new_food: {
            name: '',
            amount: '',
        },
        contents: [
            {
                name:'Завтрак',
                foods: [],
                videos: []
            },
            {
                name:'Перекус№1',
                foods: [],
                videos: []
            },
            {
                name:'Обед',
                foods: [],
                videos: []
            },
            {
                name:'Перекус№2',
                foods: [],
                videos: []
            },
            {
                name:'Ужин',
                foods: [],
                videos: []
            }
        ],
        content: {
            videos: []
        },
    }),
    mounted() {
        console.log(this.contents);
    },
    methods: {
        task_done() {
            this.$emit('task_done')
        },
        add_task(index) {
            if (this.new_task.title != '', this.new_task.link != '') {
                this.content.videos.push({
                    title: this.new_task.title,
                    link: this.new_task.link,
                });
                this.new_task.title = '';
                this.new_task.link = '';
            }
        },
        delete_task(index) {
            this.content.videos.splice(index, 1);
        },

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
        },
        delete_food(index) {
            this.content.foods.splice(index, 1);
        },
        prepareContents() {
            return typeof this.contents === 'string' ? this.contents : JSON.stringify(this.contents);
        }
    }
}
</script>

