import axios from "axios";
import { mapGetters } from "vuex";
export default {
  name: "LoginPage",
  data() {
    return {
      userData: {
        email: "",
        password: "",
      },
      tokenStatus: false,
    };
  },
  computed: {
    ...mapGetters(["storageToken", "storageUserData"]),
  },
  methods: {
    login() {
      axios
        .post("http://localhost:8000/api/user/login", this.userData)
        .then((res) => {
          if (res.data.token == null) {
            alert(
              "Please make sure to fill in all the required fields correctly before proceeding with the login."
            );
          } else {
            this.storeUserInfo(res);
            this.tokenStatus = true;
            this.$router.push({
              name: "home",
            });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    storeUserInfo(res) {
      this.$store.dispatch("setToken", res.data.token);
      this.$store.dispatch("setUserData", res.data.user);
    },
    goBack() {
      window.history.back();
    },
    // check() {
    //   console.log(this.storageToken);
    //   console.log(this.storageUserData);
    // },
  },
  mounted() {
    this.userData = {};
  },
};
