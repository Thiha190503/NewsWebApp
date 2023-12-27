<template>
  <div>
    <div class="container mt-4">
      <div class="my-4">
        <a @click="goBack()" class="btn btn-primary mr-5">
          <span style="font-size: 20px">
            <i class="fa-solid fa-angle-left"></i>
          </span>
        </a>
        <span style="font-size: 20px">
          <i class="fa-solid fa-eye"></i>
          <span class="ml-2">{{ viewCount }}</span>
        </span>
      </div>
      <div class="row">
        <div class="col">
          <img
            :src="newsDetails.image"
            class="img-fluid mb-4"
            style="width: 800px; height: 400px"
            alt="image"
          />
          <!-- <input type="text" v-model="newsDetails.title" /> -->
          <h1 class="mb-4 fw-bolder">{{ newsDetails.title }}</h1>
          <h3 class="mb-4 fw-semibold">
            {{ newsDetails.description }}
          </h3>
          <p>{{ newsDetails.news }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="../js/NewsDetails.js"></script>
