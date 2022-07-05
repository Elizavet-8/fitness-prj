import Vue from 'vue'
import Vuex from 'vuex'

//#region import modules
import problemZones from './modules/problemZones'
import lifeStyles from './modules/lifeStyles'
import trainingLocations from './modules/trainingLocations'
import menuCalories from './modules/menuCalories'
import menuTypes from './modules/menuType'
import menus from './modules/menus'
import trainings from './modules/trainings'
import topics from './modules/topics'
import questions from './modules/questions'
import notifications from './modules/notifications'
import physicsParameters from './modules/physicsParameters'
import personalAccount from './modules/personalAccount'
import userMenus from './modules/userMenus'
import foodCalendars from './modules/foodCalendars'
import trainingUsers from './modules/trainingUsers'
import activityCalendars from './modules/activityCalendars'
import accessHistory from './modules/accessHistory'
import pricing from './modules/pricing'
import serviceInfo from "./modules/serviceInfo";
//#endregion

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        problemZones,
        lifeStyles,
        trainingLocations,
        menuCalories,
        menuTypes,
        personalAccount,
        menus,
        userMenus,
        foodCalendars,
        trainings,
        trainingUsers,
        activityCalendars,
        questions,
        notifications,
        physicsParameters,
        topics,
        accessHistory,
        pricing,
        serviceInfo
    }
})
