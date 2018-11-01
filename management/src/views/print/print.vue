<template>
 <div>
   <div id="pdfDom">
  <p class="head">南京航空航天大学志愿服务认证书</p>
  <p class="detail"><span>{{name}}</span>同学（学号： <span>{{stuid}}</span> ）：<br></p>
  <p class="detail1">在大学期间，积极践行“奉献、友爱、互助、进步”的志愿精神，共参加志愿服务<span>{{times}}</span>余次，总计服务{{time}}小时。感谢您对志愿服务工作付出的辛勤和汗水，您的笑容是南航志愿者最好的名片！<br><br><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;特此认证！</span></p>
  <p class="title">参加志愿服务项目表</p>
    <el-table
    class="table"
      :data="doneActivityForm"
      style="margin-top:50px;"
      border>
      <el-table-column
        prop="title"
        label="活动名称">
      </el-table-column>
      <el-table-column
        prop="hostname"
        label="主办方">
      </el-table-column>
      <el-table-column
        prop="timelong"
        label="活动时长">
      </el-table-column>
  </el-table>
  <p class="tuanwei">共青团南京航空航天大学委员会</p>
  <p class="date"><span>{{year}}</span> 年 <span>{{month}}</span> 月 <span>{{day}}</span> 日 </p>
  </div>
  <el-button class="button" type="primary" @click="getPdf()">点击打印</el-button>
 </div>
</template>

<script>
import {getToken} from '@/utils/auth'
let jwt = getToken()
var date = new Date();
var nowMonth = date.getMonth() + 1;
var strDate = date.getDate();
var year = date.getFullYear();
export default{
  data() {
    return {
      name:'',
      stuid:'',
      times:' ',
      time:0,
      year:year,
      day:strDate,
      month:nowMonth,
      doneActivityForm:[],
      htmlTitle:"青年志愿者服务认证书",
    }
  },
  created(){
    this.axios.post('//my.nuaa.edu.cn/xiaohongmao2/?service=App.User.GetJoin',{
      'jwt':jwt,
    })
    .then((response)=>{
      this.times = Object.keys(response.data.data.done).length
      this.time = 0;
      for(var a = 0;a < this.times;a++){
        this.time+=parseInt(response.data.data.done[a].timelong)
      }
      this.doneActivityForm = response.data.data.done
    })
    this.axios.post('//my.nuaa.edu.cn/xiaohongmao2/?service=App.User.GetInfo', {
      'jwt': jwt
    }).then((response) => {
          if (response.data.ret == 200) {
            this.name = response.data.data.uname
            this.stuid = response.data.data.stuid
          } else {
            this.$notify({
              title: '获取失败',
              message: '您的个人信息获取失败，请尝试重新登陆',
              duration: 5000
            })
          }
    		})
  },
  methods:{
  }
}
</script>
<style>
.head{
  font-weight: 200px;
  text-align: center;
  padding-top: 100px;
  font-size:30px;
  font-family:黑体;
}
.table{
  margin-left: 15%;
  width:70%;
}
.detail{
  margin-left: 17%;
  padding-top: 5%;
  width: 65%;
  font-weight: 300px;
  font-size: 20px;
}
.detail1{
  text-indent:2em;
  margin-left: 25%;
  padding-top: 4%;
  width: 50%;
  font-weight: 300px;
  font-size: 20px;
}
.title{
  padding-top: 50px;
  margin-left: 40%;
  font-weight: 900px;
  font-size: 18px;
}
.tuanwei{
  margin-left: 68%;
  padding-top:4%;
  font-weight: 900px;
  font-size: 15px;
}
.date{
  margin-left: 72%;
  padding-top:1%;
  font-weight: 900px;
  font-size: 15px;
}
.button{
  margin-left: 48%;
}
@media print {
  .button{
    display: none !important;
  }
}
</style>
