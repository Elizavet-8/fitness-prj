<template>
    <div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Дополнительно</label>
            <div class="col-md-7">
                <input class="form-control" type="text" placeholder="Дополнительная информация" v-model="new_task.text">
            </div>
            <div class="2">
                <small class="form-text text-muted">{{ "Дополнительно: " + infos.length }}</small>
                <button type="button" class="btn btn-outline-primary" @click="add_task">Добавить</button>
            </div>
            <div class="col-md-12 edit-chips">
                <div class="badge badge-pill badge-secondary"
                     @task_done="delete_task(index)" :key="index" v-for="(text,index) in infos"
                >
                    * {{ text }}.

                    <input type="hidden" name="info[]" :value="text">

                    <span class="badge badge-light" @click="delete_task(index)">x</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        new_task: {
            title: '',
            desc: '',
            measure: ''
        },
        infos: []
    }),
    mounted(){
        console.log(this.infos);
    },
    methods: {
        task_done() {
            this.$emit('task_done')
        },
        add_task() {
            if (this.new_task.text != '') {
                this.infos.push(this.new_task.text);
                this.new_task.text = '';
            }
        },
        delete_task(index) {
            this.infos.splice(index, 1);
        }
    }
}
</script>
