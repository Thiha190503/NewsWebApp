import axios from "axios";
import { mapGetters } from "vuex";

export default {
  name: "HomePage",

  data() {
    return {
      posts: {},
      categories: {},
      searchKey: "",
      tokenStatus: false,
    };
  },

  computed: {
    ...mapGetters(["storageToken", "storageUserData"]),
  },

  mounted() {
    this.getAllPosts();
    this.getAllCategories();
    this.checkToken();
  },

  methods: {
    getAllPosts() {
      axios.get("http://localhost:8000/api/posts").then((res) => {
        for (let i = 0; i < res.data.posts.length; i++) {
          // if (res.data.post[i].image != null) {
          //   res.data.posts[i].image =
          //     "http://localhost:8000/postImage/" + res.data.posts[i].image;
          // } else {
          //   res.data.posts[i].image =
          //     "http://localhost:8000/storage/default/default_image.jpg";
          // }

          res.data.posts[i].image =
            "http://localhost:8000/postImage/" + res.data.posts[i].image;
        }
        this.date = res.data.posts[0].updated_at;
        this.posts = res.data.posts;
        console.log(this.posts);
        console.log(this.date);
      });
    },

    getAllCategories() {
      axios.get("http://localhost:8000/api/categories").then((res) => {
        this.categories = res.data.categories;
      });
    },

    search() {
      let search = {
        key: this.searchKey,
      };
      axios
        .post("http://localhost:8000/api/posts/search", search)
        .then((res) => {
          for (let i = 0; i < res.data.searchData.length; i++) {
            // if (res.data.searchData[i].image != null) {
            //   res.data.searchData[i].image =
            //     "http://localhost:8000/postImage/" +
            //     res.data.searchData[i].image;
            // } else {
            //   res.data.searchData[i].image =
            //     "http://localhost:8000/storage/default/default_image.jpg";
            // }

            res.data.searchData[i].image =
              "http://localhost:8000/postImage/" + res.data.searchData[i].image;
          }
          this.posts = res.data.searchData;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    searchCategories(searchKey) {
      let search = {
        key: searchKey,
      };
      axios
        .post("http://localhost:8000/api/categories/search", search)
        .then((res) => {
          for (let i = 0; i < res.data.result.length; i++) {
            // if (res.data.result[i].image != null) {
            //   res.data.result[i].image =
            //     "http://localhost:8000/postImage/" +
            //     res.data.result[i].image;
            // } else {
            //   res.data.result[i].image =
            //     "http://localhost:8000/storage/default/default_image.jpg";
            // }

            res.data.result[i].image =
              "http://localhost:8000/postImage/" + res.data.result[i].image;
          }
          this.posts = res.data.result;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    logout() {
      this.$store.dispatch("setToken", null);
      location.reload();
    },

    checkToken() {
      if (
        this.storageToken != null &&
        this.storageToken != undefined &&
        this.storageToken != ""
      ) {
        this.tokenStatus = true;
      } else {
        this.tokenStatus = false;
      }
    },
  },
};
