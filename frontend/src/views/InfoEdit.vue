<template>
  <div id="InfoEdit">
    <div>
        <div class="userInfo">
        <div>
            <img src="../assets/logo.png" alt="avater" class="avater">
        </div>
        <div>
            <div class="editable">{{username}}</div>
            <div class="editable">{{userid}}</div>
        </div>
    </div>
    
    </div>
    
    <div class="carousel">
        <carousel :per-page="1" :navigate-to="someLocalProperty" mouse-drag="true" loop='true'>
            <slide>
            Slide 1 Content
            </slide>
            <slide>
            Slide 2 Content
            </slide>
        </carousel>
    </div>
  </div>
</template>

<script>
var echarts = require('echarts')
export default {
  name: 'loggedIn',
  components: {
    
  },
  data(){
      return{
        username:'一个人',
        userid:'123456789',
        activityList:[
            {activity:'随便什么凑够十五个字还差一点够了',host:'纸飞机啦啦啦',time:'1.1.1',date:'10',state:'1'},
        
        ]
          
      }
  },
  methods: {
      getInfo(){
          this.axios.post('https://my.nuaa.edu.cn/xiaohongmao2/api').then(re => {
              console.log(re)
          })
      }
  },
  created() {
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
.carousel{
    display: inline-block;
    background-color: grey;
    width: 80%;
    margin-bottom: 20px;
}
</style>