<template>
	<div>
		<div class="panel panel-default">
		    <div class="panel-heading">Lihat Produk</div>

		    <div class="panel-body">
		        <table class="table table-bordered">
		        	<tbody>
		        		<tr>
		        			<th class="attr">Nama</th>
		        			<td class="titik">:</td>
		        			<td>{{ data.nama }}</td>
		        		</tr>
		        		<tr>
		        			<th>Warna</th>
		        			<td>:</td>
		        			<td>{{ data.warna }}</td>
		        		</tr>
		        		<tr>
		        			<th>Gramasi</th>
		        			<td>:</td>
		        			<td>{{ data.gramasi }}</td>
		        		</tr>
		        		<tr>
		        			<th>Harga</th>
		        			<td>:</td>
		        			<td>{{ data.harga }}</td>
		        		</tr>
		        	</tbody>
		        </table>
		        <table class="table table-bordered">
		        	<thead>
		        		<tr>
		        			<th colspan="3">Bahan Baku</th>
		        		</tr>
		        		<tr>
		        			<th>Bahan Baku</th>
		        			<th>Jumlah</th>
		        			<th>Satuan</th>
		        		</tr>
		        	</thead>
		        	<tbody>
		        		<tr v-for="item in data.bahan_baku">
		        			<td>{{ item.nama }}</td>
		        			<td>{{ item.jumlah }}</td>
		        			<td>{{ item.satuan }}</td>
		        		</tr>
		        	</tbody>
		        </table>
		    </div>
		</div>
	</div>
</template>

<script>
	export default{
		name: "ShowProduk",
		props: ['id'],
		data(){
			return {
				data: {}
			}
		},
		methods:{
			getData(){
				let that = this
				that.$http.get('/'+that.id)
				.then(res => {
					Vue.set(that.$data, 'data', res.data)
				})
			},
		},
		beforeMount(){
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