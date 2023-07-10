<script setup>
import PostCard from './PostCard.vue';
import PostDetail from './PostDetail.vue';
import CustomButton from '../Buttons/CustomButton.vue';
import axios from 'axios';

import { computed, ref } from 'vue';

const posts = ref([])
const postDetail = ref({})
const showDetail = ref(false)
const showEdit = ref(false)

const showEditForm = () => {
    showEdit.value = true
}

const fetchPost = async (page) => {
    await axios.get(`http://127.0.0.1:8000/api/post${'?page='+page}`)
        .then(res => {
            posts.value = res.data.posts
        })
        .catch(err => {
            console.log(err)
        })
}

fetchPost()

const fetchPostDetail = async (id) => {
    showEdit.value = false
    showDetail.value = false
    await axios.get(`http://127.0.0.1:8000/api/post/${id}`)
        .then(res => {
            postDetail.value = res.data.post
            showDetail.value = true
        })
        .catch(err => {
            console.log(err)
        })
}

const previousPage = () => {
    if (posts.value.current_page > 1) {
        fetchPost(posts.value.current_page - 1)
    }
}

const nextPage = () => {
    if (posts.value.current_page < posts.value.last_page) {
        fetchPost(posts.value.current_page + 1)
    }
}
</script>

<template>
  <div class="w-full relative">
    <div class="posts-wrapper flex items-center flex-wrap gap-5"
        :class="[
            'transform transition duration-200 ease-in-out',
            showDetail ? 'w-2/3' : 'w-full'
        ]"
    >
        <PostCard v-for="post in posts.data" :key="post.id" :post="post">
            <CustomButton text="Detail" primary @click="fetchPostDetail(post.id)"/>
        </PostCard>
        <div class="paginations flex items-center gap-5">
            <CustomButton text="Prev" primary @click="previousPage" :disabled="posts.current_page === 1"/>
            <h1>{{ posts.current_page }}</h1>
            <CustomButton text="Next" primary @click="nextPage" :disabled="posts.current_page === posts.last_page"/>
        </div>
    </div>
    <div class="w-1/3 p-10 pt-12 post-detail h-screen bg-white shadow-md fixed z-1 right-0 top-0 mt-[100px]"
        :class="[
            'transform transition duration-200 ease-in-out',
            showDetail ? 'translate-x-0' : 'translate-x-full'
        ]"
    >
        <CustomButton 
            text="Close" 
            @click="showDetail = false" 
            isDelete 
            primary
        />
        <PostDetail :post="postDetail" :showEdit="showEdit" @edit="showEditForm"/>
    </div>
  </div>
</template>

<style scoped>

</style>
