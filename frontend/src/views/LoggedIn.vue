<template>
  
</template>

<script>
var echarts = require('echarts')
export default {
  name: 'loggedIn',
  components: {
    
  },
  data(){
      return{
        time:{},
        averageTime:[],
        collegeAve:{},
        mouthAve:{},
        universityAve:{},
        allUsers:{},
        username:'一个人',
        userid:'123456789',
        activityList:[
            {activity:'随便什么凑够十五个字还差一点够了',host:'纸飞机啦啦啦',time:'10',date:'1.1.1',state:'1'},
        
        ]
          
      }
  },
  filters: {
    activity: function (value) {
      if (value.length >= 15){
        return value.substring(0, 15) + ' ...';
      }
      else {
        return value;
      }
    },
    host: function (value) {
      if (value.length >= 5){
        return value.substring(0, 5) + ' ...';
      }
      else {
        return value;
      }
    }
  },
    methods: {
      getInfo(){
          this.axios.post('https://my.nuaa.edu.cn/xiaohongmao2/api', {
              service: 'Front.ShowData',
          }).then(re => {
              if(re.data.ret != 200){

              }else{
                  this.allUsers = re.data.allUsers
                  this.mouthAve = re.data.mouthLong / allUsers

                //  this.averageTime[0] = re.data.data
              }
          })
      },
      showEdit(){
          document.getElementById("editIcon").style.display = 'block';
      },
      hideEdit(){
          document.getElementById("editIcon").style.display = 'none';
      },
      getuserchart(){
        var myChart = echarts.init(document.getElementById('myChart'));
        var averageTime = this.averageTime;
        myChart.setOption({
                title: {
                    text: ''
                },
                tooltip: {},
                legend: {
                    data:['时长']
                },
                xAxis: {
                    data: ["我","专业平均","院平均","年级平均","校平均"]
                },
                yAxis: {},
                series: [{
                    name: '志愿时长',
                    type: 'bar',
                    data: averageTime,
                }]
        });
      }
  },
  created() {
      
  },
  mounted() {
        this.getInfo()
        
  },
}

</script>

<style lang="scss">
#app {
  text-align: center;
  color: #2c3e50;
}
#nav {
  padding: 30px;
  text-align: center;
  a {
    padding-left: 20px;
    font-weight: bold;
    color: #2c3e50;
    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
.basicInfo{
    display: inline-flex;
    width: 100%;
    align-items: flex-start;
    justify-content: center;
    flex-flow: row nowrap;
}
.userInfo{
    width: 14%;
    font-size: 20px;
    padding-bottom: 20px;
    box-shadow: 2px 2px 5px grey;
}
.editIcon{
    width: 32px;
    position: relative;
    float: right;
    display: none;
}
.userInfos{
    margin: 15px 0;
    text-align: center;
}
.editBox{
    position: relative;
    width: 100%;
    height: 32px;
}
.infoTable{
    position: relative;
    width: 100%;
    top: -15px;
}
.avater{
    position: relative;
    width: 120px;
    border-radius: 100%;
}
</style>