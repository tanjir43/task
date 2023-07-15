<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Withdraw</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">

    <style>

    /* Modal CSS */
    .modal {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
    }

    .modal-content {
      background-color: #fff;
      padding: 20px;
      border-radius: 4px;
      max-width: 500px;
    }

    .close {
      display: inline-block;
      padding: 8px 12px;
      margin-top: 10px;
      background-color: #f44336;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .close:hover {
      background-color: #d32f2f;
    }
  </style>

</head>
<body>
    <section>
        <div class="row">
            <div class="container">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header" style="text-align: center">
                            <button type="button"  onclick="window.location.href='{{route('home')}}'" class="">Transaction</button>
                            <button type="button"  onclick="window.location.href='{{route('deposit')}}'" class="">Deposit</button>
                            <button type="button"  onclick="window.location.href='{{route('withdraw')}}'" class="">Withdraw</button>
                        </div>
                            <div class="card-body">
                                <h1>All Withdraw</h1>
                                <button id="openModal">Make a Withdraw</button>
                              
                                  <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Transaction ID</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Fee</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($withdraws as $withdraw)
                                                <tr>
                                                    <td>{{ $withdraw->id ?? 'N/A' }}</td>
                                                    <td>{{ $withdraw->type == 'withdraw' ? 'Withdraw' : 'Deposit' }}</td>
                                                    <td>{{ $withdraw->amount ?? "N/A" }}</td>
                                                    <td> {{ $withdraw->fee ?? '0.00'  }} </td>
                                                    <td>{{ showDateFormat($withdraw->date) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- modal --}}

    <div class="modal" id="modal">
        <div class="modal-container">
          <div class="modal-content">
            <h2>Make  A Withdraw</h2>
            <form action="{{route('withdraw.store')}}" method="POST">
                @csrf
                <label for="user_id">User Name</label>
                <select name="user_id">
                    @foreach ($users as $user )
                        <option value="{{$user->id}}">{{ $user->name }} </option>
                    @endforeach
                </select>
                <label for="amount">Amount</label>
                <input type="number" name="amount" placeholder="amount">
                <button type="submit">Submit</button>
            </form>
            <button class="close" id="closeModal">Close</button>
          </div>
        </div>
      </div>

      <script>
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');
        const modal = document.getElementById('modal');
    
        openModalButton.addEventListener('click', () => {
          modal.style.display = 'block';
        });
    
        closeModalButton.addEventListener('click', () => {
          modal.style.display = 'none';
        });
      </script>
</body>
</html>