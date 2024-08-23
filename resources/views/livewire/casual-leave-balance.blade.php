<div>
    <style>
        .custom-table-wrapper {
            position: relative;
            /* max-height: 100px; */
            overflow-y: auto;
            border-collapse: collapse;
        }

        .custom-table-wrapper .balance-table {
            width: 100%;
            margin: 0 auto;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .custom-table-wrapper th {
            background-color: #ecf5ff;
            padding: 10px;
            color: #778899;
            text-align: center;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            /* Remove left and right borders */
            border-left: none;
            border-right: none;
        }

        .custom-table-wrapper td {
            padding: 10px;
            font-size: 12px;
            text-align: center;
            background-color: #fff;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            /* Remove left and right borders */
            border-left: none;
            border-right: none;
        }

        .custom-table-wrapper thead {
            position: sticky;
            top: 0;
            font-size: 12px;
            z-index: 1;
        }

        .info-container {
            background-color: #ffffe8;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 10px;
            display: flex;
            width: 60%;
            max-width: 100%;
            justify-content: space-around;
            align-items: center;
        }

        .info-item {
            flex: 1;
            text-align: center;
        }

        .info-item:not(:last-child) {
            border-right: 1px solid #e0e0e0;
        }

        .info-value {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .info-title {
            color: #778899;
            font-size: 11px;
        }
    </style>
    <div class="row m-0 px-2 py-1 ">
        @if(session()->has('emp_error'))
        <div class="alert alert-danger">
            {{ session('emp_error') }}
        </div>
        @endif
        <div class="row m-0 p-0">
            <div class="col-7 p-0 m-0 mb-2 ">
                <ol class="breadcrumb d-flex align-items-center ">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('leave-balance') }}">Leave Balance</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Casual Leave</li>
                </ol>
            </div>
            <div class="col-md-5 ">
                <div class="buttons-container d-flex gap-3 justify-content-end mt-2 p-0 ">
                    @if($year==$currentYear)
                    <button class="leaveApply-balance-buttons  py-2 px-4  rounded" onclick="window.location.href='/leave-page'">Apply</button>
                    @endif
                    <select class="dropdown bg-white rounded " wire:change='changeYear($event.target.value)'  wire:model='year'    style="margin-right:5px;">
                        <?php
                        // Get the current year
                        $currentYear = date('Y');
                        // Generate options for current year, previous year, and next year
                        $options = [$currentYear - 2, $currentYear - 1, $currentYear, $currentYear + 1];
                        ?>
                        @foreach($options as $pre_year)
                        <option  value="{{ $pre_year }}">{{ $pre_year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if($Availablebalance == 0)
            <div class="row m-0 p-0">
                <div class="col-md-12" style="max-height: 100px;">
                    <div class="card" style="height: 100%;">
                        <div class="card-body" style="height: 100%;">
                            <h6 class="card-title">Information</h6>
                            @if($year <= $currentYear)
                            <p class="card-text">No information found</p>
                            @else

                            <p class="card-text">HR will add the leaves</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row m-0 p-0">

                <div class="col-12 mt-2 d-flex justify-content-start">
                    <div class="info-container">
                        <div class="info-item px-2">
                            <div class="info-title">Available Balance</div>
                            <div class="info-value">{{ $Availablebalance }}</div>
                        </div>
                        <div class="info-item px-2">
                            <div class="info-title">Opening Balance</div>
                            <div class="info-value">0</div>
                        </div>
                        <div class="info-item px-2">
                            <div class="info-title">Granted</div>

                            <div class="info-value">{{ $employeeLeaveBalances}}</div>

                        </div>
                        <div class="info-item px-2">
                            <div class="info-title">Availed</div>
                            <div class="info-value">{{ $totalSickDays }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="conatiner mt-4 ">
                <div class="row m-0 p-0">
                    <div class=" p-2 bg-white border">
                        <div class="col-md-10">
                            <canvas id="casualLeaveChart" style="background-color: transparent;width:300px;height:200px;">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-0 m-0">
                <div class="col-md-12 mt-4">
                    <div class="custom-table-wrapper bg-white border rounded ">
                        <table class="balance-table table-striped ">
                            <thead class="thead">
                                <tr>
                                    <th style="width:13.66%; padding: 5px 7px;">Transaction Type</th>
                                    <th style="width: 16.66%; padding: 5px 7px;">Posted On</th>
                                    <th style="width: 18.66%; padding: 5px 7px;">From</th>
                                    <th style="width: 18.66%; padding: 5px 7px;">To</th>
                                    <th style="width: 5%; padding: 5px 7px;">Days</th>
                                    <th style="width: 27.36%; padding: 5px 7px;">Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employeeleaveavlid as $index => $balance)
                                <tr>
                                    <td>{{ $balance->status == 'approved' ? 'Availed' : '' }}</td>
                                    <td>{{ date('d M Y', strtotime($balance->created_at)) }}</td>
                                    <td>{{ date('d M Y', strtotime($balance->from_date)) }}</td>
                                    <td>{{ date('d M Y', strtotime($balance->to_date)) }}</td>
                                    <td>{{ $totalSickDays }}</td>
                                    <td>{{ $balance->reason }}</td>
                                </tr>
                                @endforeach
                                @foreach($leaveGrantedData as $index => $balance)
                                <tr>
                                    <td>{{ $balance->status }}</td>
                                    <td>{{ date('d M Y', strtotime($balance->created_at)) }}</td>
                                    <td>{{ date('d M Y', strtotime($balance->from_date)) }}</td>
                                    <td>{{ date('d M Y',strtotime($balance->to_date)) }}</td>
                                    <td>{{ $employeeLeaveBalances }}</td>
                                    <td>Annual Grant for the present year </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<script>
    // Ensure that Chart.js is properly loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Convert PHP variables to JavaScript
        var chartData = @json($chartData);
        var chartOptions = @json($chartOptions);

        // Get the context of the canvas element
        var ctx = document.getElementById('casualLeaveChart').getContext('2d');

        // Create the chart
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: chartOptions
        });

        console.log(chartData);
    });
</script>

<!-- <script>
    var ctx = document.getElementById('sickLeaveChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data:  json_encode($chartData),
        options: json_encode($chartOptions)
    });
    console.log(json_encode($chartData));
</script> -->
