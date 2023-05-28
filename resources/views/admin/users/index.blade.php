@extends('layout.app')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row mt-5 mx-auto d-flex justify-content-center">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4  px-5">
                <h6 class="mb-4">Users Table</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr >
                                    <th scope="col">Username</th>
                                    <th scope="col">Inn Name</th>
                                    <th scope="col">status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (count($users) > 0)
                                    @foreach ($users as $user)
                                    <tr >
                                    <td>{{$user->name}}</td>
                                    @if(count($user->inn) > 0)
                                    <td>{{$user->inn[0]->inn_name}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                        <td>
                                            <div class="form-check form-switch">
                                                <form action="/admin/users-admin/{{$user->id}}" id="formName" method="get">
                                                    @csrf
                                                    @method('put')
                                                    <input class="form-check-input" type="checkbox" role="switch" value="{{($user->status == 1) ? 'verified' : 'not_verified'}}" name="status"  onchange="document.getElementById('formName').submit()" id="flexSwitchCheckChecked" {{($user->status == 1) ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">{{($user->status == 1) ? 'verified' : 'not verified'}}</label>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach                                
                                @endif
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection