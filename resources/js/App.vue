<template>
  <div id="app">
    <div class="heading">
        <Post></Post>
    </div>

  </div>
</template>

<script>

import Post from './components/Post'

export default {
    name: 'App',
    components: {
        Post
    }
}
</script>