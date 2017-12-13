<template>
	<div>
		<header>
          <div class="icons"><i class="fa ga-table"></i></div>
          <h5>Tambah Pesanan</h5>
        </header>
        <div class="body">
	        <form class="form-horizontal" v-on:submit.prevent="simpan">
	        	<div class="form-group">
	        		<label for="pelanggan" class="col-md-3 control-label">Pelanggan</label>
	        		<div class="col-md-9">
	        			<select class="form-control" id="pelanggan" v-model="data.pelanggan">
	        				<option v-for="item in pelanggan" :value="item.id">{{ item.nama_perusahaan }}</option>
	        			</select>
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="total_bayar" class="col-md-3 control-label">Total Bayar</label>
	        		<div class="col-md-9">
	        			<input type="text" class="form-control" id="total_bayar" v-model="data.total_bayar" readonly="">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="batas_waktu" class="col-md-3 control-label">Batas Waktu</label>
	        		<div class="col-md-9">
	        			<input type="date" class="form-control" id="batas_waktu" v-model="data.batas_waktu" readonly="">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="status" class="col-md-3 control-label">Status</label>
	        		<div class="col-md-9">
	        			<select class="form-control" id="status" v-model="data.status">
	        				<option value="lunas">lunas</option>
	        				<option value="belum lunas">belum lunas</option>
	        			</select>
	        		</div>
	        	</div>

	        	<div class="form-group">
	        		<table class="table table-bordered">
	        			<thead>
	        				<tr>
	        					<th>Produk</th>
	        					<th>Jumlah</th>
	        					<th>Harga</th>
	        					<th>Sub Total</th>
	        					<th class="actions">#</th>
	        				</tr>
	        			</thead>
	        			<tbody>
	        				<tr v-for="(item, idx) in data.produk">
	        					<td>
	        						<select class="form-control" v-model="data.produk[idx].produk_id" name="produk" v-on:change="UpdateProduk($event, idx)">
	        							<option v-for="item in produk" :value="item.id" :key="item.id" :data-harga="item.harga">{{ item.nama }}</option>
	        						</select>
	        					</td>
	        					<td>
	        						<input type="text" class="form-control" v-model="data.produk[idx].jumlah" v-on:input='updateQty($event, idx)'>
	        					</td>
	        					<td>
	        						{{ form[idx].harga }}
	        					</td>
	        					<td>
	        						<!-- {{ sub_total(idx) }} -->
	        						<input type="text" class="form-control" v-model="item.sub_total" readonly="">
	        					</td>
	        					<td>
	        						<a v-on:click="removeProduk(idx)" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
	        						</a>
	        						<a v-on:click="addProduk" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a>
	        					</td>
	        				</tr>
	        				<tr>
	        					<th colspan="3" class="text-right">Total</th>
	        					<td>{{ data.total_bayar }}</td>
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
					total_bayar: 0,
					produk: [
						{produk_id: '', jumlah: 1}
					]
				},
				pelanggan: [],
				produk: [
					{id: '', harga: 0}
				],
				form: [{id: '', harga: 0}],
			}
		},
		methods:{
			getPelanggan(){
				let that = this
				that.$http.get(base_url+'select/pelanggan')
				.then(res => {
					Vue.set(that.$data, 'pelanggan', res.data)
				})
			},
			addProduk(){
				this.data.produk.push({produk_id: '', jumlah: 1});
				this.form.push({id: '', harga: 0});
			},
			removeProduk(idx){
				if (this.data.produk.length > 1) {
					this.data.produk.splice(idx, 1)
					this.form.splice(idx, 1)
				}
			},
			getProduk(){
				let that = this
				that.$http.get(base_url+'select/produk')
				.then(res => {
					Vue.set(that.$data, 'produk', res.data)
				})
			},
			UpdateProduk(event, idx){
				let _find = this.produk.find(o => o.id == event.target.value)
				this.form[idx].id = _find.id;
				this.form[idx].harga = _find.harga;
				this.data.produk[idx].sub_total = _find.harga * this.data.produk[idx].jumlah;
				this._total()
			},
			updateQty(event, idx){
				this.data.produk[idx].sub_total = event.target.value * this.form[idx].harga;
				this._total()
			},
			sub_total(idx){
				this.form[idx].sub_total = this.data.produk[idx].jumlah * this.form[idx].harga
				return this.data.produk[idx].jumlah * this.form[idx].harga
			},
			_total(){
				let tot = 0;
				this.data.produk.forEach((val, key) => {
					tot += val.sub_total
				})
				this.data.total_bayar = tot
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
			this.getPelanggan()
			this.getProduk()
		},
	}
</script>

<style type="scss" scoped>
	.actions{
		width: 120px;
	}
</style>