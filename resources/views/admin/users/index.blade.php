@extends('layout.app')
@section('content')
<div class="container">
    <div class="row mt-5 mx-auto d-flex justify-content-center">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4  px-5">
                <h6 class="mb-4">Users Table</h6>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="row mx-0">
                                <th scope="col" class="col-sm-2 ms-2">status</th>
                                <th scope="col" class="col-sm-9">username</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) > 0)
                                @foreach ($users as $user)
                                   <tr class="row mx-0">
                                    <td class="col-sm-2 ms-2">
                                        <div class="form-check form-switch">
                                            <form action="/admin/users-admin/{{$user->id}}" id="formName" method="get">
                                                @csrf
                                                @method('put')
                                                <input class="form-check-input" type="checkbox" role="switch" value="{{($user->status == 1) ? 'verified' : 'not_verified'}}" name="status"  onchange="document.getElementById('formName').submit()" id="flexSwitchCheckChecked" {{($user->status == 1) ? 'checked' : ''}}>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">{{($user->status == 1) ? 'verified' : 'not verified'}}</label>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="col-sm-9">{{$user->name}}</td>
                                   </tr>
                                @endforeach                                
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
@endsection