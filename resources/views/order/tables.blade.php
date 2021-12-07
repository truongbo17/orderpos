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
                                    <div class="col-md-5">
                                        <table
                                            class="table table-responsive table-bordered align-items-center justify-content-center mb-0"
                                            id="myTable" data-page-length="5">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Ảnh</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Tên</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Giá</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Số lượng</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Tổng</th>
                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="cartList">
                                            </tbody>
                                        </table>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <p>Tổng tiền : </p>
                                                <p>Tiền khách đưa : </p>
                                                <p>Giảm giá : </p>
                                                <p>Thẻ thành viên : </p>
                                                <p>Tiền trả khách : </p>
                                                <p>Giá cuối : </p>
                                            </div>
                                            <div class="col-md-5">
                                                <p id="result_money"> VNĐ</p>
                                                <div class="input-group input-group-outline">
                                                    <input type="text" class="form-control" name="customer_money"
                                                        id="customer_money">
                                                </div>
                                                <div class="input-group input-group-outline">
                                                    <input type="text" class="form-control" name="discount" id="discount">
                                                </div>
                                                <div class="input-group input-group-outline">
                                                    <input type="text" class="form-control" name="customer" id="customer">
                                                </div>
                                                <p id="back_money"> VNĐ</p>
                                                <p id="last_money"> VNĐ</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="input-group input-group-outline mb-3">
                                                    <select name="selectCategory" id="selectCategory"
                                                        class="form-control">
                                                        <option value="0">Chọn Menu</option>
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
                                                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 border cursor-pointer item"
                                                    style="padding-top: 25px" onclick="valueProduct(this)"
                                                    field-id="{{ $item->id }}"
                                                    field-thumbnail="{{ $item->thumbnail }}"
                                                    field-name="{{ $item->name }}" field-price="{{ $item->price }}">
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
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    onclick="showAllProduct()">Close</button>
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
            //select category
            $('#selectCategory').on('change', function(e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;

                if (valueSelected == 0) {
                    $('#showProduct').hide();
                    $('#showProduct').html('');
                    $('#allProduct').show();
                    return;
                }

                if (valueSelected === '' && valueSelected < 1) {
                    $('#showProduct').hide();
                    $('#showProduct').html('');
                    $('#allProduct').show();
                } else {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('tables.liveselectproduct') }}',
                        data: {
                            'selected': valueSelected,
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
            //xóa hết nhưng sản phẩm vừa gọi từ ajax ra,trả về lại all product
            function showAllProduct() {
                $('#allProduct').show();
                $('#showProduct').hide();
                $('#searchproduct').val('');
                $('#selectCategory').val(0);
            }

            //tìm kiếm product
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

            //hiển thị tất cả những table,xóa nhưng table tìm kiếm đi
            function showAllTable() {
                $('#serachtable').val('');
                $('#searchTable').html('');
                $('#checkHide').show();
                $('#checkHide1').show();
            }

            //tìm kiếm table
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

            var cartList = []; //lưu thông tin bàn và thông tin món ăn
            var totalmoney = 0; //tổng tiền
            var table_id = 0; //số bàn

            //chọn bàn
            function chooseTable(name, people_number, id) {
                document.getElementById('getnametable').innerText = name + " , Số lượng : " + people_number + " người";

                //lưu lại số bàn vừa chọn
                table_id = id;
                showCart(); //hiển thị khi ấn chọn table để xem món ăn của bàn nào
            }

            //lấy thông tin món ăn vừa click
            function valueProduct(that) {
                var product_id = $(that).attr('field-id');
                var thumbnail = $(that).attr('field-thumbnail');
                var name = $(that).attr('field-name');
                var price = $(that).attr('field-price');

                var isFind = false;
                for (i = 0; i < cartList.length; i++) {
                    if (cartList[i].table_id == table_id && cartList[i].product_id == product_id) {
                        cartList[i].num++; //lặp qua cartList,nếu tồn tại sản phẩm này rồi thì tăng số lượng lên
                        cartList[i].totalcash = cartList[i].num * cartList[i].price;
                        isFind = true;
                        break;
                    }
                }
                //nếu chưa tìm tháy thì thêm mới(isFind = false)
                if (!isFind) {
                    cartList.push({
                        'table_id': table_id,
                        'product_id': product_id,
                        'thumbnail': thumbnail,
                        'name': name,
                        'price': price,
                        'num': 1,
                        'totalcash': price
                    })
                }
                console.log(cartList);
                showCart(); //gọi hàm để hiển thị khi click
            }

            function showCart() {
                $('#cartList').empty(); //xóa dữ liệu cũ để cập nhật dữ liệu mới

                for (i = 0; i < cartList.length; i++) {
                    //hiển thị đsung sản phẩm của table hiện tại
                    if (cartList[i].table_id == table_id) {
                        //add du lieu tu storage
                        var money = cartList[i].num * cartList[i].price;
                        $('#cartList').append(`<tr>
                                                <td><img src={{ asset('assets/img/products/') }}/${cartList[i].thumbnail} style="width:80px"></td>
                                                <td>${cartList[i].name}</td>
                                                <td>${cartList[i].price}</td>
                                                <td><input type="number" class="form-input" onchange="changeAmount(this,${cartList[i].table_id},${cartList[i].product_id})" value="${cartList[i].num}" style="width:60px"></td>
                                                <td id="total_money">${money}</td>
                                                <td><button class="btn btn-danger" onclick="deleteProduct(${cartList[i].product_id},${cartList[i].table_id})">X</button></td>
                                            </tr>`);
                        totalmoney += money;
                    }
                }

                //lưu vào storage
                localStorage.setItem('cartList', JSON.stringify(cartList));
                $('#result_money').html(totalmoney);

            }

            //xóa món ăn trên bàn nhất định
            function deleteProduct(product_id, table_id) {
                for (i = 0; i < cartList.length; i++) {
                    if (cartList[i].table_id == table_id && cartList[i].product_id == product_id) {
                        cartList.splice(i, 1); //xóa đi 1 phần từ dựa vào table vào product_id
                        break;
                    }
                }

                showCart(); //sau khi xóa gọi đến showCart để update dữ liệu
            }

            //chỉnh sửa số lượng => giá tiền
            function changeAmount(that, table_id, product_id) {
                var currentAmount = $(that).val(); //lấy giá trị hiện tại của số lượng

                if (currentAmount < 1) {
                    $(that).val(1);
                    currentAmount = 1;
                }

                for (i = 0; i < cartList.length; i++) {
                    if (cartList[i].table_id == table_id && cartList[i].product_id == product_id) {
                        cartList[i].num = currentAmount; //nếu đúng table và product thì set num bằng cái amount hiện tại

                        //update tổng tiền trực tiếp không gọi đến showCart
                        money = currentAmount * cartList[i].price;
                        //nếu gọi trực tiếp tới $('#total_money') thì sẽ không biết được update cái nào
                        $(that).parent().parent().find('#total_money').html(money);
                        break;
                    }
                }

                localStorage.setItem('cartList', JSON.stringify(cartList)); //lưu lại num vừa bị thay đổi
            }

            //tiền nhập vào
            // $('#customer_money').keyup(function() {
            //     var customer_money = $(this).val();
            //     var last_money = customer_money - total_money;
            //     $('#customer_money').html(last_money);
            // })

            $(document).ready(function() {
                $('#showProduct').hide(); // ẩn thông tin gọi ajax khi chưa send ajax

                var data = localStorage.getItem('cartList'); //lấy dữ liệu từ storage
                if (data != null && data != '') {
                    cartList = JSON.parse(data);
                    showCart(); //gọi đến hàm hiển thị dữ liệu
                }
            });
        </script>
    @endsection
@endsection
