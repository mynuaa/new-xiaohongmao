<template>
<div id="content">
	<div class="title-cont" >
		<span class="title">{{this.item.title}}</span>
	</div>

	<div class="header">
        <a href="#">{{this.item.hostname}}</a>
		<span class="little-label" >{{this.item.typename}}</span>
		&nbsp;&nbsp; 时长：<span class="red">{{this.item.volunteertimemin}}</span>小时 
        &nbsp;&nbsp;&nbsp;日期：2016-11-15 - 2019-01-13
        <div class="xiugai">
			<span>【上次修改: <span style="color:gray;">2016-11-16 11:38:12</span>】</span>
	    </div>
	</div>
	
	<div class="detail">
		<p活动地点：</p>
		<span style="text-indent:85px;height:30px;line-height:30px;" >{{this.item.location}}</span>
        <p>活动简介：</p>
	    <div style="width:50%;float:left;margin:10px auto 20px 0;height:30px;" v-html="this.item.detail"></div>
	</div>
</div>
</template>

<script>
export default {
  data() {
    return {
      items: {},
      item: []
    };
  },
  methods: {
    getShowData() {
      this.axios
        .post(
          "https://my.nuaa.edu.cn/xiaohongmao2/api/?s=App.Front.GetActivity",
          {
            id: this.$route.params.aid
          }
        )
        .then(re => {
          if (re.data.ret == 200) {
            this.item = re.data.data;
          } else {
            console.log(re.data.msg);
          }
        });
    }
  },
  mounted() {
    this.getShowData();
    console.log(this.$route.params);
  }
};
</script>

<style lang="scss" scoped>
#content {
  text-align: center;
  border:1px solid #CCCCCC;
}
.header {
  text-align: center;
  margin: 10px auto;
  font-size:14px;
  .xiugai{
      width:500px;
      text-align:center;
      span{
          color:gray;
      }
  }
}

.detail {
    p{
        background:#ceffbb;height:30px;line-height:30px;text-indent:20px;font-weight:bold;
    }
}
</style>
