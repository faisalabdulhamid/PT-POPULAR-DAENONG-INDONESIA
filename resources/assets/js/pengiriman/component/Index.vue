<template>
	<div>
		<header>
          <div class="icons"><i class="fa fa-table"></i></div>
          <h5>Pengiriman</h5>
        </header>
        <div class="body">
	        <table class="table table-bordered">
	        	<thead>
	        		<tr>
	        			<th>Pesanan</th>
	        			<th>Tanggal Selesai</th>
	        			<th>Berat Produk</th>
	        			<th>Truk</th>
	        			<th>#</th>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<tr v-for="item in table.data">
	        			<td>{{ item.pesanan.nama_pelanggan }}</td>
	        			<td>{{ item.tanggal_selesai }}</td>

	        			<td>{{ item.berat_produk }}</td>
	        			<td>{{ item.truk }}</td>
	        			<td>
	        				<a v-on:click="selesai(item.id)" class="btn btn-default btn-sm"><i class="fa fa-check"></i></a>
	        			</td>
	        		</tr>
	        	</tbody>
	        </table>
        	
        </div>
	</div>
</template>

<script>
	import {base_url} from './../../config/env.config'
	export default{
		name: "Index",
		data(){
			return {
				table: {},
				user: {}
			}
		},
		methods:{
			setUser(){
				let self = this
				self.$http.get(`${base_url}users`).then(res => {
					self.user = res.data
				})
			},
			getData(){
				let self = this
				self.$http.get('')
				.then(res => {
					Vue.set(self.$data, 'table', res.data)
				})
			},
			selesai(id){
				this.$swal({
					title: "Are you sure?",
					text: "Are you sure self you want to leave this page?",
					type: "warning",
					showCancelButton: true,
				}).then((result) => {
					if (result.value) {
						var self = this
						self.$http.put('/'+id)
						.then(res => {
							this.$swal({
								title: "Success!",
								text: res.data.message,
								type: "success",
								timer: 5000
							}).then(() => {
								self.getData()
							})
						})
					}
				})
			}
			
		},
		beforeMount(){
			this.getData()
			this.setUser()
		}
	}
</script>

<style type="scss" scoped>
	.actions{
		width: 120px;
	}
</style>