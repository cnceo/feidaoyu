feidaoyu
========

一个购买虚拟主机和域名的在线系统

1 .本站需要建立虚拟主机来访问 。比如建立一个feidaoyu.com 的域名指向本项目目录。
feidaoyu.com =======> F:\APMServ5.2.6\www\htdocs\feidaoyu


2 . 因为框架设计者将入口文件放到了 ../feidaoyu/htdocs 目录下面,所以需要设立alias别名 。

在虚拟主机配置文件里面 写入alias 规则 ：
<VirtualHost *:80>
 ServerName feidaoyu.com
 DocumentRoot "F:/APMServ5.2.6/www/htdocs/feidaoyu"
 
 alias / "F:/APMServ5.2.6/www/htdocs/feidaoyu/htdocs/"
 <br>
 alias /admin "F:/APMServ5.2.6/www/htdocs/feidaoyu/htdocs/admin"

/指向前台入口文件 ，/admin指向后台入口文件 。 因前台是 / ,故前台模板引用相关文件前面都要加/;
后台是/admin ,所以后台模板引用相关文件都不能加/ ,比如js/ ,不能写成/js ,否则会报错 。。



3 。伪静态问题 。
要保证index.php 和 。htaccess 在同一个目录下 。
然后在apache配置文件里面开启伪静态支持 。在虚拟主机的配置文件里将 AllowOverride None 改为 AllowOverride All。。
然后重启apache服务器 。。。。。

4 。项目就可以跑起来了 。。。。。。。。


5 。后台账号： admin  123456

