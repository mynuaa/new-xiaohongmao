# 小红帽系统 新版本

分为 backend fontend management 三端

## backend

使用 phalApi via PHP7 + mysql + redis

数据库插件使用`medoo`，通过 `di()->db` 拉起

### 安装方法

* 开启redis
* 导入数据库
* 将`/config/myConfig.example.php` 复制 成 `/config/myConfig.php`,修改其中的数据库信息

## fontend

使用 vuecli via vue2

### 安装方法

安装最新版本的 vuecli `yarn global add @vue/cli`，然后 `vue ui`启动ui模式，选择载入`/fontend`文件夹即可

也可以直接 `yarn install` 后，`yarn dev`

需要sass，请先换成国内源

## management

基于 vueadmin 修改 via vue2

### 安装方法

直接 `yarn install` 后，`yarn dev` 即可

ps: 因为需要 `webpack4`，所以可能与之前版本的表现有所不同。依赖较多，可能会比较慢

## 数据mock

<del>待定</del>

还mock个小学弟呀，后端接口已经上线了

## 验证码

验证码采取geetest方案

前端在登录时，从后台拉取一个challengecode，然后初始化验证码，在前端先校验验证码是否正确。若正确，则允许提交，提交时附带geetest返回的三个认证数据。

## 后端调试

后端的接口以 `/xiaohongmao2/api` 开头 ，建议使用时的样例如 `/xiaohongmao2/api/?s=App.Admin.BeforeLogin`，不要使用调试文档生成的默认地址

* 为了配合跨域 后端接口统一以 `/xiaohongmao2` 开头 *

* 重要更新，因为学校缓存服务器更新的缘故，无法直接通过proxy连接后端，方法有2

1. 增加hosts `211.65.101.15 my.nuaa.edu.cn`，使用内网访问（portal

2. 访问 `view-source:http://my.nuaa.edu.cn/`，打开f12工具，application - cookie工具，清除所有，刷新，得到一个名字类似`TGseFIykuMZjI36`的cookie，添加到`localhost`的cookie中。这样可以暂时绕过cookie校验


调试文档地址 <http://my.nuaa.edu.cn/xiaohongmao2/docs.php> ps:使用http调试，否则有一个不安全调用问题
