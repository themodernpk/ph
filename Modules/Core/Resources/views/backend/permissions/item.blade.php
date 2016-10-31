<div class="slidePanel-content scrollable-content">
    <header class="slidePanel-header">
        <div class="slidePanel-actions" aria-label="actions" role="group">
            <button type="button" class="btn btn-icon btn-pure btn-inverse slide-panel-close actions-top icon wb-close"
                    aria-hidden="true"></button>
        </div>
        <h1>Details</h1>
    </header>
    <div class="slidePanel-inner">
        <div class="scrollable">
            <div>
                <div>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Prefix</th>
                            <td>{{$data->item->prefix}}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{$data->item->name}}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>
                                {{$data->item->slug}}
                            </td>
                        </tr>
                        <tr>
                            <th>Enable</th>
                            <td>{{$data->item->enable}}</td>
                        </tr>
                        <tr>
                            <th>Details</th>
                            <td>{{$data->item->details}}</td>
                        </tr>
                        <tr>
                            <th>Roles</th>
                            <td>
                                @if(count($data->item->roles))
                                    @foreach($data->item->roles as $role)
                                        {{$role->name}},
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created By</th>
                            <td>
                                @if($data->item->createdBy)
                                    {{$data->item->createdBy->name}} /
                                @endif
                                @if($data->item->created_at)
                                    {{$data->item->created_at->diffForHumans()}}
                                    / {{$data->item->created_at}}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Updated By</th>
                            <td>
                                @if($data->item->updatedBy)
                                    {{$data->item->updatedBy->name}} /
                                @endif
                                @if($data->item->updated_at)
                                    {{$data->item->updated_at->diffForHumans()}}
                                    / {{$data->item->updated_at}}
                                @endif
                            </td>
                        </tr>

                        @if($data->item->deletedBy)
                        <tr>
                            <th>Deleted By</th>
                            <td>
                                {{$data->item->deletedBy->name}} /
                                @if($data->item->deleted_at)
                                    {{$data->item->deleted_at->diffForHumans()}}
                                    / {{$data->item->deleted_at}}
                                @endif
                            </td>
                        </tr>
                        @endif

                    </table>




                </div>
            </div>
        </div>
    </div>
</div>