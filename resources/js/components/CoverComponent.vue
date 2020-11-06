<template>
    <div>
        <div class="row">
            <div class="card-body">
                <img :src="'/storage/'+userCover" width="100" height="100">
               
            <form @submit.prevent="updateCover" enctype="multipart/form-data" > 
                 <div class="form-group">
        
        <input type="file" name="image"  class="form-control" v-on:change="onImageChange">
        
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update</button>
        
    </div>
    </form>

            </div>

        </div>
    </div>
</template>
<script>
export default {
    props:['userid'],
    data(){
        return{
            image:'',
            userCover:''
        }
    },
    mounted(){
        
          this.getUserCover()
    },
    methods:{
         onImageChange(e){
             console.log(e)
             this.image= e.target.files[0];
        },
        updateCover(){
            const config={
                headers:{
                    "content-type" :"multipart/form-data"
                }
              
            }
            let formData=new FormData()
            formData.append('image',this.image)
            axios.post('/coverPic/update',formData,config)
            .then((response)=>{
                this.image='',
                this.getUserCover();
            })
            .catch((error)=>{
                alert(error)
            })
           
        },
        getUserCover(){
            axios.get('/coverPic/'+this.userid)
            .then((response)=>{
                this.userCover=response.data.substr(7)
            })
            .catch((error)=>{
                alert(error)
            })
        }
    }
}
</script>