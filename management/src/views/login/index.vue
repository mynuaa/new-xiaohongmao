<template>
  <div class="login-container">

    <el-form ref="loginForm" :model="loginForm" :rules="loginRules" class="login-form" auto-complete="on" label-position="left">

      <div class="title-container">
        <h3 class="title">小红帽 - 用户登录</h3>
      </div>

      <el-form-item prop="username">
        <span class="svg-container svg-container_login">
          <svg-icon icon-class="user" />
        </span>
        <el-input
          v-model="loginForm.username"
          placeholder="学号"
          name="username"
          type="text"
        />
      </el-form-item>

      <el-form-item prop="password">
        <span class="svg-container">
          <svg-icon icon-class="password" />
        </span>
        <el-input
          :type="passwordType"
          v-model="loginForm.password"
          placeholder="教务处密码"
          name="password"
          auto-complete="on"
          @keyup.enter.native="handleLogin" />
        <span class="show-pwd" @click="showPwd">
          <svg-icon icon-class="eye" />
        </span>
      </el-form-item>
      <div id="captchaBox" style="width: 100%;"></div>
      <el-button :loading="loading" type="primary" style="width:100%;margin-bottom:30px;margin-top: 22px;" @click.native.prevent="handleLogin">登录</el-button>
    <!--
      <div class="tips">
        <span>{{ $t('login.username') }} : admin</span>
        <span>{{ $t('login.password') }} : {{ $t('login.any') }}</span>
      </div>
      <div class="tips">
        <span style="margin-right:18px;">{{ $t('login.username') }} : editor</span>
        <span>{{ $t('login.password') }} : {{ $t('login.any') }}</span>
      </div>

      <el-button class="thirdparty-button" type="primary" @click="showDialog=true">{{ $t('login.thirdparty') }}</el-button>-->
    </el-form>

  </div>
</template>

<script>
import { isvalidUsername } from '@/utils/validate'
import LangSelect from '@/components/LangSelect'
import SocialSign from './socialsignin'
import '../../dx.js'
import { setToken, getRole} from '@/utils/auth'

export default {
  name: 'Login',
  components: { LangSelect, SocialSign },
  data() {
    const validateUsername = (rule, value, callback) => {
      if (!isvalidUsername(value)) {
        callback(new Error('请输入9位学号'))
      } else {
        callback()
      }
    }
    const validatePassword = (rule, value, callback) => {
      if (value.length < 4) {
        callback(new Error('密码不能这么短哦~'))
      } else {
        callback()
      }
    }
    return {
      loginForm: {
        username: '',
        password: ''
      },
      dxResult: false,
      loginRules: {
        username: [{ required: true, trigger: 'blur', validator: validateUsername }],
        password: [{ required: true, trigger: 'blur', validator: validatePassword }]
      },
      passwordType: 'password',
      loading: false,
      showDialog: false,
      redirect: undefined
    }
  },
  watch: {
    $route: {
      handler: function(route) {
        this.redirect = route.query && route.query.redirect
      },
      immediate: true
    }

  },
  created() {
    // window.addEventListener('hashchange', this.afterQRScan)
  },
  destroyed() {
    // window.removeEventListener('hashchange', this.afterQRScan)
  },
  mounted(){
    this.makecode()
  },
  methods: {
    /*makegt(){
      this.gtKey = (Math.floor(Math.random()*1e14)).toString(32)
      this.axios.post('https://my.nuaa.edu.cn/xiaohongmao2/api', {
        service: 'App.Admin.BeforeLogin',
        stuid: this.gtKey
      }).then(re => {
        re = {
          ...re.data.data,
          new_captcha: 1
        }
        initGeetest({
          ...re,
          width: '100%',
          product: 'popup',
          https: true
        }, captchaObj => {
          captchaObj.appendTo("#captchaBox"); //将验证按钮插入到宿主页面中captchaBox元素内
          captchaObj.onReady(()=>{

          }).onSuccess(()=>{
              this.gtResult = captchaObj.getValidate()

          }).onError(function(e){
              console.log(e)
          })
      })
      })
    },*/
    makecode(){
      this._dx = _dx.Captcha(document.getElementById('captchaBox'), {
        appId: '069ae57274e54291f373478057e1d796',
        style: 'inline',
        inlineFloatPosition: 'up',
        protocol: 'https:',
        width: document.querySelector('.el-form-item').offsetWidth,
        success: (token)=>{
          this.dxResult = token
        },
        fail: (e) => {
            console.log(e)
        }
      })
    },
    showPwd() {
      if (this.passwordType === 'password') {
        this.passwordType = ''
      } else {
        this.passwordType = 'password'
      }
    },
    handleLogin() {
        /*不要验证
      this.$refs.loginForm.validate(valid => {
        if (valid) {
          this.loading = true
          this.$store.dispatch('LoginByUsername', this.loginForm).then(() => {
            this.loading = false
            this.$router.push({ path: this.redirect || '/' })
          }).catch(() => {
            this.loading = false
          })
        } else {
          console.log('error submit!!')
          return false
        }
      })*/
      if(this.dxResult == false){
        return;//todo 提示验证码错误
      }
      //http://g.gg/new-xiaohongmao/backend/public/index.php
      //https://my.nuaa.edu.cn/xiaohongmao2/api
      this.loading = true
      this.axios.post('/xiaohongmao2/api', {
        service: 'App.Admin.Login',
        stuid: this.loginForm.username,
        passwd: this.loginForm.password,
        dx: this.dxResult
      }).then(re => {
        re = re.data
        if(re.ret != 200 ){
          alert(re.msg)
          this._dx.reload()
          this.loading = false
        }
        setToken(re.data)
        //getRole()
        this.$router.push({ path: '/information' })
      })

    },
    afterQRScan() {
      // const hash = window.location.hash.slice(1)
      // const hashObj = getQueryObject(hash)
      // const originUrl = window.location.origin
      // history.replaceState({}, '', originUrl)
      // const codeMap = {
      //   wechat: 'code',
      //   tencent: 'code'
      // }
      // const codeName = hashObj[codeMap[this.auth_type]]
      // if (!codeName) {
      //   alert('第三方登录失败')
      // } else {
      //   this.$store.dispatch('LoginByThirdparty', codeName).then(() => {
      //     this.$router.push({ path: '/' })
      //   })
      // }
    }
  }
}
</script>

<style rel="stylesheet/scss" lang="scss">
  /* 修复input 背景不协调 和光标变色 */
  /* Detail see https://github.com/PanJiaChen/vue-element-admin/pull/927 */

  $bg:#283443;
  $light_gray:#eee;
  $cursor: #fff;

  @supports (-webkit-mask: none) and (not (cater-color: $cursor)) {
    .login-container .el-input input{
      color: $cursor;
      &::first-line {
        color: $light_gray;
      }
    }
  }

  /* reset element-ui css */
  .login-container {
    .el-input {
      display: inline-block;
      height: 47px;
      width: 85%;
      input {
        background: transparent;
        border: 0px;
        -webkit-appearance: none;
        border-radius: 0px;
        padding: 12px 5px 12px 15px;
        color: $light_gray;
        height: 47px;
        caret-color: $cursor;
        &:-webkit-autofill {
          -webkit-box-shadow: 0 0 0px 1000px $bg inset !important;
          -webkit-text-fill-color: $cursor !important;
        }
      }
    }
    .el-form-item {
      border: 1px solid rgba(255, 255, 255, 0.1);
      background: rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      color: #454545;
    }
  }
</style>

<style rel="stylesheet/scss" lang="scss" scoped>
$bg:#2d3a4b;
$dark_gray:#889aa4;
$light_gray:#eee;

.login-container {
  position: fixed;
  height: 100%;
  width: 100%;
  background-color: $bg;
  .login-form {
    position: absolute;
    left: 0;
    right: 0;
    width: 520px;
    max-width: 100%;
    padding: 35px 35px 15px 35px;
    margin: 120px auto;
  }
  .tips {
    font-size: 14px;
    color: #fff;
    margin-bottom: 10px;
    span {
      &:first-of-type {
        margin-right: 16px;
      }
    }
  }
  .svg-container {
    padding: 6px 5px 6px 15px;
    color: $dark_gray;
    vertical-align: middle;
    width: 30px;
    display: inline-block;
    &_login {
      font-size: 20px;
    }
  }
  .title-container {
    position: relative;
    .title {
      font-size: 26px;
      color: $light_gray;
      margin: 0px auto 40px auto;
      text-align: center;
      font-weight: bold;
    }
    .set-language {
      color: #fff;
      position: absolute;
      top: 5px;
      right: 0px;
    }
  }
  .show-pwd {
    position: absolute;
    right: 10px;
    top: 7px;
    font-size: 16px;
    color: $dark_gray;
    cursor: pointer;
    user-select: none;
  }
  .thirdparty-button {
    position: absolute;
    right: 35px;
    bottom: 28px;
  }
}
</style>
