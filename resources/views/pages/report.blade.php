@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">เมนูระบบ</a></li>
            <li class="breadcrumb-item active">รายงานข้อมูลหนี้</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-title">
                                <i class="fa-solid fa-clipboard"></i>
                                รายงานข้อมูลหนี้
                            </h5>
                        </div>
                    </div>
                    <table id="tableReport" class="table table-borderless table-striped nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">ปี พ.ศ.</th>
                                <th>เจ้าหนี้</th>
                                <th>ประเภทหนี้</th>
                                <th class="text-center">วันที่บันทึก</th>
                                <th class="text-center">วันที่สั่งซื้อของ</th>
                                <th class="text-center">เลขที่หนังสือ</th>
                                <th class="text-center">เลขที่บิล</th>
                                <th>ยอดหนี้</th>
                                <th class="text-center">สถานะชำระ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $res)
                            <tr>
                                <td class="text-center">{{ $res->d_year }}</td>
                                <td style="width: 30%;">{{ $res->cre_name }}</td>
                                <td style="width: 20%;">{{ $res->type_name }}</td>
                                <td style="width: 15%;" class="text-center">{{ DateThai($res->d_date_create) }}</td>
                                <td style="width: 15%;" class="text-center">{{ DateThai($res->d_date_order) }}</td>
                                <td class="text-center">{{ $res->d_doc_no }}</td>
                                <td class="text-center">{{ $res->d_bill_no }}</td>
                                <td class="text-end"><span class="fw-bold">{{ number_format($res->d_cost,2) }}</span></td>
                                <td class="text-center"><span class="{{ $res->st_color }}">{{ $res->st_name }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')

@endsection
