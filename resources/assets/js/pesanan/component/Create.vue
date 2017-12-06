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
	        				
	        			</select>
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="tanggal" class="col-md-3 control-label">Tanggal</label>
	        		<div class="col-md-9">
	        			<input type="text" class="form-control" id="tanggal" v-model="data.tanggal">	
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="total_bayar" class="col-md-3 control-label">Total Bayar</label>
	        		<div class="col-md-9">
	        			<input type="text" class="form-control" id="total_bayar" v-model="data.total_bayar" readonly="">
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
	        				</tr>
	        			</thead>
	        			<tbody>
	        				<tr v-for="(item, idx) in data.produk">
	        					<td>
	        						<select class="form-control" v-model="data.produk[idx].produk_id">
	        							<option value=""></option>
	        						</select>
	        					</td>
	        					<td>
	        						<input type="text" class="form-control" v-model="data.produk[idx].jumlah">
	        					</td>
	        					<td>
	        						20
	        					</td>
	        					<td>
	        						20
	        					</td>
	        				</tr>
	        				<tr>
	        					<td colspan="3">Total</td>
	        					<td>Rp.2323</td>
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
	import { mapActions, mapGetters} from 'vuex'

	export default{
		name: "CreatePesanan",
		data(){
			return {
				data: {
					produk: [
						{produk_id: '', jumlah: 1}
					]
				}
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