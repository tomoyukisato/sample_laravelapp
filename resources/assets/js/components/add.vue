<template>
  <div>
    <router-link :to="{name:'index'}">トップ</router-link>
    <form @submit.prevent="addBook">
      <div>
        <label>タイトル</label>
        <input type="text" v-model="title" />
      </div>
 
      <div>
        <label>著者</label>
        <input type="text" v-model="author" />
      </div>
 
      <button>追加</button>
    </form>
 
    <p v-if="message">{{ message }}</p>
  </div>
</template>
 
<script>
export default {
  data() {
    return {
      message: "",
      books: {},
      title: "",
      author: ""
    };
  },
  methods: {
    addBook() {
      axios
        .post("/api/books/", {
          title: this.title,
          author: this.author
        })
        .then(response => {
          this.$router.push({ name: "index" });
        })
        .catch(erorr => {
          this.message = erorr;
        });
    }
  }
};
</script>