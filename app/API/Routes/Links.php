<?php

namespace WCPaymentLink\API\Routes;
//TODO: needs authentication to use this API
//TODO: create operation methods
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
        $this->sendJsonResponse(
            "pong!",
        );

    }

    private function getLinks(): array {
        return [];
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
}
