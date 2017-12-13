<template>
	<div>
		<header>
          <div class="icons"><i class="fa fa-table"></i></div>
          <h5>Edit Produk</h5>
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
	        		<label for="warna" class="col-md-3 control-label">Warna</label>
	        		<div class="col-md-9">
	        			<select class="form-control" id="warna" v-model="data.warna">
	        				<option value="Hitam">Hitam</option>
	        				<option value="Merah">Merah</option>
	        				<option value="Hijau">Hijau</option>
	        				<option value="Kuning">Kuning</option>
	        				<option value="Biru">Biru</option>
	        			</select>	
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="gramasi" class="col-md-3 control-label">Gramasi</label>
	        		<div class="col-md-9">
	        			<select class="form-control" id="gramasi" v-model="data.gramasi">
	        				<option value="20 s">20 s</option>
	        				<option value="25 s">25 s</option>
	        				<option value="30 s">30 s</option>
	        				<option value="35 s">35 s</option>
	        				<option value="40 s">40 s</option>
	        			</select>
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="harga" class="col-md-3 control-label">Harga</label>
	        		<div class="col-md-9">
	        			<input type="text" class="form-control" id="harga" v-model="data.harga">	
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<table class="table table-bordered">
	        			<thead>
	        				<tr>
	        					<th>Bahan Baku</th>
	        					<th>Jumlah</th>
	        					<th class="actions">#</th>
	        				</tr>
	        			</thead>
	        			<tbody>
	        				<tr v-for="(item, idx) in data.bahan_baku">
	        					<td>
	        						<select class="form-control" v-model="data.bahan_baku[idx].bahan_baku_id">
	        							<option v-for="item in bahan" :value="item.id">{{ item.nama }}</option>
	        						</select>
	        					</td>
	        					<td>
	        						<input type="text" class="form-control" v-model="data.bahan_baku[idx].jumlah">
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
		name: "Edit",
		props: ['id'],
		data(){
			return {
				data: {
					bahan_baku: [
						{bahan_baku_id: '', jumlah: 1}
					]
				},
				bahan: []
			}
		},
		methods:{
			getBahan(){
				let that = this
				that.$http.get(base_url+'select/bahan-baku')
				.then(res => {
					Vue.set(that.$data, 'bahan', res.data)
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
			getData(){
				let that = this
				that.$http.get('/'+that.id+'/edit')
				.then(res => {
					Vue.set(that.$data, 'data', res.data)
				})
			},
			simpan(){
				let that = this
				that.$http.put('/'+that.id, that.data)
				.then(res => {
					that.$swal({
						title: res.data.message,
						type: "success",
						timer: 5000,
					}).then(() => {
						that.$router.push({name: 'index'})
					})
				})
			}
		},
		beforeMount(){
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