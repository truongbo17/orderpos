@extends('dashbroad.app')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="d-flex">
                            <div class="p-2 w-90 bd-highlight">
                                <h6 class="text-white text-capitalize ps-3">Thêm nhân viên</h6>
                            </div>
                            <div class="bd-highlight">
                                <button class="btn btn-success"
                                    onclick="window.location.href='{{ route('user.index') }}'">Quay lại</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <form role="form" method="POST" action="{{ route('user.postadd') }}" class="text-start"
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
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible text-white" role="alert"
                                    aria-live="assertive" id="dangerToast" aria-atomic="true">
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
                                <img id="output" class="avatar border-radius-lg w-100 h-auto">
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
                                        name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label class="input-group">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" autocomplete="email">
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label class="input-group">Số điện thoại</label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label class="input-group">Địa chỉ</label>
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" autocomplete="address" autofocus>
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <label class="input-group">Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <select class="form-control" name="type">
                                        <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>Nhân viên</option>
                                        <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Quản lý</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Tạo tài khoản</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
