@extends('admin.layouts.dashboard')

@section('main-page')
<div class="title">
    <h1>Organizations</h1>
    <hr>
</div>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            Edit Organization
        </div>
        <div class="actions">
            <a href="{{ route('admin.organization.index') }}" class="btn btn-redtheme"> Back to List </a>
        </div>
    </div>
    <div class="portlet-body">
        {!! Form::open(['route' => ['admin.organization.update', $organization->id], 'method' => 'put']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('name', 'Organization Name') }}
                        {{ Form::text('name',  $organization->name, ['class' => 'form-control', 'placeholder' => 'Text, Unique']) }}
                    </div>
                </div>
            </div>
            @for ($i = 1; $i <= $organization->accounts->count(); $i ++)
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('email'.$i, 'Email '.$i) }}
                            {{ Form::text('email'.$i, $organization->accounts->get($i-1)->email, ['class' => 'form-control', 'placeholder' => 'Enter email']) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('password'.$i, 'Password '.$i) }}
                            {{ Form::password('password'.$i, ['class' => 'form-control', 'placeholder' => 'Enter password']) }}
                        </div>
                    </div>
                </div>
            @endfor
            @for ($index = $i; $index <= 3; $index ++)
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('email'.$index, 'Email '.$index) }}
                            {{ Form::text('email'.$index, '', ['class' => 'form-control', 'placeholder' => 'Enter email']) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        {{ Form::label('password'.$index, 'Password '.$index) }}
                            {{ Form::password('password'.$index, ['class' => 'form-control', 'placeholder' => 'Enter password']) }}
                        </div>
                    </div>
                </div>
            @endfor
            
            <div class="row">
                <div class="text-right col-sm-12">
                    <div class="form-group">
                        <br>
                        {{ Form::submit('Save', array('class' => 'btn-theme btn')) }}
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection