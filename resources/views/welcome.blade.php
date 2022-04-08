@extends('layouts.app')

@section('content')
    <main>
        <header class="margin-bottom-md">
          <h2 class="text-lg">Sign in</h2>
        </header>

        <div class="card">
          <ul>
              <li class="border-bottom hoverable">
                  <a href="/auth" class="flex gap-xxs items-center text-decoration-none">
                    <figure class="margin-left-md position-relative inline-flex items-center">
                      <svg class="icon width-md height-md " viewBox="0 0 48 48"><g class="nc-icon-wrapper"><path d="M24,11a12.932,12.932,0,0,1,8.346,3.047l6.54-6.228A21.973,21.973,0,0,0,4.293,14.236l7.373,5.683A13.016,13.016,0,0,1,24,11Z" fill="#d94f3d"></path> <path d="M11,24a12.942,12.942,0,0,1,.666-4.081L4.293,14.236a21.935,21.935,0,0,0,0,19.528l7.373-5.683A12.942,12.942,0,0,1,11,24Z" fill="#f2c042"></path> <path d="M45.1,20h-21v9H36a10.727,10.727,0,0,1-4.555,6.162l7.316,5.64C43.436,36.606,46.183,29.783,45.1,20Z" fill="#5085ed"></path> <path d="M31.442,35.162A13.98,13.98,0,0,1,24,37a13.016,13.016,0,0,1-12.334-8.919L4.293,33.764A22.023,22.023,0,0,0,24,46a21.865,21.865,0,0,0,14.758-5.2Z" fill="#57a75c"></path></g></svg>
                    </figure>

                    <div class="text-component text-space-y-md padding-sm">
                      <h3 class="text-base color-contrast-higher">Sign in With Google</h3>
                      <p class="color-contrast-medium text-sm ">Authorize BloomCU to access your Google Analytics account.</p>
                    </div>
                  </a>
              </li>
          </ul>
        </div>
    </main>
@endsection
