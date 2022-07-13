@include('layouts.header')
@include('layouts.sidebar')

<div class="main-content">
@yield('content')
</div> 

@include('admin.layouts.footer')