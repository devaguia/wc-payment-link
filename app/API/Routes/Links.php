<?php

namespace WCPaymentLink\API\Routes;

use DateTime;
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

    private function updateLink(array $params): void
    {
        $this->validateLinkFields($params);
        
        try {
            $link = new LinkModel(
                $params['name'],
                '',
                new DateTime($params['expire_at']),
                $params['coupon']
            );
            $link->setId($params['id']);
            $link->setToken($params['token']);
            $link->saveProducts($params['products']);

            $repository = new LinkRepository();
            $result = $repository->save($link);
            
            if ($result) {
                $this->sendJsonResponse(
                    'Link succefuly updated!',
                    true,
                    200,    
                    $link->getData()
                );
            }

        } catch (\Exception $e) {
            $this->sendJsonResponse(
                $e->getMessage(),
                false,
                422,
                []
            );
        }
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

    private function validateLinkFields(array $params): void 
    {
        $params['id'] = intval($params['id']) && $params['id'] !== 0 ? (int) $params['id'] : false;

        $needed = [
            'id' => 'integer',
            'name' => 'string',
            'token' => 'string',
            'coupon' => 'string',
            'expire_at' => 'string',
            'products' => 'array'
        ];

        $missing = [];
        $type_error = [];

        foreach($needed as $key => $item) {
            if (!isset($params[$key])) {
                $missing[] = $key;

            } else if (gettype($params[$key]) !== $item) {
                $type_error[$key] = $item;
            }
        }

        if (!empty($missing)) {
            $this->sendUnprocessableEntity(
                __('Missing some required fields.', 'wc-payment-link'),
                ['missing' => $missing]
            );

        } else if (!empty($type_error)) {
            $this->sendUnprocessableEntity(
                __('Some fields do not have the expected types.', 'wc-payment-link'),
                ['fields' => $type_error]
            );
        }
    }

    private function sendUnprocessableEntity(string $message, array $fields): void
    {
        $this->sendJsonResponse(
            $message,
            false,
            422,
            $fields
        );
    }
}
