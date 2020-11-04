<template>
<div>
    <form @submit.prevent="albumCreate" enctype="multipart/form-data" v-if="!success"> 
    <div class="form-group">
        <label>Name of the Album</label>
        <input type="text" v-model="name" class="form-control" maxlength="20">
        <span v-if="allerrors.name" class="btn btn-danger">{{allerrors.name[0]}}</span>
    </div>
     <div class="form-group">
        <label>description</label>
        <textarea  v-model="description" class="form-control"  maxlength="200"></textarea>
        <span v-if="allerrors.description" class="btn btn-danger">{{allerrors.description[0]}}</span>
    </div>
  <div class="form-group">
        <label>Select Category</label>
        <select class="form-control" v-model="category" > 
            <option v-for="(category,index) in categories" :key="index" :value="category.id">
                {{category.name}}
            </option>
            <span v-if="allerrors.category" class="btn btn-danger">{{allerrors.category[0]}}</span>
        </select>
    </div>
     <div class="form-group">
        <label>Image</label>
        <input type="file" name="image"  class="form-control" v-on:change="onImageChange">
        <span v-if="allerrors.image" class="btn btn-danger">{{allerrors.image[0]}}</span>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Create</button>
        
    </div>
    </form>
    <div v-if="success">
        <a :href="'/create/image/'+albumId">Album Created.Click Here To Upload Photos</a>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return{
            name:'',
            description:'',
            category:'',
            image:'',
            categories:[],
            albumId:'',
            success:false,
            allerrors:''	

        }
    },
    created(){
        this.getCategory()
    },
    methods:{
        getCategory(){
            axios.get('/api/categories')
            .then((response) =>{
                this.categories=response.data
            })
            .catch((error)=>{
                alert('something wrong')
            })
        },
         onImageChange(e){
             console.log(e)
             this.image= e.target.files[0];
        },
        albumCreate(){
            const config={
                headers:{
                    "content-type" :"multipart/form-data"
                }
              
            }
            let formData=new FormData()
            formData.append('image',this.image)
            formData.append('name',this.name)
            formData.append('description',this.description)
            formData.append('category_id',this.category)
            axios.post('/albums/store',formData,config)
            .then((response) =>{
                this.image='',
                this.name='',
                this.description='',
                this.category='',
                this.albumId=response.data.id,
                this.success=true,
                console.log(response.data.id)

            })
            .catch((error)=>{
                console.log(error)
                this.allerrors=error.response.data.errors
            })

        }
    }
}
</script>