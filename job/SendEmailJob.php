<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace fecshop\queue\job;

use yii\base\BaseObject;
use yii\queue\JobInterface;
//use yii\queue\RetryableJobInterface;
/**
 * Send Email Job.
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */

class SendEmailJob extends BaseObject implements  JobInterface
{
    public $compose;
    
    public function execute($queue)
    {
        echo "\n[begin send email]  to:  " .implode(',',array_keys($this->compose->getTo())). "\n";
        echo "[begin send email]  subject: ".$this->compose->getSubject()."\n";
        $this->compose->send();
        echo "[end send email]  \n \n";
    }
}