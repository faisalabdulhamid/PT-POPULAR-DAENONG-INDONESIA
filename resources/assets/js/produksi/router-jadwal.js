import VueRouter from 'vue-router';

export default new VueRouter({
    routes: [
        {path: '/', component: require('./component/IndexJadwal.vue'), name: 'index'},
    ]
});