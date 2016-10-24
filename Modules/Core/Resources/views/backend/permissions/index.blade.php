@extends('core::layouts.backend')

@section("page_specific_footer")
    <script src="{{moduleAssets('core')}}/permissions.js"></script>



@endsection

@section('content')


    <div class="page">
        <!--header-->
        <div class="page-header">
        </div>
        <!--header-->
        <!--content-->
        <div id="exampleTransition"
             class="page-content container-fluid"
             data-plugin="animateList">
            <ul class="blocks-sm-100 blocks-md-12 blocks-lg-12 blocks-xxl-3">
                <li>
                    <div class="panel panel-bordered animation-scale-up"
                         style="animation-fill-mode: backwards; animation-duration: 250ms; animation-delay: 0ms;">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$data->title}}</h3>
                            <div class="panel-actions">
                                <nav>
                                    <ul class="pagination_con pagination pagination-md">
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="pull-xs-left">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-pure" data-toggle="dropdown"
                                            aria-expanded="false">
                                        More
                                        <span class="icon wb-chevron-down-mini" aria-hidden="true"></span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item bulkEnable" href="javascript:void(0)">Enable</a>
                                        <a class="dropdown-item bulkDisable" href="javascript:void(0)">Disable</a>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-xs-right m-l-10 hidden-sm-down">
                                <div class="btn-group" aria-label="Basic example" role="group">
                                    <button type="button" class="btn btn-outline btn-default">
                                        <i class="icon wb-share" aria-hidden="true"></i>Trashed
                                    </button>
                                </div>
                            </div>
                            <div class="pull-xs-right ">
                                <div class="form-group">
                                    <div class="input-search">
                                        <button type="submit" class="input-search-btn"><i class="icon wb-search"
                                                                                          aria-hidden="true"></i>
                                        </button>
                                        <input type="text" class="form-control search" name="" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                            <table class="table"
                                   data-plugin="selectable" data-row-selectable="true">
                                <thead>
                                <tr>
                                    <th class="w-50">
                                        <span class="checkbox-custom checkbox-primary">
                                            <input class="selectable-all" type="checkbox"><label></label>
                                        </span>
                                    </th>
                                    <th class="hidden-sm-down">#</th>
                                    <th class="hidden-sm-down">Prefix</th>
                                    <th>Name</th>
                                    <th>Enable</th>
                                    <th class="hidden-sm-down">Slug</th>
                                    <th class="hidden-sm-down">Roles</th>
                                    <th class="hidden-sm-down">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="list">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!--/content-->
    </div>
@endsection


