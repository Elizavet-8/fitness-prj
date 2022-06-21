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
                <small class="form-text text-muted">{{ "Видео: " + videos.length }}</small>
                <button type="button" class="btn btn-outline-primary" @click="add_task">Добавить</button>
            </div>
        </div>
        <div class="edit-chips form-group">
            <div class="badge badge-pill badge-secondary"
                 @task_done="delete_task(index)" :key="index" v-for="(video,index) in videos"
            >
                {{typeof video === 'string' ? JSON.parse(video).title : video.title }} / {{typeof video === 'string' ? JSON.parse(video).link : video.link }}
                <input type="hidden" name="videos[]" :value="toString(video)">
                <span class="badge badge-light" @click="delete_task(index)">x</span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:["videos"],
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
        }
    },
}
</script>
