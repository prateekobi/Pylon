<template>
  <div class="editWrapper">
    <h2>Edit: {{ title }}</h2>
    <div class="editWrapper--wrapper">
      Title:
      <input class="editWrapper--input" type="text" v-model="title" />
      system Details:
      <input class="editWrapper--input" type="text" v-model="systemDetails" />
      Site Latitude:
      <input class="editWrapper--input" type="text" v-model="lat" />
      Site Longitude:
      <input class="editWrapper--input" type="text" v-model="lon" />
    </div>
  </div>
</template>

<script>
import { http } from "./api.js";
export default {
  data() {
    return {
      project: null,
      title: "",
      systemDetails: "",
      lat: "",
      lon: ""
    };
  },
  mounted() {
    this.fetchProjectDetails();
  },
  methods: {
    async fetchProjectDetails() {
      let response = await http.get(
        "/solar_projects/" + this.$route.params.project_id
      );
      this.project = response.data.data;
      this.title = this.project.attributes.title;
      this.systemDetails = this.project.attributes.system_details;
      this.lat = this.project.attributes.site_latitude;
      this.lon = this.project.attributes.site_longitude;
    }
  }
};
</script>

<style scoped>
.editWrapper--wrapper {
  width: 25%;
}
input[type="text"] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 1px solid #555;
}
input[type="text"]:focus {
  outline: none;
  border: 3px solid #555;
}
</style>>