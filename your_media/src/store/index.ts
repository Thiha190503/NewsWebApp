import { createStore } from "vuex";
export default createStore({
  state: {
    userData: {},
    token: "",
  },
  getters: {
    storageUserData: (state) => state.userData,
    storageToken: (state) => state.token,
  },
  mutations: {},
  actions: {
    setUserData: ({ state }, value) => (state.userData = value),
    setToken: ({ state }, value) => (state.token = value),
  },
  modules: {},
});

// userData: {id: 3, name: 'Thiha', email: 'thiha@gmail.com', email_verified_at: null, phone: null...}
// token: "4|u3giKaEyHLJQ3FwMAtJ0lpyehe6dwjIDU7I5rxBd"
