import "../css/app.css";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import axios from "axios";
import { ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";

const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error("CSRF token not found!");
}


axios.defaults.withCredentials = true; //  send cookies with requests
window.axios = axios; // optional, if we want axios globally


const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,

    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },

    progress: {
        color: "#4B5563",
    },
});

const page = usePage();
const showPricingModal = ref(false);

onMounted(() => {
    // only run after login
    if (page.props.auth.user) {
        const intent = localStorage.getItem("postLoginIntent");
        if (intent === "pricing") {
            showPricingModal.value = true;
            localStorage.removeItem("postLoginIntent"); // clear it
        }
    }
});
