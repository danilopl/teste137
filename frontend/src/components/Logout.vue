<template>
  <div></div>
</template>
<script>
import axios from 'axios'

export default {
  props: [
    'Logout'
  ],
  methods: {
    logout (id, name){
      axios
        .get('http://backend.local/api/auth/logout')
        .then((response) => {
            localStorage.removeItem('authorization')
            this.$router.push({ path: '/' })
        });
    }
  },
  created() {
    this.logout();
  }
}
</script>