<template>
  <div>
    <el-table
      :data="doneActivityForm"
      stripe
      style="width: 100%">
      <el-table-column
        prop="title"
        label="已参与活动">
      </el-table-column>
      <el-table-column
        prop="timelong"
        label="时长">
      </el-table-column>
      </el-table>
      <el-table
      :data="notcertified"
      stripe
      style="width: 100%">
      <el-table-column
        prop="title"
        label="未审核活动">
      </el-table-column>
      <el-table-column
        prop="timelong"
        label="时长">
      </el-table-column>
      <el-table-column
        prop="timelong"
        label="申请认证">
      <template slot-scope="scope">
        <el-button
        type="primary"
          @click="Certification(scope.row.jid)">认证时长</el-button>
      </template>
      </el-table-column>
    </el-table>
  </div>
</template>
<script>
import {getToken} from '@/utils/auth'
let jwt = getToken()
export default {
  name: 'Documentation',
  data() {
    return {
      doneActivityForm:[],
      notcertified:[]
    }
  },
  created(){
    this.axios.post('http://my.nuaa.edu.cn/xiaohongmao2/?service=App.User.GetJoin',{
      'jwt':jwt,
    })
    .then((response)=>{
      for (var prop in response.data.data){
        if(response.data.data[prop].status==1){
          this.notcertified.push(response.data.data[prop])
        }
        else  if(response.data.data[prop].status>1e9){
          this.doneActivityForm.push(response.data.data[prop])
        }
      }
    })
  },
  methods:{
    Certification(id){
      this.axios.post('http://my.nuaa.edu.cn/xiaohongmao2/?service=App.User.ValidJoin',{
        'jwt':jwt,
        'jid':id
      })
      .then((response)=>{
        console.log(response.data.ret)
        if(response.data.ret==200){
          this.$message({
            message: '认证成功，请刷新后查看',
            type: 'success'
        });
        }
        else{
          this.$message.error(response.data.data.message);
        }
      })
    }
  }
}
</script>

<style rel="stylesheet/scss" scoped>

</style>
