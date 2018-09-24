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
    </el-table>
  </div>
</template>
<script>

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
      'jwt':'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6InNlaXJ5Iiwic3R1aWQiOiIwMzE2MzAyMjYiLCJhZG1pbiI6eyJsZXZlbCI6MiwieXVhbiI6M319.r9vW77YBAKyQTzdaD-IVA42hEeCLizaYFmqv6pl8NAA',
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
  }
}
</script>

<style rel="stylesheet/scss" scoped>

</style>
