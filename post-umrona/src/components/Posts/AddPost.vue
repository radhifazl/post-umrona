<script setup>
import CustomInput from '../Inputs/CustomInput.vue';
import CustomButton from '../Buttons/CustomButton.vue';

import { ref } from 'vue';
import axios from 'axios';

const isLoading = ref(false)
const successMessage = ref(false)

const postForm = ref({
    title: '',
    author: '',
    content: ''
})

const submitNewPost = async () => {
    const { title, author, content } = postForm.value

    if(!title || !author || !content) {
        alert('Please fill all the fields')
        return
    } else {
        isLoading.value = true
        await axios.post('http://127.0.0.1:8000/api/post', postForm.value)
        .then(res => {
            isLoading.value = false
            console.log(res)
            successMessage.value = true
        }).catch(err => {
            successMessage.value = false
            isLoading.value = false
            console.log(err)
        }).finally(() => {
            setTimeout(() => {
                successMessage.value = false
            }, 3000)
        })
    }
}
</script>

<template>
    <div class="content h-full">
      <div class="w-full h-fit">
          <form method="post" @submit.prevent="submitNewPost">
            <div class="inp-box mb-3">
                <CustomInput name="title"
                    label="Title"
                    placeholder="Type post title here"
                    v-model="postForm.title"
                />
            </div>
            <div class="inp-box mb-3">
                <CustomInput name="author"
                    label="Author"
                    placeholder="Type post author here"
                    v-model="postForm.author"
                />
            </div>
            <div class="inp-box mb-3">
                <CustomInput name="content"
                    label="Content / Description"
                    placeholder="Type post content / description here"
                    v-model="postForm.content"
                />
            </div>
            <div class="inp-box mb-3 flex items-center gap-5">
                <CustomButton text="Create new post" type="submit" :loading="isLoading" primary/>
                <h1 v-if="successMessage">Berhasil membuat post baru</h1>
            </div>
          </form>
      </div>
    </div>
</template>

<style scoped>

</style>
