<template>
	<div>
		<header>
          <div class="icons"><i class="fa fa-table"></i></div>
          <h5>Tambah Pelanggan</h5>
        </header>
        <div class="body">
	        <form class="form-horizontal" v-on:submit.prevent="simpan">
	        	<div class="form-group">
	        		<label for="nama_perusahaan" class="col-md-3 control-label">Nama Perusahaan</label>
	        		<div class="col-md-9">
	        			<input type="text" class="form-control" id="nama_perusahaan" v-model="data.nama_perusahaan">	
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
		name: "CreatePelanggan",
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
				simpan(){
					let that = this
					
					that.$http.post('', that.data,{
						headers: {
							Authorization: that.token.token_type+' '+that.token.access_token
						}
					}).then(res => {
						this.$swal({
							text: res.data.message,
							type: "success",
							timer: 5000
						}).then(() => {
							this.$router.push({name: 'index'})
						})
					})
				}
			})
		},
		created(){
			this.Oauth()
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