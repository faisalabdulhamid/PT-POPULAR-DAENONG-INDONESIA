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
	        			<th>Batas Waktu</th>
	        			<th>Durasi</th>
	        			<th>Waktu Kerja Sisa</th>
	        			<th>Rasio Kritis</th>
	        			<!-- <th>Urutan Produksi</th> -->
	        			<th>Tanggal Selesai</th>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<tr v-for="item in data">
	        			<td>{{ item.nama_pelanggan }}</td>
	        			<td>{{ item.batas_waktu }}</td>
	        			<td>{{ item.durasi }}</td>
	        			<td>{{ item.waktu_sisa }}</td>
	        			<th>{{ item.rasio }}</th>
	        			<!-- <th>{{ item.urutan }}</th> -->
	        			<th>{{ item.waktu_selesai }}</th>
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