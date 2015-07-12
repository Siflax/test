<?php

return [
	'apiKey' => 'c87b93574fee854472224b5c224e596f',
	//'password' => '062ecea9deee5e43712a6abab72a0c57',
	'sharedSecret' => '82a73e97a138ee7eae66957430bd7e30',
	//'shopName' => 'test-11182.myshopify.com'

	'app_store_url' => 'https://apps.shopify.com/groovepacker',

	'subscriptionPlans' => [
		'name' => 'test subscription plan',
		'price' => 5,
		'return_url' => url('/account/subscription-plans/activate'),
		'test' => true
	]
];
