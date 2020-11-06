<template>
    <div><nav aria-label="Page navigation example">
      
  <ul class="pagination">
    <li class="page-item" :class="{'disabled':meta.current_page===1}" >
        <a class="page-link" href="#" @click.prevent="pageChange(meta.current_page-1)">Previous</a>
        </li>
    <li class="page-item" :class="{'active':meta.current_page===paginate}" v-for="paginate in meta.last_page">
        <a class="page-link" href="#" @click.prevent="pageChange(paginate)">{{paginate}}</a>
    </li>
 
    <li class="page-item" :class="{'disabled':meta.current_page===meta.last_page}">
        <a class="page-link" href="#"  @click.prevent="pageChange(meta.current_page+1)">Next</a>
        </li>
  </ul>
</nav></div>
</template>
<script>
export default {
    props:['meta'],
    data(){
        return{

        }
    },
    methods:{
        pageChange(page){
            this.$emit('pagination',page)
        }
    }
}
</script>