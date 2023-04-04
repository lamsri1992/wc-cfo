@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">เมนูระบบ</a></li>
            <li class="breadcrumb-item active">รายการหนี้ชำระแล้ว</li>
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
                                <i class="fa-solid fa-clipboard-check"></i>
                                รายการหนี้ชำระแล้ว
                            </h5>
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
                                <td>{{ $res->d_creditor_name }}</td>
                                <td class="text-center">{{ $res->d_type_name }}</td>
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
                                    <span class="fw-bold text-success">
                                        {{ number_format($res->d_cost,2) }} ฿ 
                                        <i class="fa-solid fa-check-circle"></i>
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
