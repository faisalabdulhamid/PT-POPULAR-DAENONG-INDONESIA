<template>
	<div>
		<div class="panel panel-default">
		    <div class="panel-heading">Lihat Pembelian</div>

		    <div class="panel-body">
		        <table class="table table-bordered">
		        	<tbody>
		        		<tr>
		        			<th class="attr">Supplier</th>
		        			<td class="titik">:</td>
		        			<td>{{ data.nama_supplier }}</td>
		        		</tr>
		        		<tr>
		        			<th>Tanggal Pembelian</th>
		        			<td>:</td>
		        			<td>{{ data.tanggal }}</td>
		        		</tr>
		        	</tbody>
		        </table>
		        <table class="table table-bordered">
		        	<thead>
		        		<tr>
		        			<th>Bahan Baku</th>
		        			<th>Satuan</th>
		        			<th>Jumlah</th>
		        		</tr>
		        	</thead>
		        	<tbody>
		        		<tr v-for="item in data.bahan_baku">
		        			<td>{{ item.nama }}</td>
		        			<td>{{ item.satuan }}</td>
		        			<td>{{ item.jumlah }}</td>
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
				let self = this
				self.$http.get('/'+self.id)
				.then(res => {
					Vue.set(self.$data, 'data', res.data)
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