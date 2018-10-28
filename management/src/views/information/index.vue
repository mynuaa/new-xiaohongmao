<template>
  <div class="app">
    <el-table :data="tableData" style="width: 100%">
      <el-table-column prop="uname" label="姓名" width="180"/>
      <el-table-column prop="gender" label="性别" width="180"/>
      <el-table-column prop="stuid" label="学号"/>
    </el-table>
  </div>
</template>
<script>
import {getToken} from '@/utils/auth'
export default {
  name: 'Information',
  data() {
    	return {
      		tableData: [{
        		uname: null,
        		gender: null,
        		stuid: null
      		}]
    	}
	  },
  	created() {
    	this.fetchData()
	  },
  methods: {
    fetchData() {
        let jwt = getToken()
    		this.axios.post('//my.nuaa.edu.cn/xiaohongmao2/?service=App.User.GetInfo', {
        'jwt': jwt
      })
        .then((response) => {
          if (response.data.ret == 200) {
            this.tableData = []
            this.tableData.push(response.data.data)
          } else {
            this.$notify({
              title: '获取失败',
              message: '您的个人信息获取失败，请尝试重新登陆',
              duration: 5000
            })
          }
    		})
    }
  }
}
</script>
