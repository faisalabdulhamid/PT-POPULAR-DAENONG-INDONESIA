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
		        			<td>{{ data.tanggal }}</td>
		        		</tr>
		        	</tbody>
		        </table>

		        <table class="table table-bordered">
		        	<tbody v-for="item in data.produks">
		        		<tr>
		        			<th>{{ item.nama }}</th>
		        			<th colspan="2">{{ item.jumlah }}</th>
		        		</tr>
		        		<tr v-for="bahan in item.bahan_baku">
		        			<td>{{bahan.nama}}</td>
		        			<td>{{bahan.jumlah}}</td>
		        			<td>{{bahan.jumlah_total}}</td>
		        		</tr>
		        	</tbody>
		        </table>
		    </div>
		</div>
	</div>
</template>

<script>
	export default{
		name: "Show",
		props: ['id'],
		data(){
			return {
				data: {}
			}
		},
		methods:{
			getData(){
				let that = this
				that.$http.get('/'+that.id).then(res => {
					console.log(res.data)
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
					width: 5px;
				}
			}

		}
	}
</style>