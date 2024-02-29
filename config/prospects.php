<?php

return [

  'requiredFields' => [
    "first_name",
    "last_name",
    "company_email",
    "linkedin_url",
  ],

  'model' => 'App\\Models\\ProspectModel',

  'limit' => env('PROSPECT_LIMIT_EXPORT', 1000),

  'chunkSize' => env('PROSPECT_LIMIT_EXPORT', 1000)

];
