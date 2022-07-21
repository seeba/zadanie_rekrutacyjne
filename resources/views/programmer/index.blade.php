@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{__('Programiści')}}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Imię</th>
                                <th scope="col">Nazwisko</th>
                                <th scope="col">Wiek</th>
                                <th scope="col">Dodany przez</th>
                                <th scope="col">języki prog</th>
                                <th scope="col">Do pełnoletności</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($programmers as $programmer )
                                <tr>
                                    <td>{{$programmer['first_name']}}</td>
                                    <td>{{$programmer['last_name']}}</td>
                                    <td>{{$programmer['age']}}</td>
                                    <td>{{$programmer['from']}}</td>
                                    <td>
                                        @foreach ($programmer['languages'] as $lang )
                                            {{$lang['name']}},
                                        @endforeach
                                    </td>
                                    
                                    <td>{{$programmer['left']}}</td>
                                </tr>
                       
                    @endforeach
                        </tbody>
                    </table>
                    <div class="row mb-0">
                        <div class="col-md-2 offset-md-10">
                            <a class="nav-link btn btn-success" href="{{route('programmer.create')}}">Dodaj</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection