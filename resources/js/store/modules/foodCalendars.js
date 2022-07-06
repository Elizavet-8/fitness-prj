export default {
    actions:{
        async fetchFoodCalendars({ commit }) {
            axios.get('/api/food-calendar/list').then(response => {
                commit('LoadFoodCalendars', response.data)
            }).catch((error)=>{
                console.log("fetchFoodCalendars:",error.response);
            });
        },
        async fetchFoodCalendar({ commit }, FoodCalendarId) {
            axios.get('/api/food-calendar/show/'+FoodCalendarId).then(response => {
                commit('LoadFoodCalendar', response.data)
            }).catch((error)=>{
                console.log("LoadFoodCalendar:",error.response);
            });
        },
        storeFoodCalendar({ commit }, FoodCalendar){
            axios.post('/api/food-calendar/create',{
                users_menus_id:FoodCalendar.users_menus_id,
                day:FoodCalendar.day,
                is_active: FoodCalendar.is_active,
            }).then(response => {
                commit('CreateFoodCalendar', FoodCalendar)
            }).catch((error)=>{
                console.log("storeFoodCalendar:",error.response);
            });
        },
        setFoodCalendar({ commit }, FoodCalendar){
            axios.put('/api/food-calendar/update/'+FoodCalendar.id,{
                users_menus_id:FoodCalendar.users_menus_id,
                day:FoodCalendar.day,
                is_active: FoodCalendar.is_active,
            }).then(response => {
                commit('UpdateFoodCalendar', FoodCalendar)
            }).catch((error)=>{
                console.log("setFoodCalendar:",error.response);
            });
        },
        delFoodCalendar({ commit }, FoodCalendar){
            axios.delete('/api/food-calendar/delete/'+FoodCalendar.id).then((response)=>{
                commit('DeleteFoodCalendar', FoodCalendar)
            }).catch((error)=>{
                console.log("delFoodCalendar:",error.response);
            });
        },
    },
    mutations:{
        LoadFoodCalendars(state, FoodCalendars){
            state.FoodCalendars = FoodCalendars;
        },
        LoadFoodCalendar(state, FoodCalendar){
            state.FoodCalendar = FoodCalendar;
        },
        CreateFoodCalendar(state, FoodCalendar){
            let index = state.FoodCalendars.findIndex(FoodCalendar => FoodCalendar.id == id)
            state.FoodCalendars.unshift(index)
        },
        UpdateFoodCalendar(state, FoodCalendar){
            let index = state.FoodCalendars.findIndex(p=> p.id === FoodCalendar.id)
            state.FoodCalendars[index] = FoodCalendar
        },
        DeleteFoodCalendar(state, FoodCalendar){
            let index = state.FoodCalendars.findIndex(FoodCalendar => FoodCalendar.id == id)
            state.FoodCalendars.splice(index, 1);
        },
    },
    state:{
        FoodCalendars:[],
        FoodCalendar:null,
    },
    getters:{
        GetFoodCalendars(state){
            return state.FoodCalendars;
        },
        GetFoodCalendar(state){
            return state.FoodCalendar;
        }
    }
}
