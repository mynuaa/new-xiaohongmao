<template>
  <div class="home">
    <div class="body-left">
      <Box class="box-activity"></Box>
    </div>
    <div class="body-right">
      <div id="myChart" class="charts" style="width:100%; height:300px;"></div>
    </div>
    <ul class="bg-bubbles">

    <li  v-for="(item, index) in bubbles" :key="index"></li>
</ul>
  </div> 
</template>

<script>
// @ is an alias to /src
import Box from "../components/Box.vue";
var echarts = require("echarts");

export default {
  name: "home",
  data: function() {
    return {
      bubbles: [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
      showData:{},
      time:[]
    };
  },
  components: {
    Box
  },
  methods:{
    getShowData(){
      this.axios.post('https://my.nuaa.edu.cn/xiaohongmao2/api/?s=App.Front.ShowData').then(re => {
        if(re.data.ret == 200){
          this.showData = re.data.data;
          const timedata = this.showData.yuan;
          let time = []
          for(var i = 1; i <= 16; i++ ){
            time.push(timedata[i]);
          }
          this.time = time
          this.initEchart()
        }else{
          console.log(re.data.msg)
        }
      })
    },
    initEchart(){
        const myChart = echarts.init(document.getElementById("myChart"));
        myChart.setOption({
          title: {
            text: "南航各院志愿时长统计",
            left: "center"
          },
          tooltip: {},
          legend: {
            data: ["时长"]
          },
          xAxis: {
            data: [
              "一院",
              "二院",
              "三院",
              "四院",
              "五院",
              "六院",
              "七院",
              "八院",
              "九院",
              "十院",
              "十一院",
              "十二院",
              "十三院",
              "十四院",
              "十五院",
              "十六院"
            ]
          },
          yAxis: {},
          series: [
            {
              name: "志愿时长",
              type: "bar",
              data: this.time
            }
          ]
        });

      }
  },
  mounted() {
    // var time = [5, 20, 36, 10, 10, 12, 23, 34, 45, 1, 5, 1, 5, 1, 5, 1]
    this.getShowData();
  }
};
</script>

<style scoped lang="scss">
.home {
  width: 100%;
  display: flex;
  flex-direction: row;
}
.body-left {
  display: inline-block;
  width: 40%;

  padding-left: 10%;
}
.body-right {
  display: inline-block;
  width: 40%;
  .charts{
    display: inline-block;
}
}

.bg-bubbles {
  position: absolute;
  // 使气泡背景充满整个屏幕
  bottom: 0px;
  left: 0;
  width: 90%;
  // height: 300px;
  li {
    position: absolute;
    // bottom 的设置是为了营造出气泡从页面底部冒出的效果；
    bottom: 10px;
    // 默认的气泡大小；
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.15);
    list-style: none;
    // 使用自定义动画使气泡渐现、上升和翻滚；
    animation: square 15s infinite;
    transition-timing-function: linear;
    // 分别设置每个气泡不同的位置、大小、透明度和速度，以显得有层次感；

    &:nth-child(1) {
      left: 10%;
    }
    &:nth-child(2) {
      left: 30%;
      width: 90px;
      height: 90px;
      animation-delay: 2s;
      animation-duration: 7s;
    }
    &:nth-child(3) {
      left: 25%;
      animation-delay: 4s;
    }
    &:nth-child(4) {
      left: 40%;
      width: 60px;
      height: 60px;
      animation-duration: 8s;
      background-color: rgba(255, 255, 255, 0.3);
    }
    &:nth-child(5) {
      left: 70%;
    }
    &:nth-child(6) {
      left: 80%;
      width: 60px;
      height: 60px;
      animation-delay: 3s;
      background-color: rgba(255, 255, 255, 0.2);
    }
    &:nth-child(7) {
      left: 32%;
      width: 100px;
      height: 100px;
      animation-delay: 2s;
    }
    &:nth-child(8) {
      left: 55%;
      width: 20px;
      height: 20px;
      animation-delay: 4s;
      animation-duration: 15s;
    }
    &:nth-child(9) {
      left: 25%;
      width: 10px;
      height: 10px;
      animation-delay: 2s;
      animation-duration: 12s;
      background-color: rgba(255, 255, 255, 0.3);
    }
    &:nth-child(10) {
      left: 80%;
      width: 90px;
      height: 90px;
      animation-delay: 5s;
    }
  }
  // 自定义 square 动画；
  @keyframes square {
    0% {
      opacity: 0.5;
      transform: translateY(0px) rotate(45deg);
    }
    25% {
      opacity: 0.75;
      transform: translateY(-400px) rotate(90deg);
    }
    50% {
      opacity: 1;
      transform: translateY(-600px) rotate(135deg);
    }
    100% {
      opacity: 0;
      transform: translateY(-1000px) rotate(180deg);
    }
  }
}
</style>