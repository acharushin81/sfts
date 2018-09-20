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
        {!! Form::open(['route' => 'admin.submission.store', 'method' => 'post', 'files' => 'true']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('organization', 'Organization Name') }}
                        {{ Form::select('organization', $organizations, null, ['class' => 'form-control', 'placeholder' => 'Select Organization']) }}
                        @if ($errors->has('organization'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('organization') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('year', 'Year') }}
                        {{ Form::selectRange('year', 2000, 2030, '',  ['class' => 'form-control'.($errors->has('year') ? ' is-invalid' : ''), 'placeholder' => 'Select Year']) }}
                        @if ($errors->has('year'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('year') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('month', 'Month') }}
                        {{ Form::selectMonth('month', '', ['class' => 'form-control'.($errors->has('month') ? ' is-invalid' : ''), 'placeholder' => 'Select Month']) }}
                        @if ($errors->has('month'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('month') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('file', 'File Upload') }}
                        {{ Form::file('file', ['accept' => '.xlsx, .csv, .xls', 'id' => 'file', 'class' => 'form-control'.($errors->has('file') ? ' is-invalid' : ''), 'placeholder' => 'Upload File']) }}
                        @if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                        @endif
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
<script>
    $('#organization').select2({
        placeholder: 'Select an option'
    });
</script>
@endsection