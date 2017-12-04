<template>
	<div>

		<header>
          <div class="icons"><i class="fa fa-table"></i></div>
          <h5>Edit Supplier</h5>
        </header>
        <div class="body">
	        <form class="form-horizontal" v-on:submit.prevent="simpan">
	        	<div class="form-group">
	        		<label for="nama" class="col-md-3 control-label">Nama</label>
	        		<div class="col-md-9">
	        			<input type="text" class="form-control" id="nama" v-model="data.nama">	
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="no_telepon" class="col-md-3 control-label">No Telepon</label>
	        		<div class="col-md-9">
	        			<input type="text" class="form-control" id="no_telepon" v-model="data.no_telepon">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="email" class="col-md-3 control-label">Email</label>
	        		<div class="col-md-9">
	        			<input type="text" class="form-control" id="email" v-model="data.email">
	        				
	        			</select>
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="alamat" class="col-md-3 control-label">Alamat</label>
	        		<div class="col-md-9">
	        			<textarea class="form-control" id="alamat" v-model="data.alamat"></textarea>
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<table class="table table-bordered">
	        			<thead>
	        				<tr>
	        					<th>Bahan Baku</th>
	        					<th>Jumlah</th>
	        					<th>#</th>
	        				</tr>
	        			</thead>
	        			<tbody>
	        				<tr v-for="(bahanItem, idx) in data.bahan_baku">
	        					<td>
	        						<select class="form-control" v-model="data.bahan_baku[idx].bahan_baku_id">
										<option v-for="item in bahan" :value="item.id">{{ item.nama }}</option>
	        						</select>
	        					</td>
	        					<td>
	        						<input type="text" class="form-control" v-model="data.bahan_baku[idx].jumlah">
	        					</td>
	        					<td>
	        						<a class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
	        					</td>
	        				</tr>
	        			</tbody>
	        			<tfoot>
	        				<tr>
	        					<th colspan="2"></th>
	        					<th>
	        						<a class="btn btn-sm btn-info" v-on:click="addBahan"><i class="fa fa-plus"></i></a>
	        					</th>
	        				</tr>
	        			</tfoot>
	        		</table>
	        	</div>
				
				<div class="pull-right">
					<router-link class="btn btn-default" :to="{ name: 'index'}">Batal</router-link>
	        		<button class="btn btn-default">Simpan</button>	
				</div>
	        	
	        </form>
        	
        </div>
	</div>
</template>

<script>
	import { mapActions, mapGetters} from 'vuex'

	export default{
		name: "EditSupplier",
		props: ['id'],
		data(){
			return {
				data: {
					bahan_baku: [
						{bahan_baku_id: '', jumlah: 1},
					]
				},
				bahan: []
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
				that.$http.get('/'+that.id+'/edit', {
					headers: {
						Authorization: that.token.token_type+' '+that.token.access_token
					}
				}).then(res => {
					Vue.set(that.$data, 'data', res.data)
				}).catch(error => {
					this.$swal({
					  title: error.response.data.message,
					  type: 'error',
					  timer: 5000,
					})
				})
			},
			getBahan(){
				let that = this
				that.$http.get('http://localhost:8000/api/select/bahan-baku', {
					headers: {
						Authorization: that.token.token_type+' '+that.token.access_token
					}
				}).then(res => {
					Vue.set(that.$data, 'bahan', res.data)
				}).catch(error => {
					console.log(error)
				})
			},
			addBahan(){

			},
			simpan(){
				let that = this
				that.$http.put('/'+that.id, that.data,{
					headers: {
						Authorization: that.token.token_type+' '+that.token.access_token
					}
				}).then(res => {
					console.log(res)
					that.$swal({
						title: res.data.message,
						type: "success",
						timer: 5000,
					}).then(() => {
						that.$router.push({name: 'index'})
					})
				}).catch(error => {
					// console.log(error)
					var contentHtml = '';
					Object.keys(error.response.data.errors).forEach((key) => {
						contentHtml +=  '<p class="text-danger">'+error.response.data.errors[key][0]+'</p>'
					})
					
					this.$swal({
					  title: error.response.data.message,
					  html: contentHtml,
					  type: 'error',
					  timer: 5000,
					})
				})
			}
		},
		created(){

		},
		beforeMount(){
			this.Oauth()
			this.getData()
			this.getBahan()
		}
	}
</script>

<style type="scss" scoped>
	.actions{
		width: 120px;
	}
</style>