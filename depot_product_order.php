<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

<head>

    <meta charset="utf-8" />
    <title>
        Product Inventory Order |
        <?php echo $_SESSION['user_name']; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- App favicon -->

    <?php include 'css_script.php'; ?>


</head>
<style>
    .password-container {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .password-input {
        padding-right: 30px;
        /* Space for the show/hide button */
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>


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
        <?php include 'right_siebar.php'; ?>

        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-6">
                            <button class="btn btn-soft-primary waves-effect waves-light" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" id="add_btn"
                                aria-controls="offcanvasRight"><i
                                    class="bx bxs-add-to-queue font-size-16 align-middle me-2 cursor-pointer"></i>Add</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3>Product Inventory Order</h3>

                            <table id="myTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">S.No</th>
                                        <th class="text-center">Depot Name</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">created Time</th>
                                        <th class="text-center">Backlog</th>
                                        <th class="text-center">order receiving</th>
                                        <th class="text-center">View receiving</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'footer.php'; ?>
            <div id="order_backlog_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                aria-hidden="true" data-bs-scroll="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" id="myModalLabel">Create Permit Type</h5> -->
                            <h5 class="modal-title" id="myModalLabel">
                                <h5 id="labelc">Backlog</h5>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="timeline">
                                            <div class="timeline-container">
                                                <div class="timeline-end">
                                                    <p>Start</p>
                                                </div>
                                                <div class="timeline-continue" id='order_logs'>




                                                </div>
                                                <div class="timeline-start">
                                                    <p>End</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div>
        <div id="view_products_price_backlog_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
            aria-hidden="true" data-bs-scroll="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title" id="myModalLabel">Create Permit Type</h5> -->
                        <h5 class="modal-title" id="myModalLabel">
                            <h5 id="labelc">View Order Receiving</h5>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-hover mb-1"
                                            id="view_product_price_backlog">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th class="text-center">S.No</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Depots</th>
                                                    <th class="text-center">Product</th>
                                                    <th class="text-center">Qty</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">


                                    <div class="container-fluid" id="view_survey-container">


                                    </div>







                                </div>
                            </div>
                        </div>

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
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
                                                    <th class="text-center">S.No</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Depots</th>
                                                    <th class="text-center">Product</th>
                                                    <th class="text-center">Qty</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" id="insert_form_receiving" enctype="multipart/form-data">


                                        <div class="form-row mb-4">


                                            <div class="container-fluid" id="survey-container">


                                            </div>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-4">

                                                        <input type="hidden" name="order_main_id" id="order_main_id">
                                                    </div>

                                                </div>

                                            </div>




                                            <div class="col-12">
                                                <input type="hidden" name="row_id" id="row_id">

                                                <input type="hidden" name="user_id" id="user_id"
                                                    value="<?php echo $_SESSION['user_id'] ?>">


                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-10 col-form-label"></label>
                                                    <div class="col-md-12 text-center">

                                                        <input class="btn rounded-pill btn-primary" type="submit"
                                                            name="insert" id="insert" value="Save">
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
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
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasRightLabel">Order</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid">
                <form method="post" id="insert_form" enctype="multipart/form-data">


                    <div class="form-row mb-4">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Depot</label>
                            <select id="allo_depot" name="allo_depot" class="form-control selectpicker" required>


                            </select>
                        </div>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputEmail4">Product</label>
                                    <select name="products[]" class="form-select" id="depot_all_product1" required>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4">Qty</label>
                                    <input type="number" class="form-control" name="product_qtyS[]" id="product_qty1"
                                        value="0" required>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputEmail4">Product</label>
                                    <select name="products[]" class="form-select" id="depot_all_product2" required>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4">Qty</label>
                                    <input type="number" class="form-control" name="product_qtyS[]" id="product_qty2"
                                        value="0" required>

                                </div>
                            </div>
                        </div>




                        <div class="col-12">
                            <input type="hidden" name="row_id" id="row_id">

                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id'] ?>">


                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-10 col-form-label"></label>
                                <div class="col-md-12 text-center">

                                    <input class="btn rounded-pill btn-primary" type="submit" name="insert" id="insert"
                                        value="Save">
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->

    <?php include 'script_tags.php'; ?>

    <script>
        var table;
        var type;
        var subtype;
        load_all_select();
        $(document).ready(function () {
            product_price_backlog = $('#product_price_backlog').DataTable({
                dom: 'Bfrtip',


                buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

            });
            view_product_price_backlog = $('#view_product_price_backlog').DataTable({
                dom: 'Bfrtip',


                buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

            });
            // $('.js-example-basic-multiple').select2();
            $('#togglePassword').on('click', function () {
                togglePasswordVisibility('password', 'togglePassword');
            });

            $('#toggleConfirmPassword').on('click', function () {
                togglePasswordVisibility('confirm_password', 'toggleConfirmPassword');
            });

            function togglePasswordVisibility(inputId, toggleId) {
                var passwordInput = $('#' + inputId);
                var toggleButton = $('#' + toggleId);

                var passwordType = passwordInput.attr('type');
                if (passwordType === 'password') {
                    passwordInput.attr('type', 'text');
                    toggleButton.find('i').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    toggleButton.find('i').removeClass('fa-eye-slash').addClass('fa-eye');
                }
            }

            $("#role").on("change", function () {
                var selectedRole = $(this).val();
                // Hide all secondary dropdowns
                $("#salesRole, #zmRole, #tmRole,#logisticsSelect").hide();
                if (selectedRole === "Sales") {
                    $("#salesRole").show();
                } else if (selectedRole === "Logistics") {
                    $("#logisticsSelect").show();
                }
            });

            $("#sales").on("change", function () {
                var selectedSalesRole = $(this).val();
                // alert(selectedSalesRole)
                // Hide all secondary dropdowns
                $("#zmRole, #tmRole").hide();
                if (selectedSalesRole === "TM") {
                    $("#zmRole").show();
                } else if (selectedSalesRole === "ASM") {
                    $("#tmRole").show();
                }
            });

            table = $('#myTable').DataTable({
                dom: 'Bfrtip',


                buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

            });

            fetchtable();
            $('#add_btn').click(function () {

                $('#row_id').val("");

                $('#insert_form')[0].reset();
                // alert("running")

            });

            $('#insert_form').on("submit", function (event) {
                update_id = $('#row_id').val();
                if (update_id == 0) {
                    event.preventDefault();
                    // alert("Name")
                    var data = new FormData(this);

                    $.ajax({
                        url: "<?php echo $api_url; ?>depots/create/create_depot_product_orders.php",
                        cache: false,
                        contentType: false,
                        processData: false,
                        method: "POST",
                        data: data,
                        beforeSend: function () {
                            $('#insert').val("Saving");
                            document.getElementById("insert").disabled = true;

                        },
                        success: function (data) {
                            console.log(data)

                            if (data != 1) {
                                Swal.fire(
                                    'Server Error!',
                                    'Record Not Created',
                                    'error'
                                )
                                $('#insert').val("Save");
                                document.getElementById("insert").disabled = false;
                            } else {


                                Swal.fire(
                                    'Success!',
                                    'Record Created Successfully',
                                    'success'
                                )
                                setTimeout(function () {
                                    $('#insert_form')[0].reset();
                                    $('#offcanvasRight').modal('hide');
                                    fetchtable();
                                    $("#salesRole, #zmRole, #tmRole,#logisticsSelect")
                                        .hide();
                                    $('#insert').val("Save");
                                    document.getElementById("insert").disabled = false;

                                    location.reload();


                                }, 2000);

                            }

                        }
                    });
                } else {
                    event.preventDefault();
                    // alert("Name")
                    var data = new FormData(this);

                    $.ajax({
                        url: "<?php echo $api_url; ?>update/update_user.php",
                        cache: false,
                        contentType: false,
                        processData: false,
                        method: "POST",
                        data: data,
                        beforeSend: function () {
                            $('#insert').val("Saving");
                            document.getElementById("insert").disabled = true;

                        },
                        success: function (data) {
                            console.log(data)

                            if (data != 1) {
                                Swal.fire(
                                    'Server Error!',
                                    'Record Not Updated',
                                    'error'
                                )
                                $('#insert').val("Save");
                                document.getElementById("insert").disabled = false;
                            } else {


                                Swal.fire(
                                    'Success!',
                                    'Record Updated Successfully',
                                    'success'
                                )
                                setTimeout(function () {
                                    $('#insert_form')[0].reset();
                                    $('#offcanvasRight').modal('hide');
                                    fetchtable();
                                    $("#salesRole, #zmRole, #tmRole,#logisticsSelect")
                                        .hide();
                                    $('#insert').val("Save");
                                    document.getElementById("insert").disabled = false;

                                    location.reload();



                                }, 2000);
                                // load_all_select()

                            }

                        },
                        error: function (xhr, textStatus, errorThrown) {
                            console.log(xhr)
                            console.log(textStatus)
                            console.log(errorThrown)
                            Swal.fire(
                                'Server Error!',
                                'Record Not Updated',
                                'error'

                            )

                            // console.log("Request failed with status code: " + xhr.status);
                        }
                    });


                }
            });

        })
        $('#insert_form_receiving').on("submit", function (event) {

            event.preventDefault();
            // alert("Name")
            var data = new FormData(this);

            $.ajax({
                url: "<?php echo $api_url; ?>depots/create/depot_order_receiving.php",
                cache: false,
                contentType: false,
                processData: false,
                method: "POST",
                data: data,
                beforeSend: function () {
                    $('#insert').val("Saving");
                    document.getElementById("insert").disabled = true;

                },
                success: function (data) {
                    console.log(data)

                    if (data != 1) {
                        Swal.fire(
                            'Server Error!',
                            'Record Not Created',
                            'error'
                        )
                        $('#insert').val("Save");
                        document.getElementById("insert").disabled = false;
                    } else {


                        Swal.fire(
                            'Success!',
                            'Record Created Successfully',
                            'success'
                        )
                        setTimeout(function () {
                            $('#insert_form')[0].reset();
                            $('#offcanvasRight').modal('hide');
                            fetchtable();
                            $("#salesRole, #zmRole, #tmRole,#logisticsSelect")
                                .hide();
                            $('#insert').val("Save");
                            document.getElementById("insert").disabled = false;

                            location.reload();


                        }, 2000);

                    }

                },
                error: function (xhr, status, error) {
                    // Handle API errors
                    console.log('Error:', error);
                    console.log('Status:', status);
                    console.log('Response:', xhr.responseText);
                }
            });





        })
        $('#password,#confirm_password').on('input', function () {
            validatePassword();
        });


        function validatePassword() {
            var password = $('#password').val();
            var confirmPassword = $('#confirm_password').val();

            if (password !== confirmPassword) {
                var error_message = $('#message').html('Passwords do not match!').css('color', 'red');
                $("#insert").prop("disabled", true);


            } else {
                var success_message = $('#message').html('Passwords match.').css('color', 'green');
                $("#insert").prop("disabled", false);

            }
        }


        function fetchtable() {

            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };

            fetch("<?php echo $api_url; ?>depots/get/get_depot_order.php?key=03201232927&pre=<?php echo $_SESSION['privilege'] ?>&user_id=<?php echo $_SESSION['user_id'] ?>",
                requestOptions)
                .then(response => response.json())
                .then(response => {
                    console.log(response)

                    table.clear().draw();
                    $.each(response, function (index, data) {
                        var status = data.status;
                        var status_value = '';

                        var statusText = (status == 1) ?
                            'Received view <button type="button" id="view_rec_order" name="view_rec_order" onclick="view_rec_order(' +
                            data.id +
                            ')" class="btn btn-soft-danger waves-effect waves-light"><i class="fas fa-eye font-size-16 align-middle"></i></button>' :
                            "Not Received";


                        table.row.add([
                            index + 1,
                            data.depot_name,
                            data.product_qty,
                            data.current_status,
                            data.created_at,
                            '<button type="button" id="delete" name="delete" onclick="get_orders_log(' +
                            data.id +
                            ')" class="btn btn-soft-danger waves-effect waves-light"><i class="fas fa-align-justify font-size-16 align-middle"></i></button>',
                            '<button type="button" id="view_order" name="view_order" onclick="view_order(' +
                            data.id +
                            ')" class="btn btn-soft-danger waves-effect waves-light"><i class="fas fa-edit font-size-16 align-middle"></i></button>',
                            statusText
                        ]).draw(false);
                    });
                })
                .catch(error => console.log('error', error));


        }

        function view_order(id) {
            if (id != "") {
                var requestOptions = {
                    method: 'GET',
                    redirect: 'follow'
                };

                console.log("<?php echo $api_url; ?>depots/get/get_depot_sub_order.php?key=03201232927&id=" + id + "");
                fetch("<?php echo $api_url; ?>depots/get/get_depot_sub_order.php?key=03201232927&id=" + id + "",
                    requestOptions)
                    .then(response => response.json())
                    .then(response => {
                        console.log(response);
                        if (response.length > 0) {
                            product_price_backlog.clear().draw();
                            $('#survey-container').empty();
                            var inds = 1; // Start index at 1
                            response.forEach(function (data) {
                                // IIFE to capture the correct value of inds
                                (function (inds) {
                                    product_price_backlog.row.add([
                                        inds,
                                        data.created_at,
                                        data.depot_name,
                                        data.product_name,
                                        data.qty,
                                    ]).draw(false);
                                    $('#order_main_id').val(data.main_id)
                                    var divs = `<div class="row">
                                <div class="col-md-4">
                                    <label for="inputEmail4">Product</label>
                                    <input type="text" class="form-control" name="product[]"
                                        id="product_qty_${inds}" value="${data.product_name}" required readonly>
                                    <input type="hidden" name="product_id[]" id="product_id_${inds}" value="${data.porduct_id}">
                                    <input type="hidden" name="sub_order_id[]" id="sub_order_id_${inds}" value="${data.id}">
                                    <input type="hidden" name="depot_id[]" id="depot_id_${inds}" value="${data.depot_id}">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail4">Order Qty</label>
                                    <input type="number" class="form-control" name="product_qty[]"
                                        id="product_qty_${inds}" value="${data.qty}" required readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail4">Temperature</label>
                                    <input type="number" class="form-control"
                                        name="temperatures[]" id="temperatures_${inds}" value="0" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail4">Receive Dip</label>
                                    <input type="number" class="form-control"
                                        name="rec_dip[]" id="rec_dip_${inds}" value="0" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail4">Receive Reading</label>
                                    <input type="number" class="form-control"
                                        name="rec_reading[]" id="rec_reading_${inds}" value="0" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail4">Receive in Tank</label>
                                    <select name="rec_tanks[]" class="form-select"
                                        id="rec_tanks_${inds}" required>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail4">Receive File</label>
                                    <input type="file" class="form-control"
                                        name="rec_file[]" id="rec_file_${inds}" required>
                                </div>
                            </div><hr>`;

                                    console.log(
                                        "<?php echo $api_url; ?>depots/get/get_product_tanks.php?key=03201232927&product_id=" +
                                        data.porduct_id + "&depot_id=" + data.depot_id);
                                    fetch("<?php echo $api_url; ?>depots/get/get_product_tanks.php?key=03201232927&product_id=" +
                                        data.porduct_id + "&depot_id=" + data.depot_id, requestOptions)
                                        .then(response => response.json())
                                        .then(result => {
                                            var tanksSelect = $("#rec_tanks_" + inds);
                                            tanksSelect.empty(); // Clear previous options

                                            // Add default option
                                            tanksSelect.append($('<option>', {
                                                value: '',
                                                text: 'Select Tank'
                                            }));

                                            // Add tank options
                                            $.each(result, function (index, tank) {
                                                tanksSelect.append($('<option>', {
                                                    value: tank.id,
                                                    text: tank.name
                                                }));
                                            });
                                        })
                                        .catch(error => console.log('error', error));

                                    $('#survey-container').append(divs);
                                })(inds); // Pass inds to the IIFE
                                inds++; // Increment inds for the next iteration
                            });
                        }
                        $('#products_price_backlog_modal').modal('show');
                    })
                    .catch(error => console.log('error', error));
            }
        }

        function view_rec_order(id) {
            if (id != "") {
                var requestOptions = {
                    method: 'GET',
                    redirect: 'follow'
                };

                console.log("<?php echo $api_url; ?>depots/get/get_depot_sub_order_with_rec.php?key=03201232927&id=" + id +
                    "");
                fetch("<?php echo $api_url; ?>depots/get/get_depot_sub_order_with_rec.php?key=03201232927&id=" + id + "",
                    requestOptions)
                    .then(response => response.json())
                    .then(response => {
                        console.log(response);
                        if (response.length > 0) {
                            view_product_price_backlog.clear().draw();
                            $('#survey-container').empty();
                            var inds = 1; // Start index at 1
                            response.forEach(function (data) {
                                // IIFE to capture the correct value of inds
                                (function (inds) {
                                    view_product_price_backlog.row.add([
                                        inds,
                                        data.created_at,
                                        data.depot_name,
                                        data.product_name,
                                        data.qty,
                                    ]).draw(false);
                                    $('#order_main_id').val(data.main_id)
                                    var divs = `<div class="row">
                                <div class="col-md-4">
                                    <label for="inputEmail4">Product</label>
                                    <input type="text" class="form-control" name="product[]"
                                        id="product_qty_${inds}" value="${data.product_name}" required readonly>
                                   
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail4">Order Qty</label>
                                    <input type="text" class="form-control" name="product_qty[]"
                                        id="product_qty_${inds}" value="${data.qty}" required readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail4">Temperature</label>
                                    <input type="text" class="form-control"
                                        name="temperatures[]" id="temperatures_${inds}" value="${data.receiving_temperature}" required readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail4">Receive Dip</label>
                                    <input type="text" class="form-control"
                                        name="rec_dip[]" id="rec_dip_${inds}" value="${data.receiving_dip}" required readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail4">Receive Reading</label>
                                    <input type="text" class="form-control"
                                        name="rec_reading[]" id="rec_reading_${inds}" value="${data.receiving_reading}" required readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail4">Gain/Loss</label>
                                    <input type="text" class="form-control"
                                        name="rec_gain[]" id="rec_gain_${inds}" value="${data.difference}" required readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail4">Receive in tank</label>
                                    <input type="text" class="form-control"
                                        name="rec_gain[]" id="rec_gain_${inds}" value="${data.tank_name}" required readonly>
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="inputEmail4">Receive File</label>
                                    <div>
                                    <img class='w-50' src="<?php echo $api_url_files; ?>uploads/${data.file}" alt="">
                                    <a href="<?php echo $api_url_files; ?>uploads/${data.file}" target="_blank">View File</a>
                                    </div>
                                </div>
                            </div><hr>`;

                                    

                                    $('#view_survey-container').append(divs);
                                })(inds); // Pass inds to the IIFE
                                inds++; // Increment inds for the next iteration
                            });
                        }
                        $('#view_products_price_backlog_modal').modal('show');
                    })
                    .catch(error => console.log('error', error));
            }
        }


        function load_all_select() {


            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };

            fetch("<?php echo $api_url; ?>get/all_depot.php?key=03201232927",
                requestOptions)
                .then(response => response.json())
                .then(result => {
                    var products_name = $("#allo_depot");

                    products_name.append($('<option>', {
                        value: '',
                        text: 'Select Depot'
                    }));

                    $.each(result, function (index, data) {
                        products_name.append($('<option>', {
                            value: data.id,
                            text: data.name
                        }));


                    });
                })
                .catch(error => console.log('error', error));

            fetch("<?php echo $api_url; ?>get/get_all_products.php?key=03201232927",
                requestOptions)
                .then(response => response.json())
                .then(result => {



                    var ind = 1;
                    $.each(result, function (index, data) {
                        var products_name = $("#depot_all_product" + ind + "");
                        products_name.append($('<option>', {
                            value: data.id,
                            text: data.name
                        }));

                        ind++;
                    });
                })
                .catch(error => console.log('error', error));

        }

        function deleteData(id) {
            var result = window.confirm("Are you sure you want to proceed?");

            // Check the result
            if (result) {
                var settings = {
                    "url": "<?php echo $api_url; ?>delete/delete_users.php?key=03201232927&id=" + id + "",
                    "method": "DELETE",
                    "timeout": 0,
                };
                $.ajax({
                    ...settings,
                    statusCode: {
                        200: function (response) {
                            console.log(response);
                            // $('#myModal').modal('hide');
                            // console.log("Request was successful");
                            Swal.fire(
                                'Success!',
                                'Record Deleted Successfully',
                                'success'
                            )
                            setTimeout(function () {

                                // location.reload();


                            }, 2000);
                        },
                        // Add more status code handlers as needed
                    },
                    success: function (data) {
                        // Additional success handling if needed
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        Swal.fire(
                            'Server Error!',
                            'Record Not Deleted',
                            'error'
                        )

                        // console.log("Request failed with status code: " + xhr.status);
                    }
                });
            }
        }

        function editData(id) {
            $('#zmRole').hide();
            $('#tmRole').hide();
            var settings = {
                "url": "<?php echo $api_url; ?>get/view_user.php?key=03201232927&id=" + id + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax({
                ...settings,
                statusCode: {
                    200: function (response) {
                        // load_all_select()
                        $('#name').val(response[0]['name']);
                        $('#email').val(response[0]['email']);
                        $('#password').val(response[0]['description']);
                        $('#confirm_password').val(response[0]['description']);
                        $('#number').val(response[0]['telephone']);
                        $('#role').val('Sales');
                        var row_id = $('#row_id').val(response[0]['id']);



                        // setTimeout(function() {
                        var role_val = $('#role').val()
                        if (role_val == 'Sales') {
                            var privilege = response[0]['privilege']

                            $("#salesRole").show();

                            if (privilege == 'ZM') {
                                $('#sales').val('ZM');
                                $('#sales_role_hide').val('ZM');
                            }
                            if (privilege == 'TM') {

                                var settings = {
                                    "url": "<?php echo $api_url; ?>get/get_zm_tm.php?key=03201232927&id=" +
                                        id + "",
                                    "method": "GET",
                                    "timeout": 0,
                                };
                                $.ajax({
                                    ...settings,
                                    statusCode: {
                                        200: function (response) {
                                            $('#sales').val('TM')
                                            $('#sales_role_hide').val('TM');
                                            $('#zmRole').show();
                                            // alert("hello")
                                            // alert(response[0]['zm_id'])
                                            $('#zm_hide').val(response[0]['zm_id'])
                                            $('#zm').val(response[0]['zm_id']);
                                        }
                                    }
                                })


                            }
                            if (privilege == 'ASM') {
                                var settings = {
                                    "url": "<?php echo $api_url; ?>get/get_asm_tm.php?key=03201232927&id=" +
                                        id + "",
                                    "method": "GET",
                                    "timeout": 0,
                                };
                                $.ajax({
                                    ...settings,
                                    statusCode: {
                                        200: function (response) {
                                            $('#sales_role_hide').val('ASM');
                                            $('#sales').val('ASM');
                                            $('#tmRole').show();
                                            // alert("hello")
                                            // alert(response[0]['tm_id'])
                                            $('#tm_hide').val(response[0]['tm_id'])
                                            $('#tm').val(response[0]['tm_id']);
                                        }
                                    }
                                })
                            }

                        }
                        // }, 2000);



                        // $('#role').value(response[0]['name'])

                    }
                }
            })
            $('#offcanvasRight').offcanvas('show')
        }
        $('#add_btn').on('click', function () {
            $('#zmRole').hide();
            $('#tmRole').hide();
            $("#salesRole").hide();

        })

        function get_orders_log(id) {

            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };

            fetch("<?php echo $api_url; ?>depots/get/get_depot_order_backlog.php?key=03201232927&order_id=" + id + "",
                requestOptions)
                .then(response => response.json())
                .then(response => {
                    console.log(response)
                    $('#order_logs').empty();

                    $.each(response, function (index, data) {
                        var status = data.status;
                        var status_value = '';

                        var originalDate = data.created_at;
                        var dateObject = new Date(originalDate);

                        var day = dateObject.getDate(); // Extract the day (returns 25)
                        var month = dateObject.toLocaleString('en-US', {
                            month: 'short'
                        }); // Extract the month (returns "Oct")

                        console.log("Day:", day);
                        console.log("Month:", month);
                        $('#order_logs').append('<div class="row timeline-right">' +
                            '<div class="col-md-6">' +
                            ' <div class="timeline-icon">' +
                            '<i class="bx bx-briefcase-alt-2 text-primary h2 mb-0"></i>' +
                            ' </div>' +
                            '</div>' +
                            '<div class="col-md-6">' +
                            '<div class="timeline-box">' +
                            '<div class="timeline-date bg-primary text-center rounded">' +
                            '<h3 class="text-white mb-0 font-size-20">' + day + '</h3>' +
                            '<p class="mb-0 text-white-50">' + month + '</p>' +
                            '</div>' +
                            '<div class="event-content">' +
                            '<div class="timeline-text">' +
                            '<h3 class="font-size-17">' + data.current_status + '</h3>' +
                            '<p class="mb-0 mt-2 pt-1 text-muted">Action By : ' + data.name + '</p>' +
                            '<p class="mb-0 mt-2 pt-1 text-muted">Action Time : ' + data.created_at +
                            '</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>');

                    });
                    $('#order_backlog_modal').modal('show');
                })
                .catch(error => console.log('error', error));


        }
    </script>
</body>


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

</html>