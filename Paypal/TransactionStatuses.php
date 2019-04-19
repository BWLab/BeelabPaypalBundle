<?php
/*
 * This file is part of the Syncro application.
 *
 * (c) Luigi Massa <lmassa@bwlab.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Beelab\PaypalBundle\Paypal;


class TransactionStatuses
{
    const STATUS_KO = -1;
    const STATUS_STARTED = 0;
    const STATUS_OK = 1;
    const STATUS_ERROR = 2;
    
    public static $statuses = [
        self::STATUS_STARTED => 'started',
        self::STATUS_OK => 'success',
        self::STATUS_KO => 'canceled',
        self::STATUS_ERROR => 'failed',
    ];
}