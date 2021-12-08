@extends('dashbroad.app')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="d-flex">
                            <div class="p-2 w-85 bd-highlight">
                                <h6 class="text-white text-capitalize ps-3">Danh sách lịch làm</h6>
                            </div>
                            @if (Auth::user()->type == 1)
                                <div class="">
                                    <button class="btn btn-success"
                                        onclick="window.location.href='{{ route('attendance.add') }}'">Thêm
                                        lịch làm</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-3">
                        <div id="msg">

                        </div>
                        <p>Lịch làm hiện tại</p>
                        <table class="table align-items-center justify-content-center mb-0" id="" data-page-length="5">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Trạng thái</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Chức vụ</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ca làm</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ngày</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ghi chú Ca trước</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ghi chú Quản lý</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listAtt as $item)
                                    @if ($item->datework == $currentDate && $item->starttime <= $currentTime && $item->endtime >= $currentTime)
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
                                            <td class="align-middle text-sm">
                                                @if ($item->status == 1)
                                                    <span class="badge badge-sm bg-gradient-success">Đang làm</span>
                                                @elseif($item->status == 0)
                                                    <span class="badge badge-sm bg-gradient-secondary">Chưa làm</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-dark">Nghỉ việc</span>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $item->type == 1 ? 'Quản lý' : 'Nhân viên' }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->starttime }}h -
                                                    {{ $item->endtime }}h</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->datework)->format('d/m/Y') }}
                                                </span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->notesecond }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->notefr }}</p>
                                            </td>
                                            <td class="align-middle">
                                                @if (Auth::user()->type == 1)
                                                    <button class="btn btn-warning"
                                                        onclick="deleteAtt({{ $item->att_id }})">Cho nghỉ</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <p>Lịch làm hôm nay</p>
                        <table class="table align-items-center justify-content-center mb-0" id="" data-page-length="5">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Trạng thái</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Chức vụ</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ca làm</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ngày</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ghi chú Ca trước</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ghi chú Quản lý</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listAtt as $item)
                                    @if ($item->datework == $currentDate)
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
                                            <td class="align-middle text-sm">
                                                @if ($item->status == 1)
                                                    <span class="badge badge-sm bg-gradient-success">Đang làm</span>
                                                @elseif($item->status == 0)
                                                    <span class="badge badge-sm bg-gradient-secondary">Chưa làm</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-dark">Nghỉ việc</span>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $item->type == 1 ? 'Quản lý' : 'Nhân viên' }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->starttime }}h -
                                                    {{ $item->endtime }}h</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->datework)->format('d/m/Y') }}
                                                </span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->notesecond }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->notefr }}</p>
                                            </td>
                                            <td class="align-middle">
                                                @if (Auth::user()->type == 1)
                                                    <button class="btn btn-warning"
                                                        onclick="deleteAtt({{ $item->att_id }})">Cho nghỉ</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <p>Tất cả lịch</p>
                        <table class="table align-items-center justify-content-center mb-0" id="myTable"
                            data-page-length="5">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Trạng thái</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Chức vụ</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ca làm</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ngày</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ghi chú Ca trước</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ghi chú Quản lý</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listAtt as $item)
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
                                        <td class="align-middle text-sm">
                                            @if ($item->status == 1)
                                                <span class="badge badge-sm bg-gradient-success">Đang làm</span>
                                            @elseif($item->status == 0)
                                                <span class="badge badge-sm bg-gradient-secondary">Chưa làm</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-dark">Nghỉ việc</span>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $item->type == 1 ? 'Quản lý' : 'Nhân viên' }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->starttime }}h -
                                                {{ $item->endtime }}h</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->datework)->format('d/m/Y') }}
                                            </span>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->notesecond }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->notefr }}</p>
                                        </td>
                                        <td class="align-middle">
                                            @if (Auth::user()->type == 1)
                                                <button class="btn btn-warning"
                                                    onclick="deleteAtt({{ $item->att_id }})">Cho nghỉ</button>
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
        function deleteAtt(att_id) {
            var r = confirm("Bạn có muốn cho nhân viên này nghỉ làm ca này!");
            if (r != true) {
                return
            }

            $.post('{{ route('attendance.deleteatt') }}', {
                'att_id': att_id,
                '_token': '{{ csrf_token() }}'
            }, function(data) {
                setTimeout(function() {
                    location.reload();
                }, 500);
                $('#msg').append(`<div class="alert alert-success alert-dismissible text-white" role="alert" aria-live="assertive"
                                id="dangerToast" aria-atomic="true">
                                <span class="text-sm">
                                    ${data}
                                </span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`);
            })
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
