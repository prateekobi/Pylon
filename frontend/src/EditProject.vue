<template>
  <div class="editWrapper">
    <h2 class="editWrapper--heading">Edit: {{ title }}</h2>
    <div class="editWrapper--wrapper">
      Title:
      <input class="editWrapper--input" type="text" v-model="title" />
      system Details:
      <input class="editWrapper--input" type="text" v-model="systemDetails" />
      Site Latitude:
      <input class="editWrapper--input" type="number" v-model="lat" />
      Site Longitude:
      <input class="editWrapper--input" type="number" v-model="lon" />
      System Size *(leave blank for null):
      <input
        class="editWrapper--input"
        type="number"
        v-model="systemSize"
      />
      <button
        class="button is-info is-small"
        @click="updateRecord(title, lat, lon, systemSize)"
      >Save</button>
    </div>
  </div>
</template>

<script>
import { http } from "./api.js";
import axios from "axios";

export default {
  data() {
    return {
      project: null,
      title: "",
      systemDetails: "",
      lat: 0,
      lon: 0,
      systemSize: 0
    };
  },
  mounted() {
    this.fetchProjectDetails();
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
    async updateRecord(id, title) {
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
        .then(response => {
          console.log(response);
          this.$router.push(`/projects/${this.$route.params.project_id}`);
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
.editWrapper--wrapper {
  width: 25%;
}
.editWrapper--heading {
  font-weight: 600;
  margin-bottom: 20px;
}
input[type="text"],
input[type="number"] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 1px solid #555;
}
input[type="text"],
input[type="number"]:focus {
  outline: none;
  border: 3px solid #555;
}
</style>>