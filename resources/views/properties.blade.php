@extends('layouts.app')

@section('content')
    <div class="margin-bottom-sm">
        <a href="/accounts" class="text-sm">Accounts</a>
        <span class="text-sm">/</span>
        <span class="text-sm ">Properties</span>

        <span class="text-sm float-right">{{ $username }} (<a href="/auth" class="text-sm">Change</a>)</span>
    </div>

    <main>
        <header class="margin-bottom-md">
          <h2 class="text-lg">Properties</h2>
          <p>Below are properties within this account.</p>
        </header>

        <div class="card">
          <ul>
            @foreach ($properties as $property)
                <li class="border-bottom hoverable">
                    <a href="/accounts/{{ $account_id }}/properties/{{ $property['id'] }}/views" class="text-decoration-none">
                      <div class="text-component text-space-y-md padding-sm ">
                        <h3 class="text-base color-contrast-higher">{{ $property['name'] }}</h3>
                        <p class="color-contrast-medium text-sm ">Property id: {{ $property['id'] }}</p>
                      </div>
                    </a>
                </li>
            @endforeach
          </ul>
        </div>
    </main>
@endsection
