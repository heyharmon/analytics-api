@extends('layouts.app')

@section('content')
    <div class="margin-bottom-sm">
        <a href="/accounts" class="text-sm">Accounts</a>
        <span class="text-sm">/</span>
        <a href="/accounts/{{ $account_id }}/properties" class="text-sm">Properties</a>
        <span class="text-sm">/</span>
        <span class="text-sm">Views</span>

        <span class="text-sm float-right">{{ $username }} (<a href="/auth" class="text-sm underline">Change</a>)</span>
    </div>

    <main>
        <header class="margin-bottom-md">
          <h2 class="text-lg">Views</h2>
          <p>Below are views within this property.</p>
        </header>

        <div class="card">
          <ul>
            @foreach ($views as $view)
                <li class="border-bottom hoverable">
                    <a href="/accounts/{{ $account_id }}/properties/{{ $property_id }}/views/{{ $view['id'] }}/dashboard" class="text-decoration-none">
                      <div class="text-component text-space-y-md padding-sm ">
                        <h3 class="text-base color-contrast-higher">{{ $view['name'] }}</h3>
                        <p class="color-contrast-medium text-sm ">View id: {{ $view['id'] }}</p>
                      </div>
                    </a>
                </li>
            @endforeach
          </ul>
        </div>
    </main>
@endsection
