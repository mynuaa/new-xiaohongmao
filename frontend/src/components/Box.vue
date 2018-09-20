<template>
    <div id="box">
        <div id="header">
            <div>活动总览</div>
        </div>
        <div id="body">
          <ul>
            <li v-for="item in items">
              <div class="label" style="font-weight:550;">{{item.label}}</div>
              <div class="origin">{{item.origin}}</div>
              <div class="date">{{item.date}}</div>
            </li>
          </ul>
        </div>
        <div id="footer"><a href='#'>more</a></div>
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
      items: [
        {
          label: "南京航空航天大学志愿",
          origin: "校青协",
          date: "2014-02-03"
        },
        {
          label: "南京航空航天大学纸飞机志愿",
          origin: "南航纸飞机",
          date: "2014-02-08"
        },
        {
          label: "南京航空航天大学十六院志愿",
          origin: "南航石榴园",
          date: "2014-02-08"
        },
        {
          label: "南京航空航天大学技术部志愿",
          origin: "技术部",
          date: "2014-02-08"
        },
        {
          label: "南京航空航天大学何惧老俱乐部志愿",
          origin: "何巨佬",
          date: "2014-02-08"
        },
        {
          label: "南京航空航天大学何惧老俱乐部志愿",
          origin: "何巨佬",
          date: "2014-02-08"
        },
        {
          label: "南京航空航天大学何惧老俱乐部志愿",
          origin: "何巨佬",
          date: "2014-02-08"
        }
      ]
    };
  }
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
        width: 60%;
      }
      .origin {
        display: inline-block;
        width: 20%;
      }
      .date {
        display: inline-block;
        width: 20%;
      }
    }
  }
}

#footer {
  height: 10%;
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

