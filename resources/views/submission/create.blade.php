@extends('layouts.dashboard')

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
            <a href="{{ route('submission.index') }}" class="btn btn-redtheme"> Back to List </a>
        </div>
    </div>
    <div class="portlet-body">
        {!! Form::open(['route' => 'submission.store', 'method' => 'post', 'files' => true]) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('organization', 'Organization Name') }}
                        {{ Form::text('organization', $organization, ['class' => 'form-control', 'readonly']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('year', 'Year') }}
                        {{ Form::number('year', '', ['class' => 'form-control'.($errors->has('year') ? ' is-invalid' : ''), 'placeholder' => 'Select Year', 'min' => '2000', 'max' => '2018']) }}
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
                        {{ Form::number('month', '', ['class' => 'form-control'.($errors->has('month') ? ' is-invalid' : ''), 'placeholder' => 'Select Month', 'min' => '1', 'max' => '12']) }}
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
                        {{ Form::file('file', ['id' => 'file', 'class' => 'form-control'.($errors->has('file') ? ' is-invalid' : ''), 'placeholder' => 'Upload File']) }}
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
@endsection