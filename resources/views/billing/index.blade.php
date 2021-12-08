@extends('dashbroad.app')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="d-flex">
                            <div class="p-2 w-85 bd-highlight">
                                <h6 class="text-white text-capitalize ps-3">Danh sách Order</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="card-body px-0 pb-2">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Tên</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Bàn</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Tạm tính</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Giảm giá</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Tiền nhập vào</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Tiền thừa</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder">
                                        Ngày</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listOrder as $item)
                                    <tr>
                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">
                                                {{ $item->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">
                                                {{ $item->table_id }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">
                                                {{ number_format($item->result_money) }} VND</p>
                                        </td>
                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">
                                                {{ $item->discount }}%</p>
                                        </td>
                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">
                                                {{ number_format($item->customer_money) }} VND</p>
                                        </td>
                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">
                                                {{ number_format($item->back_money) }} VND</p>
                                        </td>
                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}</p>
                                        </td>

                                        <td class="align-middle text-center">
                                            <button class="text-secondary font-weight-bold text-white text-xs btn btn-info"
                                                type="button" data-bs-toggle="modal" data-bs-target="#getProduct"
                                                onclick="chooseTable('{{ $item->name }}',{{ $item->id }})">
                                                Xem
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $listOrder->links() }}
                    <!-- Modal -->
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
                                                            Giá</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Số lượng</th>
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

                </div>
            </div>
        </div>
    </div>
@section('scriptadd1')
    <script>
        function chooseTable(name, id) {
            document.getElementById('getnametable').innerText = name;

            $.post('{{ route('billing.viewdetail') }}', {
                '_token': '{{ @csrf_token() }}',
                'order_id': id
            }, function(data) {
                // console.log(data)
                var newData = JSON.parse(data)
                console.log(newData);
                if (newData.status === "success") {
                    document.querySelector("#viewProduct").innerHTML = "";
                    var data = newData.data;
                    var content = ``;
                    data.forEach((element) => {
                        content += `
                                    <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('assets/img/products/') }}/${element.thumbnail}"
                                                    class="avatar avatar-sm me-3 border-radius-lg"
                                                    alt="products">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">${element.name}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            ${element.price}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            ${element.num}</p>
                                    </td>
                                </tr>`;
                        document.querySelector("#viewProduct").innerHTML = content;
                    });
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
