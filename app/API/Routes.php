<?php

namespace WCPaymentLink\API;

use WCPaymentLink\API\Routes\Links;

class Routes
{
	public function register()
	{
		new Links();
	}
}
