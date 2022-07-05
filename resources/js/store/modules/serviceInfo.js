export default {
    state: {
        serviceInfo: {
            'name' : null,
            'price' : null,
            'stripe_id' : null,
            'menu_id' : null,
            'training_id' : null,
            'old_price' : null,
            'is_marathon' : false,
            'extended_stripe_id' : null,
            'current_stripe_id' : null,
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
