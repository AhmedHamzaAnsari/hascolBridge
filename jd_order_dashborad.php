<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

<head>

    <meta charset="utf-8" />
    <title>
        Order |
        <?php echo $_SESSION['user_name']; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="BYCO" name="description" />
    <meta content="P2P" name="author" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- App favicon -->

    <?php include 'css_script.php'; ?>

    <style>
    #dropArea {
        border: 2px dashed #ccc;
        padding: 20px;
        text-align: center;
        position: relative;
    }

    #imageContainer {
        max-width: 100%;
        max-height: 200px;
        display: none;
        position: relative;
    }

    #imagePreview {
        max-width: 100%;
        max-height: 200px;
    }

    #removeButton {
        position: absolute;
        top: 10px;
        right: 10px;
        display: none;
        cursor: pointer;
        color: red;
        font-size: 24px;
    }

    #dropArea2 {
        border: 2px dashed #ccc;
        padding: 20px;
        text-align: center;
        position: relative;
    }

    #imageContainer2 {
        max-width: 100%;
        max-height: 200px;
        display: none;
        position: relative;
    }

    #imagePreview2 {
        max-width: 100%;
        max-height: 200px;
    }

    #removeButton2 {
        position: absolute;
        top: 10px;
        right: 10px;
        display: none;
        cursor: pointer;
        color: red;
        font-size: 24px;
    }
    </style>
</head>


<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <?php include 'header.php'; ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php include 'sidebar.php'; ?>

        <!-- Left Sidebar End -->


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="inputEmail4">From</label>

                            <input type="date" class="form-control" name="fromdate" id="fromdate"
                                value="<?php echo date('Y-m-01') ?>">

                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail4">To</label>

                            <input type="date" class="form-control" name="todate" id="todate"
                                value="<?php echo date('Y-m-30') ?>">

                        </div>
                        <div class="col-md-3">

                            <input type="btn" class="btn btn-primary mt-3" name="btn_get" id="btn_get" value="Get"
                                onclick="fetchtable()">

                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="inputEmail4">Stations</label>

                            <select data-live-search="true" class="form-control selectpicker" id="regions"
                                name="regions" required multiple>
                                <option value="">Select</option>



                            </select>

                        </div>
                        <div class="col-md-3 d-none">
                            <label for="inputEmail4">Province</label>

                            <select data-live-search="true" class="form-control selectpicker" id="province"
                                name="province" required multiple>
                                <option value="">Select</option>



                            </select>

                        </div>
                        <div class="col-md-3 d-none">
                            <label for="inputEmail4">City</label>

                            <select data-live-search="true" class="form-control selectpicker" id="city" name="city"
                                required multiple>
                                <option value="">Select</option>



                            </select>

                        </div>
                        <div class="col-md-3 d-none">
                            <label for="inputEmail4">District</label>

                            <select data-live-search="true" class="form-control selectpicker" id="district"
                                name="district" required multiple>
                                <option value="">Select</option>



                            </select>

                        </div>
                        <div class="col-md-3 d-none">
                            <label for="inputEmail4">RM</label>

                            <select data-live-search="true" class="form-control selectpicker" id="tm_user"
                                name="tm_user" required multiple>
                                <option value="">Select</option>



                            </select>

                        </div>
                        <div class="col-md-3 d-none">
                            <label for="inputEmail4">TM</label>

                            <select data-live-search="true" class="form-control selectpicker" id="asm_users"
                                name="asm_users" required multiple>
                                <option value="">Select</option>



                            </select>

                        </div>



                    </div>

                    <div class="row my-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body" style="height: 600px;">
                                    <div>
                                        <h4>Orders Details</h4>
                                        <div class="d-flex align-items-center">
                                            <!-- <div class="avatar">
                                                <div class="avatar-title rounded bg-primary-subtle ">
                                                    <i class="bx bx-check-shield font-size-24 mb-0 text-primary"></i>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0 font-size-15">Order</h6>
                                            </div> -->

                                            <div class="flex-grow-1 ms-3" style="text-align: right;">

                                                <!-- <h6 onclick="getting_listing('orders_dealers')"
                                                    class="mb-0 font-size-15 " style="cursor: pointer"><small> Stations
                                                        Order</small> : <span id="no_of_dealers_orders">0</span> </h6> -->


                                                <div class="container-fluid">
                                                    <div class="row my-2">
                                                        <div class="col-md-4">
                                                            <div class="flex-shrink-0">
                                                                <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center hover-effect"
                                                                    data-toggle="tooltip" title="Total Orders">
                                                                    <span style="font-size: 10px;">Total Orders :
                                                                    </span> <span id="total_dispatchs">0</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="flex-shrink-0">
                                                                <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center hover-effect"
                                                                    data-toggle="tooltip"
                                                                    title="Dispatch Order Invoices">
                                                                    <span style="font-size: 10px;">Invoices : </span> <span
                                                                        id="jd_dispatchs">0</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="flex-shrink-0">
                                                                <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center hover-effect"
                                                                    data-toggle="tooltip"
                                                                    title="Dispatch Order Invoices Not Dispatched">
                                                                    <span style="font-size: 10px;">Not
                                                                        Dispatched : </span> <span
                                                                        id="jd_not_dispatchs">0</span>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-md-4">
                                                            <div class="flex-shrink-0" style="cursor: pointer;">
                                                                <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center hover-effect"
                                                                    data-toggle="tooltip" title="Shortage Submited"
                                                                    onclick="filterByStatus('Shortage Submitted')">
                                                                    <span style="font-size: 10px;">Shortage Submited:
                                                                    </span> <span id="jd_shortages">0</span>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="flex-shrink-0" style="cursor: pointer;">
                                                                <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center hover-effect"
                                                                    data-toggle="tooltip" title="Shortage Not Submit"
                                                                    onclick="filterByStatus('Shortage Not Submit')">
                                                                    <span style="font-size: 10px;">Shortage Not Submit:
                                                                    </span> <span id="jd_not_shortages">0</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="flex-shrink-0" style="cursor: pointer;">
                                                                <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center hover-effect"
                                                                    data-toggle="tooltip" title="Complete Trips"
                                                                    onclick="filterByStatus('Complete')">
                                                                    <span style="font-size: 10px;">Complete Trips:
                                                                    </span><span id="completed_orders">0</span>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row my-2">


                                                        <div class="col-md-4">
                                                            <div class="flex-shrink-0" style="cursor: pointer;">
                                                                <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center hover-effect"
                                                                    data-toggle="tooltip" title="Start Trips"
                                                                    onclick="filterByStatus('Start')">
                                                                    <span style="font-size: 10px;">Start Trips: </span>
                                                                    <span id="start_orders">0</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="flex-shrink-0" style="cursor: pointer;">
                                                                <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center hover-effect"
                                                                    data-toggle="tooltip" title="Pending Trips"
                                                                    onclick="filterByStatus('Pending')">
                                                                    <span style="font-size: 10px;">Pending Trips:
                                                                    </span> <span id="Pending_orders">0</span>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="flex-shrink-0" style="cursor: pointer;">
                                                                <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center hover-effect"
                                                                    data-toggle="tooltip" title="With-Tracker Trip"
                                                                    onclick="filterByStatus('With-Tracker')">
                                                                    <span style="font-size: 10px;">With-Tracker Trip:
                                                                    </span> <span id="with_tracker_orders">0</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">


                                                        <div class="col-md-4">
                                                            <div class="flex-shrink-0" style="cursor: pointer;">
                                                                <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center hover-effect"
                                                                    data-toggle="tooltip" title="Without-Tracker"
                                                                    onclick="filterByStatus('Without-Tracker')">
                                                                    <span style="font-size: 10px;">Without-Tracker:
                                                                    </span> <span id="without_tracker_orders">0</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="d-flex align-items-start mb-2">


                                                                                <div class="d-flex align-items-center">
                                                                                    <img src="data:image/jpeg;base64,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"
                                                                                        class="rounded-circle avatar img-thumbnail"
                                                                                        alt="">
                                                                                    <div class="flex-grow-1 ms-3 overflow-hidden"
                                                                                        style='text-align:left;'>
                                                                                        <h5
                                                                                            class="font-size-15 mb-1 text-truncate">
                                                                                            No Stations Order :
                                                                                        </h5>

                                                                                    </div>
                                                                                    <div class="flex-shrink-0">
                                                                                        <h5
                                                                                            class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                                                                            <span
                                                                                                id="no_of_dealers_orders">0</span>
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                            <div class="mx-n4 simplebar-scrollable-y"
                                                                                data-simplebar="init"
                                                                                style="max-height: 260px;">
                                                                                <div class="simplebar-wrapper"
                                                                                    style="margin: 0px;">
                                                                                    <div
                                                                                        class="simplebar-height-auto-observer-wrapper">
                                                                                        <div
                                                                                            class="simplebar-height-auto-observer">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="simplebar-mask">
                                                                                        <div class="simplebar-offset"
                                                                                            style="right: 0px; bottom: 0px;">
                                                                                            <div class="simplebar-content-wrapper"
                                                                                                tabindex="0"
                                                                                                role="region"
                                                                                                aria-label="scrollable content"
                                                                                                style="height: auto; overflow: hidden scroll;">
                                                                                                <div class="simplebar-content"
                                                                                                    style="padding: 0px;">
                                                                                                    <div class="border-bottom loyal-customers-box pt-2"
                                                                                                        id='list_dealers_no'>

                                                                                                    </div>






                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="simplebar-placeholder"
                                                                                        style="width: 277px; height: 432px;">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="simplebar-track simplebar-horizontal"
                                                                                    style="visibility: hidden;">
                                                                                    <div class="simplebar-scrollbar"
                                                                                        style="width: 0px; display: none;">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="simplebar-track simplebar-vertical"
                                                                                    style="visibility: visible;">
                                                                                    <div class="simplebar-scrollbar"
                                                                                        style="height: 410px; transform: translate3d(0px, 0px, 0px); display: block;">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>

                                            <h4 class="mt-4 pt-1 mb-0 font-size-22" id="dealers_count">0</h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body" style="height: 600px;">
                                    <canvas id="myPolarChart" style="width:600px;margin:auto;"></canvas>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-none">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar">
                                                <div class="avatar-title rounded bg-primary-subtle ">
                                                    <i class="bx bx-check-shield font-size-24 mb-0 text-primary"></i>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0 font-size-15">Visits Task</h6>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0 font-size-15"><small> Pending </small>: <span
                                                        id="Pending_tasks">0</span> </h6>
                                                <h6 class="mb-0 font-size-15"><small> Complete</small> : <span
                                                        id="completed_tasks">0</span> </h6>

                                            </div>


                                        </div>

                                        <div>
                                            <h4 class="mt-4 pt-1 mb-0 font-size-22" id="task_count">0</h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-none">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar">
                                                <div class="avatar-title rounded bg-primary-subtle ">
                                                    <i class="bx bx-check-shield font-size-24 mb-0 text-primary"></i>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0 font-size-15">RM</h6>
                                            </div>
                                            <div class="flex-grow-1 ms-3" onclick="getting_listing('TM')">
                                                <svg style="float: right;" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-more-vertical">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="5" r="1"></circle>
                                                    <circle cx="12" cy="19" r="1"></circle>
                                                </svg>
                                            </div>


                                        </div>

                                        <div>
                                            <h4 class="mt-4 pt-1 mb-0 font-size-22" id="rm_counts">0</h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-none">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar">
                                                <div class="avatar-title rounded bg-primary-subtle ">
                                                    <i class="bx bx-check-shield font-size-24 mb-0 text-primary"></i>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0 font-size-15">TM</h6>
                                            </div>
                                            <div class="flex-grow-1 ms-3" onclick="getting_listing('ASM')">
                                                <svg style="float: right;" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-more-vertical">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="5" r="1"></circle>
                                                    <circle cx="12" cy="19" r="1"></circle>
                                                </svg>
                                            </div>


                                        </div>

                                        <div>
                                            <h4 class="mt-4 pt-1 mb-0 font-size-22" id="tm_counts">0</h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row d-none">
                        <div class="col-md-6 d-none">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="region_chart"></canvas>

                                </div>
                            </div>


                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="lineChart"></canvas>

                                </div>
                            </div>


                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="city_chart"></canvas>

                                </div>
                            </div>


                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="terr_chart"></canvas>

                                </div>
                            </div>


                        </div>
                        <div class="col-md-6 d-none">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="rm_chart"></canvas>

                                </div>
                            </div>


                        </div>

                        <div class="col-md-6 d-none">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="tm_chart"></canvas>

                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="row d-none">

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body" style="height: 350px;">
                                    <strong>Task</strong>
                                    <canvas id="task_users"></canvas>

                                </div>
                            </div>


                        </div>
                        <div class="col-md-6 ">
                            <div class="card">
                                <div class="card-body" style="height: 350px;">
                                    <strong>Task Status</strong>
                                    <canvas id="task_status"></canvas>

                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="card">

                        <div class="card-body" style="overflow: auto;">
                            <div id="loader" style="display: none;text-align: center;">Loading Data...</div>
                            <h3>JD Sales Invoiced</h3>
                            <table id="myTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">S.No</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Site Name</th>
                                        <th class="text-center">TM Name</th>
                                        <th class="text-center">Depot</th>
                                        <th class="text-center">Vehicle</th>
                                        <th class="text-center">Tracker Status</th>
                                        <th class="text-center">Product</th>
                                        <th class="text-center">Order #</th>
                                        <th class="text-center">Invoice #</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Rate</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Order Status</th>
                                        <th class="text-center">Driver Sign</th>
                                        <th class="text-center">Shortage</th>
                                        <th class="text-center">Distance</th>
                                        <th class="text-center">Active Time</th>
                                        <th class="text-center">ETA</th>
                                        <th class="text-center">Close Time</th>
                                        <th class="text-center">Shortage</th>
                                        <!-- <th class="text-center">Track</th> -->

                                        <!-- <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="row d-none">
                        <div class="container-fluid">

                            <div class="card">
                                <div class="card-body">
                                    <h3>Task</h3>

                                    <table id="task_table" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>User</th>
                                                <th>Site Name</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Description</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <div id="listing_users" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                data-bs-scroll="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" id="myModalLabel">Create Permit Type</h5> -->
                            <h5 class="modal-title" id="myModalLabel">
                                <h5 id="labelc"></h5>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid user_lists" id="tm_div">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>RM List</h4>

                                        <div class="card">
                                            <div class="card-body">


                                                <div class="mx-n4 simplebar-scrollable-y" data-simplebar="init"
                                                    style="max-height: 421px;">
                                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                                        <div class="simplebar-height-auto-observer-wrapper">
                                                            <div class="simplebar-height-auto-observer"></div>
                                                        </div>
                                                        <div class="simplebar-mask">
                                                            <div class="simplebar-offset"
                                                                style="right: 0px; bottom: 0px;">
                                                                <div class="simplebar-content-wrapper" tabindex="0"
                                                                    role="region" aria-label="scrollable content"
                                                                    style="height: auto; overflow: hidden scroll;">
                                                                    <div class="simplebar-content"
                                                                        style="padding: 0px;">
                                                                        <div class="border-bottom loyal-customers-box pt-2"
                                                                            id='apend_rm_users'>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="simplebar-placeholder"
                                                            style="width: 325px; height: 432px;"></div>
                                                    </div>
                                                    <div class="simplebar-track simplebar-horizontal"
                                                        style="visibility: hidden;">
                                                        <div class="simplebar-scrollbar"
                                                            style="width: 0px; display: none;"></div>
                                                    </div>
                                                    <div class="simplebar-track simplebar-vertical"
                                                        style="visibility: visible;">
                                                        <div class="simplebar-scrollbar"
                                                            style="height: 410px; transform: translate3d(0px, 0px, 0px); display: block;">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid user_lists" id="asm_div">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>TM List</h4>
                                        <div class="card">
                                            <div class="card-body">


                                                <div class="mx-n4 simplebar-scrollable-y" data-simplebar="init"
                                                    style="max-height: 421px;">
                                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                                        <div class="simplebar-height-auto-observer-wrapper">
                                                            <div class="simplebar-height-auto-observer"></div>
                                                        </div>
                                                        <div class="simplebar-mask">
                                                            <div class="simplebar-offset"
                                                                style="right: 0px; bottom: 0px;">
                                                                <div class="simplebar-content-wrapper" tabindex="0"
                                                                    role="region" aria-label="scrollable content"
                                                                    style="height: auto; overflow: hidden scroll;">
                                                                    <div class="simplebar-content"
                                                                        style="padding: 0px;">
                                                                        <div class="border-bottom loyal-customers-box pt-2"
                                                                            id='apend_tm_users'>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="simplebar-placeholder"
                                                            style="width: 325px; height: 432px;"></div>
                                                    </div>
                                                    <div class="simplebar-track simplebar-horizontal"
                                                        style="visibility: hidden;">
                                                        <div class="simplebar-scrollbar"
                                                            style="width: 0px; display: none;"></div>
                                                    </div>
                                                    <div class="simplebar-track simplebar-vertical"
                                                        style="visibility: visible;">
                                                        <div class="simplebar-scrollbar"
                                                            style="height: 410px; transform: translate3d(0px, 0px, 0px); display: block;">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid user_lists" id="dealers_orders_list">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Stations Orders</h4>
                                        <div class="card">
                                            <div class="card-body">




                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <?php include 'footer.php'; ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->


    <!-- Right Sidebar -->

    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- chat offcanvas -->
    <div id="products_price_backlog_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
        aria-hidden="true" data-bs-scroll="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="myModalLabel">Create Permit Type</h5> -->
                    <h5 class="modal-title" id="myModalLabel">
                        <h5 id="labelc">Order Detail</h5>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-nowrap table-hover mb-1" id="product_price_backlog">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>S #</th>
                                                <th>Site Name</th>
                                                <th>JD Code</th>
                                                <th>Material</th>
                                                <th>Order #</th>
                                                <th>Invoice #</th>
                                                <th>Qty</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                                <th>Driver Sign</th>
                                                <th>Shortage</th>
                                                <th>Status</th>
                                                <th>Distance</th>
                                                <th>Active Time</th>
                                                <th>ETA</th>
                                                <th>Close Time</th>
                                                <th>Shortage</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <!-- JAVASCRIPT -->

    <?php include 'script_tags.php'; ?>
    <script src="js_cdn/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
    var table;
    var type;
    var subtype;
    var dealers_data = "";
    var task_data = "";
    $(document).ready(function() {
        $('.multi_select').select2();
        $('.selectpicker').select2();
        $(function() {
            $('[data-toggle="tooltip"]').tooltip(); // Activate the tooltip
        });


        product_price_backlog = $('#product_price_backlog').DataTable({
            dom: 'Bfrtip',


            buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

        });


        table = $('#myTable').DataTable({
            dom: 'Bfrtip',


            buttons: ['copy', 'excel', 'csv', 'pdf', 'print']


        });
        task_table = $('#task_table').DataTable({
            dom: 'Bfrtip',


            buttons: ['copy', 'excel', 'csv', 'pdf', 'print']


        });



        // Event listener for dropdown changes
        $('.selectpicker').on('change', function() {
            filterTable();
        });

        fetchtable();
        multi_select();
        // facility_select();

        $('#add_btn').click(function() {

            $('#row_id').val("");
            $('#depots').val([]).trigger('change');


            document.getElementById("imagePreview2").src = ""
            document.getElementById("imagePreview").src = ""

            $('#insert_form')[0].reset();
            get_zm_tm(0);
            get_tm_asm(0)
            // alert("running")

        });



    })


    // Example of adding search functionality

    function filterByStatus(value) {
        // var searchText = $('#searchInput').val();
        table.search(value).draw();
        $('html, body').animate({
            scrollTop: $("#myTable").offset().top
        }, 1000);
    }

    async function fetchSubtripData(order_no) {
        try {
            const response = await fetch(
                `<?php echo $api_url; ?>get/puma_sap_order/get_sap_order_subtripdata.php?key=03201232927&id=${order_no}`
            );
            return await response.json();
        } catch (error) {
            console.error('Error fetching subtrip data:', error);
            return []; // Return an empty array in case of error
        }
    }

    function getDistinctOrderCount(data) {
        // Create a Set to store distinct order_no values
        var distinctOrders = new Set();

        // Iterate through the data array
        $.each(data, function(index, item) {
            if (item.order_no) {
                distinctOrders.add(item.order_no); // Add order_no to the Set
            }
        });

        return distinctOrders.size; // Return the count of distinct order_no
    }

    async function fetchtable() {
        blocking();
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        $('#loader').show(); // Show loader while data is being fetched

        // Fetch request options
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };

        try {
            // Fetch orders data
            const response = await fetch(
                `<?php echo $api_url; ?>get/get_all_jd_dispatches.php?key=03201232927&pre=<?php echo $_SESSION['privilege'] ?>&user_id=<?php echo $_SESSION['user_id'] ?>&from=${fromdate}&to=${todate}`,
                requestOptions);
            const data = await response.json();
            dealers_data = data;
            // Hide the loader
            $('#loader').hide();
            $('#dealers_count').html(data.length);

            // Initialize counters
            let startCount_order = 0,
                pendingCount_order = 0,
                completeCount_order = 0;
            let dispatch_counts = 0,
                jd_order_dispatch = 0,
                jd_order_not_dispatch = 0;
            let total_shortages_submit = 0,
                not_shortages_submit = 0;
            let with_tracker_trips = 0,
                without_tracker_trips = 0;

            // Clear the table before adding new rows
            table.clear().draw();

            var distinctCount = new Set(data
                    .filter(item => item.order_no !== '---') // Filter out '---'
                    .map(item => item.order_no)) // Map to order_no
                .size;
            $('#total_dispatchs').text(data.length);
            $('#jd_dispatchs').text(distinctCount);

            // Process each record from the response
            for (const [index, item] of data.entries()) {
                // Track whether the order is invoiced or not

                // Check if dispatches are present
                if (item.sub_id != null) {
                    // dispatch_counts += parseFloat(item.dispatches);
                    jd_order_dispatch++;
                } else {
                    jd_order_not_dispatch++;
                }

                if (item.is_shortage === 'Shortage Submitted') {
                    total_shortages_submit++;
                } else if (item.is_shortage === 'Shortage Not Submit') {
                    not_shortages_submit++;
                }


                let sign = item.sign ?
                    `<a href="http://151.106.17.246:8080/hascolBridge_files/uploads/${item.sign}" target="_blank">View Sign</a>` :
                    '---';
                let quantity_less_L = '---';

                // Parse product JSON if available
                if (item.product_json) {
                    try {
                        let parsedData = JSON.parse(item.product_json);
                        if (Array.isArray(parsedData) && parsedData.length > 0) {
                            quantity_less_L = parsedData[0].quantity_less_L || '---';
                        }
                    } catch (error) {
                        console.error('JSON parse error:', error.message);
                    }
                }

                if (item.current_status === "Complete") {
                    completeCount_order++;
                } else if (item.current_status === "Start") {
                    startCount_order++;
                } else if (item.current_status === "Pending") {
                    pendingCount_order++;
                }

                if (item.tracker_status === "With-Tracker") {
                    with_tracker_trips++;
                } else {
                    without_tracker_trips++;
                }

                // Fetch item data
                // const subtripData = await fetchSubtripData(item.order_no);

                // Add the main order data row to the DataTable
                table.row.add([
                    index + 1,
                    item.order_time || '---', // Date
                    item.name || '---', // Site Name
                    item.usersnames || '---', // TM Name
                    item.sp_desc || '---', // Depot
                    item.vehicle_name || '---', // Product
                    item.tracker_status || '---', // Product
                    item.product_name || '---', // Product
                    item.order_no || '---', // Invoice #
                    item.invoice || '---', // Invoice #
                    item.quantity || '---', // Qty
                    item.product_rate || '---', // Rate
                    (item.total_dispatched_amount !== '---') ?
                    parseFloat(item.total_dispatched_amount).toLocaleString() : '---', // Amount
                    item.current_status || '---', // Order Status
                    sign, // Driver Sign
                    quantity_less_L, // Shortage
                    item.distance || '---', // Distance
                    item.start_time || '---', // Active Time
                    item.eta || '---', // ETA
                    item.close_time || '---', // Close Time
                    item.is_shortage || '---' // Shortage
                ]).draw(false);


            }

            // Distinct dealer/user data processing
            let distinctNamesCount = new Set(data.map(item => item.name)).size;
            let distinctUsersOrderCount = {};

            data.forEach(item => {
                if (!distinctUsersOrderCount[item.name]) {
                    distinctUsersOrderCount[item.name] = {
                        username: item.name,
                        orderCount: 0
                    };
                }
                distinctUsersOrderCount[item.name].orderCount++;
            });

            // Display distinct dealers data
            $('#list_dealers_no').empty();
            $.each(distinctUsersOrderCount, function(key, value) {

                var d_list = `<div class="d-flex align-items-center" onclick="filterByStatus('${value.username}')" style="cursor: pointer;">
                    <div class="flex-grow-1 ms-3 overflow-hidden" style="text-align:left;">
                        <h5 class="font-size-15 mb-1 text-truncate">
                            ${value.username}
                        </h5>
                    </div>
                    <div class="flex-shrink-0">
                        <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                            ${value.orderCount}
                        </h5>
                    </div>
                </div>`;

                $('#list_dealers_no').append(d_list);
            });

            // Update the summary counters
            $('#no_of_dealers_orders').text(distinctNamesCount);
            // setTimeout(() => {
            $('#Pending_orders').text(pendingCount_order);
            $('#completed_orders').text(completeCount_order);
            $('#start_orders').text(startCount_order);
            $('#with_tracker_orders').text(with_tracker_trips);
            $('#without_tracker_orders').text(without_tracker_trips);
            $.unblockUI();
            // }, 10000);

            $('#jd_not_dispatchs').text(jd_order_not_dispatch);
            $('#jd_shortages').text(total_shortages_submit);
            $('#jd_not_shortages').text(not_shortages_submit);

            var polr_data = [parseInt(data.length), parseInt(distinctCount), parseInt(jd_order_not_dispatch),
                parseInt(total_shortages_submit), parseInt(not_shortages_submit), parseInt(completeCount_order)
            ]; // Adjust these values as needed
            set_polar(polr_data);

            // Process charts based on response data


        } catch (error) {
            console.error('Error fetching main data:', error);
            $('#loader').hide(); // Hide loader on error
        }

        // console.log('<?php echo $api_url; ?>get/get_region_district_dealers.php?key=03201232927')
        $.ajax({
            url: '<?php echo $api_url; ?>get/get_region_district_dealers.php?key=03201232927&pre=<?php echo $_SESSION['privilege'] ?>&user_id=<?php echo $_SESSION['user_id'] ?>&from=" +fromdate + "&to=" + todate + "',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var district = JSON.parse(data[0]['district']);

                var city = JSON.parse(data[0]['city']);
                var province = JSON.parse(data[0]['province']);
                var region = JSON.parse(data[0]['region']);
                var tm = JSON.parse(data[0]['tm']);
                var asm = JSON.parse(data[0]['asm']);
                var dealers_list = JSON.parse(data[0]['dealers']);


                console.log('regions')
                console.log(region)

                $('#rm_counts').text(tm.length);
                $('#tm_counts').text(asm.length);


                console.log(district)

                $('#district').empty();
                $('#district').append($('<option>', {
                    value: '',
                    text: 'Select District'
                }));
                $.each(district, function(index, item) {

                    $('#district').append($('<option>', {
                        value: item.district,
                        text: item.district
                    }));
                });


                $('#city').empty();
                $('#city').append($('<option>', {
                    value: '',
                    text: 'Select City'
                }));
                $.each(city, function(index, item) {

                    $('#city').append($('<option>', {
                        value: item.city,
                        text: item.city
                    }));
                });

                $('#province').empty();
                $('#province').append($('<option>', {
                    value: '',
                    text: 'Select'
                }));
                $.each(province, function(index, item) {

                    $('#province').append($('<option>', {
                        value: item.province,
                        text: item.province
                    }));
                });

                $('#regions').empty();
                $('#regions').append($('<option>', {
                    value: '',
                    text: 'Select'
                }));
                $.each(dealers_list, function(index, item) {

                    $('#regions').append($('<option>', {
                        value: item.name,
                        text: item.name
                    }));
                });

                $('#tm_user').empty();
                $('#tm_user').append($('<option>', {
                    value: '',
                    text: 'Select'
                }));
                $.each(tm, function(index, item) {

                    $('#tm_user').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));

                    var htmlContent = '<div class="d-flex align-items-center">';
                    htmlContent += '<div class="flex-grow-1 ms-3 overflow-hidden">';
                    htmlContent += '<h5 class="font-size-15 mb-1 text-truncate">' + item.name +
                        '</h5>';
                    htmlContent += '</div>';
                    htmlContent += '<div class="flex-shrink-0">';
                    htmlContent +=
                        '<h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">';
                    htmlContent +=
                        '<a href="tm_dashboard.php?id=' + item.id +
                        '" target="_blank" rel="noopener noreferrer"><i class="fas fa-file-import font-size-14 text-primary ms-1"></i></a> ';
                    htmlContent += '</h5>';
                    htmlContent += '</div>';
                    htmlContent += '</div>';

                    // Append the HTML content to the container
                    $('#apend_rm_users').append(htmlContent);
                });
                $('#asm_users').empty();
                $('#asm_users').append($('<option>', {
                    value: '',
                    text: 'Select'
                }));
                $.each(asm, function(index, item) {

                    $('#asm_users').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));

                    var htmlContent = '<div class="d-flex align-items-center">';
                    htmlContent += '<div class="flex-grow-1 ms-3 overflow-hidden">';
                    htmlContent += '<h5 class="font-size-15 mb-1 text-truncate">' + item.name +
                        '</h5>';
                    htmlContent += '</div>';
                    htmlContent += '<div class="flex-shrink-0">';
                    htmlContent +=
                        '<h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">';
                    htmlContent +=
                        '<a href="asm_dashboard.php?id=' + item.id +
                        '" target="_blank" rel="noopener noreferrer"><i class="fas fa-file-import font-size-14 text-primary ms-1"></i></a> ';
                    htmlContent += '</h5>';
                    htmlContent += '</div>';
                    htmlContent += '</div>';

                    // Append the HTML content to the container
                    $('#apend_tm_users').append(htmlContent);
                });



                // Refresh the Select2 element to display the newly added options
                // $('#zm').trigger('change.select2');
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });


    }

    function update_pass(id) {
        // alert(id)
        $('#dealer_row_id').val(id);
        $('#edit_password_modal').modal('show');
    }

    function multi_select() {
        $.ajax({
            url: '<?php echo $api_url; ?>get/depotes.php?key=03201232927',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Iterate through the data and append options to the select element
                $.each(data, function(index, item) {

                    $('#depots').append($('<option>', {
                        value: item.id,
                        text: item.consignee_name
                    }));
                });

                // Refresh the Select2 element to display the newly added options
                $('#mySelect').trigger('change.select2');
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });

        $.ajax({
            url: '<?php echo $api_url; ?>get/get_zm.php?key=03201232927',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Iterate through the data and append options to the select element
                $('#zm').append($('<option>', {
                    value: '',
                    text: 'Select GRM'
                }));
                $.each(data, function(index, item) {

                    $('#zm').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));
                });

                // Refresh the Select2 element to display the newly added options
                $('#zm').trigger('change.select2');
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });

        $.ajax({
            url: '<?php echo $api_url; ?>get/get_zm.php?key=03201232927',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Iterate through the data and append options to the select element
                $('#products1').append($('<option>', {
                    value: '',
                    text: 'Select Nozel'
                }));
                $.each(data, function(index, item) {

                    $('#products1').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));
                });

                // Refresh the Select2 element to display the newly added options
                $('#products1').trigger('change.select2');
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function get_zm_tm(id) {
        // alert(id)
        $.ajax({
            url: '<?php echo $api_url; ?>get/individual_tm_of_zm.php?key=03201232927&zm_id=' + id + '',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data)
                // Iterate through the data and append options to the select element
                $('#tm').empty();
                $('#tm').append($('<option>', {
                    value: '',
                    text: 'Select RM'
                }));
                $.each(data, function(index, item) {

                    $('#tm').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));
                });

                // Refresh the Select2 element to display the newly added options
                // $('#zm').trigger('change.select2');
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function get_tm_asm(id) {
        // alert(id)
        $.ajax({
            url: '<?php echo $api_url; ?>get/individual_asm_of_tm.php?key=03201232927&tm_id=' + id + '',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                // Iterate through the data and append options to the select element
                $('#asm').empty();
                $('#asm').append($('<option>', {
                    value: '',
                    text: 'Select TM'
                }));
                $.each(data, function(index, item) {

                    $('#asm').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));
                });

                // Refresh the Select2 element to display the newly added options
                // $('#zm').trigger('change.select2');
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }


    function facility_select() {
        $.ajax({
            url: '<?php echo $api_url; ?>get/facilities_get.php?key=03201232927',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Iterate through the data and append options to the select element
                $.each(data, function(index, item) {
                    $('#facility').append($('<option>', {
                        value: item.id,
                        text: item.facilities
                    }));
                });

                // Refresh the Select2 element to display the newly added options
                $('#facility').trigger('change.select2');
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }
    </script>

    <script>
    function filterTable() {
        // Get selected values from dropdowns
        var selectedCity = $('#city').val();
        var selectedProvince = $('#province').val();
        var regions = $('#regions').val();
        var terri = $('#district').val();
        var rm_counts = $('#tm_user').val();
        var tm_counts = $('#asm_users').val();
        // Get other selected values similarly



        var filteredData = dealers_data.filter(function(item) {
            // return selectedCity.includes(item.city);
            return (
                (selectedCity.length === 0 || selectedCity.includes(item.city)) &&
                (selectedProvince.length === 0 || selectedProvince.includes(item.province)) &&
                (regions.length === 0 || regions.includes(item.name)) &&
                (terri.length === 0 || terri.includes(item.district)) &&
                (rm_counts.length === 0 || rm_counts.includes(item.tm)) &&
                (tm_counts.length === 0 || tm_counts.includes(item.asm))
            );
        });
        var distinctTmCount = [...new Set(filteredData.map(dealer => dealer.tm))].length;

        // Calculate count of distinct 'sap_no' values
        var distinctASMCount = [...new Set(filteredData.map(dealer => dealer.asm))].length;
        $('#rm_counts').text(distinctTmCount);
        $('#tm_counts').text(distinctASMCount);

        // Output the results
        // console.log('Distinct TM Count:', distinctTmCount);
        // console.log('Distinct ASM No Count:', distinctASMCount);

        // console.log(filteredData)
        table.clear().draw();
        let startCount_order = 0,
            pendingCount_order = 0,
            completeCount_order = 0;
        let dispatch_counts = 0,
            jd_order_dispatch = 0,
            jd_order_not_dispatch = 0;
        let total_shortages_submit = 0,
            not_shortages_submit = 0;
        let with_tracker_trips = 0,
            without_tracker_trips = 0;

        var distinctCount = new Set(filteredData
                .filter(item => item.order_no !== null) // Filter out '---'
                .map(item => item.order_no)) // Map to order_no
            .size;
        $('#dealers_count').html(filteredData.length);

        $('#total_dispatchs').text(filteredData.length);
        $('#jd_dispatchs').text(distinctCount);

        for (const [index, item] of filteredData.entries()) {
            // Track whether the order is invoiced or not

            // Check if dispatches are present
            if (item.sub_id != null) {
                // dispatch_counts += parseFloat(item.dispatches);
                jd_order_dispatch++;
            } else {
                jd_order_not_dispatch++;
            }

            if (item.is_shortage === 'Shortage Submitted') {
                total_shortages_submit++;
            } else if (item.is_shortage === 'Shortage Not Submit') {
                not_shortages_submit++;
            }


            let sign = item.sign ?
                `<a href="http://151.106.17.246:8080/hascolBridge_files/uploads/${item.sign}" target="_blank">View Sign</a>` :
                '---';
            let quantity_less_L = '---';

            // Parse product JSON if available
            if (item.product_json) {
                try {
                    let parsedData = JSON.parse(item.product_json);
                    if (Array.isArray(parsedData) && parsedData.length > 0) {
                        quantity_less_L = parsedData[0].quantity_less_L || '---';
                    }
                } catch (error) {
                    console.error('JSON parse error:', error.message);
                }
            }

            if (item.current_status === "Complete") {
                completeCount_order++;
            } else if (item.current_status === "Start") {
                startCount_order++;
            } else if (item.current_status === "Pending") {
                pendingCount_order++;
            }

            if (item.tracker_status === "With-Tracker") {
                with_tracker_trips++;
            } else if (item.tracker_status === "Without-Tracker") {
                without_tracker_trips++;
            }

            // Fetch item data
            // const subtripData = await fetchSubtripData(item.order_no);

            // Add the main order data row to the DataTable
            table.row.add([
                index + 1,
                item.order_time || '---', // Date
                item.name || '---', // Site Name
                item.usersnames || '---', // TM Name
                item.sp_desc || '---', // Depot
                item.vehicle_name || '---', // Product
                item.tracker_status || '---', // Product
                item.product_name || '---', // Product
                item.order_no || '---', // Invoice #
                item.invoice || '---', // Invoice #
                item.quantity || '---', // Qty
                item.product_rate || '---', // Rate
                (item.total_dispatched_amount !== '---') ?
                parseFloat(item.total_dispatched_amount).toLocaleString() : '---', // Amount
                item.current_status || '---', // Order Status
                sign, // Driver Sign
                quantity_less_L, // Shortage
                item.distance || '---', // Distance
                item.start_time || '---', // Active Time
                item.eta || '---', // ETA
                item.close_time || '---', // Close Time
                item.is_shortage || '---' // Shortage
            ]).draw(false);


        }

        // Distinct dealer/user data processing
        let distinctNamesCount = new Set(filteredData.map(item => item.name)).size;
        let distinctUsersOrderCount = {};

        filteredData.forEach(item => {
            if (!distinctUsersOrderCount[item.name]) {
                distinctUsersOrderCount[item.name] = {
                    username: item.name,
                    orderCount: 0
                };
            }
            distinctUsersOrderCount[item.name].orderCount++;
        });

        // Display distinct dealers data
        $('#list_dealers_no').empty();
        $.each(distinctUsersOrderCount, function(key, value) {

            var d_list = `<div class="d-flex align-items-center" onclick="filterByStatus('${value.username}')" style="cursor: pointer;">
    <div class="flex-grow-1 ms-3 overflow-hidden" style="text-align:left;">
        <h5 class="font-size-15 mb-1 text-truncate">
            ${value.username}
        </h5>
    </div>
    <div class="flex-shrink-0">
        <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
            ${value.orderCount}
        </h5>
    </div>
</div>`;

            $('#list_dealers_no').append(d_list);
        });

        // Update the summary counters
        $('#no_of_dealers_orders').text(distinctNamesCount);
        // setTimeout(() => {
        $('#Pending_orders').text(pendingCount_order);
        $('#completed_orders').text(completeCount_order);
        $('#start_orders').text(startCount_order);
        $('#with_tracker_orders').text(with_tracker_trips);
        $('#without_tracker_orders').text(without_tracker_trips);
        $.unblockUI();
        // }, 10000);

        $('#jd_not_dispatchs').text(jd_order_not_dispatch);
        $('#jd_shortages').text(total_shortages_submit);
        $('#jd_not_shortages').text(not_shortages_submit);

        // Process charts based on response data

        var polr_data = [parseInt(filteredData.length), parseInt(distinctCount), parseInt(jd_order_not_dispatch),
            parseInt(total_shortages_submit), parseInt(not_shortages_submit), parseInt(completeCount_order)
        ]; // Adjust these values as needed
        set_polar(polr_data);



    }




    function line_charts(id, label, data, name) {
        var apexData = {
            labels: label,
            datasets: [{
                label: name,
                data: data,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true
            }]
        };
        var ctx = document.getElementById('' + id + '').getContext('2d');
        var existingChart = Chart.getChart(ctx);
        if (existingChart) {
            existingChart.destroy();
        }
        // Get the canvas element

        // Create the line chart
        var lineChart = new Chart(ctx, {
            type: 'bar',
            data: apexData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'category',
                        labels: apexData.labels
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    // stacked_chart(1)



    function chart_datas(response, id, value, name) {
        var provinceCount = {};
        console.log(value)
        // Loop through the dealers data
        $.each(response, function(index, dealer) {
            if (value == 'region') {
                var province = dealer.region;

            } else if (value == 'province') {
                var province = dealer.province;

            } else if (value == 'city') {
                var province = dealer.city;

            } else if (value == 'district') {
                var province = dealer.district;

            } else if (value == 'tm') {
                var province = dealer.tm_name;

            } else if (value == 'asm') {
                var province = dealer.asm_name;

            }

            // Check if the province is already in the count, if not, initialize it to 1, otherwise increment
            provinceCount[province] = (provinceCount[province] || 0) + 1;
        });

        console.log(provinceCount);
        var provincesArray = Object.keys(provinceCount);
        var countsArray = Object.values(provinceCount);
        console.log(provincesArray);
        console.log(countsArray);

        line_charts(id, provincesArray, countsArray, name)
    }

    function task_datas(response, id, value, name) {
        var provinceCount = {};
        console.log(response)
        // Loop through the dealers data
        $.each(response, function(index, dealer) {
            if (value == 'region') {
                var province = dealer.region;

            } else if (value == 'province') {
                var province = dealer.province;

            } else if (value == 'city') {
                var province = dealer.city;

            } else if (value == 'district') {
                var province = dealer.district;

            } else if (value == 'tm') {
                var province = dealer.tm_name;

            } else if (value == 'asm') {
                var province = dealer.asm_name;

            } else if (value == 'user_name') {
                var province = dealer.user_name;

            } else if (value == 'current_status') {
                var province = dealer.current_status;

            }

            // Check if the province is already in the count, if not, initialize it to 1, otherwise increment
            provinceCount[province] = (provinceCount[province] || 0) + 1;
        });

        var pendingCount = 0;
        var completeCount = 0;

        // Loop through the array and count Pending and Complete records
        $.each(response, function(index, record) {
            if (record.current_status === 'Pending') {
                pendingCount++;
            } else if (record.current_status === 'Complete') {
                completeCount++;
            }
        });

        $('#Pending_tasks').text(pendingCount);
        $('#completed_tasks').text(completeCount);

        console.log(provinceCount);
        var provincesArray = Object.keys(provinceCount);
        var countsArray = Object.values(provinceCount);
        console.log(provincesArray);
        console.log(countsArray);

        user_task(id, provincesArray, countsArray, name)
    }
    // user_task();

    function user_task(id, leb, ser, name) {


        var data = {
            labels: leb,
            datasets: [{
                label: name,
                data: ser,
                backgroundColor: ['rgba(255, 99, 132, 0.7)', 'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 205, 86, 0.7)'
                ],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(75, 192, 192, 1)', 'rgba(255, 205, 86, 1)'],
                borderWidth: 1
            }]
        };

        // Get the canvas element
        var ctx = document.getElementById('' + id + '').getContext('2d');
        var existingChart = Chart.getChart(ctx);
        if (existingChart) {
            existingChart.destroy();
        }
        // Create the donut chart
        var donutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 50, // Adjust the cutoutPercentage to create a donut
                legend: {
                    position: 'bottom'
                }
            }
        });
    };

    function getting_listing(user) {
        $('.user_lists').addClass('d-none')
        if (user == 'TM') {
            $('#tm_div').removeClass('d-none')

        } else if (user == 'ASM') {
            $('#asm_div').removeClass('d-none')

        } else if (user == 'orders_dealers') {
            $('#dealers_orders_list').removeClass('d-none')

        }
        $('#listing_users').modal('show');
    }

    function view_order(id, order_no) {
        if (id !== "") {
            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };

            console.log("<?php echo $api_url; ?>get/puma_sap_order/get_sap_order_subtripdata.php?key=03201232927&id=" +
                order_no);

            fetch("<?php echo $api_url; ?>get/puma_sap_order/get_sap_order_subtripdata.php?key=03201232927&id=" +
                    order_no, requestOptions)
                .then(response => response.json())
                .then(response => {
                    console.log(response);
                    if (response.length > 0) {
                        product_price_backlog.clear().draw(); // Clear the DataTable

                        response.forEach((data, index) => {
                            let sign = '---'; // Default value for sign
                            let quantity_less_L = '---'; // Default value for quantity_less_L

                            if (data.sign !== "") {
                                sign =
                                    `<a href="http://151.106.17.246:8080/hascolBridge_files/uploads/${data.sign}" target="_blank">View Sign</a>`;
                            }
                            console.log(data.product_json)
                            if (data.product_json) { // Check if `shortage_json` exists in the response
                                try {
                                    let parsedData = JSON.parse(data.product_json);

                                    // Check if the parsed data is an array and has at least one element
                                    if (Array.isArray(parsedData) && parsedData.length > 0) {
                                        // Access the first element and get the value of quantity_less_L
                                        quantity_less_L = parsedData[0].quantity_less_L || '---';
                                    }
                                } catch (error) {
                                    console.error('JSON parse error:', error.message);
                                    quantity_less_L = '---'; // Handle JSON parse error
                                }
                            }

                            // Add data to the DataTable
                            product_price_backlog.row.add([
                                index + 1,
                                data.name,
                                data.dealer_sap,
                                data.product_name,
                                data.order_no,
                                data.invoice,
                                data.quantity,
                                data.product_rate,
                                (data.quantity * data.product_rate),
                                sign,
                                quantity_less_L,
                                data.current_status,
                                data.distance,
                                data.start_time,
                                data.eta,
                                data.close_time,
                                data.is_shortage
                            ]).draw(false);
                        });
                    }
                    $('#products_price_backlog_modal').modal('show');
                })
                .catch(error => console.log('Error:', error));
        }
    }


    // Variable to hold the chart instance
    let myPolarChart;

    // Function to set up the Polar Chart
    function set_polar(data_array) {
        // Define the labels for the Polar Chart
        const labels = [
            'Total Orders',
            'Dispatch Order Invoices',
            'Dispatch Order Invoices Not Dispatched',
            'Shortage Submitted',
            'Shortage Not Submitted',
            'Complete Trips'
        ];

        // Check if data_array length matches labels length
        if (data_array.length !== labels.length) {
            console.error("Data array length does not match labels length.");
            return; // Exit the function if the lengths don't match
        }

        // Polar Chart data
        var data = {
            labels: labels,
            datasets: [{
                label: 'Orders Data',
                data: data_array,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Polar Chart configuration
        var config = {
            type: 'polarArea',
            data: data,
            options: {
                responsive: true,
                scales: {
                    r: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Destroy the previous chart if it exists
        if (myPolarChart) {
            myPolarChart.destroy();
        }

        // Create the Polar Chart
        myPolarChart = new Chart($('#myPolarChart'), config);
    }

    // Example usage




    function blocking() {
        $.blockUI({
            message: '<h1>Please Wait...</h1>',
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });
    }
    </script>
</body>


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

</html>