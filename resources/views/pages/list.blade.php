@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">เมนูระบบ</a></li>
            <li class="breadcrumb-item active">รายการเจ้าหนี้ทั้งหมด</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">
                                <i class="fa-solid fa-clipboard"></i>
                                รายการเจ้าหนี้ทั้งหมด
                            </h5>
                        </div>
                        <div class="col-md-6 text-end" style="margin-top: 0.8rem;">
                            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newDept">
                                <i class="fa-solid fa-circle-plus"></i>
                                เพิ่มเจ้าหนี้ใหม่
                            </a>
                        </div>
                    </div>
                    <table id="all" class="table table-borderless table-hover nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 15%;" class="text-center">ปี พ.ศ.</th>
                                <th style="width: 30%;">เจ้าหนี้</th>
                                <th style="width: 30%;" class="text-center">ประเภทหนี้</th>
                                <th style="width: 20%;" class="text-center">วันที่บันทึก</th>
                                <th class="text-center">Doc:No.</th>
                                <th class="text-center">Bill:No.</th>
                                <th style="width: 15%;" class="text-end">ยอดหนี้</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $res)
                            <tr onclick="location.href='{{ route('credit.show',$res->d_id) }}'">
                                <td class="text-center">{{ $res->d_year }}</td>
                                <td>{{ $res->cre_name }}</td>
                                <td class="text-center">{{ $res->type_name }}</td>
                                <td class="text-center">{{ DateThai($res->d_date_create) }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary" style="width: 100%;">
                                        <i class="fa-regular fa-file"></i>
                                        {{ $res->d_doc_no }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary" style="width: 100%;">
                                        <i class="fa-solid fa-file-invoice"></i>
                                        {{ $res->d_bill_no }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <span class="fw-bold text-danger">
                                        {{ number_format($res->d_cost,2) }} ฿ 
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 15%;"></th>
                                <th style="width: 30%;"></th>
                                <th style="width: 30%;"></th>
                                <th style="width: 20%;"></th>
                                <th></th>
                                <th></th>
                                <th style="width: 15%;"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="newDept" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('credit.add') }}" class="row g-3">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-comments-dollar"></i>
                        บันทึกเจ้าหนี้ค้างชำระหนี้
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 0.5rem;">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="d_year" name="d_year" placeholder="ปี พ.ศ.">
                                <label for="d_year">ปี พ.ศ.</label>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 0.5rem;">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="d_cost" name="d_cost" placeholder="ยอดหนี้ค้างชำระ">
                                <label for="d_cost">ยอดหนี้ค้างชำระ</label>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 0.5rem;">
                            <div class="form-floating">
                                <input type="text" class="form-control basicDate" id="d_date_create" name="d_date_create" placeholder="วันที่ลงหนี้">
                                <label for="d_date_create">วันที่ลงหนี้</label>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 0.5rem;">
                            <div class="form-floating">
                                <input type="text" class="form-control basicDate" id="d_date_order" name="d_date_order" placeholder="วันที่สั่งของ">
                                <label for="d_date_order">วันที่สั่งของ</label>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 0.5rem;">
                            <label for="d_type_id">ประเภทหนี้</label>
                            <select name="d_type_id" class="form-select basic-select2-nm">
                                <option></option>
                                @foreach ($type as $res)
                                <option value="{{ $res->type_id }}">
                                    {{ $res->type_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 0.5rem;">
                            <label for="d_creditor_id">เจ้าหนี้</label>
                            <select name="d_creditor_id" class="form-select basic-select2-nm">
                                <option></option>
                                @foreach ($credit as $res)
                                <option value="{{ $res->cre_id }}">
                                    {{ $res->cre_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 0.5rem;">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="d_doc_no" name="d_doc_no" placeholder="เลขที่หนังสือ">
                                <label for="d_doc_no">เลขที่หนังสือ</label>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 0.5rem;">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="d_bill_no" name="d_bill_no" placeholder="เลขที่บิล">
                                <label for="d_bill_no">เลขที่บิล</label>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 0.5rem;">
                            <div class="form-floating">
                                <textarea class="form-control" id="d_detail" name="d_detail" placeholder="ระบุหมายเหตุ/รายละเอียด" style="height: 100px;"></textarea>
                                <label for="d_detail">หมายเหตุ/รายละเอียด</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"
                        onclick="Swal.fire({
                            title: 'บันทึกเจ้าหนี้ค้างชำระรายใหม่ ?',
                            text: 'กรุณาตรวจสอบข้อมูลก่อนกดบันทึก',
                            showCancelButton: true,
                            confirmButtonText: `บันทึก`,
                            cancelButtonText: `ยกเลิก`,
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            } else if (result.isDenied) {
                                form.reset();
                            }
                        })">
                        <i class="fa-solid fa-plus-circle"></i>
                        เพิ่มเจ้าหนี้ใหม่
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#all').dataTable({  
        lengthMenu: [
            [10, 50, 100, -1],
            [10, 50, 100, "All"]
        ],
            responsive: true,
            oLanguage: {
                oPaginate: {
                    sFirst: '<small>หน้าแรก</small>',
                    sLast: '<small>หน้าสุดท้าย</small>',
                    sNext: '<small>ถัดไป</small>',
                    sPrevious: '<small>กลับ</small>'
                },
                sSearch: '<small><i class="fa fa-search"></i> ค้นหา</small>',
                sInfo: '<small>ทั้งหมด _TOTAL_ รายการ</small>',
                sLengthMenu: '<small>แสดง _MENU_ รายการ</small>',
                sInfoEmpty: '<small>ไม่มีข้อมูล</small>',
                sInfoFiltered: '<small>(ค้นหาจาก _MAX_ รายการ)</small>',
            },
            initComplete: function() {
                this.api().columns([0, 1, 2]).every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value="">แสดงทั้งหมด</option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.cells('', column[0]).render('display').sort().unique().each(function(
                        d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });
});
</script>
@endsection
