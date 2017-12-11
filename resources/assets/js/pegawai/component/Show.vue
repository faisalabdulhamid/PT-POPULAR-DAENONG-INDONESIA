<template>
	<div>
		<div class="panel panel-default">
		    <div class="panel-heading">Lihat Pegawai</div>

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
		        			<th>Divisi</th>
		        			<td>:</td>
		        			<td>{{ data.divisi }}</td>
		        		</tr>
		        		<tr>
		        			<th>Alamat</th>
		        			<td>:</td>
		        			<td>{{ data.alamat }}</td>
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
					})
			}
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