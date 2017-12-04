import Vue from 'vue'
import Vuex from 'vuex'
import bahan from './plugins'
import oauth from '../../config/oauth/oauth'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules:{
    	bahan: bahan,
    	oauth: oauth,
    },
    strict: debug
})