<?php
return [
	'staileu' => [
		'public' => getenv('STAILEU_PUBLIC'),
		'private' => getenv('STAILEU_PRIVATE'),
		'redirect' => getenv('STAILEU_REDIRECT')
	],
	'instagram' => [
		'id' => getenv('INSTAGRAM_ID'),
		'secret' => getenv('INSTAGRAM_SECRET'),
		'redirect_uri' => getenv('INSTAGRAM_REDIRECT_URI'),
		'access_token' => getenv('INSTAGRAM_ACCESS_TOKEN')
	]
];