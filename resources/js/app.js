require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import VueSmoothScroll from 'vue3-smooth-scroll';
//import "vue3-colorpicker/bundle.css";
import loader from 'vue-ui-preloader';
import VueToast from 'vue-toast-notification';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import 'vue-toast-notification/dist/theme-sugar.css';

const el = document.getElementById('app');


const app = createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
});
    app.mixin({ methods: { route } })
    app.use(InertiaPlugin)
    app.use(VueSmoothScroll)
    app.use(loader)
    app.use(VueToast)
    app.mount(el);

InertiaProgress.init({ color: '#4B5563' });
