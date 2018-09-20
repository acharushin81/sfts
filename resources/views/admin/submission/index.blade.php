@extends('admin.layouts.dashboard')

@section('main-page')
<div class="title">
    <h1>Submissions</h1>
    <hr>
</div>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            List of Submissions
        </div>
        <div class="actions">
            <a href="{{ route('admin.submission.create') }}" class="btn btn-redtheme"> Add New Submission </a>
        </div>
    </div>
    <div class="portlet-body">
        <div id="tblGovernmentList_wrapper" class="dataTables_wrapper no-footer">
            {!! Form::open(['route' => 'admin.submission.search', 'method' => 'get', 'id' => 'search_form']) !!}
                <div class="row">
                    <div class="col-3">
                        <div id="tblGovernmentList_filter" class="dataTables_filter text-left">
                            <label>
                                {{ Form::text('organization', request()->organization, ['placeholder' => 'Organization', 'class' => 'form-control input-sm input-small input-inline']) }}
                            </label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div id="tblGovernmentList_filter" class="dataTables_filter text-left">
                            <label>{{ Form::number('year', request()->year, [
                                                                'placeholder' => 'Year',
                                                                'class' => 'form-control input-sm input-small input-inline', 
                                                                'min' => '2000', 
                                                                'max' => '2018']) 
                                }}
                            </label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div id="tblGovernmentList_filter" class="dataTables_filter text-right">
                            <label>
                            {{ Form::number('month', request()->month, [
                                                            'placeholder' => 'Month',
                                                            'class' => 'form-control input-sm input-small input-inline',  
                                                            'min' => '1', 
                                                            'max' => '12']) 
                            }}
                            </label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div id="tblGovernmentList_filter" class="dataTables_filter text-right">
                            <label>{{ Form::text('keyword', request()->keyword , ['placeholder' => 'Search', 'class' => 'form-control input-sm input-small input-inline']) }}
                            </label>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <div class="table-scrollable">
                <table class="table table-bordered v-middle dataTable no-footer dtr-inline" id="tblGovernmentList">
                    <thead class="red-th">
                        <tr role="row">
                            <th class="sorting" style="width: 50px;">SN</th>
                            <th class="sorting" style="width: 200px;">Organization Name</th>
                            <th class="sorting">Month/Year</th>
                            <th class="sorting">Submission Status</th>
                            <th class="sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($submissions as $key=> $submission)
                        <tr role="row" class="odd">
                            <td>
                                @if ($loop->index == 0)
                                    {{ $loop->index + 1 }}
                                @elseif ($loop->index >= 1 && $submission->organization->name != $submissions[$loop->index-1]->organization->name)
                                    {{ $loop->index + 1 }}
                                @else
                                    {{ $loop->index + 1 }}
                                @endif
                                    
                            </td>   
                            <td>
                                @if ($loop->index == 0)
                                    {{ $submission->organization->name }}
                                @endif
                                @if ($loop->index >= 1 && $submission->organization->name != $submissions[$loop->index-1]->organization->name)
                                    {{ $submission->organization->name }}
                                @endif
                            </td>
                            <td>{{ $submission->month }}/{{ $submission->year }}</td>
                            <td>{{ $submission->status }}</td>
                            <td>
                                <div class="dropdown show">
                                    <a class="btn btn-theme dropdown-toggle md-skip btn-xs" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('admin.submission.show', $submission->id) }}">View Submission</a>
                                        <a class="dropdown-item" href="{{ route('admin.submission.download', $submission->id) }}">Download</a>
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
                    <div class="pt-2">Showing {{($submissions->currentpage()-1)*$submissions->perpage()+1}} to {{$submissions->currentpage()*$submissions->perpage()}}
                    of  {{$submissions->total()}} entries</div>
                    
                </div>
                <div class="col-8">
                    <div class="float-right">
                        {{ $submissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("input[name='keyword']").keypress(function( event ) {
        if ( event.which == 13 ) {
            $('#search_form').submit();
        }
    });
    $("input[name='organization']").keypress(function( event ) {
        if ( event.which == 13 ) {
            $('#search_form').submit();
        }
    });
    $("input[name='year']").keypress(function( event ) {
        if ( event.which == 13 ) {
            $('#search_form').submit();
        }
    });
    $("input[name='month']").keypress(function( event ) {
        if ( event.which == 13 ) {
            $('#search_form').submit();
        }
    });
</script>
@endsection
