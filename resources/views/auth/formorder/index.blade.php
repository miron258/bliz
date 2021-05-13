@extends('auth.layouts.app')
@section('title', 'Список форм заказов')
@section('content')
    <div class="container-fluid">
        <div class="row-fluid justify-content-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">@yield('title')</div>




                    <div class="card-body">

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        <table class="table table-bordered table-responsive table-striped">
                            <thead>
                            <tr>
                                <td>Имя</td>
                                <td>Телефон</td>
                                <td>Адрес</td>
                                <td>Дата создания</td>
                                <td></td>
                            </tr>
                            </thead>


                            <tbody>

                            @foreach($forms as $formOrder)
                                <tr>
                                    <td>{{ $formOrder->name }}</td>
                                    <td>
                                        {{$formOrder->phone}}
                                    </td>
                                    <td>
                                        {{$formOrder->address}}
                                    </td>
                                    <td>{{ $formOrder->created_at }}</td>
                                    <td>
                                        <form action='{{route('formOrder.destroy', $formOrder->id)}}' method='POST'>
                                            @csrf
                                            @method('DELETE')
                                            <button type='submit' class="btn btn-danger btn-sm"><i class="fas fa-trash mr-2"></i>Удалить</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>


                        <div class='paginate'>
                            {{$forms->links()}}
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
