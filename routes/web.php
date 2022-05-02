<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request; // TODO: Remove
use Illuminate\Support\Facades\Http; // TODO: Remove


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth', function (Request $request) {
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
});

Route::get('/auth/callback', function (Request $request) {
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
    } else {
        $auth_url = $client->createAuthUrl();
        return redirect($auth_url);
    }

    return redirect('/accounts');
});

Route::get('/accounts', function (Request $request) {
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

    return view('accounts')
        ->with('username', $management_accounts->username)
        ->with('accounts', $accounts);
});

Route::get('accounts/{account_id}/properties', function (Request $request, $account_id) {
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
        $account_id
    );
    $properties = [];
    foreach ($management_properties['items'] as $property) {
        $properties[] = [
            'id' => $property['id'],
            'name' => $property['name']
        ];
    }

    return view('properties')
        ->with('username', $management_properties->username)
        ->with('account_id', $account_id)
        ->with('properties', $properties);
});

Route::get('accounts/{account_id}/properties/{property_id}/views', function (Request $request, $account_id, $property_id) {
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
        $account_id,
        $property_id
    );
	$views = [];
	foreach ($management_views['items'] as $view) {
		$views[] = [
            'id' => $view['id'],
            'name' => $view['name']
        ];
	}

    return view('views')
        ->with('username', $management_views->username)
        ->with('account_id', $account_id)
        ->with('property_id', $property_id)
        ->with('views', $views);
});

Route::get('accounts/{account_id}/properties/{property_id}/views/{view_id}/dashboard', function (Request $request, $account_id, $property_id, $view_id) {
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
    $start_date = $now->modify('-3 month')->format('Y-m-d');
	$end_date = $now->format('Y-m-d');
    $metrics = 'ga:uniquePageviews, ga:avgTimeOnPage';

    // Optional params
    $options = [];
    $options['dimensions'] = 'ga:pagePath';
    $options['filters'] = 'ga:pagePath==/';
    $options['sort'] = '-ga:uniquePageviews';
    $options['max-results'] = 50;

	$data = $service->data_ga->get(
        $view_id,
        $start_date,
        $end_date,
        $metrics,
		$options
	);

	$data = [
		'items' => isset($data['rows']) ? $data['rows'] : [],
		'columnHeaders'	=> $data['columnHeaders'],
		'totalResults'	=> $data['totalResults']
	];

    return view('dashboard')
        ->with('account_id', $account_id)
        ->with('property_id', $property_id)
        ->with('data', $data);
});
