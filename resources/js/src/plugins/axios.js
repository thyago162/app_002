
import Vue from 'vue';
import axios from 'axios';
import URL from '../config.js';

axios.defaults.baseURL = URL
export default Vue.use({
    install(Vue) {
        Vue.prototype.$http = axios
    }

});
