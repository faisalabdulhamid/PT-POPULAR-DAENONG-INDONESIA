<template>
	<div>
		<header>
          <div class="icons"><i class="fa fa-table"></i></div>
          <h5>Supplier</h5>
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
	        			<th>Nama</th>
	        			<th>Telepon</th>
	        			<th class="actions">#</th>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<tr v-for="item in table.data">
	        			<td>{{ item.nama }}</td>
	        			<td>{{ item.no_telepon }}</td>
	        			<td>
	        				<div class="btn-group btn-group-sm pull-right">
	        					<router-link class="btn btn-default" :to="{ name: 'show', params: { id: item.id }}"><i class="fa fa-search-plus"></i></router-link>
	        					<router-link class="btn btn-default" :to="{ name: 'edit', params: { id: item.id }}"><i class="fa fa-edit"></i></router-link>
	        					<a class="btn btn-default" v-on:click="hapus(item.id)"><i class="fa fa-trash"></i></a>
	        				</div>
	        			</td>
	        		</tr>
	        	</tbody>
	        	<tfoot>
	        		<tr>
	        			<td colspan="2"></td>
	        			<td>
	        				<div class="btn-group btn-group-sm pull-right">
	        					<a class="btn btn-info" v-show="table.prev_page_url" v-on:click="prev"><i class="fa fa-chevron-left"></i></a>
	        					<a class="btn btn-info" v-show="table.next_page_url" v-on:click="next"><i class="fa fa-chevron-right"></i></a>
	        				</div>
	        			</td>
	        		</tr>
	        	</tfoot>
	        </table>
        	
        </div>
	</div>
</template>

<script>
	import { mapActions, mapGetters} from 'vuex'
	
	export default{
		name: "IndexSupplier",
		data(){
			return {
				table: {}
			}
		},
		computed:{
			...mapGetters({
				token: 'oauth'
			})
		},
		methods:{
			...mapActions({
				'Oauth': 'setOauth',
			}),
			getData(){
				let that = this
				that.$http.get('', {
					headers: {
						Authorization: that.token.token_type+' '+that.token.access_token
					}
				}).then(res => {
					Vue.set(that.$data, 'table', res.data)
				})
			},
			next(){
				let that = this
				that.$http.get(that.table.next_page_url, {
					headers: {
						Authorization: that.token.token_type+' '+that.token.access_token
					}
				}).then(res => {
					Vue.set(that.$data, 'model', res.data.data)
					Vue.set(that.$data, 'table', res.data)
				}).catch(error => {
					console.log(error)
				})
			},
			prev(){
				let that = this
				that.$http.get(that.table.prev_page_url, {
					headers: {
						Authorization: that.token.token_type+' '+that.token.access_token
					}
				}).then(res => {
					Vue.set(that.$data, 'model', res.data.data)
					Vue.set(that.$data, 'table', res.data)
				}).catch(error => {
					console.log(error)
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
						that.$http.delete('/'+id, {
							headers: {
								Authorization: that.token.token_type+' '+that.token.access_token
							}
						}).then(res => {
							this.$swal({
								title: "Deleted!",
								text: res.data.message,
								type: "success",
								timer: 5000
							}).then(() => {
								that.getData()
							})
						}).catch(err => {
							console.log(err)
						})
					}
				})
			}
			
		},
		created(){
			this.Oauth()
			this.getData()
		},
		beforeMount(){
			
		}
	}
</script>

<style type="scss" scoped>
	.actions{
		width: 120px;
	}
</style>