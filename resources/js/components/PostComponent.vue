<script>
    import axios from 'axios';

    export default {
       data() {
           return {
               posts: null
           }
       },
       mounted() {
           this.getPosts()
       },
       methods: {
           getPosts: function() {
            axios.get('api/posts')
                .then(res=>{
                    this.posts = res.data
                })
            }
       }
       
    }
</script>
