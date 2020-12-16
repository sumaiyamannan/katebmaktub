<template>
    <div id="authors">
        <!-- below result.url is using with 'authorId as in model 'Author' the 'url' variable is passing id -->
        <!-- Search Bar -->
        <div class="form-group">
            <input type="text" placeholder="Search" v-model="query" class="form-control">
        </div>
        <div class="form-group">
        <ul v-if="results.length > 0 && query" class="list-group">
            <li v-for="result in results.slice(0,10)" :key="result.id" class="list-group-item">
                <router-link :to="{ name: 'update', params: { authorId : result.url } }">
                    <div v-text="result.title"></div>
                </router-link>
            </li>
        </ul>
        </div>

        <!-- Table with Author Listing -->
        <table class="table">
            <thead>
            <tr>
                <th scope="col" @click="sortByColumn('id')">#</th>
                <th scope="col" @click="sortByColumn('first_name')">First Name</th>
                <th scope="col" @click="sortByColumn('last_name')">Last Name</th>
                <th scope="col" @click="sortByColumn('created_at')">Created</th>
                <th scope="col" @click="sortByColumn('status')">Status</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr class="border p-3" v-for="author in laravelData.data">
                <th scope="row">{{ author.id }}</th>
                <td>{{ author.first_name }}</td>
                <td>{{ author.last_name }}</td>
                <td>{{ author.created_at }}</td>
                <td>{{ author.status }}</td>
                <td>
                    <router-link :to="{ name: 'update', params: { authorId : author.id } }">
                        <button type="button" class="p-1 mx-3 float-right btn btn-light">
                            Update
                        </button>
                    </router-link>
                </td>
                <td>
                    <button
                        type="button"
                        @click="deleteAuthor(author.id)"
                        class="p-1 mx-3 float-right btn btn-danger"
                    >
                        Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>


        <pagination :data="laravelData" @pagination-change-page="getAuthors"></pagination>


<!--
        <div>
            <button
                v-if="next"
                type="button"
                @click="navigate(next)"
                class="m-3 btn btn-primary"
            >
                Next
            </button>
            <button
                v-if="prev"
                type="button"
                @click="navigate(prev)"
                class="m-3 btn btn-primary"
            >
                Previous
            </button>
        </div>
        -->
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getAuthors();
        },
        data() {
            return {
                authors: {},
                next: null,
                prev: null,
                query: null,
                results: [],
                sortedColumn: "id",
                order: "asc",
                laravelData: {} //pagination
            };
        },
        watch:{
            query(after, before) {
                this.searchAuthors();
            }
        },
        methods: {
            getAuthors(page = 1) {

              //  let myurl = `/api/authors?column=${this.sortedColumn}&order=${this.order}&page=` + page; //another way of incorporating variables in stringphp
                let myurl = '/api/authors?column=' + this.sortedColumn + '&order=' + this.order + '&page=' + page;
                axios.get(myurl).then(response => {
                   // this.authors = response.data.data; //not required as rendering data via pagination in laravel-vue-pagination
                    this.laravelData = response.data;

                });
            },
            deleteAuthor(id) {
                axios.delete("/api/authors/" + id).then(response => this.getAuthors())
            },
            navigate(address) {
                this.getAuthors(address)
            },
            searchAuthors() {
                axios.get('/search/', { params: { query: this.query } }).then(response =>
                    this.results = response.data)
                    .catch(error => {});
            },
            sortByColumn(column) {
                if (column === this.sortedColumn) {
                    this.order = (this.order === 'asc') ? 'desc' : 'asc'
                } else {
                    this.sortedColumn = column
                    this.order = 'asc'
                }
                this.getAuthors()
            },
        }
    };
</script>
