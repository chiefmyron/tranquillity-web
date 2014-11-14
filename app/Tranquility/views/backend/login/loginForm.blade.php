@extends('backend::layouts.login')

@section('content')

        {{ Form::open(array('url' => 'login', 'class' => 'form-signin')) }}
            <h2 class="form-signin-heading">Please sign in</h2>
            
            {{ Form::label('inputEmail', 'Email address', array('class' => 'sr-only')) }}
            {{ Form::email('inputEmail', Input::old('inputEmail'), array('placeholder' => 'Email address', 'required' => true, 'autofocus' => true, 'class' => 'form-control')) }}
            
            {{ Form::label('inputPassword', 'Password', array('class' => 'sr-only')) }}
            {{ Form::password('inputPassword', array('placeholder' => 'Password', 'required' => true, 'class' => 'form-control')) }}
            
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('rememberMe', Input::old('rememberMe')) }} Remember me
                </label>
            </div>
            
            {{ Form::submit('Sign in', array('class' => 'btn btn-lg btn-primary btn-block')) }}
        
        {{ Form::close() }}
@stop