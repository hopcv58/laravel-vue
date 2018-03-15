<template>

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-5">
                        <h4 class="title-head">Danh sách sản phẩm</h4>
                        <router-link to="/product/add"><button class="btn btn-primary btn-xs">{{ $t("button.add") }}</button></router-link>
                    </div>
                    <div class="col-md-7">
                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group">
                                <input type="text" placeholder="nhập từ khóa" class="form-control" v-model.trim="keyword" v-on:keyup="autoComplete">
                                <button type="button" class="btn btn-default">{{ $t("menu.search") }}</button>
                                <span v-if="results.length > 0">
                                    <ul class="list-group result_search">
                                        <li class="list-group-item" v-for="result in results">{{ result.name }}</li>
                                    </ul>
                                </span>
                                <span v-else>

                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="panel-body" v-if="list_record.length > 0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ $t("product.name") }}</th>
                            <th>{{ $t("product.price") }}</th>
                            <th>{{ $t("product.color") }}</th>
                            <th>{{ $t("product.old") }}</th>
                            <th>{{ $t("product.created_at") }}</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in list_record">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.price }}</td>
                            <td>{{ item.color }}</td>
                            <td>{{ item.is_old == 1 ? $t("product.yes") : $t("product.no") }}</td>
                            <td>{{ item.created_at }}</td>
                            <td>
                                <button class="btn btn-success" :value="item.id" data-toggle="modal" data-target="#myModal2">!</button>
                                <button class="btn btn-danger" @click="deleteItem(index, item.id)" :value="item.id">X</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div>Hiển thị {{pagination.from}} đến {{pagination.to}} của {{pagination.total}} dữ liệu</div>
                <pagination v-bind:pagination="pagination" v-on:click.native="getRecord(pagination.current_page)" :offset="4"></pagination>
            </div>

            <div class="panel-body" v-else>
                <p>Không có dữ liệu</p>
            </div>
        </div>

    </div>

</template>

<script>

import Vue from 'vue'
import Pagination from '../../layouts/Pagination'
import axios from 'axios'

import VueValidation from 'simple-vue-validator'
Vue.use(VueValidation)
var Validator = VueValidation.Validator

export default {
    components: { Pagination },
    data () {
        return {
            data_detail: {
                email: null,
                username: null,
                phone: null,
            },
            keyword: null,
            results: [],
            list_record: [],
            counter: 0,
            isActive: false,
            pagination: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4
        }
    },
    
    mounted() {
        this.getRecord(this.pagination.current_page);
    },
    methods: {
        getRecord(page) {
            axios.get('product/show', {
                params: {
                    page: page
                }
            }).then(response => {
                this.list_record = response.data.data;
                this.pagination = response.data;
            }).catch(e => {
                this.errors.push(e);
            })
        },
        deleteItem(index, id) {
            this.$swal({
                title: 'Bạn chắc chắn muốn xóa?',
                text: "Dữ liệu sẽ bị xóa vĩnh viễn!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, xóa ngay !',
                cancelButtonText: 'Không !',
            }).then((result) => {
                if (result.value) {
                    axios.get('product/delete', {
                        params: {
                            id: id
                        }
                    }).then(response => {
                        if(response.data == 'OK') {
                            this.list_record.splice(index, 1);
                            this.$swal(
                                'Đã xóa !',
                                'Dữ liệu của bạn đã được xóa !',
                                'success'
                                )
                        } else {
                            this.$swal(
                                'Xóa thất bại', 
                                'Đã xảy ra lỗi trong quá trình xóa', 
                                'info'
                                )
                        }
                    }).catch(e => {
                        this.errors.push(e);
                    });
                }
            });
        },
        autoComplete(){
            if(this.keyword.length > 0){
                axios.get('product/search',{
                    params: {
                        keyword: this.keyword
                    }
                }).then(response => {
                    this.results = response.data;
                }).catch(e => {
                    this.errors.push(e)
                })
            } else {
                this.results = 0;
            }
        }
    }
}
</script>
