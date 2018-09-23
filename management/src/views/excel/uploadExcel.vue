<template>
<div>
  <sticky class-name="sub-navbar" zIndex="2200">
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
      this.axios.post('http://my.nuaa.edu.cn/xiaohongmao2/?service=App.Front.GetActivity',{
        id: this.$route.params.aid
      })
      .then((response) => {
        this.title = response.data.data.title
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
    test(){
      console.log(this.$route.params.aid)
    },
    handleSuccess({ results, header }) {
      this.tableData = results
      this.tableHeader = header
    },
    upload(){
      alert("666")
    },
  }
}
</script>
<style>
.uploadConfirm{
  margin-left: 50px;
}
</style>