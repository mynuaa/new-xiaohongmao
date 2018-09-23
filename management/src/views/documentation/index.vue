<template>
  <div>
    <el-table
      :data="doneActivityForm"
      stripe
      style="width: 45%">
      <el-table-column
        prop="title"
        label="已参与活动"
        width="180">
      </el-table-column>
      <el-table-column
        prop="timelong"
        label="时长"
        width="180">
      </el-table-column>
      </el-table>
      <el-table
      :data="notcertified"
      stripe
      style="width: 45%">
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
      'jwt':'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6InNlaXJ5Iiwic3R1aWQiOiIwMzE2MzAyMjYiLCJhZG1pbiI6eyJsZXZlbCI6MywieXVhbiI6M319.rhCoMzANEOyKo7ePeYh8qovrXybIPcQoeXJuj5CshAc',
    })
    .then((response)=>{
      for (var prop in response.data.data){
        if(response.data.data[prop].status==0){
          this.notcertified.push(response.data.data[prop])
        }
        else{
          this.doneActivityForm.push(response.data.data[prop])
        }
      }
    })
  }
}
</script>

<style rel="stylesheet/scss" scoped>

</style>
