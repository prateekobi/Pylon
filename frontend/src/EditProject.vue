<template>
  <div class="editWrapper level">
    <div class="editWrapper--wrapper level-left column">
      <h2 class="editWrapper--heading level-left">Edit: {{ title }}</h2>Title:
      <input class="input editWrapper--input" type="text" v-model="title" />
      system Details:
      <input
        class="input editWrapper--input"
        type="text"
        v-model="systemDetails"
      />
      Site Latitude:
      <input class="input editWrapper--input" type="number" v-model="lat" />
      Site Longitude:
      <input class="input editWrapper--input" type="number" v-model="lon" />
      System Size *(leave blank for null):
      <input
        class="input editWrapper--input"
        type="number"
        v-model="systemSize"
      />
      <button class="button is-info" @click="updateRecord()">Save</button>
    </div>
    <div class="column level-right">
      <contact-card
        v-for="contact in contacts"
        :key="contact.id"
        :contact="contact"
        :show="true"
        @delete="removeContact"
        @edit="editContact"
        class="view-project__contact"
        @first="firstName = $event"
        @last="lastName = $event"
        @email="email = $event"
      />
    </div>
  </div>
</template>

<script>
import { http } from "./api.js";
import axios from "axios";
import ContactCard from "./ContactCard.vue";

export default {
  components: {
    ContactCard
  },
  data() {
    return {
      // Project data
      project: null,
      contacts: [],
      title: "",
      systemDetails: "",
      lat: 0,
      lon: 0,
      systemSize: 0,
      firstName: "",
      lastName: "",
      email: ""
    };
  },
  mounted() {
    this.fetchProjectDetails();
    this.fetchProjectContacts();
  },
  methods: {
    async fetchProjectDetails() {
      let response = await http.get(
        `/solar_projects/${this.$route.params.project_id}`
      );
      this.project = response.data.data;
      this.title = this.project.attributes.title;
      this.lat = this.project.attributes.site_latitude;
      this.lon = this.project.attributes.site_longitude;
      this.systemSize = this.project.attributes.system_size;
      this.systemDetails = this.project.attributes.system_details;
    },
    async fetchProjectContacts() {
      this.contacts = [];
      let response = await http.get(
        "/solar_projects/" + this.$route.params.project_id + "/contacts"
      );
      response.data.data.forEach(async contact => {
        let response = await http.get("/contacts/" + contact.id);
        this.contacts.push(response.data.data);
      });
    },
    async updateRecord() {
      await axios
        .patch(
          `http://0.0.0.0:11111/api/solar_projects/${this.$route.params.project_id}`,
          {
            title: this.title,
            site_latitude: this.lat,
            site_longitude: this.lon,
            system_size: this.systemSize,
            system_details: this.systemDetails
          }
        )
        .then(() => {
          this.$router.push(`/projects/${this.$route.params.project_id}`);
          alert("Success, project updated!");
        });
    },
    removeContact(id) {
      axios.delete(`http://0.0.0.0:11111/api/contacts/${id}`).then(() => {
        let index = this.contacts.findIndex(contact => contact.id === id);
        this.contacts.splice(index, 1);
      });
    },
    editContact(id) {
      var self = this;
      axios
        .put(`http://0.0.0.0:11111/api/contacts/${id}`, {
          first_name: this.firstName,
          last_name: this.lastName,
          email: this.email
        })
        .then(() => {
          console.log("here", this.contact);
          alert("Contact edited!");
        });
    }
  }
};
</script>

<style scoped>
.editWrapper {
  margin: 30px 0 30px 0;
}
.editWrapper--heading {
  font-weight: 600;
  margin-bottom: 20px;
}
.input {
  margin-bottom: 20px;
}
.view-project__contact {
  margin-left: 20px;
}
</style>>