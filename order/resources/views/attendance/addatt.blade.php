@extends('dashbroad.app')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="d-flex">
                            <div class="p-2 w-90 bd-highlight">
                                <h6 class="text-white text-capitalize ps-3">Chi tiết lịch làm</h6>
                            </div>
                            <div class="bd-highlight">
                                <button class="btn btn-success"
                                    onclick="window.location.href='{{ route('attendance.add') }}'">Quay lại</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <form role="form" method="POST" action="{{ route('attendance.postadd') }}" class="text-start"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible text-white" role="alert"
                                    aria-live="assertive" id="dangerToast" aria-atomic="true">
                                    <span class="text-sm">
                                        {{ session('success') }}
                                    </span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <input type="text" name="schedule_id" value="{{ $schedule->id }}" hidden>
                                <h6>Ca làm ngày : {{ $schedule->datework }} , thời gian :
                                    {{ $schedule->starttime }}h-{{ $schedule->endtime }}h</h6>
                                @if ($attendance != null)
                                    <br>
                                    Đã có :
                                    @foreach ($attendance as $item)
                                        {{ $item->name }},
                                    @endforeach
                                    làm ca này
                                @else
                                    <p>Chưa có ai làm ca này</p>
                                @endif
                                <div class="input-group input-group-outline mb-3">
                                    <label for="user_id" class="input-group">Chọn nhân viên cho ca làm này</label>
                                    <select name="user_id" id="user_id" class="form-control">

                                        @foreach ($userList as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <label for="user_id" class="input-group">Ghi chú</label>
                                    <input id="note" type="text" class="form-control @error('note') is-invalid @enderror"
                                        name="note" value="{{ old('address') }}" autocomplete="note" autofocus required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@section('scriptadd1')
    <script>
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
