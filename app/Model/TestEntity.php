<?php

namespace WCPaymentLink\Model;

use WCPaymentLink\Infrastructure\Model;

class TestEntity extends Model
{
	private ?int $id = null;

	public function __construct(private string $label)
	{
        $this->label = $label;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
    }

}


