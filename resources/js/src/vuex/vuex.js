import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios'

Vue.use(Vuex);

export default new Vuex.Store({

    state: {
        lojas: [],
        produtos: []
    },

    getters: {
        lojas: state => {
            return state.lojas;
        },

        produtos: state => {
            return state.produtos;
        }

    },

    actions: {
        lojas({commit}, id) {
            if (typeof id == 'undefined') {
                id = 1
            }

            axios.get('/lojas')
            .then(res => {
                commit('setLoja', res.data.response.data);
            })
        },

        produtos({commit}, id) {
            if (typeof id == 'undefined') {
                id = 1
            }

            axios.get('produtos')
            .then(res => {
                commit('setProduto', res.data.response.data);
            })
        }
    },

    mutations: {
        setLoja(state, payload) {
            state.lojas = payload
        },

        setProduto(state, payload) {
            state.produtos = payload
        }
    }
})
