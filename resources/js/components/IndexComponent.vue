<template>
    <div>
      <table class="table table-image">
          <thead>
              <tr>
                  <th scope="col">Order</th>
                   <th scope="col">Name</th>
                    <th scope="col">Category</th>
                     <th scope="col">Image</th>
                      <th scope="col">Decription</th>
                      <th scope="col">Upload</th>
                      <th scope="col">View</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="(album,index) in albums" :key="album.id">
                  <td scope="row">{{index+1}}</td>
                  <td>{{album.name}}</td>
                  <td>{{album.category.name}}</td>
                  <td class="w-25"><img :src="'/album/'+album.image" class="img-fluid img-thumbnail"></td>
                  <td>{{album.description}}</td>
                     <td>
                     <a :href="'/create/image/'+album.id"> <button  type="button" class="btn btn-secondary">
                           Upload
                    </button></a>
                  </td>
                       <td>
                     <a :href="'/albums/'+album.slug+'/'+album.id"> <button  type="button" class="btn btn-dark">
                           view
                    </button></a>
                  </td>
                  <td>
                      <button @click.prevent="edit(album.id)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Edit
                    </button>
                  </td>
                   <td>
                      <button @click.prevent="deleteAlbum(album.id)" type="button" class="btn btn-danger">
                            Delete
                    </button>
                  </td>
              </tr>

          </tbody>

      </table>
      <edit :editrecord="records" @recordUpdate="recordUpdate"></edit>
      
    </div>
</template>
<script>
export default {
    data(){
        return{
            albums:[],
            records:[]
        }
    },
    created(){
        axios.get('/getalbums')
        .then((response)=>{
             this.albums=response.data
        })
        .catch((error)=>{
            console.log(error)
        })
    },
    methods:{
        edit(id){
            axios.get('/api/albums/'+id)
            .then((response)=>{
                this.records=response.data
            })
            .catch((error)=>{
            console.log(error)
        })
           
        },
        recordUpdate(response){
            this.albums=response.data
        },
        deleteAlbum(id){
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
                axios.delete('/albums/delete/'+id)
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