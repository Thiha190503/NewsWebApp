import axios from "axios";

export default {
  name: "RegisterPage",
  data() {
    return {
      userData: {
        name: "",
        email: "",
        password: "",
        confirmPassword: "",
      },
      tokenStatus: false,
    };
  },
  methods: {
    register() {
      if (this.userData.password !== this.userData.confirmPassword) {
        alert("Passwords Do Not Match!!");
        return;
      }

      axios
        .post("http://localhost:8000/api/user/register", this.userData)
        .then((res) => {
          if (res.data.token == null) {
            alert(
              "Please make sure to fill in all the required fields correctly before proceeding with the register."
            );
          } else {
            this.$router.push({
              name: "loginPage",
            });
          }
        });
    },
    goBack() {
      window.history.back();
    },
  },
};
