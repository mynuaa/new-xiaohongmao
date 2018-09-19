<template>
    <div id="box">
        <div id="header">
            <div>公告</div>
            <a href='/'>more</a>
        </div>
        <div id="body">
          <ul>
            <li v-for="item in items">
              <div class="label">{{item.label}}</div>
              <div class="origin" v-bind:class="{'two':istrue}">{{item.origin}}</div>
              <div class="date">{{item.date}}</div>
            </li>
          </ul>
        </div>
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
      istrue:true,  
      items: [
        {
          label: "南京航空航天大学志愿",
          origin: "校青协",
          date: "2014-02-03"
        },
        {
          label: "南京航空航天大学志愿",
          origin: "",
          date: "2014-02-08"
        },
        {
          label: "南京航空航天大学志愿",
          origin: "",
          date: "2014-02-08"
        },
        {
          label: "南京航空航天大学志愿",
          origin: "",
          date: "2014-02-08"
        },
        {
          label: "南京航空航天大学志愿",
          origin: "",
          date: "2014-02-08"
        }
      ]
    };
  }
};
</script>

<style <style lang="scss" scoped>
#header{
  height: 20%;
  line-height: 100%;
  div{
    display: inline-block;
  }
  a{
    float: right;
  }
}
#body{
  
  height: 80%;
  ul{
    margin: 0px;
    padding: 0px;
    li{
      text-align: left;
      list-style-type: none;
      text-decoration: none;
      .label{
        display: inline-block;
        width: 50%;
      }
      .origin{
        display: inline-block;
        width: 30%;
      }
      .date{
        display: inline-block;
        width: 20%;
      }
    }
  }
}
.two{
  display: none;
}
</style>

