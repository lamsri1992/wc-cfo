<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">เมนูระบบ</li>
        <li class="nav-item">
            <a class="nav-link {{ (request()->is('/')) ? '' : 'collapsed' }}"
                href="{{ route('credit.dashboard') }}">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (request()->is('list*')) || (request()->is('report*')) ? '' : 'collapsed' }}" data-bs-target="#list-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-list-check"></i>
                <span>รายการข้อมูลหนี้</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="list-nav" class="nav-content collapse {{ (request()->is('list*')) || (request()->is('report*')) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('credit.all') }}">
                        <i class="bi bi-circle"></i><span>ข้อมูลหนี้ทั้งหมด</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('credit.paid') }}">
                        <i class="bi bi-circle"></i><span>ข้อมูลหนี้ชำระแล้ว</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addNew">
                        <i class="bi bi-circle"></i><span>เขียนรายงานข้อมูลหนี้</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (request()->is('plan')) ? '' : 'collapsed' }}"
                href="#">
                <i class="fa-solid fa-comments-dollar"></i>
                <span>วางแผนชำระหนี้</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (request()->is('process')) ? '' : 'collapsed' }}"
                href="#">
                <i class="fa-solid fa-spinner fa-spin"></i>
                <span>ประมวลผลหนี้</span>
            </a>
        </li>
    </ul>
</aside>
<!-- End Sidebar-->
<div class="modal fade" id="addNew" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form id="report" action="{{ route('credit.report') }}" class="row g-3">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-print"></i>
                        เขียนรายงานข้อมูลหนี้
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4" style="margin-bottom: 0.5rem;">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="s_year" name="s_year" placeholder="ปี พ.ศ.">
                                <label for="s_year">ปี พ.ศ.</label>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 0.5rem;">
                            <div class="form-floating">
                                <input type="text" class="form-control basicDate" id="s_start" name="s_start" placeholder="วันที่">
                                <label for="s_start">วันที่</label>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 0.5rem;">
                            <div class="form-floating">
                                <input type="text" class="form-control basicDate" id="s_end" name="s_end" placeholder="สิ้นสุด">
                                <label for="s_end">สิ้นสุด</label>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 0.5rem;">
                            <label for="s_type">ประเภทหนี้</label>
                            <select name="s_type" class="form-select basic-select2">
                                <option></option>
                                @foreach ($type as $res)
                                <option value="{{ $res->type_id }}">
                                    {{ $res->type_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 0.5rem;">
                            <label for="s_credit">เจ้าหนี้</label>
                            <select name="s_credit" class="form-select basic-select2">
                                <option></option>
                                @foreach ($credit as $res)
                                <option value="{{ $res->cre_id }}">
                                    {{ $res->cre_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 0.5rem;">
                            <label for="s_status">สถานะหนี้</label>
                            <select name="s_status" class="form-select basic-select2">
                                <option></option>
                                @foreach ($dstat as $res)
                                <option value="{{ $res->st_id }}">
                                    {{ $res->st_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"
                        onclick="
                        let s_status = document.forms['report']['s_status'].value;
                        let s_start = document.forms['report']['s_start'].value;
                        let s_end = document.forms['report']['s_end'].value;
                            if (s_status == '' || s_start == '' || s_end == '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'กรุณาระบุข้อมูลสำคัญ',
                                    text: 'ช่วงวันที่ / สถานะข้อมูล',
                                })
                                return false;
                            }else{
                                let timerInterval
                                Swal.fire({
                                title: 'กำลังสร้างรายงาน',
                                timerProgressBar: true,
                                timer: 2000,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        form.submit();
                                    }
                                })
                            }">
                            <i class="fa-solid fa-print"></i>
                            รายงาน
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        ปิด
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
