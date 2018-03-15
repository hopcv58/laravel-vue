<template>
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="title-head">Thêm mới sản phẩm</h4>
				<router-link to="/product"><button class="btn btn-primary btn-xs">{{ $t("button.list") }}</button></router-link>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="">Tên</label>
					<input type="text" class="form-control" placeholder="tên sản phẩm" v-model.trim="data_detail.name">
					<small class="form-group__message">{{ validation.firstError('data_detail.name') }}</small>
				</div>
				<div class="form-group">
					<label for="">Giá bán</label>
					<input type="text" class="form-control" placeholder="giá sản phẩm" v-model.trim="data_detail.price">
					<small class="form-group__message">{{ validation.firstError('data_detail.price') }}</small>
				</div>
				<div class="form-group">
					<label for="">Hình ảnh</label>
					<span v-if="!data_detail.image">
						<input type="file" class="form-control btn btn-primary" @change="onFileChange">
						<small class="form-group__message">{{ validation.firstError('data_detail.image') }}</small>
					</span>
					<span v-else>
						<br>
						<img :src="data_detail.image" width="100px">
						<button type="button" class="btn btn-danger" @click="removeImage">{{ $t("button.delete") }}</button>
					</span>
					
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<select class="form-control" id="sel1" v-model="data_detail.color">
								<option disabled value="">Chọn màu sắc</option>
								<option>Đen</option>
								<option>Vàng</option>
								<option>Trắng</option>
								<option>Đỏ</option>
							</select>
							<small class="form-group__message">{{ validation.firstError('data_detail.color') }}</small>
						</div>
						<div class="col-md-6">
							<input type="checkbox" v-model="data_detail.is_old"> Sản phẩm cũ
						</div>
					</div>
					
				</div>

				<button type="button" class="btn btn-primary" @click="save">{{ $t("button.add") }}</button>

			</div>
		</div>
	</div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'

import VueValidation from 'simple-vue-validator'
Vue.use(VueValidation)
var Validator = VueValidation.Validator

export default {
	data() {
		return {
			data_detail : {
				name: null,
				price: null,
				color: '',
				is_old: false,
				image: ''
			},
			file: null
		}
	},
	validators: {
		'data_detail.name': function(value) {
			return Validator.value(value).required('Bắt buộc nhập');
		},
		'data_detail.price': function(value) {
			return Validator.value(value).required('Bắt buộc nhập').integer('Giá không đúng định dạng');
		},
		'data_detail.color': function(value) {
			return Validator.value(value).required('Bắt buộc nhập');
		},
		'data_detail.image': function(value) {
			return Validator.value(value).required('Bắt buộc nhập');
		},
	},
	methods: {
		onFileChange(e) {
			let fileReader = new FileReader()
			
			fileReader.readAsDataURL(e.target.files[0])

			fileReader.onload = (e) => {
				this.data_detail.image = e.target.result
			}
		},
		removeImage(e) {
			this.data_detail.image = '';
		},
		save() {
			let that = this;
			this.$validate().then(function (success) {
				if(success) {

					axios.post('product/add', {
						data: that.data_detail
					}).then(response => {
						if(response.data == 'OK') {
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

	}
}
</script>