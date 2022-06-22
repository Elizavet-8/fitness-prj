<template>
    <div>
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
                <small class="form-text text-muted">{{ "Видео: " + content.videos.length }}</small>
                <button type="button" class="btn btn-outline-primary" @click="add_task">Добавить</button>
            </div>
        </div>
        <div class="edit-chips form-group">
            <div class="badge badge-pill badge-secondary"  @task_done="delete_task(index)" :key="index" v-for="(video,index) in content.videos">
                {{video.title }} / {{ video.link }}
                <span class="badge badge-light" @click="delete_task(index)">x</span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["content"],
    data: () => ({
        new_task: {
            title: '',
            link: '',
        },
        videos: []
    }),
    methods: {
        toString(video){
            return typeof video === 'string' ? video : JSON.stringify(video);
        },
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
        }
    },
}
</script>
