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
          v-if="!show"
          class="margin-left-2"
        >{{contact.attributes.first_name}} {{contact.attributes.last_name}}</span>
        <input
          v-if="show"
          type="text"
          class="input name is-small"
          v-model="contact.attributes.first_name"
          @input="$emit('first', $event.target.value)"
        />
        <input
          v-if="show"
          type="text"
          class="input name is-small"
          v-model="contact.attributes.last_name"
          @input="$emit('last', $event.target.value)"
        />
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
        <span v-if="!show" class="margin-left-2">{{contact.attributes.email}}</span>
        <input
          v-if="show"
          type="text"
          class="input is-small"
          v-model="contact.attributes.email"
          @input="$emit('email', $event.target.value)"
        />
      </div>
      <button v-if="show" class="button is-info" @click="editContact">Edit</button>
      <button v-if="show" class="button is-danger" @click="removeContact">Delete</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    contact: {
      required: true
    },
    show: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    removeContact() {
      this.$emit("delete", this.contact.id); // Emit removeContact method to EditProject.vue
    },
    editContact() {
      this.$emit("edit", this.contact.id); // Emit editContact method to EditProject.vue
    }
  }
};
</script>
<style scoped>
.input {
  width: 300px;
  margin-left: 10px;
}
input.name {
  width: 200px;
}
</style>