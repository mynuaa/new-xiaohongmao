<template>
    <div class="activity">
        <Loading v-if="show"></Loading>
        <div class="allActivities">
            <table class="activityTable">
                <thead>
                    <tr>
                        <th>活动标题</th>
                        <th>主办方</th>
                        <th>志愿时长</th>
                        <th>发布时间</th>
                        <th>状态</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in activityList" :key="item.aid" class="activityLine">
                        <router-link :to="'/detail/' + item.aid"><td width="52%" class="activityTitle"><div class="filter">{{item.title}}</div></td></router-link>
                        <td width="12%" class="filter">{{item.hostname}}</td>
                        <td width="12%" class="filter">{{item.volunteertimemax}}</td>
                        <td width="12%" class="filter">{{formatDateTime(item.starttime)}}</td>
                        <td width="12%" class="filter">{{item.lastupdate | status}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <div class="paginationPart">
                                <ul class="pagination">
                                    <li><div class="pageIcon" @click="turn('-')">«</div></li>
                                    <li v-for="n in indexs" :key="n" class="pageIcon" v-bind:class=" {'curpage': cur == n}"  @click="turn(n)" ><div>{{n}}</div></li>
                                    <li><div class="pageIcon" @click="turn('+')">»</div></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
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
        show:false
      }
  },
  filters: {
    status (value) {
        var nowDate = Date.parse(new Date()); 
        if(nowDate > value){
            return "已结束"
        }
        else{
            return "进行中"
        }
    }
  },
    methods: {
      getInfo(page){
          this.show = true;
          this.axios.post('https://my.nuaa.edu.cn/xiaohongmao2/api', {
              service: 'Front.AllActivity',
              from: page * 20 - 20,
          }).then(re => {
              if(re.data.ret != 200){
                 alert('')
              }else{
                  this.activityList = re.data.data;
                  this.activePage = (page == null)? 1 : page;
                  this.show = false;
              }
          })
          
      },
      turn(n){  //-----------------------------------------------------确定分页数
        if(n != '-' && n!= '+'){
                this.cur = n; 
            }
          var page = this.activePage
          console.log(page)
          if(n == '-'){
              if(page == 1){
                  return
              }
              else{
                this.getInfo(page - 1)
                this.cur --;
              }
          }
          else if(n == '+'){
              this.getInfo(page + 1)
              this.cur ++;
          }
          else{
              this.getInfo(n)
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
        this.getInfo()
        
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
.activityTable{
    background-color: white;
    display: inline-table;
    font-size: 18px;
    width: 90%;
    padding: 10px 10px;
    box-shadow: 2px 2px 5px grey;
    margin-bottom: 20px;
    border-spacing: 0px 5px;
    color: #1a3c40;
}
.activityLine{
    width: 95%;
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
}
.pagination{
    list-style: none;
    display: flex;
    flex-direction: row;
    justify-content: center;
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
