<template>
	<div>
		<header>
          <div class="icons"><i class="fa fa-table"></i></div>
          <h5>Pembelian Bahan Baku</h5>
        </header>
        <div class="body">
	        <form class="form-horizontal" v-on:submit.prevent="simpan">
	        	<div class="form-group">
	        		<label for="bahan_baku_id" class="col-md-3 control-label">Bahan Baku</label>
	        		<div class="col-md-9">
	        			<select class="form-control" id="bahan_baku_id" v-model="data.bahan_baku_id" v-on:change="changeBahan">
	        				<option v-for="item in bahan" :value="item.id">{{item.nama}}</option>
	        			</select>	
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="supplier_id" class="col-md-3 control-label">Supplier</label>
	        		<div class="col-md-9">
	        			<select class="form-control" id="supplier_id" v-model="data.supplier_id">
	        				<option v-for="item in supplier" :value="item.id">{{item.nama}}</option>
	        			</select>	
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="jumlah" class="col-md-3 control-label">Jumlah</label>
	        		<div class="col-md-9">
	        			<input class="form-control" id="jumlah" v-model="data.jumlah">	
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
	import {base_url} from './../../config/env.config'

	export default{
		name: "Create",
		data(){
			return {
				data: {},
				bahan: [],
				supplier: [],
			}
		},
		methods:{
			getBahan(){
				let that = this
				that.$http.get(base_url+'api/select/bahan-baku')
				.then(res => {
					Vue.set(that.$data, 'bahan', res.data)
				})
			},
			changeBahan(){
				let that = this
				that.$http.get(base_url+'api/select/supplier/'+this.data.bahan_baku_id)
				.then(res => {
					Vue.set(that.$data, 'supplier', res.data)
				})
			},
			simpan(){
				let that = this
				that.$http.post('', that.data)
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
		},
		beforeMount(){
			this.getBahan()
		}
	}
</script>

<style type="scss" scoped>
	.actions{
		width: 120px;
	}
</style>