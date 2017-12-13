<template>
	<div>
		<header>
          <div class="icons"><i class="fa fa-table"></i></div>
          <h5>Pembelian Bahan Baku</h5>
          <div class="toolbar">
            <div class="btn-group">
              <router-link class="btn btn-default btn-sm pull-right" :to="{ name: 'create'}"><i class="fa fa-user-plus"></i></router-link>
            </div>
          </div>
        </header>
        <div class="body">
	        <table class="table table-bordered">
	        	<thead>
	        		<tr>
	        			<th>Tanggal</th>
	        			<th>Supplier</th>
	        			<th class="actions">#</th>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<tr v-for="item in table.data">
	        			<td>{{ item.tanggal }}</td>
	        			<td>{{ item.nama_supplier }}</td>
	        			<td>
	        				<div class="btn-group btn-group-sm pull-right">
	        					<router-link class="btn btn-default" :to="{ name: 'show', params: { id: item.id }}"><i class="fa fa-search-plus"></i></router-link>
	        				</div>
	        			</td>
	        		</tr>
	        	</tbody>
				<tfoot>
				  	<tr>
				  		<td colspan="2"></td>
				  		<td>
				  			<a v-on:click="prev" :disabled="table.prev_page_url === null" class="btn btn-info btn-xs"><i class="fa fa-arrow-left"></i></a>
				  			<a v-on:click="next" :disabled="table.next_page_url === null" class="btn btn-info btn-xs"><i class="fa fa-arrow-right"></i></a>
				  		</td>
				  	</tr>
				</tfoot>
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
				table: {}
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
				let that = this
				that.$http.get('')
				.then(res => {
					Vue.set(that.$data, 'table', res.data)
				})
			},
			next(){
				let that = this
				that.$http.get(that.table.next_page_url)
				.then(res => {
					Vue.set(that.$data, 'table', res.data)
				})
			},
			prev(){
				let that = this
				that.$http.get(that.table.prev_page_url)
				.then(res => {
					Vue.set(that.$data, 'table', res.data)
				})
			},
			hapus(id){
				this.$swal({
					title: "Are you sure?",
					text: "Are you sure that you want to leave this page?",
					type: "warning",
					showCancelButton: true,
				}).then((result) => {
					if (result.value) {
						var that = this
						that.$http.delete('/'+id)
						.then(res => {
							this.$swal({
								title: "Deleted!",
								text: res.data.message,
								type: "success",
								timer: 5000
							}).then(() => {
								that.getData()
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