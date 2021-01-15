@extends('home')
{{--@section('title', 'Danh sách tỉnh thành')--}}
@section('title')
    <div class="search-box">
{{--        <form class="input" action="{{route('cities.search')}}" method="post">--}}
{{--            @csrf--}}
{{--            <input class="sb-search-input input__field--madoka" name="search" placeholder="Search..." type="text" id="input-31" />--}}
{{--            --}}{{--                    <input type="submit" value="search">--}}
{{--            <button type="submit">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">--}}
{{--                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>--}}
{{--                </svg>--}}
{{--            </button>--}}
{{--        </form>--}}

        <form method="post" enctype="multipart/form-data" action="{{route('cities.search')}}" class="form-inline my-2 my-lg-0">
            @csrf
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
@endsection
@section('content')


    <div class="col-8">
        <div class="row">
            <div class="col-8">
                <h1>Danh Sách Thanh pho</h1>
            </div>
            <a class="btn btn-primary" href="{{route('cities.create')}}">Thêm mới</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên tỉnh thành</th>
                    <th scope="col">Số khách hàng</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
{{--                @if(count($cities) == 0)--}}
{{--                    <tr>--}}
{{--                        <td colspan="4">Không có dữ liệu</td>--}}
{{--                    </tr>--}}
{{--                @else--}}
                    @foreach($cities_page as $key => $citie)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $citie->name }}</td>
                            <td>{{ count($citie->customers) }}</td>
                            <td><a href="{{route('cities.edit',$citie->id)}}" class="btn btn-warning">sửa</a></td>
                            <td><a href="{{route('cities.destroy',$citie->id)}}" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa {{$citie->name}}?')">xóa</a></td>
                        </tr>
                    @endforeach
{{--                @endif--}}
                </tbody>
            </table>
            <div style="font-size:25px;text-align: right!important; ">
                {{$cities_page->links()}}
            </div>
        </div>
    </div>
@endsection
