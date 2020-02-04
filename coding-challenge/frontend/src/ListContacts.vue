<template>
  <div class="list-contacts">
    <pagination v-if="pagination !== null" :data="pagination" v-model="page" @input="fetchContacts" />

    <div v-if="contacts !== null">
      <table class="table is-fullwidth">
        <tbody>
          <tr v-for="contact in contacts" :key="contact.id">
            <td>{{contact.attributes.first_name}}</td>
            <td>{{contact.attributes.last_name}}</td>
            <td>{{contact.attributes.email}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style>
.list-contacts {
  padding: 1rem;
}
</style>

<script>
import axios from 'axios'; // Import axios
import Pagination from './Pagination.vue';

export default {
  components: {
    Pagination,
  },

  data() {
    return {
      page: 1,
      pagination: null,
      contacts: null,
    };
  },

  mounted() {
    this.fetchContacts();
  },

  methods: {
    fetchContacts() {
      this.contacts = null;
      let contacts = [];
      let params = { page: this.page };

      // Changed to axios
      axios.get('http://0.0.0.0:11111/api/contacts', { params }).then(response => {
        this.pagination = response.data.meta;
        response.data.data.forEach(contact => {
          axios.get(`http://0.0.0.0:11111/api/contacts/${contact.id}`).then(response => {
            contacts.push(response.data.data);
          });
        });
      });

      // Set time out to .5 seconds to avoid jump (sets this.contacts once data has been loaded) - Easiest solution :) 
      // Would rather use vuex store
      setTimeout(() => {
        this.contacts = contacts;
      }, 500);
    }
  },
}
</script>
