@extends('dashbroad.app')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="d-flex">
                            <div class="p-2 w-90 bd-highlight">
                                <h6 class="text-white text-capitalize ps-3">Chỉnh sửa thông tin nhân viên</h6>
                            </div>
                            @if (Auth::user()->type == 1)
                                <div class="bd-highlight">
                                    <button class="btn btn-success"
                                        onclick="window.location.href='{{ route('user.index') }}'">Quay lại</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body pb-2">
                    @if (Auth::user()->type == 1)
                        <form role="form" method="POST" action="{{ route('user.postedit') }}" class="text-start"
                            enctype="multipart/form-data">
                        @else
                            <form role="form" method="POST" action="{{ route('user.posteditprofile') }}"
                                class="text-start" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <input type="text" name="user_id" value="{{ $userInfo->id }}" hidden>
                    <div class="row">
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

                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible text-white" role="alert" aria-live="assertive"
                                id="dangerToast" aria-atomic="true">
                                <span class="text-sm">
                                    {{ $error }}<br />
                                </span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach
                        <div class="col-md-4">
                            <p>Ảnh đại diện</p>
                            <img id="output" class="avatar border-radius-lg w-100 h-auto"
                                src="{{ asset('assets/img/avatar/' . $userInfo->avatar) }}">
                            <hr />
                            <input type="file" name="thumbnail" accept="image/*" onchange="loadFile(event)"
                                class="form-input">
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
                            <p>Thông tin cá nhân</p>
                            <div class="input-group input-group-outline my-3">
                                <label class="input-group">Họ tên</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $userInfo->name }}" autocomplete="name" autofocus>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="input-group">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $userInfo->email }}" autocomplete="email">
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="input-group">Số điện thoại</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ $userInfo->phone }}" autocomplete="phone" autofocus>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="input-group">Địa chỉ</label>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" value="{{ $userInfo->address }}" autocomplete="address" autofocus>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="input-group">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">
                            </div>
                            @if (Auth::user()->type == 1)
                                <div class="input-group input-group-outline mb-3">
                                    <select class="form-control" name="type">
                                        <option value="2" {{ $userInfo->type == 2 ? 'selected' : '' }}>Nhân viên</option>
                                        <option value="1" {{ $userInfo->type == 1 ? 'selected' : '' }}>Quản lý</option>
                                    </select>
                                </div>
                            @else
                                <input id="type" type="text" name="type" value="{{ Auth::user()->type }}" hidden>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Cập nhật tài
                            khoản</button>
                        @if (Auth::user()->type == 1)
                            @if ($userInfo->status == 2)
                                <button class="btn bg-gradient-info w-100 mb-2"
                                    onclick="statusWorkBack({{ $userInfo->id }})">Cho đi làm lại</button>
                            @else
                                <button class="btn bg-gradient-danger w-100 mb-2"
                                    onclick="statusWorkBack({{ $userInfo->id }})">Cho nhân viên nghỉ
                                    việc</button>
                            @endif
                        @endif
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function statusWorkBack(id) {
            $.post('{{ route('user.workback') }}', {
                '_token': '{{ csrf_token() }}',
                'user_id': id
            }, function(data) {

            })
        }
    </script>
@endsection
