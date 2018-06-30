<template>
    <div>
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
                pays: []
            }
        },
        mounted: function() {
           this.getData();     
        },
        methods: {
            getData: function() {
                let url = route('api.pays.index');
                let vm = this;
                axios.get(url).then( function(res) {
                    vm.pays = res.data;            
                });
            }
        }
    }
</script>
