<?php

namespace WCPaymentLink\API;
use WCPaymentLink\API\Routes\TestRoute;

class Routes
{
	public function register()
	{
		new TestRoute();
	}
}
