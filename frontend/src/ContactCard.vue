<template>
  <div class="box">
    <div class="level is-mobile">
      <div class="level-left">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="feather feather-user"
        >
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
          <circle cx="12" cy="7" r="4" />
        </svg>
        <span
          class="margin-left-2"
        >{{contact.attributes.first_name}} {{contact.attributes.last_name}}</span>
      </div>
    </div>

    <div class="level is-mobile">
      <div class="level-left">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="feather feather-mail"
        >
          <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
          <polyline points="22,6 12,13 2,6" />
        </svg>
        <span class="margin-left-2">{{contact.attributes.email}}</span>
        <input type="text" v-model="contact.attributes.email" v-show="edit" />
      </div>
      <div class="button-container">
        <button class="button is-info" @click="editContact">Edit</button>
        <button class="button is-danger" @click="remove">Delete</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      edit: false
    };
  },
  props: {
    contact: {
      required: true
    }
  },
  methods: {
    remove() {
      this.$emit("delete", this.contact.id); // Emit remove method to ViewProject.vue
    },
    editContact() {
      this.edit = !this.edit;
    }
  }
};
</script>

<style>
.button-container {
  text-align: right;
}
.is-info {
  margin-right: 20px;
}
</style>>
