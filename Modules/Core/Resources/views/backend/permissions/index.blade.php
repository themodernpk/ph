@extends('core::layouts.backend')

@section("page_specific_footer")
    <script src="{{moduleAssets('core')}}/permission/permissions.js"></script>


@endsection

@section('content')


    <div class="page" id="vueApp">



        <!--header-->
        <div class="page-header">


            @{{message}}

            <input name="message" v-model="message"/>



            <input type="text"
                   id="url_list"
                   value="{{URL::route('core.backend.permissions.list')}}"
            />

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
                                    <ul class="pagination pagination-md">
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)">
                                                <span aria-hidden="true">«</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="active page-item">
                                            <a class="page-link" href="javascript:void(0)">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)">4</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)">
                                                <span aria-hidden="true">»</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
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
                                        <a class="dropdown-item" href="javascript:void(0)">More</a>
                                        <a class="dropdown-item" href="javascript:void(0)">More</a>
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
                                        <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                                        <input type="text" class="form-control" name="" placeholder="Search...">
                                    </div>
                                </div>
                            </div>

                            <table class="table table-hover"

                                   data-plugin="selectable" data-row-selectable="true">
                                <thead>
                                <tr>
                                    <th class="w-50">
                                        <span class="checkbox-custom checkbox-primary">
                                            <input class="selectable-all" type="checkbox"><label></label>
                                        </span>
                                    </th>
                                    <th class="hidden-sm-down">#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th class="hidden-sm-down">Slug</th>
                                    <th class="hidden-sm-down">Roles</th>
                                    <th class="hidden-sm-down">Users</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="">
                                    <td>
                                      <span class="checkbox-custom checkbox-primary">
                                        <input class="selectable-item" type="checkbox" id="row-619" value="619">
                                        <label for="row-619"></label>
                                      </span>
                                    </td>
                                    <td class="hidden-sm-down">#</td>
                                    <td>Name</td>
                                    <td><span class="tag tag-warning">Design</span></td>
                                    <td class="hidden-sm-down">Slug</td>
                                    <td class="hidden-sm-down">Roles</td>
                                    <td class="hidden-sm-down">Users</td>
                                </tr>

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


