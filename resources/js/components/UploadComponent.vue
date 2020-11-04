<template>
    <div>
        <form enctype="multipart/form-data" method="post">
        <div class="form-group files text-center" ref="fileform">
            <input type="file" multiple="multiple" ref="file">
            <span id="val"></span>
            <a class="btn btn-success" @click.prevent="uploadFiles">Upload</a>

        </div>

        </form>
        <progress max="100" style="width:100%" :value.prop="uploadPercentage" v-if="uploading"></progress>

        <div class="container">
            <hr class="mt-2 mb-5">
            <div class="row text-center text-lg-left">
                <div class="col-lg-3 col-md-4 col-6" v-for="(image,index) in images" :key="index">
                    <a href="#">
                       <img :src="'/images/'+image.image" class="img-fluid img-thumbnail">
                       <span>👍 😃 😍 😥 </span> 
                        <button class="btn btn-danger btn-sm" @click.prevent="deleteImage(image.id)">Delete </button>
                    </a>
                    
                </div>

            </div>

        </div>
    </div>
</template>
<script>
export default {
    props:['album_id'],
    data(){
        
        return{
           
            uploadPercentage:'',
            uploading:false,
            images:[],

        }
    },
    mounted(){
        this.getImages()
    },
    methods:{
        uploadFiles(){
         
            let formData=new FormData()
            for(var i=0;i<this.$refs.file.files.length;i++){
                let file=this.$refs.file.files[i]
                formData.append('files['+']',file)
                formData.append('album_id',this.album_id)
            }
            this.uploading=true;
            this.$refs.file.value=''
            axios.post('/upload/image',formData,{
                 headers:{
                    "content-type" :"multipart/form-data"
                },
                onUploadProgress:function(progressEvent){
                    this.uploadPercentage=parseInt(Math.round((progressEvent.loaded*100)/progressEvent.total));
                }.bind(this)
            })
            .then((response)=>{
               this.getImages()

            })
        },
        getImages(){
            axios.get('/get/images')
            .then((response)=>{
                this.images=response.data
            })
            .catch((error)=>{
                alert(error)
            })
        },
        deleteImage(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            })
            .then((result)=>{
                if(result.value){
                axios.delete('/deleteImage/'+id)
                .then((response)=>{
                     Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Successfully Done',
                showConfirmButton: false,
                timer: 1500
                })
                this.albums=response.data
                })
                .catch((error)=>{
                    console.log(error)
                })
                }
            })
          
        }
    }
}
</script>