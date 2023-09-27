@extends('layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1>Transaction</h1>
</div>
<div class="container row">
  <div class="col-6 offset-3">
    <form id="transaction-form" action="{{ route('transaction.post') }}" method="post" class="form">
      @csrf
      <div class="form-group">
        <label for="transaction-type">Transaction Type</label>
        <select name="transaction-type" id="transaction-type" class="form-control">
          <option value="">Please select...</option>
          @foreach ($transaction_types as $ttype)
            <option value="{{ $ttype->id }}">{{ $ttype->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group d-none" id="bank-account">
        <label for="bank-account">Bank</label>
        <select name="bank-account" id="bank-account" class="form-control">
        </select>
      </div>
      <div class="form-group" id="bank-account">
        <label for="amount">Amount</label>
        <input type="number" id="amount" name="amount" class="form-control">
      </div>
      <div class="form-group" id="bank-account">
        <label for="note">Note</label>
        <input type="text" id="note" name="note" class="form-control">
      </div>
      <button class="btn btn-info mt-3" type="submit">Submit</button>
    </form>
  </div>
</div>

<script>
  $(function(){
    $('select#transaction-type').on('change', function(){
      let ttype = $(this).val();
      console.log('ttype', ttype);
      switch(ttype)
      {
        case '3':
          $('div#bank-account').removeClass('d-none');
          let html = ''
          $.get('{{ route('bank_accounts.get') }}', function(rtn){
            console.log(rtn.bank_accounts);
            html += `<option value="">Please select...</option>`
            rtn.bank_accounts.forEach(el => {
              html += `<option value="${el.id}">${el.name} - ${el.account_number}</option>`
            });
            $('select#bank-account').html(html);
          }, 'json');
          break;
      }
    });

    $('form#transaction-form').on('submit', function(e){
      e.preventDefault();
      let url = $(this).attr('action');
      let data = $(this).serialize();

      $.post(url, data, function(rtn){
        window.location.href = '{{ route('history') }}'
      }, 'json');
    })
  });
</script>
@endsection