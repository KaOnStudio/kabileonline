<template>
  <div class="hello">
    <h1>Welcome to {{ name }} 3.0</h1>
  </div>
</template>

<script>
  import remoting from '@/helpers/remoting';

  export default {
    name: 'hello',
    data() {
      return {
        name: 'hmmm',
      };
    },
    async created() {
      this.getTest()
    },
    methods: {
      async getTest() {
        const response = await remoting.test();
        this.name = response.data.name;
      },
    }
  };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  h1, h2 {
    font-weight: normal;
  }

  ul {
    list-style-type: none;
    padding: 0;
  }

  li {
    display: inline-block;
    margin: 0 10px;
  }

  a {
    color: #35495E;
  }
</style>
