<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div
            class="card-header bg-primary text-white d-flex justify-content-between align-items-center"
          >
            <a @click="goBack()" class="btn btn-primary">
              <span style="font-size: 20px"
                ><i class="fa-solid fa-angle-left"></i
              ></span>
            </a>
            <h5 class="mb-0 text-center flex-grow-1">Login</h5>
            <div style="width: 40px"></div>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input
                type="email"
                class="form-control"
                id="email"
                placeholder="Enter your email"
                v-model="userData.email"
                v-on:keyup.enter="login()"
                required
              />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input
                type="password"
                class="form-control"
                id="password"
                placeholder="Enter your password"
                v-model="userData.password"
                v-on:keyup.enter="login()"
                required
              />
            </div>
          </div>
          <div class="card-footer">
            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="submit" @click="login">
                Login
              </button>
              <!-- <button @click="check()">Check</button> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="../js/LoginPage.js"></script>
