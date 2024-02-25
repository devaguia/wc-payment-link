<?php

namespace WCPaymentLink\API\Routes;

abstract class Route
{
	private string $namespace;

	protected function registerRoute(string $route, $callback, array $methods = ['GET']): void
	{
		register_rest_route($this->namespace, $route, [
			'methods'  => $methods,
			'callback' => $callback,
		    'permission_callback' => $this->permissionCallback(),
		] );
	}
	protected function sendJsonResponse(string $message = '', bool $success = true, int $code = 200, array $data = [])
	{
		$args = [
			"message" => $message,
			"success" => $success,
			"data"    => $data,
		];

		foreach ($args as $key => $item) {
			if (empty($item)) {
				unset($args[$key]);
			}
		}

		if (!empty($data)) {
			$args['data'] = $data;
		}

		return wp_send_json($args, $code);
	}

	protected function getNamespace(): string
	{
		return $this->namespace;
	}

	protected function setNamespace(string $namespace = ''): void
	{
		$this->namespace = wplConfig()->pluginSlug();

        if ($namespace) {
            $this->namespace .= "/$namespace";
        }
	}

	protected function permissionCallback(): string|bool
	{
		return '__return_true';
	}

}
