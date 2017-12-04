<template>
	<div>
		<header>
          <div class="icons"><i class="fa fa-table"></i></div>
          <h5>Edit Pegawai</h5>
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
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="password" class="col-md-3 control-label">Password</label>
	        		<div class="col-md-9">
	        			<input type="password" class="form-control" id="password" v-model="data.password">	
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="divisi" class="col-md-3 control-label">Divisi</label>
	        		<div class="col-md-9">
	        			<select class="form-control" id="divisi" v-model="data.divisi">
	        				<option value="marketing">Marketing</option>
							<option value="admin">Admin</option>
							<option value="purchasing">Purchasing</option>
							<option value="produksi">Produksi</option>
							<option value="exsim">Exsim</option>
	        			</select>
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="alamat" class="col-md-3 control-label">Alamat</label>
	        		<div class="col-md-9">
	        			<textarea class="form-control" id="alamat" v-model="data.alamat"></textarea>
	        		</div>
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
		name: "EditPegawai",
		props: ['id'],
		data(){
			return {
				data: {}
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
				getData(){
					let that = this
					that.$http.get('/'+that.id, {
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
			}),
		},
		created(){
			this.Oauth()
		},
		beforeMount(){
			this.getData()
		}
	}
</script>

<style type="scss" scoped>
	.actions{
		width: 120px;
	}
</style>