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
	import { mapActions, mapGetters} from 'vuex'

	export default{
		name: "ShowPegawai",
		props: ['id'],
		data(){
			return {
				data: {}
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
			getData(){
				let that = this
				that.$http.get('/'+that.id, {
					headers: {
						Authorization: that.token.token_type+' '+that.token.access_token
					}
				})
					.then(res => {
						Vue.set(that.$data, 'data', res.data)
					})
					.catch(error => {
						console.log(error)
					})
			}
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