<template>
    <div>
        <div :key="index" v-for="(content,index) in contents">
            <foods :content="content"></foods>
            <Videos :content="content"></Videos>
<!--            <div class="form-group row">
                <div class="form-group col-md-5">
                    <label class="col-form-label">{{ content.name }}</label>
                    <div>
                        <input class="form-control" type="text" v-model="new_food.name">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="col-form-label">Граммовки</label>
                    <div>
                        <input class="form-control" type="text" v-model="new_food.amount">
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <small class="form-text text-muted">{{ "Продуктов: " + content.foods.length }}</small>
                    <button type="button" class="btn btn-outline-primary" @click="add_food">Добавить</button>
                </div>
            </div>
            <div class="col-md-12 edit-chips">
                <div class="badge badge-pill badge-secondary"
                     @food_done="delete_food(index)" :key="index" v-for="(food,index) in content.foods"
                >
                    {{ food.name }} / {{ food.amount }}
                    <input type="hidden" name="foods[]" :value="toStringFood(food)">
                    <span class="badge badge-light" @click="delete_food(index)">x</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="form-group col-md-5">
                    <label class="col-form-label">Название</label>
                    <div>
                        <input class="form-control" type="text" v-model="new_task.title">
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label class="col-form-label">Ссылка</label>
                    <div>
                        <input class="form-control" type="text" v-model="new_task.link">
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <small class="form-text text-muted">{{ "Видео: " + videos.length }}</small>
                    <button type="button" class="btn btn-outline-primary" @click="add_task">Добавить</button>
                </div>
            </div>
            <div class="edit-chips form-group">
                <div class="badge badge-pill badge-secondary"
                     @task_done="delete_task(index)" :key="index" v-for="(video,index) in content.videos"
                >
                    {{video.title }} / {{ video.link }}
                    <input type="hidden" name="videos[]" :value="toString(video)">
                    <span class="badge badge-light" @click="delete_task(index)">x</span>
                </div>
            </div>-->
        </div>
        <input type="hidden" name="content[]" :value="prepareContents(contents)">
    </div>
</template>

<script>
import Foods from "./contents/Foods.vue";
import Videos from "./contents/Videos.vue";

export default {
    components: {
        Foods,
        Videos
    },
    props: ["data"],
    data: () => ({
        new_food: {
            name: '',
            amount: '',
        },
        new_task: {
            title: '',
            link: '',
        },
        foods: [],
        videos: [],
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
    }),
    mounted() {
        this.contents = this.data;
    },
    methods: {
        toStringFood(food){
            return JSON.stringify(food);
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

        toString(video){
            return JSON.stringify(video);
        },
        task_done() {
            this.$emit('task_done')
        },
        add_task() {
            if (this.new_task.title != '', this.new_task.link != '') {
                this.videos.push({
                    title: this.new_task.title,
                    link: this.new_task.link,
                });
                this.new_task.title = '';
                this.new_task.link = '';
            }
        },
        delete_task(index) {
            this.videos.splice(index, 1);
        },
        prepareContents() {
            return typeof this.contents === 'string' ? this.contents : JSON.stringify(this.contents);
        }
    },
}
</script>

