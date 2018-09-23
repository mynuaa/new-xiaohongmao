<template>
    <div class="activity">
        <div class="allActivities">
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
                    <tr v-for="item in activityList" :key="item.aid">
                        <router-link :to="'/detail/' + item.aid"><td width="52%" class="activityTitle">{{item.title | title}}</td></router-link>
                        <td width="12%" >{{item.hostname | hostname}}</td>
                        <td width="12%" >{{item.volunteertimemax}}</td>
                        <td width="12%">{{formatDateTime(item.starttime)}}</td>
                        <td width="12%">{{item.lastupdate | status}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <div class="paginationPart">
                                <ul class="pagination">
                                    <li><div class="pageIcon" @click="turn('-')">«</div></li>
                                    <li v-for="n in pageNum" :key="n" class="pageIcon" @click="turn(n)" ><div>{{n}}</div></li>
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
export default {
  name: 'activity',
  components: {
    
  },
  data(){
      return{
        pageNum:10,
        activityList:[],
        activePage:1,
      }
  },
  filters: {
    title (value) {
      if (value.length >= 20){
        return value.substring(0, 20) + ' ...';
      }
      else {
        return value;
      }
    },
    hostname (value) {
      value = value || ''
      if (value.length >= 5){
        return value.substring(0, 5) + ' ...';
      }
      else {
        return value;
      }
    },
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
          this.axios.post('https://my.nuaa.edu.cn/xiaohongmao2/api', {
              service: 'Front.AllActivity',
              from: page * 20 - 20,
          }).then(re => {
              if(re.data.ret != 200){
                 alert('')
              }else{
                  this.activityList = re.data.data;
                  this.activePage = (page == null)? 1 : page;
              }
          })
      },
      turn(n){  //-----------------------------------------------------确定分页数
          var page = this.activePage
          console.log(page)
          if(n == '-'){
              if(page == 1){
                  return
              }
              else{
                this.getInfo(page - 1)
              }
          }
          else if(n == '+'){
              this.getInfo(page + 1)
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
.activity{
    width: 100%;
    
    text-align: center;
}
.allActivities{
    width: 100%;
    text-align: center;
}
.activityTable{
    display: inline-table;
    font-size: 18px;
    width: 80%;
    padding: 10px 0px;
    box-shadow: 2px 2px 5px grey;
    margin-bottom: 20px;
    border-spacing: 5px;
}
.activityTitle{
    text-decoration: none;
}
a:-webkit-any-link{
    text-decoration: none;
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
</style>
