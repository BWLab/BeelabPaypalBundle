<?php

namespace Beelab\PaypalBundle\Paypal;


use Beelab\PaypalBundle\Entity\Transaction;
use Beelab\PaypalBundle\Entity\TransactionInterface;

/**
 * Paypal service.
 */
interface ServiceInterface
{
    /**
     * Set Transaction and parameters.
     *
     * @param Transaction $transaction
     * @param array $customParameters
     *
     * @return Service
     */
    public function setTransaction(TransactionInterface $transaction, array $customParameters = []);
    
    /**
     * Start transaction. You need to call setTransaction() before.
     *
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function start();
    
    /**
     * Complete transaction. You need to call setTransaction() before.
     */
    public function complete(): void;
}