<!DOCTYPE html>
<html lang="en">
@include("core::layouts.partials.backend.head")
<body class="@if(isset($data->body_class)){{$data->body_class}}@endif animsition site-navbar-small" >

@include("core::layouts.partials.backend.header")

<!--side navigation-->
@include("core::layouts.partials.backend.extendable.sidebar")
@include("core::layouts.partials.backend.extendable.grid_menu")
<!--/side navigation-->

<!---content-->
@yield('content')
<!--/content-->
@include("core::layouts.partials.backend.footer")
@include("core::layouts.partials.backend.scripts")
<!---page specific-->
@yield('page_specific_footer')
<!--/page specific-->
</body>
</html>