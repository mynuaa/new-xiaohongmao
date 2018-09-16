# 小红帽系统 新版本

分为 backend fontend management 三端

## backend

使用 phalApi via PHP7 + mysql + redis

### 安装方法

* 开启redis
* 导入数据库
* 将`/config/myConfig.example.php` 复制 成 `/config/myConfig.php`,修改其中的数据库信息

## fontend

使用 vuecli via vue2

### 安装方法

安装最新版本的 vuecli `yarn global add @vue/cli`，然后 `vue ui`启动ui模式，选择载入`/fontend`文件夹即可

需要sass，请先换成国内源

## management

基于 vueadmin 修改 via vue2

### 安装方法

直接 `yarn install` 即可

### 数据mock

待定
