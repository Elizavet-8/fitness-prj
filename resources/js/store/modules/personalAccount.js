export default {
    actions:{
        async fetchPersonalAccount({ commit }) {
            axios.get('/api/personal-account/list').then(response => {
                console.log(response.data);
                commit('LoadUpdatePersonalAccount', response.data)
            }).catch((error)=>{
                console.log("LoadUpdatePersonalAccount:",error.response);
            });
        },
        setPersonalAccount({ commit }, PersonalAccount){
            axios.put('/api/personal-account/update/'+PersonalAccount.id,{
                user_id: PersonalAccount.user_id,
                age: PersonalAccount.age,
                life_style_id: PersonalAccount.life_style_id,
                problem_zone_id: PersonalAccount.problem_zone_id,
                training_location_id: PersonalAccount.training_location_id,
                menu_calories_id: PersonalAccount.menu_calories_id,
                deactivated_at: PersonalAccount.deactivated_at,
            }).then(response => {
                commit('LoadUpdatePersonalAccount', PersonalAccount)
            }).catch((error)=>{
                console.log("LoadUpdatePersonalAccount:",error.response);
            });
        },
    },
    mutations:{
        LoadUpdatePersonalAccount(state, PersonalAccount){
            state.PersonalAccount = PersonalAccount;
        },
    },
    state:{
        PersonalAccount:null,
    },
    getters:{
        GetPersonalAccount(state){
            return state.PersonalAccount;
        }
    }
}
