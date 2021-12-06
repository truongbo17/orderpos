@extends('dashbroad.app')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="d-flex">
                            <div class="p-2 w-85 bd-highlight">
                                <h6 class="text-white text-capitalize ps-3">Danh sách khách hàng</h6>
                            </div>
                            <div class="">
                                @if (Auth::user()->type == 1)
                                    <button class="text-secondary font-weight-bold text-white text-xs btn btn-success"
                                        type="button" onclick="removeValueOld()" data-bs-toggle="modal"
                                        data-bs-target="#getProduct1">
                                        Thêm bàn
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
                                        Tên</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Số lượng người</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Trạng thái</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listTable as $item)
                                    <tr>
                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">
                                                {{ $item->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">
                                                {{ $item->people_number }}</p>
                                        </td>
                                        <td class="text-sm text-center">
                                            @if ($item->status == 1)
                                                <span class="badge badge-sm bg-gradient-success">Có khách</span>
                                            @elseif($item->status == 0)
                                                <span class="badge badge-sm bg-gradient-secondary">Trống</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            @if (Auth::user()->type == 1)
                                                <button
                                                    class="text-secondary font-weight-bold text-white text-xs btn btn-warning"
                                                    type="button" onclick="getInfoTable({{ $item->id }})"
                                                    data-bs-toggle="modal" data-bs-target="#getProduct1">
                                                    Sửa
                                                </button>
                                                <button
                                                    class="text-secondary font-weight-bold text-white text-xs btn btn-danger"
                                                    type="button"
                                                    onclick="deleteTable('{{ $item->name }}',{{ $item->id }})"
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
                    {{ $listTable->links() }}
                    <!-- Modal hiển thị bàn-->
                    <div class="modal fade" id="getProduct" tabindex="-1" aria-labelledby="getProduct"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="getnametable"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body px-0 pb-2">
                                        <div class="table-responsive p-3">
                                            <table class="table align-items-center justify-content-center mb-0" id="myTable"
                                                data-page-length="5">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Tên</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Số lượng người</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Trạng thái</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="viewProduct">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end model --}}

                    <!-- Modal thêm,sửa bàn -->
                    <div class="modal fade" id="getProduct1" tabindex="-1" aria-labelledby="getProduct1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="getnametable">Thêm bàn,Chỉnh sửa bàn</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('table.add') }}" method="POST">
                                    @csrf
                                    <input id="table_id" type="text" name="table_id" hidden>
                                    <div class="modal-body">
                                        <div class="card-body px-0 pb-2">
                                            <div class="table-responsive p-3">
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="input-group">Tên bàn</label>
                                                    <input id="name" type="text" class="form-control" name="name"
                                                        autocomplete="name" required>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="input-group">Số lượng người</label>
                                                    <input id="people_number" type="number" class="form-control"
                                                        name="people_number" autocomplete="people_number" required>
                                                </div>
                                                <div class="input-group input-group-outline mb-3">
                                                    <label class="input-group">Chọn trạng thái</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1">Có khách
                                                        </option>
                                                        <option value="0" selected>Trống
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
                                    <h5 class="modal-title">Xóa bàn</h5>
                                </div>
                                <form action="{{ route('table.delete') }}" method="POST">
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
            document.querySelector('[name=table_id]').value = "";
            document.querySelector('[name=name]').value = "";
            document.querySelector('[name=people_number]').value = "";
        }


        function deleteTable(name, id) {
            document.getElementById('getnametabledelete').innerText = name;
            document.getElementById('buttondelete').innerHTML = (
                `<input id="category_id" type="text" value="${id}" name="table_id" hidden>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Xác nhận</button>`
            );
        }

        function getInfoTable(id) {
            var table_id = document.querySelector('[name=table_id]');
            var name = document.querySelector('[name=name]');
            var people_number = document.querySelector('[name=people_number]');
            var status = document.querySelector('[name=status]');
            $.post('{{ route('table.getinfo') }}', {
                '_token': '{{ @csrf_token() }}',
                'table_id': id
            }, function(data) {
                var newData = JSON.parse(data);
                console.log(newData);
                if (newData.status === "success") {
                    name.value = newData.data[0].name;
                    people_number.value = newData.data[0].people_number;
                    status.value = newData.data[0].status;
                    table_id.value = newData.data[0].id;
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
