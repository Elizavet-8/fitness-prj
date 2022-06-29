export default {
    actions:{
        async fetchLifeStyles({ commit }) {
            axios.get('/api/life-style/list').then(response => {
                commit('LoadLifeStyles', response.data)
            }).catch((error)=>{
                console.log("fetchLifeStyles:",error.response);
            });
        },
        async fetchLifeStyle({ commit }, LifeStyleId) {
            axios.get('/api/life-style/show/'+LifeStyleId).then(response => {
                commit('LoadLifeStyle', response.data)
            }).catch((error)=>{
                console.log("LoadLifeStyle:",error.response);
            });
        },
        storeLifeStyle({ commit }, LifeStyle){
            axios.post('/api/life-style/create',{
                name:LifeStyle.name,
            }).then(response => {
                commit('CreateLifeStyle', LifeStyle)
            }).catch((error)=>{
                console.log("storeLifeStyle:",error.response);
            });
        },
        setLifeStyle({ commit }, LifeStyle){
            axios.put('/api/life-style/update/'+LifeStyle.id,{
                name:LifeStyle.name,
            }).then(response => {
                commit('UpdateLifeStyle', LifeStyle)
            }).catch((error)=>{
                console.log("setLifeStyle:",error.response);
            });
        },
        delLifeStyle({ commit }, LifeStyle){
            axios.delete('/api/life-style/delete/'+LifeStyle.id).then((response)=>{
                commit('DeleteLifeStyle', LifeStyle)
            }).catch((error)=>{
                console.log("delLifeStyle:",error.response);
            });
        },
    },
    mutations:{
        LoadLifeStyles(state, LifeStyles){
            state.LifeStyles = LifeStyles;
        },
        LoadLifeStyle(state, LifeStyle){
            state.LifeStyle = LifeStyle;
        },
        CreateLifeStyle(state, LifeStyle){
            let index = state.LifeStyles.findIndex(LifeStyle => LifeStyle.id == id)
            state.LifeStyles.unshift(index)
        },
        UpdateLifeStyle(state, LifeStyle){
            let index = state.LifeStyles.findIndex(p=> p.id === LifeStyle.id)
            state.LifeStyles[index] = LifeStyle
        },
        DeleteLifeStyle(state, LifeStyle){
            let index = state.LifeStyles.findIndex(LifeStyle => LifeStyle.id == id)
            state.LifeStyles.splice(index, 1);
        },
    },
    state:{
        LifeStyles:[],
        LifeStyle:null,
    },
    getters:{
        GetLifeStyles(state){
            return state.LifeStyles;
        },
        GetLifeStyle(state){
            return state.LifeStyle;
        }
    }
}
