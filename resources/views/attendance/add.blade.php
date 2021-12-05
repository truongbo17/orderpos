@extends('dashbroad.app')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="d-flex">
                            <div class="p-2 w-90 bd-highlight">
                                <h6 class="text-white text-capitalize ps-3">Thêm lịch làm</h6>
                            </div>
                            <div class="bd-highlight">
                                <button class="btn btn-success"
                                    onclick="window.location.href='{{ route('attendance.index') }}'">Quay lại</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <h6>Chọn ngày và ca làm để thêm nhân viên</h6>
                            <div class="input-group input-group-outline mb-3">
                                <table class="table align-items-center justify-content-center mb-0" id="myTable"
                                    data-page-length="5">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Ca làm</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Ngày</th>
                                            <th class=""></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($scheduleList as $item)
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $item->starttime }}h -
                                                        {{ $item->endtime }}h</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->datework)->format('d/m/Y') }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('attendance.addatt') }}?id={{ $item->id }}"
                                                        class="text-secondary font-weight-bold text-white text-xs btn btn-warning"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scriptadd1')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order": [[ 1, "asc" ]],
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
