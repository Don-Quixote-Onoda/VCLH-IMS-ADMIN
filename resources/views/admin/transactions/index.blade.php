@extends('layout.app')
@section('content')
    <div class="container-fluid mt-3">
        <div class="row mt-3">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <form action="{{route('transactions.store')}}" method="post">
                        @csrf
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection