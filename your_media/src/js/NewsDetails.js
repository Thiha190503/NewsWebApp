import axios from "axios";
import { mapGetters } from "vuex";

export default {
  name: "NewsDetails",
  data() {
    return {
      newsDetails: {
        title: "",
        description: "",
        news: "",
        image: "",
      },
      tokenStatus: false,
      viewCount: 0,
    };
  },

  computed: {
    ...mapGetters(["storageToken", "storageUserData"]),
  },

  mounted() {
    this.newsId = this.$route.params.id;
    this.getNewsDetails(this.$route.params.id);
    this.checkToken();
    this.viewCountLoad();
  },

  methods: {
    getNewsDetails() {
      axios
        .get(`http://localhost:8000/api/posts/newsDetails/${this.newsId}`)
        .then((res) => {
          this.newsDetails.title = res.data.newsDetails[0].title;
          this.newsDetails.description = res.data.newsDetails[0].description;
          this.newsDetails.news = res.data.newsDetails[0].news;
          this.newsDetails.image =
            "http://localhost:8000/postImage/" + res.data.newsDetails[0].image;
        });
    },
    goBack() {
      window.history.back();
    },
    viewCountLoad() {
      if (this.tokenStatus == true) {
        let dataId = {
          user_id: this.storageUserData.id,
          post_id: this.$route.params.id,
        };
        axios
          .post("http://localhost:8000/api/posts/actionLog", dataId)
          .then((res) => {
            this.viewCount = res.data.post.length;
          })
          .catch((error) => {
            console.log(error);
          });
      }
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
