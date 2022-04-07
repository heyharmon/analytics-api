<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request; // TODO: Remove
use Illuminate\Support\Facades\Http;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/auth/google', function (Request $request) {
    $client = new Google\Client();

    // Setup Google client
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
    $client->setScopes(explode(',', env('GOOGLE_SCOPES')));
    $client->setApprovalPrompt(env('GOOGLE_APPROVAL_PROMPT'));
    $client->setAccessType(env('GOOGLE_ACCESS_TYPE'));

    // Create auth url
    $auth_url = $client->createAuthUrl();
    return redirect($auth_url);

    // dd($client);
});

Route::get('/auth/google/callback', function (Request $request) {
    $client = new Google\Client();

    // Setup Google client
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
    $client->setScopes(explode(',', env('GOOGLE_SCOPES')));
    $client->setApprovalPrompt(env('GOOGLE_APPROVAL_PROMPT'));
    $client->setAccessType(env('GOOGLE_ACCESS_TYPE'));

    // Handle access code
    if ($request->code) {
        $client->authenticate($request->code);
        $token = $client->getAccessToken();
        $request->session()->put('google_access_token', $token);
        // return redirect('/home')->with('success','you have been authenticated');
    } else {
        $auth_url = $client->createAuthUrl();
        return redirect($auth_url);
    }

    // dd($client);
});

Route::get('/analytics/accounts', function (Request $request) {
    $client = new Google\Client();

    // Setup Google client
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
    $client->setScopes(explode(',', env('GOOGLE_SCOPES')));
    $client->setApprovalPrompt(env('GOOGLE_APPROVAL_PROMPT'));
    $client->setAccessType(env('GOOGLE_ACCESS_TYPE'));

    // Set access token or authenticate
    $access_token = $request->session()->get('google_access_token');
    if ($access_token) {
        $client->setAccessToken($access_token);
    } else {
        $auth_url = $client->createAuthUrl();
        return redirect($auth_url);
    }

    // Setup Analytics Service
    $service = new Google\Service\Analytics($client);

    // List accounts
    $management_accounts = $service->management_accounts->listManagementAccounts();
	$accounts = [];
	foreach ($management_accounts['items'] as $account) {
		$accounts[] = [
            'id' => $account['id'],
            'name' => $account['name']
        ];
	}

    dd($accounts);
});

Route::get('/analytics/properties', function (Request $request) {
    $client = new Google\Client();

    // Setup Google client
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
    $client->setScopes(explode(',', env('GOOGLE_SCOPES')));
    $client->setApprovalPrompt(env('GOOGLE_APPROVAL_PROMPT'));
    $client->setAccessType(env('GOOGLE_ACCESS_TYPE'));

    // Set access token or authenticate
    $access_token = $request->session()->get('google_access_token');
    if ($access_token) {
        $client->setAccessToken($access_token);
    } else {
        $auth_url = $client->createAuthUrl();
        return redirect($auth_url);
    }

    // Setup Analytics Service
    $service = new Google\Service\Analytics($client);

    // List properties
    $management_properties = $service->management_webproperties->listManagementWebproperties(
        $request->account_id
    );
    $properties = [];
    foreach ($management_properties['items'] as $property) {
        $properties[] = [
            'id' => $property['id'],
            'name' => $property['name']
        ];
    }

    dd($properties);
});

Route::get('/analytics/views', function (Request $request) {
    $client = new Google\Client();

    // Setup Google client
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
    $client->setScopes(explode(',', env('GOOGLE_SCOPES')));
    $client->setApprovalPrompt(env('GOOGLE_APPROVAL_PROMPT'));
    $client->setAccessType(env('GOOGLE_ACCESS_TYPE'));

    // Set access token or authenticate
    $access_token = $request->session()->get('google_access_token');
    if ($access_token) {
        $client->setAccessToken($access_token);
    } else {
        $auth_url = $client->createAuthUrl();
        return redirect($auth_url);
    }

    // Setup Analytics Service
    $service = new Google\Service\Analytics($client);

    // List views
    $management_views = $service->management_profiles->listManagementProfiles(
        $request->account_id,
        $request->property_id
    );
	$views = [];
	foreach ($management_views['items'] as $view) {
		$views[] = [
            'id' => $view['id'],
            'name' => $view['name']
        ];
	}

    dd($views);
});

Route::get('/analytics/report', function (Request $request) {
    $client = new Google\Client();

    // Setup Google client
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
    $client->setScopes(explode(',', env('GOOGLE_SCOPES')));
    $client->setApprovalPrompt(env('GOOGLE_APPROVAL_PROMPT'));
    $client->setAccessType(env('GOOGLE_ACCESS_TYPE'));

    // Set access token or authenticate
    $access_token = $request->session()->get('google_access_token');
    if ($access_token) {
        $client->setAccessToken($access_token);
    } else {
        $auth_url = $client->createAuthUrl();
        return redirect($auth_url);
    }

    // Setup Analytics Service
    $service = new Google\Service\Analytics($client);

    // Setup date for period
	$now = new DateTime();

    // Required parameters
    $view_id = 'ga:' . $request->view_id;
    $start_date = $now->modify('-1 month')->format('Y-m-d');
	$end_date = $now->format('Y-m-d');
    $metrics = 'ga:uniquePageviews, ga:avgTimeOnPage';

    // Optional params
    $options = [];
    $options['dimensions'] = 'ga:pagePath';
    $options['filters'] = 'ga:pagePath==/';
    $options['sort'] = '-ga:uniquePageviews';
    $options['max-results'] = 10;

	$data = $service->data_ga->get(
        $view_id,
        $start_date,
        $end_date,
        $metrics,
		$options
	);

    // dd($data);

	$response = [
		'items' => isset($data['rows']) ? $data['rows'] : [],
		'columnHeaders'	=> $data['columnHeaders'],
		'totalResults'	=> $data['totalResults']
	];

    dd($response);
});
