@extends('admin.layouts.dashboard')

@section('main-page')
<div class="title">
    <h1>Organizations</h1>
    <hr>
</div>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            List of Organizations
        </div>
        <div class="actions">
            <a href="{{ route('admin.organization.create') }}" class="btn btn-redtheme"> Add New Organization </a>
        </div>
    </div>
    <div class="portlet-body">
        <div id="tblGovernmentList_wrapper" class="dataTables_wrapper no-footer">
            {!! Form::open(['route' => 'admin.organization.search', 'method' => 'get']) !!}
            <div class="row">
                <div class="col-12">
                    <div id="tblGovernmentList_filter" class="dataTables_filter text-right">
                        <label>Search : {{ Form::text('keyword', request()->keyword , ['class' => 'form-control input-sm input-small input-inline']) }}
                        </label>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="table-scrollable">
                <table class="table table-bordered v-middle dataTable no-footer dtr-inline" id="tblGovernmentList" role="grid" aria-describedby="tblGovernmentList_info">
                    <thead class="red-th">
                        <tr role="row">
                            <th class="sorting" style="width: 40px;">SN</th>
                            <th class="sorting" style="width: 180px;">Organization Name</th>
                            <th class="sorting">Email1</th>
                            <th class="sorting">Email2</th>
                            <th class="sorting">Email3</th>
                            <th class="sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($organizations as $key => $organization)
                            <tr role="row" class="odd">
                                <td>{{ ++$key }}</td>
                                <td>{{ $organization->name }}</td>
                                @foreach ($organization->accounts as $account)
                                    <td>{{ $account->email }}</td>
                                @endforeach
                                @for ($i = 0; $i < 3 - $organization->accounts->count(); $i++)
                                    <td></td>
                                @endfor
                                <td>
                                    <div class="dropdown show">
                                        <a class="btn btn-theme dropdown-toggle md-skip btn-xs" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#">View Details</a>
                                            <a href="{{ route('admin.organization.edit', $organization->id) }}" class="dropdown-item" href="#">Edit Details</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="pt-2">
                        Showing {{($organizations->currentpage()-1)*$organizations->perpage()+1}} to {{$organizations->currentpage()*$organizations->perpage()}}
                        of  {{$organizations->total()}} entries
                    </div>
                    
                </div>
                <div class="col-8">
                    <div class="float-right">
                    {{ $organizations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection