<template>
<div id="content">
	<div class="title-cont" >
		<span class="title">{{this.item.title}}</span>
	</div>

	<div class="header">
        <a href="#">{{this.item.hostname}}</a>
		<span class="little-label" style="color:#666666;">[{{this.item.typename}}]</span>
		&nbsp;&nbsp; 时长：<span style="color:red;">{{this.item.volunteertimemin}}</span>小时 
        &nbsp;&nbsp;&nbsp;日期：2016-11-15 - 2019-01-13
        <div class="xiugai">
			<div >【上次修改: <span style="color:gray;">2016-11-16 11:38:12</span>】</div>
	    </div>
	</div>
	
	<div class="detail">
		<p>活动地点：</p>
		<span>{{this.item.location}}</span>
        <p>活动简介：</p>
	    <div class="detail-detail" v-html="this.item.detail" style="height:fit-content;"></div>
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
          "/xiaohongmao2/api/?s=App.Front.GetActivity",
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
  width: 80%;
  margin-left: 10%;
  text-align: center;
  border: 1px solid #cccccc;
}
.title-cont {
  margin: 10px auto;
}
.header {
  text-align: center;
  font-size: 14px;
  a {
    font-weight: 400;
    color: black;
    text-decoration: none;
  }
  .xiugai {
    width: 100%;
    text-align: center;
    span {
      color: gray;
    }
  }
}

.detail {
    padding: 10px 20px 20px 20px;
  p {
    background: #ceffbb;
    height: 30px;
    line-height: 30px;
    font-weight: bold;
  }
  span {
    height: 30px;
    line-height: 30px;
  }
  .detail-detail {
    height:fit-content;
    text-align: center;
    margin: 10px auto 20px 0;
    height: 30px;
  }
}
</style>
