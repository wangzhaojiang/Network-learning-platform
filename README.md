Network-learning-platform
=============


###Network-learning-platform


 - doc目录

	关于该项目的**文档**
	
 - source目录
 
 	该项目的**源代码**

> config.php 
>>全局配置文件，配置当前站点的相关信息，如：数据库信息、站点所在绝对路径、站点域名，Smarty路径等等
>smarty.php
>>初始化Smarty类，配置相关信息
>init.php
>>站点初始化，全局权限控制
>*.php
>>smarty前端渲染脚本
>inc/
>>逻辑层接口文件，一般都是一些接口类文件（如：用户接口类、私信接口类、课程接口类等等）。命名规则：*.class.php
>server/
>>业务层脚本文件，一般放置用于处理各类GET/POST请求的脚本文件。命名规则：*.server.php
>templates/
>>用于放置Smarty前端模板页。命名规则：tpl_*.html
>templates_c/
>>Smarty编译文件目录
>config/
>>Smarty配置文件目录

 - 注意事项

    所有的接口名 小写，  间隔用 ' _ '  来连接；
    
    类名首字母大写；
    
    切记：在提交代码前必须把最新代码拉取下来！！！
    
