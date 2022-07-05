export default {
    state: {
        serviceInfo: {
            'name' : null,
            'price' : null,
            'stripe_id' : null,
            'menu_id' : null,
            'training_id' : null
        }
    },
    getters: {
        SERVICE_INFO: state => {
            return state.serviceInfo
        }
    },
    mutations: {
        setServiceInfo(state, payload) {
            state.serviceInfo = payload;
        }
    },
    actions: {
        assignServiceInfo(context, payload) {
            context.commit('setServiceInfo', payload);
        }
    }
}