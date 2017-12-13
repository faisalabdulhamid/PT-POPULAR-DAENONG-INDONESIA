<template>
	<div>
		<header>
          <div class="icons"><i class="fa fa-table"></i></div>
          <h5>Produksi</h5>
        </header>
        <div class="body">
	        <table class="table table-bordered">
	        	<thead>
	        		<tr>
	        			<th>Pesanan</th>
	        			<th>Tanggal Pesanan</th>
	        			<th>Tanggal Pengiriman Bahan Baku</th>
	        			<th>Batas Waktu</th>
	        			<th>Waktu Kerja Sisa</th>
	        			<th>#</th>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<tr v-for="item in data">
	        			<td>{{ item.nama_pelanggan }}</td>
	        			<td>{{ item.tanggal_pesan }}</td>
	        			<td>{{ item.tanggal }}</td>
	        			<td>{{ item.batas_waktu }}</td>
	        			<td>{{ item.waktu_sisa }}</td>
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
				data: [],
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
					Vue.set(self.$data, 'data', res.data)
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
						self.$http.post('/', {
							pesanan_id: id
						}).then(res => {
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