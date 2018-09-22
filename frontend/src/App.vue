<template>
  <div id="app">
    <div id="img-toutu"></div>
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
    <router-view style="margin-bottom:20px;"/>
    <div id="footer">
      <div class="copyright">
			  <span>
				  Copyright &copy; 2012-2018
				  <span>
					  <a	href="http://my.nuaa.edu.cn" target="_blank" >纸飞机南航青年网络社区</a>
				  </span>
			  </span>
	  	</div>
		  <div class="footer-font">
			共青团南京航空航天大学委员会
		  </div>
    </div>
  </div>
</template>


<style lang="scss">
#app {
  color: #2c3e50;
  background-color: rgb(245, 245, 245);
}
#nav {
  padding: 0px 0px 20px 0px;
  // text-align: center;
  font-size: 20px;
  ul {
    background: #11998e; /* fallback for old browsers */
    background: -webkit-linear-gradient(
      to left,
      #92ff98,
      #a1e4ff
    ); /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to left, #92ff98, #a1e4ff);
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    // border:2px solid rgb(212, 103, 103);
    // box-shadow: 4px 2px rgb(202, 184, 184);
    margin: 0 auto;
    padding: 0;
    width: 100%;
    height: 70px;
    li {
      display: inline-block;
      height: 70px;
      width: 150px;
      &:hover {
        background-color: rgb(255, 255, 255);
      }
      a {
        line-height: 70px;
        display: inline-block;
        text-decoration: none;
        font-weight: bold;
        color: #1f0768;
        &.router-link-exact-active {
          color: #b98542;
        }
      }
    }
  }
}
#img-toutu {
  width: 100%;
  height: 220px;
  background-image: url("./assets/toutu.png");
  background-repeat: no-repeat;
  background-size: 100% 100%;
  margin-top: -35px;
  overflow: hidden;
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
    margin-top: 10px;
    font-weight: 900;
    width: 100%;
    font-size: 1.1em;
  }
}
</style>
