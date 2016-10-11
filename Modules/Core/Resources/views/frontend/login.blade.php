@extends('core::layouts.frontend_form')

@section('form')
<form method="post" action="#" autocomplete="off">
    <div class="form-group form-material floating">
        <input type="email" class="form-control" autocomplete="off"
               onfocus="this.removeAttribute('readonly');" readonly
               name="email" />
        <label class="floating-label">Email</label>
    </div>
    <div class="form-group form-material floating">
        <input type="password" class="form-control"
               onfocus="this.removeAttribute('readonly');" readonly
               name="password" />
        <label class="floating-label">Password</label>
    </div>
    <div class="form-group clearfix">
        <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg pull-left">
            <input type="checkbox" id="inputCheckbox" name="remember">
            <label for="inputCheckbox">Remember me</label>
        </div>
        <a class="pull-right" href="forgot-password.html">Forgot password?</a>
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-lg margin-top-40">Sign in</button>
</form>
@endsection