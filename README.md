# xmcsrv-api-php-signature

#### 介绍
xmcsrv平台PHP签名算法

#### SignatureUtil.php
```
include_once 'SignatureUtil.php';
$uuid = 'test';
$appKey = 'test';
$appSecret = 'password';
$timeMillis = '00000011461748332239';
$movedCard = 5;
$signature = new SignatureUtil($uuid, $appKey, $appSecret, $timeMillis, $movedCard);
echo $signature->getEncryptStr();

```

#### timeMillis.php

```
include_once 'timeMillis.php';
echo TimeMillisUtil::getTimMillis();    
```
