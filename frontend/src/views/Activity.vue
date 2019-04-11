<template>
    <div class="activity">
        <Loading v-if="show"></Loading>
        <div class="allActivities">
             <div class="radioBox">
                <el-radio-group v-model="selected" @change="getInfo(1,selected),turn(1), getPages()" class="radioGroup">
                    <el-radio-button :label="item.hid" :key="item.hid" v-for="item in hosters" class="radioButton">{{item.hostname}}</el-radio-button>
                </el-radio-group>
            </div>
            <div class="activityTable" style="width:90%;">
                <div class="tableHeader">
                        <div style="width:40%" class="filter">活动标题</div>
                        <div style="width:24%" class="filter">主办方</div>
                        <div style="width:12%" class="filter">志愿时长</div>
                        <div style="width:12%" class="filter">发布时间</div>
                        <div style="width:12%" class="filter">状态</div>
                </div>
                <div class="tableBody">
                    <ul>
                    <li v-for="item in activityList" :key="item.aid" class="activityLine">
                        <router-link :to="'/detail/' + item.aid" style="width:40%"><div style="width:100%" class="activityTitle filter">{{item.title}}</div></router-link>
                        <div style="width:24%" class="filter">{{item.hostname}}</div>
                        <div style="width:12%" class="filter">{{item.volunteertimemax}}</div>
                        <div style="width:12%" class="filter">{{formatDateTime(item.starttime)}}</div>
                        <div style="width:12%" class="filter">{{item.endtime | status}}</div>
                    </li>
                    </ul>
                </div>
                <div class="table-footer">
                    <div>
                        <div colspan="5">
                            <div class="paginationPart">
                                <ul class="pagination">
                                    <li><div class="pageIcon" @click="turn('-')">«</div></li>
                                    <li v-for="n in indexs" :key="n" class="pageIcon" v-bind:class=" {'curpage': cur == n}"  @click="turn(n)" ><div>{{n}}</div></li>
                                    <li><div class="pageIcon" @click="turn('+')">»</div></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>    
       
        
    </div>
    
</template>

<script>
import Loading from '../components/Loading.vue'

export default {
  name: 'activity',
  components: {
     Loading
  },
  data(){
      return{
        pageNum:10,//获取全部文章页数
        activityList:[],
        activePage:1,
        cur:1,
        radio:0,
        show:true,
        selected:"-1",
        actNum:1,
        hosters:[
            {
                "hid": "-1",
                "hostname": "全部",
                "hostnickname": "全部"
            },
            {
                "hid": "0",
                "hostname": "校青协",
                "hostnickname": "校青协"
            },
            {
                "hid": "1",
                "hostname": "航空宇航学院",
                "hostnickname": "航空宇航学院"
            },
            {
                "hid": "2",
                "hostname": "能源与动力学院",
                "hostnickname": "能源与动力学院"
            },
            {
                "hid": "3",
                "hostname": "自动化学院",
                "hostnickname": "紫冬花"
            },
            {
                "hid": "4",
                "hostname": "电子信息工程学院",
                "hostnickname": "电子信息工程学院"
            },
            {
                "hid": "5",
                "hostname": "机电学院",
                "hostnickname": "机电学院"
            },
            {
                "hid": "6",
                "hostname": "材料科学与技术学院",
                "hostnickname": "材料科学与技术学院"
            },
            {
                "hid": "7",
                "hostname": "民航学院/飞行学院",
                "hostnickname": "民航学院/飞行学院"
            },
            {
                "hid": "8",
                "hostname": "理学院",
                "hostnickname": "理学院"
            },
            {
                "hid": "9",
                "hostname": "经济管理学院",
                "hostnickname": "经济管理学院"
            },
            {
                "hid": "10",
                "hostname": "人文与社会科学学院",
                "hostnickname": "人文与社会科学学院"
            },
            {
                "hid": "11",
                "hostname": "艺术学院",
                "hostnickname": "艺术学院"
            },
            {
                "hid": "12",
                "hostname": "外国语学院",
                "hostnickname": "外国语学院"
            },
            {
                "hid": "15",
                "hostname": "航天学院",
                "hostnickname": "航天学院"
            },
            {
                "hid": "16",
                "hostname": "计算机科学与技术学院",
                "hostnickname": "计算机科学与技术学院"
            },
            {
                "hid": "17",
                "hostname": "马克思主义学院",
                "hostnickname": "马克思主义学院"
            },
            {
                "hid": "101",
                "hostname": "社团组织",
                "hostnickname": "社团组织"
            },
            {
                "hid": "102",
                "hostname": "图书馆志愿者分会",
                "hostnickname": "图书馆志愿者分会"
            },
            {
                "hid": "103",
                "hostname": "学习支持辅导中心",
                "hostnickname": "学习支持辅导中心"
            }
        ]
      }
  },
  filters: {
    status (value) {
        const nowDate = Date.parse(new Date()) / 1000 //毫秒转换
        // console.log(value, nowDate)
        if(nowDate > value){
            return "已结束"
        }
        else{
            return "进行中"
        }
    }
  },
    methods: {
        getPages(){
            this.axios.post('/xiaohongmao2/api',{
                service: 'Front.AllActivity',
                from:0,
                pagenum:this.actNum,
                hid:this.selected
            }).then(re => {
                if(re.data.ret != 200){
                    alert('');
                }else{
                    this.pageNum = Math.ceil(re.data.data.length/20);
                    if(this.pageNum == 0){this.pageNum = 1;}
                }
            })
        },

      getInfo(page,hid){
          this.axios.post('/xiaohongmao2/api', {
              service: 'Front.AllActivity',
              from: page * 20 - 20,
              hid: hid,
          }).then(re => {
              if(re.data.ret != 200){
                 alert('')
              }else{
                  this.selected = hid;
                  this.activityList = re.data.data;
                  this.activePage = (page == null)? 1 : page;
                  this.show = false;
              }
          })
            
      },
      getactNum(){
          this.axios.post('/xiaohongmao2/api', {
              service: 'Front.ShowData',
          }).then(re => {
              if(re.data.ret != 200){
                 alert('')
              }else{
                  var num = re.data.data.actNum;
                  this.actNum = num;
                  this.pageNum = Math.ceil(num/20);
              }
          })
      },
      turn(n){  //-----------------------------------------------------确定分页数
        if(n != '-' && n!= '+'){
                this.cur = n; 
            }
          var page = this.activePage;
          if(n == '-'){
              if(page == 1){
                  return
              }
              else{
                this.getInfo(page - 1 , this.selected)
                this.cur --;
              }
          }
          else if(n == '+'){
              if(n == pageNum){
                  return
              }
              else{
                this.getInfo(page + 1 , this.selected)
                this.cur ++;
            }
          }
          else{
              this.getInfo(n , this.selected)
          }
          
      },
      formatDateTime(timeStamp) { 
        var date = new Date(parseInt(timeStamp) * 1000);
        var y = date.getFullYear();    
        var m = date.getMonth() + 1;    
        m = m < 10 ? ('0' + m) : m;    
        var d = date.getDate();    
        d = d < 10 ? ('0' + d) : d;   
        return y + '-' + m + '-' + d;    
      },

  },
  mounted() {
        this.getInfo();
        this.getactNum();
  },

  computed:{
        indexs: function(){
          var left = 1;
          var right = this.pageNum;
          var ar = [];
          if(this.pageNum>= 5){
            if(this.cur > 3 && this.cur < this.pageNum-2){
                    left = this.cur - 2
                    right = this.cur + 2
            }else{
                if(this.cur<=3){
                    left = 1
                    right = 5
                }else{
                    right = this.pageNum
                    left = this.pageNum -4
                }
            }
         }
        while (left <= right){
            ar.push(left)
            left ++
        }
        return ar
       }
    },


}

</script>

<style lang="scss">
#app {
  width:100%;
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
a{
    text-decoration: none;
}
.activity{
    width: 100%;
    text-align: center;
}
.allActivities{
    width: 100%;
    text-align: center;
}
.radioBox{
    width: 90%;
    text-align: center;
    display: inline-block;
    background-color: white;
    box-shadow: 2px 0px 4px grey;


}
.radioGroup{
    display: flex !important ;
    justify-content: flex-start;
    flex-direction: row;
    flex-wrap: wrap;
    padding: 15px 10px; 
}
.radioButton{
    border-left: 0.8px solid #dcdfe6;
    margin: 2px;
    border-radius: 4px;
}
.activityTable{
    
    background-color: white;
    font-size: 18px;
    width: 90%;
    text-align: center;
    // padding: 10px 10px;
    box-shadow: 2px 2px 5px grey;
    margin-top: 2px;
    margin-bottom: 20px;
    margin-left: 5%;
    border-spacing: 0px 5px;
    color: #1a3c40;
    display: flex !important;
    flex-direction: column;
    .tableHeader{
        margin-top: 4px;
        display: flex;
        flex-direction: row;
        margin-bottom: 8px;
    }
    .tableBody{
        width:100%;
        ul{
            padding: 0px;
            margin: 0px;
            .activityLine{
                width: 100%;
                display: flex;
                flex-direction: row;
                text-align: center;
                margin-bottom: 6px;
                border-radius: 2px;
                line-height: 32px;
            }
        }
        
    }
    
}

.activityLine:hover{
    background-color: #a6e3e9;
}
.activityTitle{
    color: #1a3c40;
    text-decoration-line: none;
    vertical-align: middle;
}
.filter{
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.paginationPart{
    text-align: center;
    // ul{
    //     padding: 0px;
    //     margin: 0px;
    // }
}
.pagination{
    list-style: none;
    display: flex;
    flex-direction: row;
    justify-content: center;
    margin: 24px 0px;
    padding-inline-start:0px;
}
.pageIcon{
    margin: 5px;
    padding: 10px;
    font-weight: bold;
    border-radius: 10%;
    color: #2c3e50;
    cursor: pointer;
    &.router-link-exact-active {
      color: #42b983;
    } 
}
.pageIcon:hover{
    background-color: lightgrey;
}
.curpage{
    color:#37aa9c;
}
</style>
