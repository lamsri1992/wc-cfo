@extends('layouts.app')
@section('content')

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Health Station - API </h5>
                    <!-- Default Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">H::Code</th>
                                <th scope="col">หน่วยบริการ</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Time</th>
                                <th scope="col" class="text-center">Start Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">23736</td>
                                <td>รพช.วัดจันทร์ฯ</td>
                                <td class="text-center">
                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-circle-check"></i> Online
                                    </span>
                                </td>
                                <td class="text-center">xx วัน</td>
                                <td class="text-center">2566-01-01</td>
                            </tr>
                            <tr>
                                <td class="text-center">00000</td>
                                <td>รพ.สต.แม่ตะละ</td>
                                <td class="text-center">
                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-circle-check"></i> Online
                                    </span>
                                </td>
                                <td class="text-center">xx วัน</td>
                                <td class="text-center">2566-01-01</td>
                            </tr>
                            <tr>
                                <td class="text-center">00000</td>
                                <td>รพ.สต.แม่แดด</td>
                                <td class="text-center">
                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-circle-check"></i> Online
                                    </span>
                                </td>
                                <td class="text-center">xx วัน</td>
                                <td class="text-center">2566-01-01</td>
                            </tr>
                            <tr>
                                <td class="text-center">00000</td>
                                <td>รพ.สต.ห้วยบง</td>
                                <td class="text-center">
                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-circle-check"></i> Online
                                    </span>
                                </td>
                                <td class="text-center">xx วัน</td>
                                <td class="text-center">2566-06-11</td>
                            </tr>
                            <tr>
                                <td class="text-center">00000</td>
                                <td>รพ.สต.แม่ละอูป</td>
                                <td class="text-center">
                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-circle-check"></i> Online
                                    </span>
                                </td>
                                <td class="text-center">xx วัน</td>
                                <td class="text-center">2566-01-01</td>
                            </tr>
                            <tr>
                                <td class="text-center">00000</td>
                                <td>สสช.ขุนแม่รวม</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        Offline
                                    </span>
                                </td>
                                <td class="text-center">xx วัน</td>
                                <td class="text-center">2566-01-01</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')

@endsection
