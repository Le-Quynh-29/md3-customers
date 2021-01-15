@extends('home')
@section('title')
    <div class="search-box">
        <form class="input" action="{{route('customers.search')}}" method="post">
            @csrf
            <input class="sb-search-input input__field--madoka" name="search" placeholder="Search..." type="text" id="input-31" />
            {{--                    <input type="submit" value="search">--}}
{{--            <button type="submit">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">--}}
{{--                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>--}}
{{--                </svg>--}}
            </button>
        </form>
    </div>
@endsection

@section('content')


    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <h1>Danh Sách Khách Hàng</h1>
            </div>
            <a class="btn btn-primary" href="{{ route('customers.create') }}">Thêm mới</a>

            <a  class="btn btn-warning" href="" data-toggle="modal" data-target="#cityModal">
                Lọc
            </a>

            <div class="col-12">
                @if (Session::has('success'))
                    <p class="text-success">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        {{ Session::get('success') }}
                    </p>
                @endif

                @if(isset($totalCustomerFilter))
                    <span class="text-muted">
                    {{'Tìm thấy' . ' ' . $totalCustomerFilter . ' '. 'khách hàng:'}}
                </span>
                @endif

                @if(isset($cityFilter))
                    <div class="pl-5">
                   <span class="text-muted"><i class="fa fa-check" aria-hidden="true"></i>
                       {{ 'Thuộc tỉnh' . ' ' . $cityFilter->name }}</span>
                    </div>
                @endif
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Ngày Sinh</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tỉnh thành</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
{{--                @if(count($customers) == 0)--}}
{{--                    <tr>--}}
{{--                        <td colspan="7" class="text-center">Không có dữ liệu</td>--}}
{{--                    </tr>--}}
{{--                @else--}}
                    @foreach($customer_page as $key => $customer)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->dob }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->city->name }}</td>
                            <td><a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">sửa</a></td>
                            <td><a href="{{ route('customers.destroy', $customer->id) }}" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">xóa</a></td>
                        </tr>
                    @endforeach
{{--                @endif--}}
                </tbody>
            </table>
            <div style="font-size:25px;text-align: right!important; ">
{{--                {{$customer_page->links()}}--}}
            </div>
        </div>

        <div class="modal fade" id="cityModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <form action="{{ route('customers.filterByCity') }}" method="get">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <!--Lọc theo khóa học -->
                            <div class="select-by-program">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label border-right">Lọc khách hàng theo tỉnh thành</label>
                                    <div class="col-sm-7">
                                        <select class="custom-select w-100" name="city_id">
                                            <option value="">Chọn tỉnh thành</option>
                                            @foreach($cities as $city)
                                                @if(isset($cityFilter))
                                                    @if($city->id == $cityFilter->id)
                                                        <option value="{{$city->id}}" selected >{{ $city->name }}</option>
                                                    @else
                                                        <option value="{{$city->id}}">{{ $city->name }}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$city->id}}">{{ $city->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- </form> -->
                            </div>
                            <!--End-->

                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="submitAjax" class="btn btn-primary" >Chọn</button>
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Hủy</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
