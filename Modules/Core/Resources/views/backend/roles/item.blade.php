@extends('core::layouts.backend')

@section("page_specific_head")
@endsection

@section("page_specific_footer")
    <script src="{{moduleAssets('core')}}/rolesItem.js"></script>
@endsection

@section('content')

    <div class="page">
        <!--header-->
        <div class="page-header">
            <input type="hidden" name="url_current" value="{{url()->current()}}">

            <h1>{{$data->item->name}}</h1>


        </div>
        <!--header-->
        <!--content-->

        <!--/content-->
    </div>
@endsection


