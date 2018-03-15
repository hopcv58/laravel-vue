<template>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<span class="navbar-brand"><router-link to="/">Laravel + VueJS</router-link></span>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><router-link to="/users">{{ $t("menu.user") }}</router-link></li>
					<li><router-link to="/about">{{ $t("menu.about") }}</router-link></li>
					<li><router-link to="/product">{{ $t("menu.product") }}</router-link></li>
				</ul>
				
				<autocomplete></autocomplete>

				<ul class="nav navbar-nav navbar-right">

					<li v-for="lang in optionLangs" :value="lang.value" @click.prevent="callSetLangActions(lang.value)"><a href="javascript:void(0)" >{{ lang.text }}</a></li>

					<li><router-link to="/login">Đăng nhập</router-link></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Tài khoản <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Thông tin</a></li>
							<li><a href="#">Đăng xuất</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>
</template>

<script>

import Vue from 'vue'
import Autocomplete from './Autocomplete'

export default {
	components: {
		Autocomplete
	},
	data() {
		return {
			optionLangs:
			[
				{
					text: 'VN',
					value: 'vn'
				},
				{
					text: 'EN',
					value: 'en'
				}
			]
		}
	},

	methods: {
		callSetLangActions(lang) {
			this.$store.dispatch('setLang', event.target.getAttribute('value'))
		}
	}
}
</script>