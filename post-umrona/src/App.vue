<script setup>
import Navbar from "./components/Navbar/Navbar.vue";
import Posts from "./components/Posts/Posts.vue";
import AddPost from "./components/Posts/AddPost.vue";
import CustomButton from "./components/Buttons/CustomButton.vue";

import { computed, ref } from "vue";

const currentTab = ref("Posts");

const currentTabComponent = computed(() => {
  if (currentTab.value === "Posts") return Posts;
  if (currentTab.value === "AddPost") return AddPost;
});
</script>

<template>
  <div class="w-full h-screen max-h-screen relative text-slate-800 bg-gray-50">
    <Navbar>
      <CustomButton text="Add Post" primary v-if="currentTab != 'AddPost'" @click="currentTab = 'AddPost'"/>
      <CustomButton text="Back to posts" @click="currentTab = 'Posts'" v-else/>
    </Navbar>

    <div class="content h-full px-10 pt-[150px]">
      <div class="w-full h-fit">
          <component :is="currentTabComponent" />
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
