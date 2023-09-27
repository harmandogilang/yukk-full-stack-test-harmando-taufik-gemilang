@extends('layout.auth')

@section('container')
<div class="row m-auto">
  <form id="form-login">
      @csrf
      <h1 class="h3 mb-3 fw-normal">Login</h1>
      <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
          <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
          <label for="floatingPassword">Password</label>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
  </form>
</div>
<script>
  $(function(){
      $('form#form-login').on('submit', function(e){
          e.preventDefault();
          $.post('{{ route('auth.do_login') }}', $(this).serialize(), function(rtn){
              if(rtn.code == 0){
                  window.location.href = '{{ route('history') }}';
              } else {
                alert(rtn.message);
              }
          }, 'json')
      });
  });
</script>
@endsection