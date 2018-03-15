<template>

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-5">
                        <h4 class="title-head">Danh sách tài khoản</h4>
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">{{ $t("button.add") }}</button>
                    </div>
                    <div class="col-md-7">
                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group">
                                <input type="text" placeholder="nhập từ khóa" class="form-control" v-model.trim="keyword" v-on:keyup="autoComplete">
                                <button type="button" class="btn btn-default">{{ $t("menu.search") }}</button>
                                <span v-if="results.length > 0">
                                    <ul class="list-group result_search">
                                        <li class="list-group-item" v-for="result in results">{{ result.username }}</li>
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
                            <th>{{ $t("common.username") }}</th>
                            <th>{{ $t("common.email") }}</th>
                            <th>{{ $t("common.phone") }}</th>
                            <th>{{ $t("common.ip_address") }}</th>
                            <th>{{ $t("common.created_at") }}</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in list_record">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.username }}</td>
                            <td>{{ item.email }}</td>
                            <td>{{ item.phone }}</td>
                            <td>{{ item.ip_address }}</td>
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

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Thêm mới tài khoản</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="username" v-model.trim="data_detail.username">
                            <small class="form-group__message">{{ validation.firstError('data_detail.username') }}</small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="email" v-model.trim="data_detail.email">
                            <small class="form-group__message">{{ validation.firstError('data_detail.email') }}</small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="phone" v-model.trim="data_detail.phone">
                            <small class="form-group__message">{{ validation.firstError('data_detail.phone') }}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ $t("button.close") }}</button>
                        <button type="button" class="btn btn-primary" @click="save">{{ $t("button.add") }}</button>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Cập nhật dữ liệu</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="username" v-model.trim="data_detail.username">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="email" v-model.trim="data_detail.email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="phone" v-model.trim="data_detail.phone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ $t("button.close") }}</button>
                        <button type="button" class="btn btn-primary" @click="update">{{ $t("button.update") }}</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>

import Vue from 'vue'
import Pagination from '../layouts/Pagination'
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
    validators: {
        'data_detail.email': function(value) {
            return Validator.value(value).required('Bắt buộc nhập').email('Email không hợp lệ');
        },
        'data_detail.phone': function(value) {
            return Validator.value(value).required('Bắt buộc nhập');
        },
        'data_detail.username': function(value) {
            return Validator.value(value).required('Bắt buộc nhập');
        },
    },
    mounted() {
        this.getRecord(this.pagination.current_page);
    },
    methods: {
        getRecord(page) {
            axios.get('user/show', {
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
        save() {
            var that = this;
            this.$validate().then(function (success) {
                if(success) {
                    axios.post('user/add', {
                        data: that.data_detail
                    }).then(response => {
                        if(response.data == 'OK') {
                            that.data_detail.email = null;
                            that.data_detail.username = null;
                            that.data_detail.phone = null;

                            that.$swal({
                                title: 'Thành công !',
                                text: "Dữ liệu đã được thêm mới !",
                                type: 'success'
                            });
                        }
                    }).catch(e => {
                        that.errors.push(e);
                    })
                }
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
                    axios.get('user/delete', {
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
                                );
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
        update() {
            alert(1);
        },
        autoComplete(){
            if(this.keyword.length > 0){
                axios.get('user/search',{
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
