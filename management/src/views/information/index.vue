<template>
	<div class="app">
    	<el-table :data="tableData" style="width: 100%">
      		<el-table-column prop="uname" label="姓名" width="180"></el-table-column>
      		<el-table-column prop="gender" label="性别" width="180"></el-table-column>
     		<el-table-column prop="stuid" label="学号"></el-table-column>
    	</el-table>
  	</div>
</template>
<script>
import axios from 'axios';
export default {
	name: 'information',
	data() {
    	return {
      		tableData: [{
        		uname: '666',
        		gender: null,
        		stuid: null
      		}]
    	}
	  },
  	created () {
    	this.fetchData()
	  },
	methods:{
		fetchData(){
			axios.post('http://my.nuaa.edu.cn/xiaohongmao2/?service=App.User.GetInfo', {
      		'jwt':'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6InNlaXJ5Iiwic3R1aWQiOiIwMzE2MzAyMjYiLCJhZG1pbiI6eyJsZXZlbCI6M319.EZrwdqZRItLmiGrq6wAbPjtZXgVlX5NnvKfYCB4gx4I'
    		})  
    		.then((response)=>{
				this.tableData = response.data
    		});
		}
	}
}
</script>