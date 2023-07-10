<script setup>
import DetailTitle from './DetailTitle.vue';
import CustomButton from '../Buttons/CustomButton.vue';
import CustomInput from '../Inputs/CustomInput.vue';
import moment from 'moment';
import axios from 'axios';
import { onMounted, ref } from 'vue';

const props = defineProps({
    post: {
        type: Object,
        required: true
    },
    showEdit: {
        type: Boolean,
        default: false,
        required: true
    }
})

const isLoading = ref(false)
const successMessage = ref(false)

const editForm = ref({
    title: '',
    author: '',
    content: ''
})

const date = moment(props.post.created_at).format('YYYY-MM-DD HH:mm')

const deletePost = async (id) => {
    if(window.confirm('Are you sure you want to delete this post?')) {
        await axios.delete(`http://127.0.0.1:8000/api/post/${id}`)
            .then(res => {
                console.log(res)
                window.location.reload()
            })
            .catch(err => {
                console.log(err)
            })
    } 
}

const editPost = async (id) => {
    isLoading.value = true
    if(window.confirm('Are you sure you want to edit this post?')) {
        await axios.put(`http://127.0.0.1:8000/api/post/${id}`, {
            title: editForm.value.title ? editForm.value.title : props.post.title,
            author: editForm.value.author ? editForm.value.author : props.post.author,
            content: editForm.value.content ? editForm.value.content : props.post.content
        }).then(res => {
            console.log(res)
            successMessage.value = true
            isLoading.value = false
            window.location.reload()
        })
        .catch(err => {
            console.log(err)
            isLoading.value = false
        })
    }
}
</script>

<template>
    <div class="post-detail-wrapper my-5 relative h-3/4">
        <div class="detail-box mb-3" v-if="showEdit === false">
            <DetailTitle detail="Date"/>
                <p>{{ date}}</p>
        </div>

        <div class="detail-wrapper" v-if="showEdit === false">
            <div class="detail-box mb-3">
                <DetailTitle detail="Title"/>
                <p>{{ post.title }}</p>
            </div>
            <div class="detail-box mb-3">
                <DetailTitle detail="Author"/>
                <p>{{ post.author }}</p>
            </div>
            <div class="detail-box mb-3">
                <DetailTitle detail="Description"/>
                <p>{{ post.content }}</p>
            </div>
        </div>

        <div class="detail-edit" v-else>
          <form method="post" @submit.prevent="editPost(post.id)">
            <div class="inp-box mb-3">
                <CustomInput name="title"
                    label="Title"
                    :placeholder="post.title"
                    v-model="editForm.title"
                />
            </div>
            <div class="inp-box mb-3">
                <CustomInput name="author"
                    label="Author"
                    :placeholder="post.author"
                    v-model="editForm.author"
                />
            </div>
            <div class="inp-box mb-3">
                <CustomInput name="content"
                    label="Content / Description"
                    :placeholder="post.content"
                    v-model="editForm.content"
                />
            </div>
            <div class="inp-box mb-3 flex items-center gap-5">
                <CustomButton text="Edit Post" type="submit" :loading="isLoading" primary/>
                <h1 v-if="successMessage">Berhasil edit</h1>
            </div>
          </form>
        </div>

        <div class="detail-action absolute bottom-5 left-0 flex items-center gap-3" v-if="showEdit === false">
            <CustomButton text="Edit" primary @click="$emit('edit')"/>
            <CustomButton text="Delete" primary isDelete @click="deletePost(post.id)"/>
        </div>
    </div>
</template>