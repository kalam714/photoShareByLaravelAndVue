<template>
    <div>
        <button class="btn btn-primary ml-4" @click.prevent="followUser" v-text="textButton">

        </button>

    </div>
</template>
<script>
export default {
    props:['userId','follows'],
    data(){
        return {
            status:this.follows,

        }
    },
    methods:{
        followUser(){
            axios.post('/follow',{
                userId:this.userId
            })
            .then((response)=>{
                this.status=!this.status
            })
           .catch((error)=>{
               alert('error')
           })
        }

    },
    computed:{
        textButton(){
            return (this.status) ? 'Unfollow' : 'Follow';
        }

    }
}
</script>