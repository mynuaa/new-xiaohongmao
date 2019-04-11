<template>
<div>
  <sticky class-name="sub-navbar" :zIndex="200">
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
import {getToken} from '@/utils/auth'
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
      const jwt = getToken()
      this.axios.post('/xiaohongmao2/?service=App.Admin.GetActivity',{
        'aid': this.$route.params.aid,
        'jwt': jwt
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
      const jwt = getToken()
      var this1=this
      for (var prop in this.tableData) {
        setTimeout(function(prop) {
          this1.axios.post('/xiaohongmao2/?service=App.Admin.AddJoin',{
            'jwt': jwt,
            'aid':this1.$route.params.aid,
            'stuid': Object.values(this1.tableData[prop])[0].trim(),
            'timelong': Object.values(this1.tableData[prop])[1].trim()
          })
          .then((response) => {
            if(response.data.ret==200){
              this1.$message({
                message: Object.values(this1.tableData[prop])[0] + '上传成功',
                type: 'success',
                duration: 500
              })
            }
            else{
              this1.$notify.error({
                title: '上传错误',
                message: Object.values(this1.tableData[prop])[0] + response.data.msg,
                duration: 0
              })
            }
          })
        },200*prop,prop);
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
