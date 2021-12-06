@extends('dashbroad.index')

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
                    <button class="btn btn-white border-radius-lg p-2 mt-n4 mt-md-2" type="button" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Tìm bàn">
                        <i class="material-icons p-2">search</i>
                    </button>
                    <button class="btn btn-white border-radius-lg p-2 mt-n4 mt-md-2" type="button" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Đổi bàn">
                        <i class="material-icons p-2">more_horiz</i>
                    </button>
                    <button class="btn btn-white border-radius-lg p-2 mt-n4 mt-md-2 avatar avatar-lg border-0 p-1"
                        type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ Auth::user()->name }}">
                        <img class="border-radius-lg" alt="Image placeholder" src="{{ asset('assets/img/avatar/' . Auth::user()->avatar) }}">
                    </button>
                </div>
            </div>
            <main class="main-content border-radius-lg h-100">
                <div class="section min-vh-85 position-relative transform-scale-md-8">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
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
                                                        onclick="chooseTable('{{ $item->name }}',{{ $item->id }})">
                                                        <i class="material-icons text-white">store</i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-4">
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
                                                        onclick="chooseTable('{{ $item->name }}',{{ $item->id }})">
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
                                                        onclick="chooseTable('{{ $item->name }}',{{ $item->id }})">
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
                <div class="modal fade" id="getProduct" tabindex="-1" aria-labelledby="getProduct"
                    aria-hidden="true">
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
                                       2 
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
        <script>
            function chooseTable(name,id) {
                document.getElementById('getnametable').innerText = name;
            }
        </script>
    </body>
@endsection
