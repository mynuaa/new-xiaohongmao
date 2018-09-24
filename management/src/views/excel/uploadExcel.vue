<template>
<div>
  <sticky class-name="sub-navbar" zIndex="200">
    <label style="color: white">活动名称:</label>
    <span style="color: white">{{title}}</span>
    <el-button size="medium" class="uploadConfirm" @click="upload">确定上传</el-button>
  </sticky>
  <div class="app-container">
    <upload-excel-component :on-success="handleSuccess" :before-upload="beforeUpload"/>
    <el-table :data="tableData" border highlight-current-row style="width: 100%;margin-top:20px;">
      <el-table-column v-for="item of tableHeader" :prop="item" :label="item" :key="item"/>
    </el-table>

  </div>
  </div>
</template>

<script>
import UploadExcelComponent from '@/components/UploadExcel/index.vue'
import Sticky from '@/components/Sticky'
export default {
  name: 'UploadExcel',
  components: { UploadExcelComponent,Sticky },
  data() {
    return {
      tableData: [],
      tableHeader: [],
      title:''
    }
  },
  created(){
      this.axios.post('http://my.nuaa.edu.cn/xiaohongmao2/?service=App.Admin.GetActivity',{
        'aid': this.$route.params.aid,
        'jwt':'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6InNlaXJ5Iiwic3R1aWQiOiIwMzE2MzAyMjYiLCJhZG1pbiI6eyJsZXZlbCI6MiwieXVhbiI6M319.r9vW77YBAKyQTzdaD-IVA42hEeCLizaYFmqv6pl8NAA'
      })
      .then((response) => {
        this.title = response.data.data.activity.title
      })
    },
  methods: {
    beforeUpload(file) {
      const isLt1M = file.size / 1024 / 1024 < 1

      if (isLt1M) {
        return true
      }

      this.$message({
        message: 'Please do not upload files larger than 1m in size.',
        type: 'warning'
      })
      return false
    },
    handleSuccess({ results, header }) {
      this.tableData = results
      this.tableHeader = header
    },
    upload(){
      for (var prop in this.tableData) {
        this.axios.post('http://my.nuaa.edu.cn/xiaohongmao2/?service=App.Admin.AddJoin',{
          'jwt': 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6InNlaXJ5Iiwic3R1aWQiOiIwMzE2MzAyMjYiLCJhZG1pbiI6eyJsZXZlbCI6MiwieXVhbiI6M319.r9vW77YBAKyQTzdaD-IVA42hEeCLizaYFmqv6pl8NAA',
          'aid':this.$route.params.aid,
          'stuid': this.tableData[prop].stuid,
          'timelong': this.tableData[prop].timelong
      })
      .then((response) => { 
        if(response.data.ret==200){
          this.$message({
            message: this.tableData[prop].stuid + '上传成功',
            type: 'success',
            duration: 500
          })
        }
        else{
          this.$notify.error({
            title: '上传错误',
            message: this.tableData[prop].stuid + '上传错误',
            duration: 0
          })
        }
      })
      }
    },
  }
}
</script>
<style>
.uploadConfirm{
  margin-left: 50px;
}
</style>