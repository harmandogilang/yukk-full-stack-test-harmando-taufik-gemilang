@extends('layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1>Dashboard</h1>
  <h3>Current balance: <span id="user-balance">{{ $user->balance }}</span></h3>
</div>
<div class="container">
  <table class="table w-100" id="transaction-history">
    <thead>
      <tr>
        <th>Date</th>
        <th>Transaction Type</th>
        <th>Amount</th>
        <th>Debit/Credit</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<script>
  $(function(){
    let tableTransaction = $('table#transaction-history').DataTable({
      ajax: {
        url: '{{ route('transaction.history') }}'
      },
      columns: [
        {
          data: 'created_at',
          render: function(data, type, row){
            return moment(new Date(data)).format('YYYY-MM-DD hh:mm A');
          }
        },
        {
          data: 'transaction_type_name'
        },
        {
          data: 'amount'
        },
        {
          data: 'type'
        },
        {
          data: 'status'
        },
        {
          data: 'id',
          render: function(data, type, row){
            if(row['status'] == 'pending'){
              return `<button id="btn-approve" class="btn btn-info">Simulate payment</button>`;
            } else {
              return ''
            }
          }
        }
      ]
    });

    $('table#transaction-history').on('click', 'button#btn-approve', function(){
      let data = tableTransaction.row($(this).parents('tr')).data();
      $.post('{{ route('transaction.approve') }}', {
        _token: '{{ csrf_token() }}',
        trx_id: data.id
      }, function(rtn){
        if(rtn.code == 0){
          tableTransaction.ajax.reload(null, false);
          $('#user-balance').html(rtn.new_amt);
        }
      }, 'json');
    });
  });
</script>
@endsection