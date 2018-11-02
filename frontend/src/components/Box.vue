<template>
    <div id="box">
        <div id="header">
            <div>近期活动</div>
        </div>
        <div id="body">
          <ul>
            <li v-for="item in items" :key="item.aid">
              <router-link :to="'/detail/' + item.aid"><div class="label filter" style="font-weight:550;">{{item.title}}</div></router-link>
              <div class="origin filter">{{item.hostname}}</div>
              <div class="date filter">{{formatDateTime(item.starttime)}}</div>
            </li>
          </ul>
        </div>
        <div id="footer"><a href='#' @click="routeractivity" style="padding-bottom:2px;">more</a></div>
    </div>
</template>

<script>
export default {
  name: "Box",
  props: {
    // isTwo:string
  },
  data: function() {
    return {
      istrue: true,
      items: []
    };
  },
  methods :{
    routeractivity () {
      this.$router.push('/activity');
    },
    getShowData(){
      this.axios.post('/xiaohongmao2/api/?s=App.Front.AllActivity',  {
          pagenum: 8
      }).then(re => {
        if(re.data.ret == 200){
          this.items = re.data.data;
        }else{
          console.log(re.data.msg)
        }
      })
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
    this.getShowData()
  },
};
</script>

<style <style lang="scss" scoped>
#box {
  border:1px solid #cffdf8;
}
#header {
  background-color:#cffdf8;
  color: #2d767f;
  letter-spacing: 4px;
  font-weight: 800;
  height: 40px;
  // padding-bottom: 20px;
  text-align: center;
  div {
    line-height: 40px;
  }
  
}
#body {
  margin-top: 10px;
  height: 70%;
  
  padding-left: 20px;
  ul {
    margin: 0px;
    padding: 0px;
    li {
      line-height: 24px;
      border-bottom:1px dashed #cffdf8;
      margin-left: 4px;
      margin-bottom: 2px;
      text-align: left;
      list-style-type: none;
      text-decoration: none;
      .label {
        display: inline-block;
        width: 50%;
      }
      .origin {
        display: inline-block;
        width: 30%;
      }
      .date {
        display: inline-block;
        width: 20%;
      }
      .filter{
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
      }
    }
  }
}
a{
  color: #2c3e50;
}
#footer {
  height: 28px;
  &:hover {
      background-color:#65c0ba; 
      color: white;
    }
  a {
    width: 100%;
    color: #666666;
    text-decoration: none;
    
  }
}
</style>

