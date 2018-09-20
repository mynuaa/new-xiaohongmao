<template>
  <div id="LoggedIn">
    <div class="basicInfo">
        <div class="userInfo">
        <div>
            <img src="../assets/logo.png" alt="avater" class="avater">
        </div>
        <div>
            <div class="username">{{username}}</div>
            <div class="userid">{{userid}}</div>
        </div>
    </div>
    <div class="activities">
        <table class="activityTable">
            <thead>
                <tr>
                    <th>活动标题</th>
                    <th>主办方</th>
                    <th>志愿时长</th>
                    <th>活动时间</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in activityList" :key="item.a-id">
                    <td width="40%">{{item.activity}}</td>
                    <td width="15%" >{{item.host}}</td>
                    <td width="15%" >{{item.time}}</td>
                    <td width="15%">{{item.date}}</td>
                    <td width="15%">{{item.state}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
    
    <div class="achivement">
        <div id="myChart" class="charts" style="width:80%; height:300px">

        </div>
    </div>
    <div class="carousel">
        <carousel :per-page="1" :navigate-to="someLocalProperty" mouse-drag="true" loop='true'>
            <slide>
            Slide 1 Content
            </slide>
            <slide>
            Slide 2 Content
            </slide>
        </carousel>
    </div>
  </div>
</template>

<script>
var echarts = require('echarts')
export default {
  name: 'loggedIn',
  components: {
    
  },
  data(){
      return{
        username:'user',
        userid:'id',
        activityList:[
            {activity:'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',host:'zfj',time:'1.1.1',date:'10',state:'1'},
        
        ]
          
      }
  },
  mounted() {
      var myChart = echarts.init(document.getElementById('myChart'));
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
                data: [5, 20, 36, 10, 10]//aaaaaaaaaaaaaaaaaaa抓数据
            }]
      });
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
#loggedIn{
}
.basicInfo{
    display: inline-flex;
    width: 100%;
    align-items: flex-start;
    justify-content: center;
    flex-flow: row nowrap;
}
.userInfo{
    width: 15%;
    font-size: 28px;
}
.avater{
    width: 120px;
    border-radius: 100%;
}
.activities{
    text-align: center;
    
    width: 70%;
}
.activityTable{
    display: inline-block;
    font-size: 20px;
    width: 70%;

}
.charts{
    display: inline-block;
}
.carousel{
    display: inline-block;
    background-color: grey;
    width: 80%;
    margin-bottom: 20px;
}
</style>