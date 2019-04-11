<template>
  <div>
    <el-table
      :data="expire"
      stripe
      style="width: 100%">
      <el-table-column
        prop="title"
        label="认证过期活动">
      </el-table-column>
      <el-table-column
        prop="timelong"
        label="时长">
      </el-table-column>
      </el-table>
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
      notcertified:[],
      expire:[]
    }
  },
  created(){
    this.axios.post('/xiaohongmao2/?service=App.User.GetJoin',{
      'jwt':jwt,
    })
    .then((response)=>{
          this.notcertified = response.data.data.undone
          this.doneActivityForm = response.data.data.done
          this.expire = response.data.data.expire
    })
  },
  methods:{
    Certification(id){
      this.axios.post('/xiaohongmao2/?service=App.User.ValidJoin',{
        'jwt':jwt,
        'jid':id
      })
      .then((response)=>{
        if(response.data.ret==200){
          this.$message({
            message: '认证成功',
            type: 'success'
        });
          location.reload()
        }
        else if(response.data.ret!=200){
          this.$message.error(response.data.msg);
        }
      })
    }
  }
}
</script>

<style rel="stylesheet/scss" scoped>

</style>
