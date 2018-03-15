<template>
	<div id="app">
		<Menu></Menu>

		<div class="container">
			<div class="row">
				<router-view />
			</div>
			
		</div>
	</div>
</template>

<script>
import Menu from './Menu'

export default {
	components: { Menu },
	data() {
		return {
			message: null
		}
	}
}
</script>