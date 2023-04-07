@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">เมนูระบบ</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">
    <div class="col-lg-12">
        <div class="row">
            <!-- Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">เจ้าหนี้ทั้งหมด</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-users text-secondary"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($creditor) }} ราย</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">หนี้คงค้างทั้งหมด</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-comments-dollar text-secondary"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($crelist,2) }} บาท</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">จำนวนรายการชำระหนี้</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-clipboard-list text-secondary"></i>
                            </div>
                            <div class="ps-3">
                                <h6>
                                    <span class="text-success">
                                        {{ number_format($pay) }}
                                    </span> 
                                    /
                                    <span>
                                        {{ number_format($list) }}
                                    </span> 
                                    รายการ
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">หนี้ที่ชำระแล้ว</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-clipboard-check text-success"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($paid,2) }} บาท</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <div class="row">
            <div class="col-lg-6" style="margin-bottom: 1rem;">
                <div class="card" style="height: 100%;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            <i class="fas fa-chart-line"></i>
                            แผนภูมิแสดงสถิติแยกหนี้ตามปี
                        </h5>
                        <!-- Bar Chart -->
                        <canvas id="yearChart" style="max-height: 400px;"></canvas>
                        <!-- End Bar CHart -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6" style="margin-bottom: 1rem;">
                <div class="card" style="height: 100%;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            <i class="fas fa-chart-line"></i>
                            แผนภูมิแสดงสถิติแยกตามประเภทหนี้
                        </h5>
                        <!-- Bar Chart -->
                        <canvas id="myChart" style="max-height: 400px;"></canvas>
                        <!-- End Bar CHart -->
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-12">
                <div class="card" style="height: 100%;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            <i class="fa-solid fa-comments-dollar"></i>
                            แผนการชำระหนี้
                        </h5>
                        <div class="activity">
                            <div class="activity-item d-flex">
                                <div class="activite-label">1 เม.ย. 2566</div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                    ชำระหนี้ <a href="#" class="badge bg-success text-light">BillNo. XXXX</a>
                                </div>
                            </div>
                            <div class="activity-item d-flex">
                                <div class="activite-label">31 มี.ค. 2566</div>
                                <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                                <div class="activity-content">
                                    ชำระหนี้ <a href="#" class="badge bg-success text-light">BillNo. XXXX</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    const labels = [
        @foreach ($total as $res)
        [ "{{ $res->d_type_name }}"],
        @endforeach
    ];
    const data = {
    labels: labels,
        datasets: [
            {
                label: 'ยอดหนี้คงค้าง',
                data: [
                    @foreach ($total as $res)
                    "{{ $res->total }}",
                    @endforeach
                ],
                backgroundColor: [
                    '#dc3545',
                ],
                borderColor: [
                    '#dc3545',
                ],
            },
            {
                label: 'ยอดหนี้ชำระแล้ว',
                data: [
                    @foreach ($complete as $res)
                    "{{ $res->total }}",
                    @endforeach
                ],
                backgroundColor: [
                    '#198754',
                ],
                borderColor: [
                    '#198754',
                ],
            }
        ]
    };
    const config = {
      type: 'bar',
      data: data,
        options: {
            responsive: true,
            plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'แสดง 5 อันดับหนี้คงค้าง + ชำระแล้ว'
            }
            }
        },
    };

    const labels2 = [
        @foreach ($year as $res)
        [ "พ.ศ. {{ $res->d_year }}"],
        @endforeach
    ];
    const config2 = {
      type: 'bar',
      data: {
        datasets: [{
            label: 'ยอดหนี้/ปี',
            data: [
                @foreach ($year as $res)
                "{{ $res->total }}",
                @endforeach
            ],
            backgroundColor: [
                '#ffc107',
            ],
            borderColor: [
                '#ffc107',
            ],
        }],
        labels: labels2
    },
      options: {}
    };

    $(document).ready(function () {
        Chart.defaults.font.family = 'Prompt';
    });

    const yearChart = new Chart(
        document.getElementById('yearChart'),
        config2
    );

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

</script>
@endsection
