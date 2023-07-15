<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">

</head>
<body>
    <section>
        <div class="row">
            <div class="container">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header" style="text-align: center">Transactions</div>
                            <div class="card-body">
                                <div class="card-header" style="text-align: center">
                                    <button type="button"  onclick="window.location.href='{{route('home')}}'" class="">Transaction</button>
                                    <button type="button"  onclick="window.location.href='{{route('deposit')}}'" class="">Deposit</button>
                                    <button type="button"  onclick="window.location.href='{{route('withdraw')}}'" class="">Withdraw</button>
                                </div>
                                <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Transaction ID</th>
                                                <th>Amount</th>
                                                <th>Balance</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $transaction->id ?? 'N/A' }}</td>
                                                    <td>{{ $transaction->amount ?? "N/A" }}</td>
                                                    <td>{{ $transaction->user->balance ??"N/A" }}</td>
                                                    <td>{{ showDateFormat($transaction->date) }}</td>
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
</body>
</html>