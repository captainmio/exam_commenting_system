<template>
    <div>
      <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center pt-3">Commenting System</h1>

                    <div class="card" v-for="post in posts" :key="post.id">
                        <div v-if="post.title" class="card-header">
                            {{ post.title }}
                        </div>

                        <div class="card-body">
                            {{ post.body }}
                            <br><br>
                            <AddComment :parent="{id: 0, btntxt: 'Add comment', depth: 0}" @pull-comments="callComments"></AddComment>

                            <h3>Comments</h3>
                            <div v-for="comment in comments" :key="comment.id">
                                <strong v-html="comment.name"></strong>
                                <i>{{ comment.created_at | moment("MMMM Do YYYY h:mm:ss a") }}</i>
                                <p class="content_content" v-html="comment.body"></p>
                                <AddComment :parent="{id: comment.id, btntxt: 'Reply', depth: 0}"></AddComment>
                            </div>  
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import AddComment from './AddComment'

export default {
    name: 'Post',
    data: function() {
        return {
            posts: [{
                id: 1,
                title: 'This is the first post',
                body: 'Proident mollit ullamco sunt velit ullamco ex nostrud nulla enim ea dolore magna. Id aliqua nulla velit sint consequat est id ut anim. Eu consequat consectetur ad mollit consequat aliquip voluptate laboris. Irure amet nulla tempor veniam in. Lorem eiusmod excepteur pariatur laborum labore exercitation cillum sit nisi do tempor culpa excepteur. Quis elit Lorem cillum non ut incididunt dolor minim id veniam. Ad duis eu adipisicing irure in et laborum culpa est non ut cupidatat sit.'
            }],
            comments:{},
            primary_comment: 0
        }
    },
    components: {
        AddComment
    },
    methods: {
        // pull all base comments(base layer)
        callComments() {
            this.$store.dispatch('comment/pullComments', {parent_id: 0}).then(data => {
                this.comments = data.data;
            });
        },
        // this is to toggle reply/add comment button to hide/show the comment box
        showComment(post_id) {
            this.primary_comment = post_id;
        }
    },
    mounted: function() {
        this.callComments();
    }
}
</script>

<style lang="scss" scoped>
    .card {
        .card-header {
            font-size: 20px;
        }
    }
</style>