@extends('layouts.app')

@section('content')
    <div class="margin-bottom-sm">
        <span class="text-sm float-right">{{ $username }} (<a href="/auth" class="text-sm">Change</a>)</span>
    </div>

    <main>
        <header class="margin-bottom-md">
          <h2 class="text-lg">Accounts</h2>
          <p>Below are Google Analytics accounts you have access to.</p>
        </header>

        <div class="card">
          <ul>
            @foreach ($accounts as $account)
                <li class="border-bottom hoverable">
                    <a href="/accounts/{{ $account['id'] }}/properties" class="text-decoration-none">
                      <div class="text-component text-space-y-md padding-sm ">
                        <h3 class="text-base color-contrast-higher">{{ $account['name'] }}</h3>
                        <p class="color-contrast-medium text-sm ">Account id: {{ $account['id'] }}</p>
                      </div>
                    </a>
                </li>
            @endforeach
          </ul>
        </div>
    </main>
@endsection
