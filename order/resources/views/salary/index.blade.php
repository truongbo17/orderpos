@extends('dashbroad.app')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="d-flex">
                            <div class="p-2 w-85 bd-highlight">
                                <h6 class="text-white text-capitalize ps-3">Danh sách lương</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="msg"></div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center justify-content-center mb-0">
                            @if (Auth::user()->type == 1)
                                <p>Tạm tính lương nhân viên</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tên
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Chức vụ</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Ngày đi làm</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tổng giờ làm</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Lương/1 giờ(Đơn vị Nghìn</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Thưởng</th>
                                            <th class="text-secondary opacity-7"></th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listUser as $item)
                                            <tr id="deleteSalary{{ $item->id }}">
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('assets/img/avatar/' . $item->avatar) }}"
                                                                class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $item->phone }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $item->type == 1 ? 'Quản lý' : 'Nhân viên' }}</p>
                                                </td>
                                                <td class="text-xs text-center font-weight-bold mb-0">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                                    </span>
                                                </td>
                                                <td class="text-xs text-center font-weight-bold mb-0"
                                                    id="worktime{{ $item->id }}">
                                                    {{ $item->sumworktime * 4 }}</td>
                                                <td class="text-xs text-center font-weight-bold mb-0">
                                                    <input type="number" name="wage" id="wage{{ $item->id }}"
                                                        onchange="checkWage({{ $item->id }},this.value)"
                                                        style="width:80px" required>
                                                </td>
                                                <td class="text-xs text-center font-weight-bold mb-0">
                                                    <input type="number"
                                                        onchange="checkBonus({{ $item->id }},this.value)" name="bonus"
                                                        id="bonus{{ $item->id }}" value="0" style="width:80px"
                                                        required>
                                                </td>
                                                <td class="text-xs text-center font-weight-bold mb-0">
                                                    <button onclick="checkSalary({{ $item->id }})"
                                                        class="text-secondary font-weight-bold text-white text-xs btn btn-warning">
                                                        Tính
                                                    </button>
                                                </td>
                                                <td class="text-xs text-center font-weight-bold mb-0">
                                                    <input type="number" name="total" style="width:100px"
                                                        id="total{{ $item->id }}" disabled>
                                                </td>
                                                <td class="text-xs text-center font-weight-bold mb-0">
                                                    <button onclick="submitSalary({{ $item->id }})"
                                                        class="text-secondary font-weight-bold text-white text-xs btn btn-success">
                                                        Xác nhận
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-3">
                    <hr>
                    <p>Bảng lương nhân viên</p>
                    <div id="msg1"></div>
                    <table class="table align-items-center justify-content-center mb-0" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Chức vụ</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Ngày đi làm</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tổng giờ làm</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Lương/1 giờ(Đơn vị Nghìn</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Thưởng</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tổng tiền</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Trạng thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Thời gian</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody id="newSalary">
                            @foreach ($listSalary as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('assets/img/avatar/' . $item->avatar) }}"
                                                    class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $item->phone }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $item->type == 1 ? 'Quản lý' : 'Nhân viên' }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="text-xs text-center font-weight-bold mb-0">
                                        {{ $item->worktime }}</td>
                                    <td class="text-xs text-center font-weight-bold mb-0">
                                        {{ $item->wage }}</td>
                                    <td class="text-xs text-center font-weight-bold mb-0">
                                        {{ $item->bonus }}</td>
                                    <td class="text-xs text-center font-weight-bold mb-0">
                                        {{ number_format($item->total) }} VNĐ</td>
                                    <td class="text-xs text-center font-weight-bold mb-0"
                                        id="statuspay{{ $item->id }}">
                                        @if ($item->status == 1)
                                            <span class="badge badge-sm bg-gradient-success">Đã thanh toán</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-danger">Chưa thanh toán</span>
                                        @endif
                                    <td class="text-xs text-center font-weight-bold mb-0">
                                        {{ date('d/m/Y', strtotime($item->updated_at)) }}</td>
                                    <td class="text-xs text-center font-weight-bold mb-0"
                                        id="buttonpay{{ $item->id }}">
                                        @if (Auth::user()->type == 1)
                                            @if ($item->status == 1)
                                            @else
                                                <button onclick="submitpaySalary({{ $item->id }})"
                                                    class="text-secondary font-weight-bold text-white text-xs btn btn-success">
                                                    Thanh toán
                                                </button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

@section('scriptadd1')
    <script>
        function checkSalary(id) {
            var worktime = parseInt($('#worktime' + id).text());
            // alert(worktime);
            var wage = $('#wage' + id).val();
            var bonus = $('#bonus' + id).val();
            if (wage == '' || bonus == '') {
                $('#msg').append(`<div class="alert alert-danger alert-dismissible text-white" role="alert" aria-live="assertive"
                                id="dangerToast" aria-atomic="true">
                                <span class="text-sm">
                                    Vui lòng nhập đầy đủ thông tin
                                </span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`);
            } else {
                wage = parseInt(wage);
                bonus = parseInt(bonus);
                $('#total' + id).val(worktime * wage * 1000 + bonus * 1000);
            }
        }

        function checkWage(id, wage) {
            if (parseInt(wage) < 0) {
                $('#wage' + id).val(0);
            }
        }

        function checkBonus(id, wage) {
            if (parseInt(wage) < 0) {
                $('#bonus' + id).val(0);
            }
        }

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [day, month, year].join('/');
        }

        function submitSalary(id) {
            var total = $('#total' + id).val();
            if (total == '') {
                $('#msg').append(`<div class="alert alert-danger alert-dismissible text-white" role="alert" aria-live="assertive"
                                id="dangerToast" aria-atomic="true">
                                <span class="text-sm">
                                    Vui lòng tính tổng tiền lương để tiếp tục
                                </span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`);
            } else {
                var worktime = parseInt($('#worktime' + id).text());
                var wage = parseInt($('#wage' + id).val());
                var bonus = parseInt($('#bonus' + id).val());
                total = parseInt(total);
                var user_id = id;

                $.post('{{ route('salary.submitsalary') }}', {
                        '_token': '{{ @csrf_token() }}',
                        'user_id': user_id,
                        'worktime': worktime,
                        'wage': wage,
                        'bonus': bonus,
                        'total': total,
                    },
                    function(data) {
                        var newData = JSON.parse(data)
                        // console.log(newData);

                        if (newData.status === "success") {

                            var removeSalary = document.querySelector("#deleteSalary" + id);
                            removeSalary.parentElement.removeChild(removeSalary);

                            $('#msg').append(`<div class="alert alert-success alert-dismissible text-white" role="alert" aria-live="assertive"
                                id="dangerToast" aria-atomic="true">
                                <span class="text-sm">
                                    Tính lương nhân viên thành công
                                </span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`);

                            var created_at1 = newData.data[0].usercreated_at;
                            created_at = formatDate(created_at1);
                            var updated_at1 = newData.data[0].updated_at;
                            updated_at = formatDate(updated_at1);

                            $('#newSalary').append(`<tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('assets/img/avatar/') }}/${newData.data[0].avatar}"
                                                        class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">${newData.data[0].name}</h6>
                                                    <p class="text-xs text-secondary mb-0">${newData.data[0].phone}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                ${newData.data[0].type ? 'Quản lý' : 'Nhân viên'}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">${created_at}
                                            </span>
                                        </td>
                                        <td class="text-xs text-center font-weight-bold mb-0">
                                            ${newData.data[0].worktime}</td>
                                        <td class="text-xs text-center font-weight-bold mb-0">
                                            ${newData.data[0].wage}</td>
                                        <td class="text-xs text-center font-weight-bold mb-0">
                                            ${newData.data[0].bonus}</td>
                                        <td class="text-xs text-center font-weight-bold mb-0">
                                            ${newData.data[0].total} VNĐ</td>
                                        <td class="text-xs text-center font-weight-bold mb-0" id="statuspay${newData.data[0].id}">
                                                <span class="badge badge-sm bg-gradient-danger">Chưa thanh toán</span>
                                        <td class="text-xs text-center font-weight-bold mb-0">
                                            ${updated_at}
                                        <td class="text-xs text-center font-weight-bold mb-0" id="buttonpay${newData.data[0].id}">
                                            @if (Auth::user()->type == 1)
                                                <button onclick="submitpaySalary(${newData.data[0].id})"
                                                    class="text-secondary font-weight-bold text-white text-xs btn btn-success">
                                                    Thanh toán
                                                </button>
                                            @endif
                                        </td>
                                    </tr>`);
                        }
                    });
            }
        }

        function submitpaySalary(id) {
            $.post('{{ route('salary.submitpaysalary') }}', {
                    '_token': '{{ @csrf_token() }}',
                    'id': id
                },
                function(data) {
                    if (data === "success") {
                        $('#msg1').append(`<div class="alert alert-success alert-dismissible text-white" role="alert" aria-live="assertive"
                                id="dangerToast" aria-atomic="true">
                                <span class="text-sm">
                                    Thanh toán lương thành công
                                </span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`);
                        $('#statuspay' + id).html(
                            "<span class='badge badge-sm bg-gradient-success'>Đã thanh toán</span>");
                        $('#buttonpay' + id).html("");
                    }
                });
        }

        $(document).ready(function() {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'print'
                ],
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
