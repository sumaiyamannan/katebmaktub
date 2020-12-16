<template>
    <div class="container">
        <form>
            <div :class="['form-group m-1 p-9', (successful ? 'alert-success' : '')]">
                <span v-if="successful" class="label label-success">Published!</span>
            </div>
            <div :class="['form-group m-1 p-9', error ? 'alert-danger' : '']">
                <span v-if="errors.first_name" class="label label-danger">
                  {{ errors.first_name[0] }}
                </span>
                <span v-if="errors.last_name" class="label label-danger">
                  {{ errors.last_name[0] }}
                </span>
                <span v-if="errors.body" class="label label-danger">
                  {{ errors.body[0] }}
                </span>
                <span v-if="errors.ISNI" class="label label-danger">
                  {{ errors.ISNI[0] }}
                </span>
                <span v-if="errors.date_of_birth" class="label label-danger">
                  {{ errors.date_of_birth[0] }}
                </span>
                <span v-if="errors.date_of_flourish" class="label label-danger">
                  {{ errors.date_of_flourish[0] }}
                </span>
                <span v-if="errors.email" class="label label-danger">
                  {{ errors.email[0] }}
                </span>
                <span v-if="errors.contact_number" class="label label-danger">
                  {{ errors.contact_number[0] }}
                </span>
                <span v-if="errors.author_image" class="label label-danger">
                  {{ errors.author_image[0] }}
                </span>
                <span v-if="errors.wikilink" class="label label-danger">
                  {{ errors.wikilink[0] }}
                </span>
                <span v-if="errors.status" class="label label-danger">
                  {{ errors.status[0] }}
                </span>
            </div>

            <div class="form-group">
                <input type="text" ref="first_name" class="form-control" id="first_name" placeholder="Enter First Name" required>
            </div>

            <div class="form-group">
                <input type="text" ref="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" required>
            </div>

            <div class="form-group">
                <textarea class="form-control" ref="body" id="body" placeholder="Enter a body" rows="8" required></textarea>
            </div>

            <div class="form-group">
                <input type="text" ref="ISNI" class="form-control" id="ISNI" placeholder="Enter ISNI" required>
            </div>

            <div class="form-group">
                <input type="date" ref="date_of_birth" class="form-control" id="date_of_birth" placeholder="Enter Date of Birth" required>
            </div>

            <div class="form-group">
                <input type="date" ref="date_of_flourish" class="form-control" id="date_of_flourish" placeholder="Enter Date of Flourish" required>
            </div>

            <div class="form-group">
                <input type="text" ref="email" class="form-control" id="email" placeholder="Enter Email" required>
            </div>

            <div class="form-group">
                <input type="text" ref="contact_number" class="form-control" id="contact_number" placeholder="Enter Contact Number" required>
            </div>

            <div class="custom-file mb-3">
                <input type="file" ref="author_image" name="author_image" class="custom-file-input" id="author_image" required>
                <label class="custom-file-label" >Choose file...</label>
            </div>

            <div class="form-group">
                <input type="text" ref="wikilink" class="form-control" id="wikilink" placeholder="Enter Wikipedia Link" >
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <!--  <input type="text" ref="status" class="form-control" id="status" placeholder="Enter Status" required>-->
                <select class="form-control" id="status" ref="status">
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="reject">Reject</option>
                </select>
              </div>

              <button type="submit" @click.prevent="create" class="btn btn-primary block">
                  Submit
              </button>
          </form>
      </div>
  </template>

  <script>
      export default {
          props: {
              userId: {
                  type: Number,
                  required: true
              }
          },
          data() {
              return {
                  error: false,
                  successful: false,
                  errors: []
              };
          },
          methods: {
              create() {
                  const formData = new FormData();
                  formData.append("first_name", this.$refs.first_name.value);
                  formData.append("last_name", this.$refs.last_name.value);
                  formData.append("body", this.$refs.body.value);
                  formData.append("ISNI", this.$refs.ISNI.value);
                  formData.append("date_of_birth", this.$refs.date_of_birth.value);
                  formData.append("date_of_flourish", this.$refs.date_of_flourish.value);
                  formData.append("email", this.$refs.email.value);
                  formData.append("contact_number", this.$refs.contact_number.value);
                  formData.append("user_id", this.userId);
                  formData.append("author_image", this.$refs.author_image.files[0]);
                  formData.append("wikilink", this.$refs.wikilink.value);
                  formData.append("status", this.$refs.status.value);
                  axios
                      .post("/api/authors", formData)
                      .then(response => {
                          this.successful = true;
                          this.error = false;
                          this.errors = [];
                      })
                      .catch(error => {
                          if (!_.isEmpty(error.response)) {
                              if ((error.response.status = 422)) {
                                  this.errors = error.response.data.errors;
                                  this.successful = false;
                                  this.error = true;
                              }
                              if ((error.response.status = 500)) {
                                  this.errors = error.response.data.errors;
                                  this.successful = false;
                                  this.error = true;
                              }
                          }
                      });

                  this.$refs.first_name.value = "";
                  this.$refs.last_name.value = "";
                  this.$refs.body.value = "";
                  this.$refs.ISNI.value = "";
                  this.$refs.date_of_birth.value = "";
                  this.$refs.date_of_flourish.value = "";
                  this.$refs.email.value = "";
                  this.$refs.contact_number.value = "";
                  this.$refs.wikilink.value = "";
                  this.$refs.status.value = "";
              }
          }
      };
  </script>
