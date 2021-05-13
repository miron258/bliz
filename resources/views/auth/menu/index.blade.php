@extends('auth.layouts.app')
@section('title', 'Список меню')
@section('content')
<div class="container-fluid">
    <div class="row-fluid justify-content-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">@yield('title')</div>


                <div class="col-12 ml-1 mt-2">
                    <a class="btn btn-primary btn-sm" href="{{route('menu.create')}}"><i class="far fa-plus-square mr-2"></i>Создать меню</a>
                </div>


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
                                <td>Сортировка</td>
                                <td>Дата создания</td>
                                <td></td>
                            </tr>
                        </thead>


                        <tbody>

                            @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->order }}</td>

                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{route('menu.edit', $menu->id)}}"><i class="far fa-edit mr-2"></i>Редактировать</a>
                                </td>
                                <td>
                                    <form action='{{route('menu.destroy', $menu->id)}}' method='POST'>
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
                        {{$menus->links()}}
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
