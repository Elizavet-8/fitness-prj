<template>
    <div v-if="day&&trainingId&&locationId" class="workout-video">
        <template>
            <div class="workout-video-scroll__contain scroll__contain">
                <div v-if="!IsDayOff&&current_day" class="workout-video__list">
                    <div v-for="(video, index) in current_day.videos" :key="index" class="workout-video__item">
                        <!--                        <a :href="video.link" class="workout-video__img-preview tube">-->
                        <a href="https://www.youtube.com/watch?v=JgWycU5YLj4" class="workout-video__img-preview tube">
                            <img class="workout-video__img"
                                 src="https://i.ytimg.com/vi/xsOyQIY8SRw/hqdefault.jpg?sqp=-oaymwEbCKgBEF5IVfKriqkDDggBFQAAiEIYAXABwAEG&rs=AOn4CLCPvP5w5MrzRJOcv1n1zEAE5h9Ulw"
                                 alt="video">
                            <button
                                type="button"
                                class="workout-video__btn"
                            >
                                <svg
                                    width="24"
                                    height="27"
                                    viewBox="0 0 24 27"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M22.8547 11.8451C24.1738 12.639 24.1388 14.5632 22.7917 15.3086L3.30879 26.0901C1.96169 26.8355 0.312779 25.8431 0.340746 24.3038L0.745229 2.04034C0.773196 0.500993 2.45707 -0.430825 3.7762 0.363069L22.8547 11.8451Z"
                                        fill="white"
                                    />
                                </svg>
                            </button>
                        </a>
                        <div class="workout-video__title">{{ video.title }}</div>
                    </div>
                </div>
                <div v-else-if="current_day" class="workout-info__txt-block">
                    <div class="workout-info__img">
                        <img src="/images/luba.png" alt=""/>
                    </div>
                    <p v-html="current_day.description"></p>
                </div>
                <div v-if="current_training" class="workout-info__block">
                    <h5 class="workout-info__title">
                        {{ current_training.training.description }}
                        <b>
                            ДЕНЬ №{{ day }}
                        </b>
                    </h5>
                    <ul v-if="current_day" class="workout-info__list">
                        <li v-for="(step, index) in current_day.info" :key="index" class="workout-info__item">
                            <b>
                                Шаг {{ index + 1 }}.
                            </b>
                            <p>
                                {{ step }}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </template>
    </div>
</template>
<script>

export default {
    props: ["day", "trainingId", "locationId"],
    data: () => ({
        current_training: null,
        current_day: null,
        show_video_link: null,
    }),
    mounted() {
        if (userInfo) {
            this.$store.dispatch('fetchTrainingUsers');
        }
    },
    computed: {
        IsDayOff() {
            //console.log("this.day:",this.day);
            //console.log("this.trainingId:",this.trainingId);
            if (!this.trainingId)
                return false;
            this.current_training = this.$store.getters.GetTrainingUsers.find(element => element.training_id === this.trainingId.training_user.training_id && element.training_location_id === this.locationId);
            //console.log("this.current_training:",this.current_training);
            if (this.current_training) {
                this.current_day = Object.values(this.current_training.days).find(element => element.day_number === parseInt(this.day) && element.training_location_id === parseInt(this.locationId));
                console.log("this.current_day:", this.current_day);
                if (this.current_day && this.current_day.name === "Выходной")
                    return true
            }
            return false
        },
        VideoLink() {
            this.show_video_link = this.current_day.videos[0].link;
            return this.show_video_link;
        }
    },
    methods: {
        videoLink(link) {
            this.show_video_link = link;
            console.log(this.show_video_link);
        }
    }
};
</script>
