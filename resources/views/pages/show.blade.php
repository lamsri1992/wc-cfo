@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">เมนูระบบ</a></li>
            <li class="breadcrumb-item active">BillNo. {{ $list->d_bill_no }}</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-regular fa-clipboard"></i>
                        BillNo. {{ $list->d_bill_no }}
                    </h5>
                    <form action="{{ route('credit.update',$list->d_id) }}" class="row g-3">
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="d_year" class="form-control" value="{{ $list->d_year }}">
                                <label for="">ปี พ.ศ.</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="d_date_create" class="form-control basicDate" value="{{ $list->d_date_create }}">
                                <label for="">วันที่ลงหนี้</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="d_date_order" class="form-control basicDate" value="{{ $list->d_date_order }}">
                                <label for="">วันที่สั่งซื้อของ</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="d_cost" class="form-control" value="{{ $list->d_cost }}">
                                <label for="">ยอดหนี้ค้างชำระ</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="d_type_id" class="form-select">
                                    @foreach ($type as $res)
                                    <option value="{{ $res->type_id }}" {{ ($list->d_type_id == $res->type_id) ? 'SELECTED' : '' }}>
                                        {{ $res->type_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="">ประเภทหนี้</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="d_creditor_id" class="form-select">
                                    @foreach ($credit as $res)
                                    <option value="{{ $res->cre_id }}" {{ ($list->d_creditor_id == $res->cre_id) ? 'SELECTED' : '' }}>
                                        {{ $res->cre_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="">เจ้าหนี้</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="d_doc_no" class="form-control" value="{{ $list->d_doc_no }}">
                                <label for="">เลขที่หนังสือ</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="d_bill_no" class="form-control" value="{{ $list->d_bill_no }}">
                                <label for="">เลขที่บิล</label>
                            </div>
                        </div>
                        <div class="col-md-12" hidden>
                            <div class="form-floating">
                                <input type="text" name="d_log" class="form-control" value="{{ $list->d_log }}">
                                <label for="">LOG DATA</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span class="badge bg-light text-dark" style="margin-bottom: 0.5rem;">
                                <i class="fa-solid fa-history"></i>
                                LOG DATA
                            </span>
                            @php $log = explode(',',$list->d_log); @endphp
                            <ul class="list-group">
                                @foreach ($log as $logs)
                                <li class="list-group-item">
                                    {{ $logs }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @if ($list->d_status != 3)
                        <div class="">
                            <button type="button" class="btn btn-success"
                                onclick="Swal.fire({
                                    title: 'แก้ไขข้อมูลเจ้าหนี้ ?',
                                    showCancelButton: true,
                                    confirmButtonText: `แก้ไข`,
                                    cancelButtonText: `ยกเลิก`,
                                    icon: 'success',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    } else if (result.isDenied) {
                                        form.reset();
                                    }
                                })">
                                <i class="fa-solid fa-check-circle"></i>
                                แก้ไขข้อมูล
                            </button>
                            <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#paid">
                                <i class="fa-solid fa-comments-dollar"></i>
                                บันทึกการจ่ายหนี้
                            </a>
                        </div>
                        @endif
                        @if ($list->d_status == 3)
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <h4 class="alert-heading fw-bold">
                                        <i class="fa-solid fa-check-circle"></i>
                                        บิลถูกชำระเรียบร้อยแล้ว
                                    </h4>
                                    <p class="mb-0">
                                        <i class="fa-regular fa-calendar-check"></i>
                                        วันที่ชำระ
                                        {{ DateThai($list->d_date_payment) }}
                                    </p>
                                    <p class="mb-0">
                                        <i class="fa-regular fa-note-sticky"></i>
                                        {{ $list->d_note }}
                                    </p>
                                    <hr>
                                    <p class="mb-0">
                                        <a href="{{ asset('img/bill/'.$list->d_bill) }}" target="_blank">
                                            <i class="fa-solid fa-file-pdf text-danger"></i>
                                            ไฟล์เอกสารบิลชำระหนี้ :: {{ $list->d_bill }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="paid" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('credit.payment',$list->d_id) }}" class="row g-3" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('POST') }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-comments-dollar"></i>
                        บันทึกการชำระหนี้
                        <small class="badge bg-primary">
                            [ BillNo. {{ $list->d_bill_no }} ]
                        </small>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 0.5rem;">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="ft_cost" placeholder="ยอดหนี้ค้างชำระ" value="{{ number_format($list->d_cost,2) }}" readonly>
                                <label for="ft_cost">ยอดหนี้ค้างชำระ</label>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 0.5rem;">
                            <div class="form-floating">
                                <input type="text" class="form-control basicDate" id="ft_date" name="ft_date" placeholder="วันที่ชำระหนี้" readonly>
                                <label for="ft_date">วันที่ชำระหนี้</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="ft_note" name="ft_note" placeholder="ระบุหมายเหตุ / Note Taker" style="height: 100px;"></textarea>
                                <label for="ft_note">ระบุหมายเหตุ / Note Taker</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="inputNumber" class="col-sm-2 col-form-label">
                                <i class="fa-solid fa-file-pdf"></i>
                                อัพโหลดบิล
                            </label>
                            <div class="col-sm-12">
                                <input class="form-control" type="file" id="d_bill" name="d_bill">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"
                        onclick="Swal.fire({
                            title: 'ยอดชำระ {{ number_format($list->d_cost,2) }} ฿',
                            text: 'เลขที่บิล : {{ $list->d_bill_no }}',
                            showCancelButton: true,
                            confirmButtonText: `ตกลง`,
                            cancelButtonText: `ยกเลิก`,
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            } else if (result.isDenied) {
                                form.reset();
                            }
                        })">
                        <i class="fa-solid fa-check-circle"></i>
                        ชำระหนี้
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        ปิด
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')

@endsection
