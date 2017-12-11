<template>
	<div>
		<header>
          <div class="icons"><i class="fa ga-table"></i></div>
          <h5>Tambah Bahan Baku</h5>
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
	        		<label for="berat" class="col-md-3 control-label">Berat</label>
	        		<div class="col-md-9">
	        			<input type="text" class="form-control" id="berat" v-model="data.berat">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="gramasi" class="col-md-3 control-label">Gramasi</label>
	        		<div class="col-md-9">
	        			<select class="form-control" id="gramasi" v-model="data.gramasi">
	        				<option value="20 s">20 S</option>
	        				<option value="25 s">25 S</option>
	        				<option value="30 s">30 S</option>
	        				<option value="35 s">35 S</option>
	        				<option value="40 s">40 S</option>
	        			</select>
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