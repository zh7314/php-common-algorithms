# phpCommonAlgorithms

#### 介绍
php常用算法集合  
包含常用的加密解密算法，一些常用的功能算法

#### 测试环境
php ^7.2

#### 使用说明
个人开发这些年使用的各种算法的集合，如果需要在线上使用，请严格测试

如果有bug，请反馈

#### 新增composer
```
composer require zx/php-common-algorithms


use ZX\Algorithm\GlobalUniqueId;

$r1 = GlobalUniqueId::CreateBasicsUid(1, 1);
$r2 = GlobalUniqueId::CreateBasicsUid(1, 2);

p($r1);
p($r2);
```
