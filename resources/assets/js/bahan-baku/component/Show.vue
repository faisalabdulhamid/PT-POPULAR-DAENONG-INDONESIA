<template>
	<div>
		<div class="panel panel-default">
		    <div class="panel-heading">Lihat Bahan Baku</div>

		    <div class="panel-body">
		        <table class="table table-bordered">
		        	<tbody>
		        		<tr>
		        			<th class="attr">Nama</th>
		        			<td class="titik">:</td>
		        			<td>{{ data.nama }}</td>
		        		</tr>
		        		<tr>
		        			<th>Berat</th>
		        			<td>:</td>
		        			<td>{{ data.berat }}</td>
		        		</tr>
		        		<tr>
		        			<th>Gramasi</th>
		        			<td>:</td>
		        			<td>{{ data.gramasi }}</td>
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