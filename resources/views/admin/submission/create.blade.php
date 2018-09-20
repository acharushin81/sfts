@extends('admin.layouts.dashboard')

@section('main-page')
<div class="title">
    <h1>Submissions</h1>
    <hr>
</div>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            Add New Submission
        </div>
        <div class="actions">
            <a href="{{ route('admin.submission.index') }}" class="btn btn-redtheme"> Back to List </a>
        </div>
    </div>
    <div class="portlet-body">
        {!! Form::open(['route' => 'admin.submission.store', 'method' => 'post']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('organization', 'Organization Name') }}
                        {{ Form::select('organization', $organizations, null, ['class' => 'form-control', 'placeholder' => 'Select Organization']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('year', 'Year') }}
                        {{ Form::number('year', '', ['class' => 'form-control', 'placeholder' => 'Select Year', 'min' => '2000', 'max' => '2018']) }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('month', 'Month') }}
                        {{ Form::number('month', '', ['class' => 'form-control', 'placeholder' => 'Select Month', 'min' => '1', 'max' => '12']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('file', 'File Upload') }}
                        {{ Form::file('file', ['class' => 'form-control', 'placeholder' => 'Upload File']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="text-right col-sm-12">
                    <div class="form-group">
                        <br>
                        <button type="submit"  class="btn-theme btn"> Save </button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection