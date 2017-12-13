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
	        			<th>Tanggal Kirim</th>
	        			<th>Berat Produk</th>
	        			<th>Truk</th>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<tr v-for="item in table.data">
	        			<td>{{ item.pesanan.nama_pelanggan }}</td>
	        			<td>{{ item.tanggal_kirim }}</td>

	        			<td>{{ item.berat_produk }}</td>
	        			<td>{{ item.truk }}</td>
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