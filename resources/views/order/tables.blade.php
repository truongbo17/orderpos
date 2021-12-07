@extends('dashbroad.app')

@section('content')

    <body class="g-sidenav-show  bg-gray-200 virtual-reality">
        <div class="border-radius-xl mx-2 mx-md-3 position-relative"
            style="background-image: url('../assets/img/vr-bg.jpg'); background-size: cover;">
            <div class="row">
                <div class="col-md-12 ms-lg text-center">
                    <button class="btn btn-white border-radius-lg p-2 mt-n4 mt-md-2" type="button" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Home" onclick="window.location.href='{{ route('home') }}'">
                        <i class="material-icons p-2">home</i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn btn-white border-radius-lg p-2 mt-n4 mt-md-2" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="material-icons p-2">search</i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="form-input" style="">
                                    <div class="input-group input-group-outline">
                                        <label class="form-label">Tìm bàn ăn...</label>
                                        <input type="text" class="form-control" id="serachtable" name="search">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <button class="btn btn-white border-radius-lg p-2 mt-n4 mt-md-2" type="button" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Đổi bàn">
                        <i class="material-icons p-2">more_horiz</i>
                    </button>
                    <button class="btn btn-white border-radius-lg p-2 mt-n4 mt-md-2 avatar avatar-lg border-0 p-1"
                        type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ Auth::user()->name }}"
                        onclick="window.location.href='{{ route('user.profile') }}'">
                        <img class="border-radius-lg" alt="Image placeholder"
                            src="{{ asset('assets/img/avatar/' . Auth::user()->avatar) }}">
                    </button>
                </div>
            </div>
            <main class="main-content border-radius-lg h-100">
                <div class="section min-vh-85 position-relative transform-scale-md-8">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row" id="searchTable"></div>
                            </div>
                            <div class="col-md-8" id="checkHide">
                                <div class="row">
                                    <h5 class="text-center mb-0 ms-1 text-white">Bàn thông thường</h5>
                                    @foreach ($listTables as $item)
                                        @if ($item->people_number <= 6)
                                            <div class="col-md-3 cursor-pointer">
                                                <div class="card bg-gradient-dark move-on-hover">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <h5 class="mb-0 text-white">{{ $item->name }}</h5>
                                                            <div class="ms-auto">
                                                                <h1 class="text-white text-end mb-0 mt-n2">
                                                                    {{ $item->people_number }}</h1>
                                                                <p class="text-sm mb-0 text-white"> người</p>
                                                            </div>
                                                        </div>
                                                        <p class="text-white mb-0">Chưa order</p>
                                                        <p class="mb-0 text-white">
                                                            {{ $item->status == 1 ? 'Đã đặt trước' : 'Chưa đặt trước' }}
                                                        </p>
                                                    </div>
                                                    <button class="btn bg-gradient-warning w-100 mb-0 toast-btn"
                                                        type="button" data-bs-toggle="modal" data-bs-target="#getProduct"
                                                        onclick="chooseTable('{{ $item->name }}',{{ $item->people_number }},{{ $item->id }})">
                                                        <i class="material-icons text-white">store</i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-4" id="checkHide1">
                                <h5 class="text-center mb-0 ms-1 text-white">Bàn gia đình</h5>
                                <div class="row">
                                    @foreach ($listTables as $item)
                                        @if ($item->people_number > 6 && $item->people_number <= 15)
                                            <div class="col-md-6 cursor-pointer">
                                                <div class="card bg-gradient-dark move-on-hover">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <h5 class="mb-0 text-white">{{ $item->name }}</h5>
                                                            <div class="ms-auto">
                                                                <h1 class="text-white text-end mb-0 mt-n2">
                                                                    {{ $item->people_number }}</h1>
                                                                <p class="text-sm mb-0 text-white"> người</p>
                                                            </div>
                                                        </div>
                                                        <p class="text-white mb-0">Chưa order</p>
                                                        <p class="mb-0 text-white">
                                                            {{ $item->status == 1 ? 'Đã đặt trước' : 'Chưa đặt trước' }}
                                                        </p>
                                                    </div>
                                                    <button class="btn bg-gradient-warning w-100 mb-0 toast-btn"
                                                        type="button" data-bs-toggle="modal" data-bs-target="#getProduct"
                                                        onclick="chooseTable('{{ $item->name }}',{{ $item->people_number }},{{ $item->id }})">
                                                        <i class="material-icons text-white">store</i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <hr>
                                <h5 class="text-center mb-0 ms-1 text-white">Bàn tổ chức tiệc</h5>
                                <div class="row">
                                    @foreach ($listTables as $item)
                                        @if ($item->people_number > 15)
                                            <div class="col-md-6 cursor-pointer">
                                                <div class="card bg-gradient-dark move-on-hover">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <h5 class="mb-0 text-white">{{ $item->name }}</h5>
                                                            <div class="ms-auto">
                                                                <h1 class="text-white text-end mb-0 mt-n2">
                                                                    {{ $item->people_number }}</h1>
                                                                <p class="text-sm mb-0 text-white"> người</p>
                                                            </div>
                                                        </div>
                                                        <p class="text-white mb-0">Chưa order</p>
                                                        <p class="mb-0 text-white">
                                                            {{ $item->status == 1 ? 'Đã đặt trước' : 'Chưa đặt trước' }}
                                                        </p>
                                                    </div>
                                                    <button class="btn bg-gradient-warning w-100 mb-0 toast-btn"
                                                        type="button" data-bs-toggle="modal" data-bs-target="#getProduct"
                                                        onclick="chooseTable('{{ $item->name }}',{{ $item->people_number }},{{ $item->id }})">
                                                        <i class="material-icons text-white">store</i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="getProduct" tabindex="-1" aria-labelledby="getProduct" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="getnametable"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        1
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="input-group input-group-outline mb-3">
                                                    <select name="selectCategory" id="selectCategory"
                                                        class="form-control">
                                                        <option>Chọn Menu</option>
                                                        @foreach ($allCategory as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="input-group input-group-outline">
                                                    <label class="form-label">Tìm món ăn...</label>
                                                    <input type="text" class="form-control" name="search"
                                                        id="searchproduct">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="height:500px;position: relative;overflow: auto;"
                                            id="showProduct">
                                        </div>
                                        <div class="row" style="height:500px;position: relative;overflow: auto;"
                                            id="allProduct">
                                            @foreach ($allProduct as $item)
                                                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 border"
                                                    style="padding-top: 25px">
                                                    <div class="card card-blog card-plain">
                                                        <div class="card-header p-0 mt-n4 mx-3">
                                                            <a class="d-block shadow-xl border-radius-xl">
                                                                <img src="{{ asset('assets/img/products/' . $item->thumbnail) }}"
                                                                    alt="img-blur-shadow"
                                                                    class="img-fluid shadow border-radius-xl"
                                                                    style="height: 128px">
                                                            </a>
                                                        </div>
                                                        <div class="card-body p-3">
                                                            <p class="mb-0 text-sm">
                                                                {{ number_format($item->price) }}VNĐ
                                                            </p>
                                                            <a href="javascript:;">
                                                                <h5>
                                                                    {{ $item->name }}
                                                                </h5>
                                                            </a>
                                                            <p class="mb-4 text-sm">
                                                                {{ $item->description }}
                                                            </p>
                                                            <p class="mb-4 text-sm">
                                                                {{ $item->categoryname }}
                                                            </p>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <button type="button"
                                                                    class="btn btn-outline-primary btn-sm mb-0">Chọn
                                                                    Món</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end model -->
            </main>
        </div>
    @section('scriptadd1')
        <script>
            function showAllProduct() {
                $('#allProduct').show();
                $('#showProduct').hide();
                $('#searchproduct').val('');
            }
            $('#searchproduct').on('keyup', function() {
                $value = $(this).val();
                if ($value === '' && $value.length < 1) {
                    $('#showProduct').hide();
                    $('#showProduct').html('');
                    $('#allProduct').show();
                } else {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('tables.livesearchproduct') }}',
                        data: {
                            'search': $value,
                            '_token': '{{ @csrf_token() }}',
                        },
                        success: function(data) {
                            $('#showProduct').show();
                            // console.log(data);
                            $('#showProduct').html(data);
                            $('#allProduct').hide();
                        }
                    });
                }
            });


            function showAllTable() {
                $('#serachtable').val('');
                $('#searchTable').html('');
                $('#checkHide').show();
                $('#checkHide1').show();
            }

            $('#serachtable').on('keyup', function() {
                $value = $(this).val();
                if ($value === '' && $value.length < 1) {
                    $('#searchTable').html('');
                    $('#checkHide').show();
                    $('#checkHide1').show();
                } else {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('tables.livesearchtable') }}',
                        data: {
                            'search': $value,
                            '_token': '{{ @csrf_token() }}',
                        },
                        success: function(data) {
                            // console.log(data);
                            $('#searchTable').html(data);
                            $('#checkHide').hide();
                            $('#checkHide1').hide();
                        }
                    });
                }
            });

            function chooseTable(name, people_number, id) {
                document.getElementById('getnametable').innerText = name + " , Số lượng : " + people_number + " người";
            }

            $(document).ready(function() {
                $('#showProduct').hide();
            });
        </script>
    @endsection
@endsection
