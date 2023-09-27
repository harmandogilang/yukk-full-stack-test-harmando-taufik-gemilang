@extends('layout.auth')

@section('container')
<div class="row m-auto">
    <form id="form-register">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Register</h1>
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password_confirmation" placeholder="Password">
            <label for="floatingPassword">Re-type Password</label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
    </form>
</div>
<script>
    $(function(){
        console.log('ready');

        $('form#form-register').on('submit', function(e){
            e.preventDefault();
            $.post('{{ route('auth.do_register') }}', $(this).serialize(), function(rtn){
                if(rtn.code == 0){
                    window.location.href = '{{ route('auth.login') }}';
                }
            }, 'json').fail(function(err){
                alert(err.responseJSON.message);
            });
        });
    });
</script>
@endsection
