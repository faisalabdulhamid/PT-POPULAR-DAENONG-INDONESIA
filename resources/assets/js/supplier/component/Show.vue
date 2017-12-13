<template>
	<div>
		<div class="panel panel-default">
		    <div class="panel-heading">Lihat Supplier</div>

		    <div class="panel-body">
		        <table class="table table-bordered">
		        	<tbody>
		        		<tr>
		        			<th class="attr">Nama</th>
		        			<td class="titik">:</td>
		        			<td>{{ data.nama }}</td>
		        		</tr>
		        		<tr>
		        			<th>Telepon</th>
		        			<td>:</td>
		        			<td>{{ data.no_telepon }}</td>
		        		</tr>
		        		<tr>
		        			<th>Email</th>
		        			<td>:</td>
		        			<td>{{ data.email }}</td>
		        		</tr>
		        		<tr>
		        			<th>Alamat</th>
		        			<td>:</td>
		        			<td>{{ data.alamat }}</td>
		        		</tr>
		        		
		        	</tbody>
		        </table>

		        <table class="table table-bordered">
		        	<thead>
		        		<tr>
		        			<th>Bahan Baku</th>
		        		</tr>
		        	</thead>
		        	<tbody>
		        		<tr v-for="bahan in data.bahan_baku">
		        			<td colspan="3">{{ bahan.nama }}</td>
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
				that.$http.get('/'+that.id)
				.then(res => {
					Vue.set(that.$data, 'data', res.data)
				}).catch(error => {
					console.log(error)
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