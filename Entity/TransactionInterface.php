<?php

namespace Beelab\PaypalBundle\Entity;


/**
 * Transaction.
 *
 * @ORM\MappedSuperclass
 */
interface TransactionInterface
{
    public function getId(): ?int;
    
    public function setStart(?\DateTime $start): \Beelab\PaypalBundle\Entity\Transaction;
    
    public function getStart(): ?\DateTime;
    
    public function setEnd(?\DateTime $end): \Beelab\PaypalBundle\Entity\Transaction;
    
    public function getEnd(): ?\DateTime;
    
    public function setStatus(?int $status): ?int;
    
    public function getStatus(): ?int;
    
    public function getStatusLabel(): string;
    
    public function setToken(?string $token): \Beelab\PaypalBundle\Entity\Transaction;
    
    public function getToken(): ?string;
    
    public function getAmount(): ?string;
    
    public function getResponse(): ?array;
    
    public function complete(array $response): void;
    
    public function cancel(): void;
    
    public function error(array $response): void;
    
    public function isOk(): bool;
    
    public function getDescription(): ?string;
    
    public function getItems(): array;
    
    public function getShippingAmount(): string;
}