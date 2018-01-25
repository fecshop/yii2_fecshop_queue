<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace fecshop\queue\services;

use yii\base\BaseObject;
use yii\queue\JobInterface;
//use yii\queue\RetryableJobInterface;
use fecshop\queue\job\SendEmailJob;
/**
 * Coupon.
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */

class Email extends \fecshop\services\Email
{
    
    /**
     * @property $sendInfo | Array ， example：
     * [
     *	'to' => $to,
     *	'subject' => $subject,
     *	'htmlBody' => $htmlBody,
     *	'senderName'=> $senderName,
     * ]
     * @property $mailerConfigParam | array or String，对于该参数的配置，
     * 您可以参看上面的函数 function actionMailer($mailerConfigParam = '') 或者到 @fecshop/config/services/Email.php参看 $mailerConfig的配置
     * 该函数用于发送邮件.
     */
    protected function actionSend($sendInfo, $mailerConfigParam = '')
    {
        $to         = isset($sendInfo['to']) ? $sendInfo['to'] : '';
        $subject    = isset($sendInfo['subject']) ? $sendInfo['subject'] : '';
        $htmlBody   = isset($sendInfo['htmlBody']) ? $sendInfo['htmlBody'] : '';
        $senderName = isset($sendInfo['senderName']) ? $sendInfo['senderName'] : '';
        if (!$subject) {
            Yii::$service->helper->errors->add('email title is empty');

            return false;
        }
        if (!$htmlBody) {
            Yii::$service->helper->errors->add('email body is empty');

            return false;
        }

        $mailer = $this->mailer($mailerConfigParam);
        if (!$mailer) {
            Yii::$service->helper->errors->add('compose is empty, you must check you email config');

            return false;
        }

        if (!$this->_from) {
            Yii::$service->helper->errors->add('email send from is empty');

            return false;
        } else {
            $from = $this->_from;
        }
        if ($senderName) {
            $setFrom = [$from => $senderName];
        } else {
            $setFrom = $from;
        }
        $compose = $mailer->compose()
            ->setFrom($setFrom)
            ->setTo($to)
            ->setSubject($subject)
            ->setHtmlBody($htmlBody);
        // $compose->send();
        // ????????????????С?
        \Yii::$app->queue->push(new SendEmailJob([
            'compose' => $compose,
        ]));
        return true;
    }
    

}