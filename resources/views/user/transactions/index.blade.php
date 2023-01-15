@extends('layout.app')
@section('content')

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <h1>{{ $inns[0]->inn_name }}</h1>
                <h2>Number of Rooms: {{ $inns[0]->number_of_rooms }}</h2>
                <hr class="my-3">

                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewTransaction">Add Transaction</button>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Transactions Table</h6>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">username</th>
                                        <th scope="col">lodging house / inn name</th>
                                        <th scope="col">room number</th>
                                        <th scope="col">freebie</th>
                                        <th scope="col">hours</th>
                                        <th scope="col">rate</th>
                                        <th scope="col" colspan="3">actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($transactions) > 0)
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->user->name }}</td>
                                                <td>{{ $transaction->inn->inn_name }}</td>
                                                <td>{{ $transaction->room->room_number }}</td>
                                                <td>{{ $transaction->room->freebies }}</td>
                                                <td>{{ $transaction->room_rate->number_of_hours }} hours</td>
                                                <td>PHP{{ $transaction->room_rate->rate }}</td>
                                                <td>
                                                    <a href="/admin/transactions-admin/{{ $transaction->id }}"
                                                        class="btn btn-success">Print</a>

                                                </td>
                                                <td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="addNewTransaction" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Transaction</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('transactions-manager.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="inn_id" value="{{ $inn[0]->id }}">
                                            <livewire:room></livewire:room>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
