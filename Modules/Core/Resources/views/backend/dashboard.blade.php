@extends('core::layouts.backend')

@section('content')

    <div class="page">
        <div class="page-content container-fluid">
            @include("core::layouts.partials.backend.extendable.dashboard")
        </div>
    </div>
@endsection


@section("page_specific_footer")
    <script>
    </script>

@endsection