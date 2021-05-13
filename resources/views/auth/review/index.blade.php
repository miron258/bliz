@extends('auth.layouts.app')
@section('title', 'Список отзывов')
@section('content')
    <div class="container-fluid">
        <div class="row-fluid justify-content-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">@yield('title')</div>


                    <div class="col-12 ml-1 mt-2">
                        <a class="btn btn-primary btn-sm" href="{{route('review.create')}}"><i class="far fa-plus-square mr-2"></i>Создать отзыв</a>
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
                                <td>Фото</td>
                                <td>Видимость</td>
                                <td>Дата создания</td>
                                <td></td>
                                <td></td>
                            </tr>
                            </thead>


                            <tbody>

                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->name }}</td>
                                    <td>
                                        @if(!empty($review->img))
                                            <img class="img-rounded img-fluid" alt="{{$review->name}}" src="{{Storage::url($review->img)}}">
                                        @endif
                                    </td>
                                    <td>
                                        @if($review->hidden)
                                            <i class="far fa-eye"></i>
                                        @else
                                            <i class="far fa-eye-slash"></i>
                                        @endif
                                    </td>
                                    <td>{{ $review->created_at }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{route('review.edit', $review->id)}}"><i class="far fa-edit mr-2"></i>Редактировать</a>
                                    </td>
                                    <td>
                                        <form action='{{route('review.destroy', $review->id)}}' method='POST'>
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
                            {{$reviews->links()}}
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
