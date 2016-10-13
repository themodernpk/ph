@extends('core::layouts.backend')

@section('content')

    <div class="page">
        <div class="page-content container-fluid">
            <h1>dashboard</h1>

            {{getModuleExtendOrder()}}


        </div>
    </div>

@endsection


@section("page_specific_footer")
    <script>
    </script>
@endsection