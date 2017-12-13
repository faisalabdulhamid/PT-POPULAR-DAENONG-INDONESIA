import VueRouter from 'vue-router';

export default new VueRouter({
    routes: [
        {path: '/', component: require('./component/Index.vue'), name: 'index'},
        {path: '/:id/lihat', component: require('./component/Show.vue'), name: 'show', props: true},
        {path: '/create', component: require('./component/Create.vue'), name: 'create'},

        {path: '/:id/purchasing', component: require('./component/ShowPurchasing.vue'), name: 'purchasing', props: true},
    ]
});