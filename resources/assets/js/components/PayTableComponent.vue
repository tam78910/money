<template>
    <div>
        <div class="row" v-if="create">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">New Payment</div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="">
                            <div class="form-group" v-bind:class="errors.kind_id ? 'has-error' : ''">
                                <label for="kind_id" class="control-label col-md-2">Kind:</label>
                                <div class="col-md-8">
                                    <select v-model="pay.kind_id" name="kind_id" id="kind_id" class="form-control">
                                        <option v-for="kind in kinds" :value="kind.id"  :key="kind.id">{{ kind.name }}</option>
                                    </select>
                                    <span class="help-block" v-if="errors.kind_id">{{errors.kind_id[0] }}</span>
                                </div>
                            </div>
                            <div class="form-group" v-bind:class="errors.amount ? 'has-error' : ''">
                                <label for="amount" class="control-label col-md-2">Amount:</label>
                                <div class="col-md-8">
                                    <input v-model="pay.amount" name="amount" id="amount" class="form-control">
                                    <span class="help-block" v-if="errors.amount">{{errors.amount[0] }}</span>
                                </div>   
                            </div>
                            <div class="form-group" v-bind:class="errors.description ? 'has-error' : ''">
                                <label for="amount" class="control-label col-md-2">Description:</label>
                                <div class="col-md-8">
                                     <textarea v-model="pay.description" name="description" id="description" class="form-control"></textarea>
                                     <span class="help-block" v-if="errors.description">{{errors.description[0] }}</span>
                                </div>    
                            </div>
                            <div class="form-group">        
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" v-on:click="saveData()" class="btn btn-default">Save</button>
                                    <button type="button" v-on:click="create = false" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>                
            </div>       
        </div>
        <div class="display" v-if="!create">
            <div class="row">
            <div class="col-md-6">
                <button class="btn btn-success btn-sm" v-on:click="create = !create">New</button>
            </div>
            <div class="col-md-6">
                <div class="pagination">
                    <button class="btn btn-default" @click="getData(pagination.prev_page_url)"
                        :disabled="!pagination.prev_page_url">Previous
                    </button>
                    <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
                    <button class="btn btn-default" @click="getData(pagination.next_page_url)"
                            :disabled="!pagination.next_page_url">Next
                    </button>
                </div>
            </div> 
        </div>       
        <table class="table">
            <thead>
                <th>Date</th>
                <th>Kind</th>
                <th>Amount</th>
                <th>Description</th>
            </thead>
            <tbody>
                <tr v-for="pay in pays" :key="pay.id">
                    <td>{{ pay.date }}</td>
                    <td>{{ pay.kind.name }}</td>
                    <td>{{ pay.amount.toLocaleString('en') }}</td>
                    <td>{{ pay.description }}</td>
                </tr>
            </tbody>
        </table>
        </div>    
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                pays: [],
                pagination: {},
                create: false,
                kinds: {},
                kind: {},
                pay: {},
                errors: {}
            }
        },
        mounted: function() {
            this.getData();
            this.getKinds();
        },
        methods: {
            getData: function(url= route('api.pays.index')) {
                let vm = this;
                axios.get(url).then( function(res) {
                    vm.pays = res.data.data;
                    vm.makePagination(res.data);
                });
            },
            getKinds: function() {
                let url = route('api.pays.kinds');
                let vm = this;
                axios.get(url).then( function(res) {
                    vm.kinds = res.data;
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
            },
            saveData: function() {
                let url = route('api.pays.save');
                let vm = this;
                vm.errors = {};
                axios.post(url, this.pay).then(function(res) {
                    vm.create = false;
                    vm.getData();
                    vm.pay = {};    
                }).catch(function (er) {
                    let res = er.response;
                    if(res.status == 422) {
                        vm.errors = res.data.errors;  
                    }
                });
            }

        }
    }
</script>
