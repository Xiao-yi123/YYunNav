# 项目介绍
YYunNav 本项目这是一个网址导航网站，内容均由viggo收集并整理。本项目后期基于layui前端框架开发。
这是一个开源的公益项目，你可以拿来制作自己的网址导航，也可以做与导航无关的网站。如果你有任何疑问，可以通过个人网站 http://blog.yiyunt.cn/ 中的联系方式找到我，欢迎与我交流分享。

# 环境要求
PHP >= 7.1.0
Mysql >= 5.7.0 (需支持innodb引擎)
Apache 或 Nginx

# 安装教程

## 通过git下载安装包
```gitexclude
第一步,下载安装包
git clone https://github.com/Xiao-yi123/YYunNav

第二步,install 安装
域名/install.php

第三步,更新节点 (可选)
- 使用命令 php think node 进行更新权限节点
- 或者在后台节点管理里面点击更新

第四步,更新数据库 (可选)
将 config/install/sql/update.sql 导入到数据库
```
注：下载请下载最近版本

# 配置
## 公共目录
安装完 YYunNav 之后，你必须将 web 服务器根目录指向 public 目录。该目录下的 index.php 文件将作为所有进入应用程序的 HTTP 请求的前端控制器。

## 目录权限
安装完 YYunNav 后，你可能需要给这两个文件配置读写权限：config 目录和 runtime 目录应该允许 Web 服务器写入，否则 easyadmin 程序将无法运行。

## 安装提示
- 运行网站地址, 会自动进入安装界面, 请根据提示进行设置, 然后点击安装。
- 安装完成后会自动生成安装锁config/install/lock/install.lock, 如需重新安装, 删掉该文件即可。

# 演示站点
演示地址：http://nav.yiyunt.cn/

# 代码仓库
GitHub地址：https://github.com/Xiao-yi123/YYunNav

# 使用说明
1. 如需修改免责声明请修改  index/view/disclaimer/index.html 文件
2. 如需修改search的背景图片 则替换 public/static/image/user-default-cover-full.jpg 文件
3. 如需修改头部菜单请修改 public/static/index/json/header_menu.json 文件
4. 如需修改搜索的数据请修改 public/static/index/json/search_data.json 文件
5. 如需修改侧边底部信息请修改 public/static/index/json/sidebar_top.json 文件
6. 如需添加图标请在 public/static/index/wp-content/themes/onenav/css/my-iconfont.css 文件里面添加css定义 图标可在 https://igoutu.cn/ 里面找 图标名需要以 .fa-开头
7. 如需替换QQ跟微信的图片，请替换 public/static/logo 路径下的 QQGuroup.jpg 和 wechat.jpg 文件
8. 一言、和风天气的api建议大家自己注册换成自己的，每个注册的人有每日免费使用次数， 我的大家一起用可能最后都显示不出来了。
9. 源码要感谢GitHub的webstack开源项目及一为导航，我是在它们的源码基础上本地静态化修改而来。

## 更新日志
2024/05/11  后台新增图标管理功能

## 特别感谢
以下项目排名不分先后

* ThinkPHP：[https://github.com/top-think/framework](https://github.com/top-think/framework)

* Layuimini：[https://github.com/zhongshaofa/layuimini](https://github.com/zhongshaofa/layuimini)

* Annotations：[https://github.com/doctrine/annotations](https://github.com/doctrine/annotations)

* Layui：[https://github.com/sentsin/layui](https://github.com/sentsin/layui)

* Jquery：[https://github.com/jquery/jquery](https://github.com/jquery/jquery)

* RequireJs：[https://github.com/requirejs/requirejs](https://github.com/requirejs/requirejs)

* CKEditor：[https://github.com/ckeditor/ckeditor4](https://github.com/ckeditor/ckeditor4)

* Echarts：[https://github.com/apache/incubator-echarts](https://github.com/apache/incubator-echarts)
 
* LayuiMINI：[http://layuimini.99php.cn/](http://layuimini.99php.cn/)
 
* liutongxu：[https://github.com/liutongxu/liutongxu.github.io](https://github.com/liutongxu/liutongxu.github.io)

# BUG
## 处理重复出现【请求验证失败，请重新刷新页面！】的错误
删除 vendor 文件夹，重新下载项目，替换其中的 vendor 文件夹

## 反馈
项目使用过程成，如遇到BUG，可通过以下途径进行反馈。

GitHub:https://github.com/Xiao-yi123/YYunNav/issues

QQ群：794852447

联系站长：yi_yun200301@163.com

# 版权信息
YYunNav 遵循MIT开源协议发布，并提供免费使用。



