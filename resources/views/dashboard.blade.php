@extends('layouts.app')

@section('content')
    <div class="margin-bottom-sm">
        <a href="/accounts" class="text-sm">Accounts</a>
        <span class="text-sm">/</span>
        <a href="/accounts/{{ $account_id }}/properties" class="text-sm">Properties</a>
        <span class="text-sm">/</span>
        <a href="/accounts/{{ $account_id }}/properties/{{ $property_id }}/views" class="text-sm">Views</a>
        <span class="text-sm">/</span>
        <span class="text-sm">Dashboard</span>

        {{-- <span class="text-sm float-right">{{ $username }} (<a href="/auth" class="text-sm underline">Change</a>)</span> --}}
    </div>

    <main>
        <header class="margin-bottom-md">
          <h2 class="text-lg">Dashboard</h2>
          <p>Explore analytics for this view: [Insert view name here]</p>
        </header>

        <div class="card">
          @php
              dd($data);
          @endphp
          <pre>{{ $data['items'] }}</pre>
          <pre>{{ $data['columnHeaders'] }}</pre>
          <pre>{{ $data['totalResults'] }}</pre>
        </div>
    </main>
@endsection
