@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th>Date</th>
                            <th>Kind</th>
                            <th>Amount</th>
                            <th>Description</th>
                        </thead>
                        <tbody>
                            @foreach($pays as $pay)
                                <tr>
                                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $pay->kind->name }}</td>
                                    <td>{{ number_format($pay->amount) }} THB</td>
                                    <td>{{ $pay->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
