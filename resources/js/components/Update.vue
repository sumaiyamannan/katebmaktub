<template>
    <div class="container">
        <form>
            <div :class="['form-group m-1 p-3', successful ? 'alert-success' : '']">
                <span v-if="successful" class="label label-success">Updated!</span>
            </div>

            <div :class="['form-group m-1 p-3', error ? 'alert-danger' : '']">
            <span v-if="errors.first_name" class="label label-danger">
              {{ errors.first_name[0] }}
            </span>
                <span v-if="errors.body" class="label label-danger">
              {{ errors.body[0] }}
            </span>
                <span v-if="errors.author_image" class="label label-danger">
              {{ errors.author_image[0] }}
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
                <select class="form-control" id="status" ref="status">
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="reject">Reject</option>
                </select>
            </div>

            <button type="submit" @click.prevent="update" class="btn btn-primary block">
                Submit
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getAuthor();
        },
        props: {
            authorId: {
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
            update() {
                let first_name = this.$refs.first_name.value;
                let last_name = this.$refs.last_name.value;
                let body = this.$refs.body.value;
                let ISNI = this.$refs.ISNI.value;
                let date_of_birth = this.$refs.date_of_birth.value;
                let date_of_flourish = this.$refs.date_of_flourish.value;
                let email = this.$refs.email.value;
                let contact_number = this.$refs.contact_number.value;
                let author_image = this.$refs.author_image.files[0];
                let wikilink = this.$refs.wikilink.value;
                let status = this.$refs.status.value;

                axios
                    .put("/api/authors/" + this.authorId, { first_name, last_name, body, ISNI, date_of_birth, date_of_flourish, email, contact_number, author_image, wikilink, status})
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
                        }
                    });
            },
            getAuthor() {
                axios.get("/api/authors/" + this.authorId).then(response => {
                    this.$refs.first_name.value = response.data.data.first_name;
                    this.$refs.last_name.value = response.data.data.last_name;
                    this.$refs.body.value = response.data.data.body;
                    this.$refs.ISNI.value = response.data.data.ISNI;
                    this.$refs.date_of_birth.value = response.data.data.date_of_birth;
                    this.$refs.date_of_flourish.value = response.data.data.date_of_flourish;
                    this.$refs.email.value = response.data.data.email;
                    this.$refs.contact_number.value = response.data.data.contact_number;
                    this.$refs.author_image.value = "";
                    this.$refs.wikilink.value=response.data.data.wikilink;
                    this.$refs.status.value=response.data.data.status;

                });
            }
        }
    };
</script>
