@extends('dashbroad.app')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="d-flex">
                            <div class="p-2 w-85 bd-highlight">
                                <h6 class="text-white text-capitalize ps-3">Danh sách món ăn</h6>
                            </div>
                            <div class="">
                                @if (Auth::user()->type == 1)
                                    <button class="text-secondary font-weight-bold text-white text-xs btn btn-success"
                                        type="button" data-bs-toggle="modal" onclick="removeValueOld()"
                                        data-bs-target="#getProduct1">
                                        Thêm món ăn mới
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="card-body px-0 pb-2">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible text-white" role="alert" aria-live="assertive"
                                id="dangerToast" aria-atomic="true">
                                <span class="text-sm">
                                    {{ session('success') }}
                                </span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible text-white" role="alert" aria-live="assertive"
                                id="dangerToast" aria-atomic="true">
                                <span class="text-sm">
                                    {{ session('error') }}
                                </span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Tên món</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Người thêm</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Menu</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Price</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Thông tin</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Trạng thái</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listProduct as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('assets/img/products/') . '/' . $item->thumbnail }}"
                                                        class="avatar avatar-sm me-3 border-radius-lg" alt="products">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $item->username }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $item->category_name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ number_format($item->price) }} VND</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $item->description }}</p>
                                        </td>
                                        <td class="text-sm text-center">
                                            @if ($item->status == 1)
                                                <span class="badge badge-sm bg-gradient-success">Hiển thị</span>
                                            @elseif($item->status == 0)
                                                <span class="badge badge-sm bg-gradient-secondary">Bị Ẩn</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            @if (Auth::user()->type == 1)
                                                <button
                                                    class="text-secondary font-weight-bold text-white text-xs btn btn-warning"
                                                    type="button" onclick="getInfoProduct({{ $item->id }})"
                                                    data-bs-toggle="modal" data-bs-target="#getProduct1">
                                                    Sửa
                                                </button>
                                                <button
                                                    class="text-secondary font-weight-bold text-white text-xs btn btn-danger"
                                                    type="button"
                                                    onclick="delelteProduct('{{ $item->name }}',{{ $item->id }})"
                                                    data-bs-toggle="modal" data-bs-target="#getProduct2">
                                                    Xóa
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $listProduct->links() }}
                    <!-- Modal thêm,sửa product -->
                    <div class="modal fade" id="getProduct1" tabindex="-1" aria-labelledby="getProduct1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="getnametable">Thêm món ăn,Chỉnh sửa món ăn</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('product.addproduct') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input id="product_id" type="text" name="product_id" hidden>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>Ảnh đại diện</p>
                                                <img id="output" src="" class="avatar border-radius-lg w-100 h-auto">
                                                <hr />
                                                <input type="file" name="thumbnails" accept="image/*"
                                                    onchange="loadFile(event)" class="form-input">
                                                <!-- view image befor upload -->
                                                <script>
                                                    var loadFile = function(event) {
                                                        var output = document.getElementById('output');
                                                        output.src = URL.createObjectURL(event.target.files[0]);
                                                        output.onload = function() {
                                                            URL.revokeObjectURL(output.src) // free memory
                                                        }
                                                    };
                                                </script>
                                            </div>
                                            <div class="col-md-8">
                                                <p>Thông tin món ăn</p>
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="input-group">Tên món ăn</label>
                                                    <input id="name" type="text" class="form-control" name="name"
                                                        autocomplete="name" required>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="input-group">Chọn Menu</label>
                                                    <select class="form-control" name="category_id">
                                                        @foreach ($listCategory as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="input-group">Giá</label>
                                                    <input id="price" type="number" class="form-control" name="price"
                                                        autocomplete="price" required>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="input-group">Mô tả</label>
                                                    <input id="description" type="text" class="form-control"
                                                        name="description" autocomplete="description" required>
                                                </div>
                                                <div class="input-group input-group-outline mb-3">
                                                    <label class="input-group">Chọn trạng thái</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1" selected>Hiển thị
                                                        </option>
                                                        <option value="0">Bị ẩn
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- end model --}}


                    <!-- Modal xóa -->
                    <div class="modal fade" id="getProduct2" tabindex="-1" aria-labelledby="getProduct2"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Xóa món</h5>
                                </div>
                                <form action="{{ route('product.deleteproduct') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <h6 class="modal-title" id="getnametabledelete"></h6>
                                    </div>
                                    <div class="modal-footer" id="buttondelete">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- end model --}}

                </div>
            </div>
        </div>
    </div>
@section('scriptadd1')
    <script>
        function removeValueOld() {
            document.querySelector('[name=product_id]').value = "";
            document.querySelector('[name=name]').value = "";
            document.querySelector('[name=price]').value = "";
            document.querySelector('[name=description]').value = "";
            document.getElementById("output").src = "";
        }

        function delelteProduct(name, id) {
            document.getElementById('getnametabledelete').innerText = name;
            document.getElementById('buttondelete').innerHTML = (
                `<input id="category_id" type="text" value="${id}" name="product_id" hidden>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Xác nhận</button>`
            );
        }

        function getInfoProduct(id) {
            var product_id = document.querySelector('[name=product_id]');
            var name = document.querySelector('[name=name]');
            var category_id = document.querySelector('[name=category_id]');
            var price = document.querySelector('[name=price]');
            var description = document.querySelector('[name=description]');
            var status = document.querySelector('[name=status]');
            var img = document.getElementById("output");

            $.post('{{ route('product.getinfoproduct') }}', {
                '_token': '{{ @csrf_token() }}',
                'product_id': id
            }, function(data) {
                var newData = JSON.parse(data)
                console.log(newData);
                if (newData.status === "success") {
                    name.value = newData.data[0].name;
                    category_id.value = newData.data[0].category_id;
                    price.value = newData.data[0].price;
                    description.value = newData.data[0].description;
                    status.value = newData.data[0].status;
                    product_id.value = newData.data[0].id;
                    var src = newData.data[0].thumbnail;
                    img.src = "{{ asset('assets/img/products/') }}" + "/" + src;
                }
            })

        }

        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "decimal": "",
                    "emptyTable": "Không có bản ghi nào",
                    "info": "Hiển thị _START_ tới _END_ của _TOTAL_ bản ghi",
                    "infoEmpty": "Hiển thị 0 tới 0 của 0 bản ghi",
                    "infoFiltered": "(Tìm kiếm từ _MAX_ total bản ghi)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Hiển thị _MENU_ bản ghi",
                    "loadingRecords": "Loading...",
                    "processing": "Processing...",
                    "search": "Tìm kiếm:",
                    "zeroRecords": "Không có bản ghi phù hợp",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Pre"
                    },
                    "aria": {
                        "sortAscending": ": Activate to sort column ascending",
                        "sortDescending": ": Activate to sort column descending"
                    }
                }
            });
            $(".dt-buttons").children().attr("class", "btn btn-info");
        });
    </script>
@endsection
@endsection
