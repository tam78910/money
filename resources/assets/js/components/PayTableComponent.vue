<template>
    <div>
        <div class="pagination">
            <button class="btn btn-default" @click="getData(pagination.prev_page_url)"
                    :disabled="!pagination.prev_page_url">
                Previous
            </button>
            <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
            <button class="btn btn-default" @click="getData(pagination.next_page_url)"
                    :disabled="!pagination.next_page_url">Next
            </button>
        </div>
        <table class="table">
            <thead>
                <th>Date</th>
                <th>Kind</th>
                <th>Amount</th>
                <th>Description</th>
            </thead>
            <tbody>
                <tr v-for="pay in pays">
                    <td>{{ pay.date }}</td>
                    <td>{{ pay.kind.name }}</td>
                    <td>{{ pay.amount.toLocaleString('en') }}</td>
                    <td>{{ pay.description }}</td>
                </tr>
            </tbody>
         </table>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                pays: [],
                pagination: {}
            }
        },
        mounted: function() {
            let url = route('api.pays.index');
            this.getData(url);n
        },
        methods: {
            getData: function(url) {

                let vm = this;
                axios.get(url).then( function(res) {
                    vm.pays = res.data.data;
                    vm.makePagination(res.data);
                });
            },
            makePagination: function(data) {
                let pagination = {
                    current_page: data.meta.current_page,
                    last_page: data.meta.last_page,
                    next_page_url: data.links.next,
                    prev_page_url: data.links.prev
                }
                this.pagination = pagination;
            }
        }
    }
</script>
