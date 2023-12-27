import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

createApp(App).use(store).use(router).mount("#app");

// import { createApp } from "vue";
// import App from "./App.vue";
// import store from "./store"; // Import your Vuex store

// const app = createApp(App);
// app.use(store); // Use the Vuex store
// app.mount("#app");
