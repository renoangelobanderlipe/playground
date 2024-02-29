<?php

use App\Http\Controllers\DataExchangeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(DataExchangeController::class)->prefix('prospect')->group(function () {

  Route::post('upload', 'upload');
  Route::get('export', 'export')->name('api.file.export');
  Route::get('status', 'status');
});

Route::get('/', function () {
  dd([
    "first_name" => fake()->firstName(),
    "last_name" => fake()->lastName(),
    "company_email" => fake()->unique()->companyEmail(),
    "linkedin_url" => fake()->url(),
    "meta" => [
      [
        "dynamic_id" => 1,
        "field_name" => "job_title",
        "value" => fake()->jobTitle()
      ],
      [
        "dynamic_id" => 2,
        "field_name" => "company_name",
        "value" => fake()->company()
      ],
      [
        "dynamic_id" => 3,
        "field_name" => "email_status",
        "value" => fake()->word()
      ],
      [
        "dynamic_id" => 4,
        "field_name" => "personal_email",
        "value" => fake()->email()
      ],
      [
        "dynamic_id" => 5,
        "field_name" => "seniority",
        "value" => fake()->word()
      ],
      [
        "dynamic_id" => 6,
        "field_name" => "department",
        "value" => fake()->word()
      ],
      [
        "dynamic_id" => 7,
        "field_name" => "contact_number",
        "value" => fake()->phoneNumber()
      ],
      [
        "dynamic_id" => 8,
        "field_name" => "corporate_number",
        "value" => fake()->phoneNumber()
      ],
      [
        "dynamic_id" => 9,
        "field_name" => "number_of_employees",
        "value" => fake()->randomNumber()
      ],
      [
        "dynamic_id" => 10,
        "field_name" => "prospect_industries",
        "value" => fake()->randomNumber()
      ],
      [
        "dynamic_id" => 11,
        "field_name" => "keywords",
        "value" => fake()->word()
      ],
      [
        "dynamic_id" => 12,
        "field_name" => "website",
        "value" => fake()->url()
      ],
      [
        "dynamic_id" => 13,
        "field_name" => "company_linkedin_url",
        "value" => fake()->url()
      ],
      [
        "dynamic_id" => 14,
        "field_name" => "facebook_url",
        "value" => fake()->url()
      ],
      [
        "dynamic_id" => 15,
        "field_name" => "twitter_url",
        "value" => fake()->url()
      ],
      [
        "dynamic_id" => 16,
        "field_name" => "country",
        "value" => fake()->country()
      ],
      [
        "dynamic_id" => 17,
        "field_name" => "state",
        "value" => fake()->state()
      ],
      [
        "dynamic_id" => 18,
        "field_name" => "city",
        "value" => fake()->city()
      ],
      [
        "dynamic_id" => 19,
        "field_name" => "company_address",
        "value" => fake()->address()
      ],
      [
        "dynamic_id" => 20,
        "field_name" => "company_country",
        "value" => fake()->country()
      ],
      [
        "dynamic_id" => 21,
        "field_name" => "company_state",
        "value" => fake()->state()
      ],
      [
        "dynamic_id" => 22,
        "field_name" => "company_city",
        "value" => fake()->city()
      ],
      [
        "dynamic_id" => 23,
        "field_name" => "company_phone",
        "value" => fake()->phoneNumber()
      ],
      [
        "dynamic_id" => 24,
        "field_name" => "company_description",
        "value" => fake()->text()
      ],
      [
        "dynamic_id" => 25,
        "field_name" => "technologies",
        "value" => fake()->words(3, true)
      ],
      [
        "dynamic_id" => 26,
        "field_name" => "annual_revenue",
        "value" => fake()->randomFloat(2, 1000, 1000000)
      ],
      [
        "dynamic_id" => 27,
        "field_name" => "total_funding",
        "value" => fake()->randomFloat(2, 1000, 1000000)
      ],
      [
        "dynamic_id" => 28,
        "field_name" => "latest_funding",
        "value" => fake()->dateTimeThisYear()
      ],
      [
        "dynamic_id" => 29,
        "field_name" => "latest_funding_amount",
        "value" => fake()->randomFloat(2, 1000, 1000000)
      ],
      [
        "dynamic_id" => 30,
        "field_name" => "other_info_1",
        "value" => fake()->text()
      ],
      [
        "dynamic_id" => 31,
        "field_name" => "other_info_2",
        "value" => fake()->text()
      ],
      [
        "dynamic_id" => 32,
        "field_name" => "apollo_contact_id",
        "value" => fake()->uuid()
      ],
      [
        "dynamic_id" => 33,
        "field_name" => "apollo_account_id",
        "value" => fake()->uuid()
      ],
    ]
  ]);

  return view('welcome');
});
