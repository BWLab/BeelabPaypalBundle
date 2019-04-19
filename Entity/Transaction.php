<?php

namespace Beelab\PaypalBundle\Entity;

use Beelab\PaypalBundle\Paypal\TransactionStatuses;
use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction.
 *
 * @ORM\MappedSuperclass
 */
abstract class Transaction implements TransactionInterface
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $end;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", options={"default": 0})
     */
    protected $status = TransactionStatuses::STATUS_STARTED;

    /**
     * @var string
     *
     * @ORM\Column(unique=true)
     */
    protected $token;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=6, scale=2, options={"default": 0})
     */
    protected $amount = 0;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    protected $response;

    public function __construct($amount = null)
    {
        $this->amount = $amount;
        $this->start = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setStart(?\DateTime $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getStart(): ?\DateTime
    {
        return $this->start;
    }

    public function setEnd(?\DateTime $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getEnd(): ?\DateTime
    {
        return $this->end;
    }

    public function setStatus(?int $status): ?int
    {
        $this->status = $status;

        return $status;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getStatusLabel(): string
    {
        return isset(TransactionStatuses::$statuses[$this->status]) ? TransactionStatuses::$statuses[$this->status] : 'invalid';
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function getResponse(): ?array
    {
        return $this->response;
    }

    public function complete(array $response): void
    {
        if (TransactionStatuses::STATUS_OK !== $this->status) {
            $this->status = TransactionStatuses::STATUS_OK;
            $this->end = new \DateTime();
            $this->response = $response;
        }
    }

    public function cancel(): void
    {
        $this->status = TransactionStatuses::STATUS_KO;
        $this->end = new \DateTime();
    }

    public function error(array $response): void
    {
        $this->status = TransactionStatuses::STATUS_ERROR;
        $this->end = new \DateTime();
        $this->response = $response;
    }

    public function isOk(): bool
    {
        return TransactionStatuses::STATUS_OK === $this->status;
    }

    public function getDescription(): ?string
    {
        return null;
    }

    public function getItems(): array
    {
        return [];
    }

    public function getShippingAmount(): string
    {
        return '0.00';
    }
}
