<template>
	<div>
		<div class="panel panel-default">
		    <div class="panel-heading">Lihat Pesanan</div>

		    <div class="panel-body">
		        <table class="table table-bordered">
		        	<tbody>
		        		<tr>
		        			<th class="attr">Nama Perusahaan</th>
		        			<td class="titik">:</td>
		        			<td>{{ data.nama_pelanggan }}</td>
		        		</tr>
		        		<tr>
		        			<th>Tanggal Pesanan</th>
		        			<td>:</td>
		        			<td colspan="2">{{ data.tanggal }}</td>
		        		</tr>
		        		<tr>
		        			<th>Total Bayar</th>
		        			<td>:</td>
		        			<td colspan="2">{{ data.total_bayar }}</td>
		        		</tr>
		        		<tr>
		        			<th>Status</th>
		        			<td>:</td>
		        			<td colspan="2">{{ data.status }}</td>
		        		</tr>
		        		<tr>
		        			<th colspan="4">Produk</th>
		        		</tr>
		        		<tr>
		        			<th>Nama </th>
		        			<th>Qty</th>
		        			<th>Harga</th>
		        			<th>SubTotal</th>
		        		</tr>
		        		<tr v-for="item in data.produks">
		        			<td>{{item.nama}}</td>
		        			<td>{{item.jumlah}}</td>
		        			<td>{{item.harga}}</td>
		        			<td>{{item.harga * item.jumlah}}</td>
		        		</tr>
		        	</tbody>
		        </table>
		    </div>
		</div>
	</div>
</template>

<script>
	import { mapActions, mapGetters} from 'vuex'

	export default{
		name: "ShowProduk",
		props: ['id'],
		data(){
			return {
				data: {}
			}
		},
		computed:{
			...mapGetters({
				token: 'oauth'
			}),
		},
		methods:{
			...mapActions({
				'Oauth': 'setOauth',
			}),
			getData(){
				let that = this
				that.$http.get('/'+that.id, {
					headers: {
						Authorization: that.token.token_type+' '+that.token.access_token
					}
				}).then(res => {
					Vue.set(that.$data, 'data', res.data)
				})
			},
		},
		beforeMount(){
			this.Oauth()
			this.getData()
		}
	}
</script>

<style type="scss" scoped>
	table{
		tbody{
			tr{
				th.attr{
					width: 20%;
				}
				td.titik{
					width: 20px;
				}
			}

		}
	}
</style>