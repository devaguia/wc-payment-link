<?php

namespace WCPaymentLink\API\Routes;

use WCPaymentLink\Model\LinkModel;
use WCPaymentLink\Repository\LinkRepository;

//TODO: needs authentication to use this API
//TODO: create operation methods
//TODO: create api version folder structure
class Links extends Route
{
    public function __construct()
    {
        $this->setNamespace();
        $this->registerRoute(
            'links(/(?P<id>\d+))?',
            [$this, 'handler'],
            ['GET', 'POST', 'PUT', 'DELETE']
        );
    }

    public function handler(object $data)
    {
        switch ($data->get_method()) {
            case 'GET':
                $this->getLinks($data->get_params());
                break;
            case 'POST':
                $this->insertLink($data->get_params());
                break;
            case 'PUT':
                $this->updateLink($data->get_params());
                break;
            case 'DELETE':
                $this->removeLink($data->get_params());
                break;
            default:
                $this->sendJsonResponse(
                    "pong!",
                );
                break;
        }
    }

    private function getLinks(array $data): void
    {
        $id      = isset($data['id']) ? $data['id'] : false;
        $order   = isset($data['order']) ? $data['order'] : 'ASC';
        $limit   = isset($data['per_page']) ? $data['per_page'] : 10;
        $page    = isset($data['page']) ? $data['page'] : 1;
        $orderBy = isset($data['order_by']) ? $data['order_by'] : '';

        $linkRepository = new LinkRepository();

        if ($id) {
            $links['rows'][] = $linkRepository->findById($id);
        } else {
            $links = $linkRepository->findAll(
                $orderBy,
                $limit,
                $page,
                $order,
                true
            );
        }

        $this->sendJsonResponse(
            '',
            true,
            200,
            $this->formatLinks($links)
        );
    }

    private function updateLink(): array {
        return [];
    }

    private function insertLink(): array {
        return [];
    }

    private function removeLink(): bool {
        return true;
    }

    private function formatLinks(array $links): array
    {
        $return = [];

        if (isset($links['pagination'])) {
            $return['pagination'] = $links['pagination'];
        }

        if (!isset($links['rows'])) {
            return [];
        }

        foreach($links['rows'] as $rows) {
            if ($rows instanceof LinkModel) {
                $return['links'][] = $rows->getData();
            }
        }

        return $return;
    }
}
