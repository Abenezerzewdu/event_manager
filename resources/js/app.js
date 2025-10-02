import "../css/app.css";
import "../css/main.css"; // Admin One styles

import "./bootstrap";

import { createApp, h, ref, onMounted } from "vue";
import { createInertiaApp, usePage } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { createPinia } from "pinia";
import axios from "axios";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

// ----------------------
// Axios setup
// ----------------------
const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error("CSRF token not found!");
}

axios.defaults.withCredentials = true; // send cookies with requests
window.axios = axios; // optional: make axios global

// ----------------------
// Pinia (for Admin One stores like dark mode)
// ----------------------
const pinia = createPinia();

// ----------------------
// Inertia app
// ----------------------
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
            .use(pinia)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});

// ----------------------
// Post-login intent modal logic
// ----------------------
const page = usePage();
const showPricingModal = ref(false);

onMounted(() => {
    if (page.props.auth.user) {
        const intent = localStorage.getItem("postLoginIntent");
        if (intent === "pricing") {
            showPricingModal.value = true;
            localStorage.removeItem("postLoginIntent");
        }
    }
});

// ----------------------
// Optional: Dark mode store (Admin One)
// ----------------------
// import { useDarkModeStore } from "@/stores/darkMode.js"
// const darkModeStore = useDarkModeStore(pinia)
//
// if (
//   (!localStorage["darkMode"] && window.matchMedia("(prefers-color-scheme: dark)").matches) ||
//   localStorage["darkMode"] === "1"
// ) {
//   darkModeStore.set(true)
// }
