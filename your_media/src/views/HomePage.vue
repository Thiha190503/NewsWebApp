<template>
  <div>
    <!-- Second Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-centered mb-3">
      <div class="container-fluid">
        <div class="">
          <a
            class="btn btn-danger custom-button"
            @click="logout()"
            v-if="tokenStatus"
            >Log Out</a
          >
          <router-link
            to="/loginPage"
            class="btn btn-primary custom-button mr-2"
            v-if="!tokenStatus"
            >Login</router-link
          >
          <router-link
            to="/registerPage"
            class="btn btn-secondary custom-button"
            v-if="!tokenStatus"
            >Register</router-link
          >
        </div>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarCentered"
          aria-controls="navbarCentered"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCentered">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#" @click="searchCategories('')"
                >Home <span class="sr-only">(current)</span></a
              >
            </li>
            <li
              v-for="(category, index) in categories"
              :key="index"
              class="nav-item"
              @click="searchCategories(category.title)"
            >
              <a class="nav-link fs-5" href="#">{{ category.title }}</a>
            </li>
          </ul>
        </div>
        <div class="form-inline">
          <input
            class="form-control mr-sm-2"
            type="text"
            placeholder="Search"
            v-model="searchKey"
            v-on:keyup.enter="search()"
          />
          <button
            class="btn btn-outline-dark my-2 my-sm-0"
            type="submit"
            @click="search()"
          >
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </nav>

    <main>
      <!-- Card Section -->
      <div class="container-fluid">
        <div v-if="tokenStatus" class="row">
          <div
            v-for="(post, index) in this.posts"
            :key="index"
            class="col-md-4 mb-4"
          >
            <Router-Link
              class="card h-100 mx-2"
              :to="{ path: '/newsDetails/' + post.post_id }"
            >
              <img
                v-bind:src="post.image"
                class="card-img-top h-50"
                alt="..."
              />
              <div class="card-body h-50">
                <h5 class="card-title mb-3">{{ post.title }}</h5>
                <p class="card-text mb-2">
                  {{ post.description }}
                </p>
              </div>
              <!-- <div class="card-footer">
                <p class="card-text">
                  <small class="text-muted">2 hours ago</small>
                </p>
              </div> -->
            </Router-Link>
          </div>
        </div>
        <div v-else>
          <div class="alert alert-danger m-5" role="alert">
            <h4 class="alert-heading">
              <strong style="font-size: 30px"
                >You Don't Have Permission To Read!</strong
              >
            </h4>
            <p style="font-size: 20px">
              You don't have permission to access this content. Log in to
              explore our full range of features and content. Don't have an
              account?
              <router-link to="/registerPage">register</router-link>
              now!
            </p>
            <hr />
            <p style="font-size: 20px">
              Unlock premium content and exclusive features by logging in to
              your account.
            </p>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script src="../js/HomePage.js"></script>
