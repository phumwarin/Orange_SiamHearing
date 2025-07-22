@extends('admin.layout.auth-layout')

@section('content')
<div class="login-box register-mode">
  <div class="text-center mb-3">
    <img src="{{ url('') }}/assets/img/illustrations/Daikin-Logo.png" class="mw-100 logo-scale" alt="Daikin Logo" height="50">
  </div>
  <h4 class="login-title mb-3">Register</h4>

  <form id="register-form" method="POST" action="{{ route('register.store') }}">
    @csrf

    <div class="row g-2">
      <div class="col-md-4 col-sm-6 mb-2">
        <label class="form-label">Username/ E-Mail</label>
        <input type="text" name="email" class="form-control" placeholder="@dit.daikin.co.jp" required>
      </div>

      <div class="col-md-4 col-sm-6 mb-2">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="XXXXXXXXXXXXX" required>
      </div>

      <div class="col-md-4 mb-2">
        <label class="form-label">Employee Code</label>
        <input type="text" name="employee_code" class="form-control">
      </div>

      <div class="col-md-4 col-sm-6 mb-2">
        <label class="form-label">Firstname</label>
        <input type="text" name="firstname" class="form-control">
      </div>

      <div class="col-md-4 col-sm-6 mb-2">
        <label class="form-label">Lastname</label>
        <input type="text" name="lastname" class="form-control">
      </div>

      <div class="col-md-4 mb-2">
        <label class="form-label">Tel</label>
        <input type="text" name="tel" class="form-control" placeholder="Phone extension">
      </div>

      <div class="col-md-4 mb-2">
        <label class="form-label">Daikin Plant</label>
        <input type="text" name="plant" class="form-control" placeholder="DIT/DIL or ...">
      </div>

      <div class="col-md-4 mb-2">
        <label class="form-label">Department</label>
        <input type="text" name="department" class="form-control" placeholder="R&D">
      </div>

      <div class="col-md-4 mb-2">
        <label class="form-label">Section</label>
        <input type="text" name="section" class="form-control" placeholder="DEDE, DECP">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Reason for application</label>
      <textarea name="reason" class="form-control" rows="3" placeholder="Please describe the purpose of using this system in your work ? e.g. to request lab schedule, submit test jobs, or track job status."></textarea>
    </div>

    <div class="mb-3 d-flex justify-content-between">
      <a href="{{ route('login.index') }}" class="forgot-color small">Forgot password?</a>
      <a href="{{ route('login.index') }}" class="register-color small">Log in</a>
    </div>

    <button type="submit" class="btn btn-daikin w-100">Register</button>
  </form>
</div>
@endsection
