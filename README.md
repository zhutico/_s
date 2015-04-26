[![Build Status](https://travis-ci.org/Automattic/_s.svg?branch=master)](https://travis-ci.org/Automattic/_s)

_s
===

嗨，我是一个初学者主题，如果你喜欢，你可以叫我`_s`，或者`underscores`，请不要把我做为一个父主题使用，相反的，你应该把我变成下一个更酷更棒的Wordpress主题，这就是我诞生的初衷和目的。

颗粒化的css模块可以使你写更少的代码而做出更棒的主题，下面列出了更多的特性：

* 适合学习的，带良好的注释的现代的HTML5模板；
* 包含404模板；
* 在`inc/custom-header.php`中包含简单的自定义顶部的代码，可以通过取消`functions.php`中的注释激活该功能，同时添加`inc/custom-header.php`顶部注释中的代码段到你的`header.php`文件中；
* 在`inc/template-tags.php`中包含自定义标签模板的代码， 可以保持你的模板整洁和避免代码重复；
* 在`inc/extras.php`中包含一些小的调整， 它可以提高你的主题的经验；
* 可以通过`js/navigation.js`制作适合小屏幕设备浏览的下拉菜单（如手机），同时需要把您的菜单CSS文件加入到`functions.php`的加载队列中去；
* 在`layouts/`中提供两种CSS布局，你可以把侧边栏放在主体内容的任何一侧
* 巧妙组织起始文件`style.css`，可以快速帮助你在现有设计基础上更快的做出一款主题
* 基于GPLv2或更新协议，你可以用它来做一个更酷的主题

如何开始
---------------

如果你需要保持主题的简洁，可以前往http://www.zhutico.com/dev/createtheme/ 在线创建一个主题下载使用，只需要填写要创建主题的名称，单击“创建新主题”按钮，就可以下载使用最新的`_s`主题。

当然你也可以从GitHub下载使用`_s`主题，首先要把`_s`文件夹复制到相应的位置，并修改名称（如`megatherium`），接下来你要通过以下五个步骤修改或替换所有模板文件。

1. 查找：`'_s'`（包含引号）修改本地化信息。
2. 查找：`_s_` 修改函数名称。
3. 在style.css查找：`Text Domain: _s`修改主题信息。
4. 查找：<code>&nbsp;_s</code>（注意以空格开始）修改文档块。
5. 查找 `_s-` 修改前缀。

OR

* 查找：`'_s'` 并替换为：`'megatherium'`。
* 查找：`_s_` 并替换为：`megatherium_`。
* 在style.css查找：`Text Domain: _s` 并替换为：`Text Domain: megatherium`。
* 查找：<code>&nbsp;_s</code> 并替换为：<code>&nbsp;Megatherium</code>
* 查找：`_s-` 并替换为： `megatherium-`

然后把 `style.css` 的头部注释中的内容 和`footer.php` 中的链接修改为你的信息，接下来删除这个readme文件就可以了。

OK，一切就绪，但是要做出一款不错的Wordpress主题，接下来要做的还很多。

祝您好运！
