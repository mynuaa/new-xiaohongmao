<template>
  <div id="app">
    <div id="img-toutu"></div>
    <div id="nav">
      <router-link to="/loggedIn">首页</router-link>
      <router-link to="/activity">志愿活动</router-link>
      <router-link to="/announcement">公告&动态</router-link>
      <router-link to="/comments">意见箱</router-link>
      <router-link to="/certification">服务认证</router-link>
      <router-link to="/navigate">导航</router-link>
    </div>
    <router-view/>
  </div>
</template>

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
#img-toutu {
  width: 100%;
  height: 250px;
  background-image: url('./assets/toutu.png');
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
