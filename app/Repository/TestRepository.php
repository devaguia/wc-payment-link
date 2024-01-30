<?php

namespace WCPaymentLink\Repository;

use WCPaymentLink\Model\TestEntity;
use WCPaymentLink\Infrastructure\Model;
use WCPaymentLink\Infrastructure\Repository;

class TestRepository extends Repository
{
	public function __construct()
	{
		parent::__construct('template_plugin');
	}

	protected function fill(\stdClass $row): TestEntity
	{
		$entity = new TestEntity($row->label);

		$entity->setId($row->id);
		$entity->setUpdatedAt(new \DateTime($row->updated_at));
		$entity->setCreatedAt(new \DateTime($row->created_at));

		return $entity;
	}

	public function remove(Model|TestEntity $entity): bool
	{
		if (!$entity->getId()) {
			return false;
		}

		$query = $this->db->delete(
			$this->table,
			['ID' => $entity->getId()]
		);

		if (!$query) {
			return false;
		}

		return true;
	}

	protected function getEntityData(Model|TestEntity $entity): array
	{
		return [
			'label' => $entity->getLabel()
		];
	}

	public function up(): void
	{
		$this->create([
			'id'             => ['INT AUTO_INCREMENT primary key NOT NULL' ],
			'label'          => ['VARCHAR(100) NOT NULL'],
			'created_at'     => ['DATETIME DEFAULT CURRENT_TIMESTAMP' ],
			'updated_at'     => ['DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP' ]
		]);
	}

}
