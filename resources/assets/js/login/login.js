
require('./../bootstrap');
import {api_key, base_url} from './../config/env.config'
window.Vue = require('vue');

const app = new Vue({
    el: '#root',
    data(){
    	return {
    		'data' : {
    			email: '',
    			password: ''
    		}
    	}
    }
});
