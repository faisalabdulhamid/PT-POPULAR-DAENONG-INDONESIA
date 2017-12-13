<template>
	<div>
		<header>
          <div class="icons"><i class="fa fa-table"></i></div>
          <h5>Pembelian Bahan Baku</h5>
        </header>
        <div class="body">
	        <form class="form-horizontal" v-on:submit.prevent="simpan">
	        	<div class="form-group">
	        		<label for="supplier_id" class="col-md-3 control-label">Supplier</label>
	        		<div class="col-md-9">
	        			<select v-on:change="updateSupplier" class="form-control" id="supplier_id" v-model="data.supplier_id">
	        				<option v-for="item in supplier" :value="item.id">{{item.nama}}</option>
	        			</select>	
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
	        				<tr v-for="(item, idx) in data.bahan_baku">
	        					<td>
	        						<select class="form-control" id="bahan_baku_id" v-model="item.bahan_baku_id">
	        							<option v-for="b in bahan" :value="b.id">{{b.nama}}</option>
	        						</select>
	        					</td>
	        					<td>
	        						<input class="form-control" id="jumlah" v-model="item.jumlah">	
	        					</td>
	        					<td>
	        						<a class="btn btn-sm btn-danger" v-on:click="removeBahan(idx)"><i class="fa fa-times"></i></a>
		        					<a class="btn btn-sm btn-info" v-on:click="addBahan"><i class="fa fa-plus"></i></a>
	        					</td>
	        				</tr>
	        			</tbody>
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
	import {base_url} from './../../config/env.config'

	export default{
		name: "Create",
		data(){
			return {
				data: {
					bahan_baku: [{bahan_baku_id:'', jumlah: 1}]
				},
				bahan: [],
				supplier: [],
			}
		},
		methods:{
			getSupplier(){
				let self = this
				self.$http.get(`${base_url}select/supplier`)
				.then(res => {
					Vue.set(self.$data, 'supplier', res.data)
				})
			},
			removeBahan(idx){
				if (this.data.bahan_baku.length > 1) {
					this.data.bahan_baku.splice(idx, 1)	
				}
			},
			addBahan(){
				this.data.bahan_baku.push({bahan_baku_id: '', jumlah: 1})
			},
			updateSupplier(){
				let self = this
				self.$http.get(`${base_url}select/bahan-baku/${this.data.supplier_id}`)
				.then(res => {
					Vue.set(self.$data, 'bahan', res.data)
				})
			},
			simpan(){
				let self = this
				self.$http.post('', self.data)
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
			this.getSupplier()
		}
	}
</script>

<style type="scss" scoped>
	.actions{
		width: 120px;
	}
</style>