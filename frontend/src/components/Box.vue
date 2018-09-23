<template>
    <div id="box">
        <div id="header">
            <div>近期活动</div>
        </div>
        <div id="body">
          <ul>
            <li v-for="item in items" :key="item.aid">
              <router-link :to="'/detail/' + item.aid"><div class="label" style="font-weight:550;">{{item.title | label}}</div></router-link>
              <div class="origin">{{item.hostname | origin}}</div>
              <div class="date">{{item.date}}</div>
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
  filters: {
    label: function (value) {
      if (value.length >= 15){
        return value.substring(0, 15) + ' ...';
      }
      else {
        return value;
      }
    },
    origin: function (value) {
      if (value.length >= 5){
        return value.substring(0, 5) + ' ...';
      }
      else {
        return value;
      }
    }
  },
  methods :{
    routeractivity () {
      this.$router.push('/activity');
    },
    getShowData(){
      this.axios.post('https://my.nuaa.edu.cn/xiaohongmao2/api/?s=App.Front.AllActivity',  {
          pagenum: 8
      }).then(re => {
        if(re.data.ret == 200){
          this.items = re.data.data;
        }else{
          console.log(re.data.msg)
        }
      })
    },

  },
  mounted() {
    this.getShowData()
  },
};
</script>

<style <style lang="scss" scoped>
#box {
  border:1px solid #CCCCCC;
}
#header {
  background-color:#CCCCCC;
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
  ul {
    margin: 0px;
    padding: 0px;
    li {
      border-bottom:1px dashed #CCCCCC;
      margin-left: 4px;
      margin-bottom: 2px;
      text-align: left;
      list-style-type: none;
      text-decoration: none;
      .label {
        display: inline-block;
        width: 55%;
      }
      .origin {
        display: inline-block;
        width: 25%;
      }
      .date {
        display: inline-block;
        width: 20%;
      }
    }
  }
}

#footer {
  height: 20px;
  &:hover {
      background-color:#6190e8; 
      color: white;
    }
  a {
    width: 100%;
    color: #666666;
    text-decoration: none;
    
  }
}
</style>

