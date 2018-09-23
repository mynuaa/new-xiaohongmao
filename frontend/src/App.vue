<template>
  <div id="app">
    <div id="imgBox">
      <img src="./assets/toutu.png" id='img-toutu'>
    </div>
    <div id="nav">
      <ul>
      <li><router-link to="/">首页</router-link></li>
      <li><router-link to="/activity">志愿活动</router-link></li>
      <!-- <li><router-link to="/announcement">公告&动态</router-link></li>
      <li><router-link to="/comments">意见箱</router-link></li>
      <li><router-link to="/certification">服务认证</router-link></li>
      <li><router-link to="/navigate">导航</router-link></li> -->
      <!-- <li><router-link to="/detail">活动详情</router-link></li> -->
      <li><router-link to="/loggedIn">个人详情</router-link></li>
      </ul>
    </div>
    <div class="mainPage">
      <router-view style="margin-bottom:20px;"/>
      <div class="carouselBox">
          <AdCarousel></AdCarousel>
      </div>
    </div>
    <div id="footer">
      <div class="copyright">
			  <span>
				  Copyright &copy; 2012-2018
				  <span>
					  <a	href="http://my.nuaa.edu.cn" target="_blank" style="color:black">纸飞机南航青年网络社区</a>
				  </span>
			  </span>
	  	</div>
		  <div class="footer-font">
			共青团南京航空航天大学委员会
		  </div>
    </div>
  </div>
</template>

<script>
  
import AdCarousel from "./components/AdCarousel.vue";
export default{
  components:{
    AdCarousel,
  }
}
</script>

<style lang="scss">
html{
  width: 100%;
}
#app {
  color: #2c3e50;
  background-color: #ecfffb;
  width: 100%;
  font-family: "Microsoft YaHei";
}
#nav {
  padding: 10px 0px 10px 0px;
  // text-align: center;
  font-size: 20px;
  ul {
    background: #a1e4ff; /* fallback for old browsers */
    background: -webkit-linear-gradient(
      to left,
      #c4ffdd,
      #a1e4ff
    ); /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to left, #c4ffdd, #a1e4ff);
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    // border:2px solid rgb(212, 103, 103);
    // box-shadow: 4px 2px rgb(202, 184, 184);
    margin: 0 auto;
    padding: 0;
    width: 90%;
    height: 70px;
    li {
      display: inline-block;
      height: 70px;
      width: 150px;
      &:hover {
        background-color: #ecfffb;
      }
      a {
        padding: 0;
        line-height: 70px;
        display: inline-block;
        text-decoration: none;
        font-weight: bold;
        color: #444444;
        &.router-link-exact-active {
          color: #2d767f;
        }
      }
    }
  }
}
.imgBox{
  width: 100%;
  overflow: hidden;
}
#img-toutu {
  width: 100%;
  height: 100%;
}
.carouselBox{
  width: 100%;
  margin: 10px 0;
  display: none;
}
#footer {
  font-size: 90%;
  justify-content: center;
  margin-left: 10%;
  width: 80%;
  text-align: center;
  border-top: 1px solid #999999;
  .copyright {
    
    margin-top: 10px;
    margin-bottom: 10px;
    width: 100%;
    color: #666666;
    margin-bottom: 0;
  }
  .footer-font {
    margin: 10px 0;
    font-weight: 900;
    width: 100%;
    font-size: 1.1em;
  }
}
</style>
