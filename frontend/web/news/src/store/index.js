import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(Vuex)
Vue.use(VueAxios, axios)

const url = "http://yiidevelb.r3p.ru/news";

export default new Vuex.Store({
    state: {
        news: [],
        oneNews: []
    },
    mutations: {
        setStore(state, news) {
            state.news = news;
        },
        setOneStore(state, news) {
            state.oneNews = news;
        },
    },
    actions: {
        initStore: ({commit}) => {
            axios.get(url)
            .then((response) => {
                commit('setStore', response.data)
            });
        },
        /**
         *
         * @param commit
         * @param id
         */
        initOneStore: ({commit}, id) => {
            axios.get(url+'/'+id)
            .then((response) => {
                commit('setOneStore', response.data)
            });
        }
    },
    getters: {
        news:    state => state.news,
        oneNews: state => state.oneNews
    },
    modules: {
    }
})
