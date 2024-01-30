<?php

namespace WCPaymentLink\Model\Infrastructure;

abstract class Entity
{
	private \DateTime $updatedAt;
	private \DateTime $createdAt;

	public function getUpdatedAt(): \DateTime
	{
		return $this->updatedAt;
	}

	public function getCreatedAt(): \DateTime
	{
		return $this->createdAt;
	}

	public function setUpdatedAt(\DateTime $updatedAt): void
	{
		$this->updatedAt = $updatedAt;
	}

	public function setCreatedAt(\DateTime $createdAt): void
	{
		$this->createdAt = $createdAt;
	}
}
