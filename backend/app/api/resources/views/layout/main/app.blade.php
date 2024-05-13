
@include('partials.dashboard.__header')



    @include('partials.dashboard.__loader')

  <!-- Navbar amd Sidebar -->
  @include('partials.dashboard.__navbar')
  @include('partials.dashboard.__sidebar')

            {{-- dynamic content --}}
            @yield('content')

  @include('partials.dashboard.__menubar')

  {{-- @include('partials.dashboard.__footer') --}}



@include('partials.dashboard.__scripts')

