<template>
	<div>
		<header>
          <div class="icons"><i class="fa fa-table"></i></div>
          <h5>Tambah Pegawai</h5>
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
	        				<option>marketing</option>
							<option>admin</option>
							<option>purchasing</option>
							<option>produksi</option>
							<option>exsim</option>
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
	export default{
		name: "Create",
		data(){
			return {
				data: {}
			}
		},
		methods:{
			simpan(){
				let that = this
				that.$http.post('')
				.then(res => {
					this.$swal({
						text: res.data.message,
						type: "success",
						timer: 5000
					}).then(() => {
						this.$router.push({name: 'index'})
					})
				})
			}
		}
	}
</script>

<style type="scss" scoped>
	.actions{
		width: 120px;
	}
</style>