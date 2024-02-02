<?php

namespace WCPaymentLink\Infrastructure;

abstract class Repository
{
	protected string $prefix;
	protected string $table;
    protected object $db;

	public function __construct(string $table)
	{
		$this->setTable($table);
	}

	private function setTable(string $table): void
    {
        global $wpdb;

        if ($wpdb) {
            $this->db     = $wpdb;
			$this->prefix = $this->db->prefix;
			$this->table  = "{$this->prefix}{$table}";
        }
    }

	protected function create($fields = []): void
    {
        if (empty($fields)) {
            return;
        }

        $rows = [];

        foreach ($fields as $key => $value) {
            $row = $key ? "`$key` " . implode(" ", $value) : implode(" ", $value);
            array_push($rows, $row);
        }

        $fields = implode(",", $rows);

        $this->db->query("CREATE TABLE IF NOT EXISTS {$this->table} ( {$fields} );");
    }

	public function down(): void
	{
		$this->drop();
	}

	protected function drop(): void
    {
        $this->db->query("DROP TABLE {$this->table};");
    }

    protected function query($query)
    {
        if (!str_contains($query, 'SELECT')) {
            return $this->db->query($query);
        }

        return $this->db->get_results($query);
    }

	public function save(Model $entity): bool
	{
		if (method_exists($entity, 'getId') && $entity->getId()) {
			$query = $this->update($this->getEntityData($entity), ['id' => $entity->getId()]);
		} else {
			$query = $this->insert($this->getEntityData($entity));
		}

		if (is_bool($query)) {
			return false;
		}

		return true;
	}

	protected function update($fields, $where)
	{
		return $this->db->update($this->table, $fields, $where);
	}

	protected function insert($fields)
	{
		return $this->db->insert($this->table, $fields);
	}

	public function findAll(string $orderBy = '', int $limit = 0, int $page = 1, string $order = 'ASC', bool $fill = false): array
	{
		$result = [];
		$query = "SELECT * FROM {$this->table}";

		if ($orderBy) {
            $order = $order === 'DESC' ? 'DESC' : 'ASC';
            $query .= " ORDER BY `$orderBy` $order";
		}

		if ($limit > 0) {
			$result['pagination'] = $this->getPagination($limit, $page);
			$offset = $result['pagination']['offset'];

			$query .= " LIMIT {$offset},{$limit}";
		}

		$query.= ";";

        if ($fill) {
            $rows = [];
            foreach ($this->query($query) as $item) {
                $rows[] = $this->fill($item);
            }

            $result['rows'] = $rows;
        } else {
            $result['rows'] = $this->query($query) ?? [];
        }

		return $result ;
	}

	public function getPagination(int $limit, int $page): array
	{
		$result = $this->query("SELECT COUNT(*) AS 'rows' FROM {$this->table};");
		if ($result) {
			$count = array_shift($result);

			$pages   = (int) ceil($count->rows / $limit);
			$current = min($page, $pages);
			$previous = ($current - 1) > 0 ? ($current - 1) : $current;
			$next    = min(($current + 1), $pages);

			return [
				'pages'    => $pages,
				'current'  => $current,
				'previous' => $previous,
				'next'     => $next,
				'offset'   => ($page - 1) * $limit,
				'rows'     => $count->rows
			];
		}

		return [];
	}

	public function findById(int $id): Model | bool
	{
		$result = $this->query("SELECT * FROM {$this->table} WHERE id = {$id};");

		try {
			$row = array_shift($result);
			if (!($row instanceof \stdClass)) {
				return false;
			}

			return $this->fill($row);
		} catch (\Exception $e) {
			return false;
		}
	}

	abstract protected function getEntityData(Model $entity): array;

	abstract public function remove(Model $entity): bool;

	abstract protected function fill(\stdClass $row);
}
