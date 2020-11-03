<template>
    <div>
        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form enctype="multipart/form-data" @submit.prevent="updateAlbum"> 
    <div class="form-group">
        <label>Name of the Album</label>
      
        <input type="text" name="name" v-model="editrecord.name" class="form-control" maxlength="20">
        
    </div>
     <div class="form-group">
        <label>description</label>
        <textarea  class="form-control" name="description" v-model="editrecord.description"  maxlength="200"></textarea>
        
    </div>
  <div class="form-group">
        <label>Select Category</label>
    
         <select class="form-control" v-model="editrecord.category_id" > 
            <option v-for="(category,index) in categories" :key="index" :value="category.id">
                {{category.name}}
            </option>
           
        </select>
    </div>
     <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" v-on:change="onImageChange" >
        
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update</button>
        
    </div>
    </form>
      </div>
    
    </div>
  </div>
</div>
    </div>
</template>

<script>
export default {
    props:['editrecord'],
    data(){
        return{
            categories:[],
            image:''

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
        updateAlbum(){
            const config={
                headers:{
                    "content-type" :"multipart/form-data"
                }
              
            }
            let formData=new FormData()
            formData.append('image',this.image)
            formData.append('name',this.editrecord.name)
            formData.append('description',this.editrecord.description)
            formData.append('category_id',this.editrecord.category_id)
            formData.append("_method","put")
            axios.post('/albums/'+this.editrecord.id+'/update',formData,config)
            .then((response)=>{
                $('#exampleModal').modal('hide')
                this.$emit('recordUpdate',response)
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Successfully Done',
                showConfirmButton: false,
                timer: 1500
                })
            })
            .catch((error)=>{
                console.log(error)
            })
        }
}
}
</script>