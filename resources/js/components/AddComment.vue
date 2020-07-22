<template>
    <div>
    <button v-if="parent.depth < 2" class="text-left d-inline-block btn btn-primary btn-sm bbtin" @click="showComment(!primary_comment)"><i class="fa fa-thumbs-up" aria-hidden="true"></i>{{ parent.btntxt }}</button>
    <div v-if="primary_comment == 1">
        <input type="text" v-model="name" placeholder="Name" class="form-control">
        <textarea v-model="body" class="d-inline-block form-control" placeholder="Add comment  . . ."></textarea>
        <button class="ml-auto d-block btn btn-primary btn-large" @click="addComment()">Comment</button>
    </div>

        <div v-if="parent.id !== 0" style="width: 95%; margin-left: auto; display: block">
            <div v-for="reply in replies" :key="reply.id">
                <strong v-html="reply.name"></strong>
                <i>{{ reply.created_at | moment("MMMM Do YYYY h:mm:ss a") }}</i>
                <p class="content_content" v-html="reply.body"></p>
                <AddComment :parent="{id: reply.id, btntxt: 'Reply', depth: parent.depth+1}"></AddComment>
            </div>
        </div>   
    </div>
</template>

<script>

import AddComment from './AddComment'

export default {
    name: 'AddComment',
    props:{
        parent: {
            id: {
                type: Number,
                default: NaN
            },
            depth: {
                type: Number
            },
            btntxt: {
                type: String
            }
        }
        
    },
    data: function() {
        return {
            body: null,
            name: null,
            replies: {},
            primary_comment: 0
        }
    },
    components: {
        AddComment
    },
    methods: {
        addComment() {
            // create a comment to this post
            this.$store.dispatch('comment/addComment', {
                parent_id: this.parent.id,
                body: this.body,
                name: this.name
            }).then(response => {
                // null the body and name fields
                this.body = null;
                this.name = null;
                

                this.$emit('pull-comments', true);
                this.callComments(); // call again all the comments with its proper base layer
            });
            
        },
        showComment(post_id) {
            this.primary_comment = post_id;
        },
        callComments() {
            this.$store.dispatch('comment/pullComments', {parent_id: this.parent.id}).then(data => {
                this.replies = data.data;
            });
        }
    },
    mounted: function() {

        // added timeout so it wont cause too much request to the server side
        let self = this;
        setTimeout(function(){ 
            self.callComments(); 
        }, 2000);
        
    }
}
</script>

<style lang="scss" scoped>
    textarea{
        resize: none;
        margin-top: 10px;
        margin-left: auto;
        display: block!important;
        margin-top: 20px;
        padding: 10px;
    }

    button {
        margin-top: 10px;
    }

    .bbtin {
        margin-top: -10px;
        margin-bottom: 20px;
    }

    
</style>