<template>
  <div class="d-flex flex-column vh-100">
    <main>
      <!-- First Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark navbar-top sticky-top">
        <div class="container-fluid">
          <router-link to="/" class="navbar-brand">Your Media</router-link>
          <div
            class="collapse navbar-collapse justify-content-end"
            id="navbarTop"
          >
            <span class="navbar-text" style="color: white; font-size: 22px"
              >Up To Date Daily News</span
            >
          </div>
        </div>
      </nav>

      <router-view></router-view>
    </main>

    <footer class="bg-dark text-light mt-5 vh-100">
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-4">
            <ul class="list-unstyled">
              <li class="mb-3">
                <a href="#" style="color: #f3f2f5">Privacy & Policy</a>
              </li>
              <li class="mb-3">
                <a href="#" style="color: #f3f2f5">Terms</a>
              </li>
              <li class="mb-3">
                <a href="#" style="color: #f3f2f5">Help</a>
              </li>
              <li class="mb-3">
                <a href="#" style="color: #f3f2f5">Contact</a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-unstyled">
              <li class="mb-3">
                <a href="#" style="color: #f3f2f5"
                  ><i class="fab fa-facebook mr-1"></i> Facebook</a
                >
              </li>
              <li class="mb-3">
                <a href="#" style="color: #f3f2f5"
                  ><i class="fab fa-twitter mr-1"></i> Twitter</a
                >
              </li>
              <li class="mb-3">
                <a href="#" style="color: #f3f2f5"
                  ><i class="fab fa-instagram mr-1"></i> Instagram</a
                >
              </li>
              <li class="mb-3">
                <a href="#" style="color: #f3f2f5"
                  ><i class="fab fa-linkedin mr-1"></i> LinkedIn</a
                >
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h5 class="mb-4">Contact Us</h5>
            <address>
              Yangon<br />
              Myanmar<br />
              Email: thiha190503@gmail.com
            </address>
          </div>
        </div>
      </div>
      <div class="footer-bottom bg-dark text-muted text-center py-5">
        <p>&copy; 2023 Your News. All rights reserved.</p>
      </div>
    </footer>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      tokenStatus: false,
    };
  },
  computed: {
    ...mapGetters(["storageToken", "storageUserData"]),
  },
  methods: {
    logout() {
      this.$store.dispatch("setToken", null);

      // location.reload();
    },
    checkToken() {
      if (
        this.storageToken != null &&
        this.storageToken != undefined &&
        this.storageToken != ""
      ) {
        this.tokenStatus = true;
        console.log("true");
      } else {
        this.tokenStatus = false;
        console.log("false");
      }
    },
  },
  mounted() {
    console.log(this.storageToken);
    console.log(this.storageUserData);
    this.checkToken();
  },
};
</script>
