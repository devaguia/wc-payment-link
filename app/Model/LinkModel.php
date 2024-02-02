<?php

namespace WCPaymentLink\Model;

use WCPaymentLink\Infrastructure\Model;

class LinkModel extends Model
{
	private ?int $id = null;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

	public function __construct(
        private string $name = '',
        private string $token = '',
        private ?\DateTime $expireAt = null,
        private array $products = [],
        private string $coupon = ''
    )
	{}

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getExpireAt(): ?\DateTime
    {
        return $this->expireAt;
    }

    public function setExpireAt(?\DateTime $expireAt): void
    {
        if (!$expireAt) {
            $expireAt = new \DateTime();
        }
        $this->expireAt = $expireAt;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    public function getCoupon(): string
    {
        return $this->coupon;
    }

    public function setCoupon(string $coupon): void
    {
        $this->coupon = $coupon;
    }

    public function getId(): int
    {
        return $this->id ?? 0;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCartTotal(): float
    {
        return 0.0;
    }

    public function getLinkUrl(): string
    {
        return site_url( "/pay/{$this->token}", 'https' );
    }

    public function getData(): array
    {
        return [
            'link_id'      => $this->id,
            'name'         => $this->name,
            'token'        => $this->token,
            'coupon'       => $this->coupon,
            'products'     => $this->products,
            'expire_at'    => $this->getExpireAt()->format('Y-m-d'),
            'expire_hour'  => $this->getExpireAt()->format('H'),
            'link_url'     => $this->getLinkUrl()
        ];
    }

}


