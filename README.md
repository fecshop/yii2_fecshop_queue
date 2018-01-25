<p>
  <a href="http://fecshop.appfront.fancyecommerce.com/">
    <img src="http://img.appfront.fancyecommerce.com/custom/logo.png">
  </a>
</p>
<br/>

[![Latest Stable Version](https://poser.pugx.org/fancyecommerce/fecshop_queue/v/stable)](https://packagist.org/packages/fancyecommerce/fecshop_queue)
[![Total Downloads](https://poser.pugx.org/fancyecommerce/fecshop_queue/downloads)](https://packagist.org/packages/fancyecommerce/fecshop_queue)
[![Latest Unstable Version](https://poser.pugx.org/fancyecommerce/fecshop_queue/v/unstable)](https://packagist.org/packages/fancyecommerce/fecshop_queue)



Fecshop 队列扩展


> Fecshop queue 功能部分，用于扩展一些队列的功能，将一些比较耗时的操作
> 拆出来放到队列中，异步解耦，
> 目前做的功能为：邮件发送。

安装
--------

```
composer require --prefer-dist fancyecommerce/fecshop_queue 
```

or 在根目录的`composer.json`中添加

```
"fancyecommerce/fecshop_queue": "~1.0.4"

```

然后执行

```
composer update
```


配置
-------

将@fecshop\queue\config\fecshop_queue.php 复制到
@common\config\fecshop_third_extensions\下

使用
------

1.配置完成后，就可以使用MQ了，监听命令

1.1守护进程监听（响应快，但会长时间占用php进程）
```
yii queue/listen [timeout]  // [timeout]:number of seconds to wait a job. 
```

1.2cron方式监听，可以设置每分钟执行一次（响应有一定的延迟，但不会长时间占用php进程）

```
yii queue/run
```

关于redis消费消息的更多信息参看：[yii2 redis queue](https://github.com/yiisoft/yii2-queue/blob/master/docs/guide-zh-CN/driver-redis.md)

2.队列软件

默配置的是redis队列，你可以使用下面的几种队列软件来实现队列消息
[yii2 queue driver](https://github.com/yiisoft/yii2-queue/tree/master/docs/guide-zh-CN)


3.使用Supervisor，启动管理多个监听进程

详细参看：[Supervisor](https://github.com/yiisoft/yii2-queue/blob/master/docs/guide-zh-CN/worker.md#supervisor)

4.关于重试规则

> 当一段时间没有执行完成，或者执行失败，队列会安排重试,
> 在queue组件中配置，


```
    'queue' => [
        'ttr' => 5 * 60, // Max time for anything job handling 
        'attempts' => 3, // Max number of attempts
    ],
```

更多详细参看：[queue重试规则](https://github.com/yiisoft/yii2-queue/blob/master/docs/guide-zh-CN/retryable.md)






