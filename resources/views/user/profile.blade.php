@extends('dashbroad.app')

@section('main')
    <div class="row">
        <div class="card card-body mx-3 mx-md-4">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ asset('assets/img/avatar/' . Auth::user()->avatar) }}" alt="profile_image"
                            class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ Auth::user()->name }}
                        </h5>
                        <p class="mb-0 font-weight-normal text-sm">
                            {{ Auth::user()->type == 1 ? 'Quản lý' : 'Nhân viên' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="container-flud">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-0">Lịch làm hôm nay</h6>
                        <table class="table align-items-center justify-content-center mb-0" id="" data-page-length="5">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tên</th>
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
                                                        <p class="text-xs text-secondary mb-0">{{ $item->phone }}
                                                        </p>
                                                    </div>
                                                </div>
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
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->notesecond }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->notefr }}</p>
                                            </td>
                                            <td class="align-middle">
                                                {{-- <a href="{{ route('user.edit') }}?user_id={{ $item->id }}"
                                            class="text-secondary font-weight-bold text-white text-xs btn btn-warning"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a> --}}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <div class="card card-plain h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h6 class="mb-0">Thông tin cá nhân</h6>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <a href="{{ route('user.profileedit') }}">
                                            <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Sửa thông tin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <p class="text-sm">
                                    Hãy nấu như nấu cho người mình thương yêu nhất - nhà hàng TRUONGBO.
                                </p>
                                <hr class="horizontal gray-light my-4">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Họ
                                            tên:</strong> &nbsp; {{ Auth::user()->name }}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                            class="text-dark">SĐT:</strong> &nbsp; {{ Auth::user()->phone }}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                            class="text-dark">Email:</strong>
                                        &nbsp; {{ Auth::user()->email }}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Địa
                                            chỉ:</strong> &nbsp; {{ Auth::user()->address }}</li>
                                    <li class="list-group-item border-0 ps-0 pb-0">
                                        <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                        <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0"
                                            href="http://facebook.com/truonghocgioii">
                                            <i class="fab fa-facebook fa-lg"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
