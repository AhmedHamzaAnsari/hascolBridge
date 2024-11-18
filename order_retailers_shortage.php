<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

<head>

    <meta charset="utf-8" />
    <title>
        Order Shortage | <?php echo $_SESSION['user_name'];?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- App favicon -->

    <?php include 'css_script.php'; ?>


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
                        <div class="card-body" style="overflow: auto;">
                            <h3>Order Shortage</h3>

                            <table id="myTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Received at</th>
                                        <th>Site Name</th>
                                        <th>JD code</th>
                                        <th>Order #</th>
                                        <th>Invoice #</th>
                                        <th>Product</th>
                                        <th>Order Quantity</th>
                                        <th>Received Quantity</th>
                                        <th>Shortage Quantity</th>
                                        <th>Temprature</th>
                                        <th>Density</th>
                                        <th>File</th>
                                        <th>Driver Sign</th>
                                        <th>Dealer Sign</th>

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
            <h5 id="offcanvasRightLabel">Sizes</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid">
                <form method="post" id="insert_form" enctype="multipart/form-data">


                    <div class="form-row mb-4">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Sizes</label>
                            <input type="number" class="form-control" id="name" name="name" placeholder="Enter Username"
                                required>
                        </div>






                    </div>

                    <div class="col-12">
                        <input type="hidden" name="row_id" id="row_id" value="0">
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
    $(document).ready(function() {
        // $('.js-example-basic-multiple').select2();


        $("#role").on("change", function() {
            var selectedRole = $(this).val();
            // Hide all secondary dropdowns
            $("#salesRole, #zmRole, #tmRole,#logisticsSelect").hide();
            if (selectedRole === "Sales") {
                $("#salesRole").show();
            } else if (selectedRole === "Logistics") {
                $("#logisticsSelect").show();
            }
        });

        $("#sales").on("change", function() {
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
        $('#add_btn').click(function() {

            $('#row_id').val("");

            $('#insert_form')[0].reset();
            // alert("running")

        });

        $('#insert_form').on("submit", function(event) {
            event.preventDefault();
            // alert("Name")
            update_id = $('#row_id').val();

            if (update_id == 0) {
                var data = new FormData(this);
                $.ajax({
                    url: "<?php echo $api_url; ?>create/create_containers_sizes.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: "POST",
                    data: data,
                    beforeSend: function() {
                        $('#insert').val("Saving");
                        document.getElementById("insert").disabled = true;

                    },
                    success: function(data) {
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


                            setTimeout(function() {
                                Swal.fire(
                                    'Success!',
                                    'Record Created Successfully',
                                    'success'
                                )
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

                var data = new FormData(this);

                $.ajax({
                    url: "<?php echo $api_url; ?>update/container_size.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: "POST",
                    data: data,
                    beforeSend: function() {
                        $('#insert').val("Saving");
                        document.getElementById("insert").disabled = true;

                    },
                    success: function(data) {
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


                            setTimeout(function() {
                                Swal.fire(
                                    'Success!',
                                    'Record Updated Successfully',
                                    'success'
                                )
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

            }

        });
        load_all_select();
    })
    //     function deleteData(id){

    // var settings = {
    //         "url": "<?php echo $api_url; ?>get/get_container_sizes.php?key=03201232927&id=" + id + "",
    //         "method": "GET",
    //         "timeout": 0,
    //     };

    //     $.ajax({
    //         ...settings,
    //         statusCode: {
    //             200: function(response) {

    //                 $('#row_id').val(response[0]['id'])
    //                 $('#name').val(response[0]['sizes']);

    //             }
    //         }
    //     })
    //     $('#offcanvasRight').offcanvas('show');

    // }

    function deleteData(id) {

        var settings = {
            "url": "<?php echo $api_url; ?>delete/delete_container_size.php?key=03201232927&id=" + id + "",
            "method": "GET",
            "timeout": 0,
        };

        $.ajax({
            ...settings,
            statusCode: {
                200: function(response) {
                    Swal.fire(
                        'Success!',
                        'Record Deleted Successfully',
                        'success'
                    )
                    setTimeout(function() {

                        // location.reload();


                    }, 2000);

                },
                success: function(data) {
                    // Additional success handling if needed
                },
                error: function(xhr, textStatus, errorThrown) {
                    Swal.fire(
                        'Server Error!',
                        'Record Not Deleted',
                        'error'
                    )

                    // console.log("Request failed with status code: " + xhr.status);
                }
            }
        })

    }

    function editData(id) {

        var settings = {
            "url": "<?php echo $api_url; ?>get/get_container_sizes.php?key=03201232927&id=" + id + "",
            "method": "GET",
            "timeout": 0,
        };

        $.ajax({
            ...settings,
            statusCode: {
                200: function(response) {

                    $('#row_id').val(response[0]['id'])
                    $('#name').val(response[0]['sizes']);

                }
            }
        })
        $('#offcanvasRight').offcanvas('show');

    }

    function fetchtable() {
        var rettypes = "RT";
        // var rettypes = "CO ";

        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };

        fetch("<?php echo $api_url; ?>get/get_all_orders_shortage.php?key=03201232927&id=<?php echo $_SESSION['user_id'] ?>&rettype="+rettypes+"",
                requestOptions)
            .then(response => response.json())
            .then(response => {
                // console.log(response)

                table.clear().draw();
                $.each(response, function(index, data) {

                    var product_json = data.product_json;
                    const jsonData = JSON.parse(product_json);

                    console.log('jsonData')
                    console.log(jsonData)

                    var product_name = jsonData[0].product_name;
                    var Density = jsonData[0].Density;
                    var quantity = jsonData[0].quantity;
                    var quantity_less_L = jsonData[0].quantity_less_L;
                    var quantity_rec_L = jsonData[0].quantity_rec_L;
                    var quantity_rec_mm = jsonData[0].quantity_rec_mm;
                    var temperature = jsonData[0].temperature;
               



                    table.row.add([
                        index + 1,
                        data.created_at,
                        data.customer_name,
                        data.customer_id,
                        data.order_id,
                        data.invoice_no,
                        product_name,
                        parseFloat(quantity).toLocaleString(),
                        parseFloat(quantity_rec_L).toLocaleString(),
                        parseFloat(quantity_less_L).toLocaleString(),
                        temperature,
                        Density,
                        '<a href="<?php echo $api_url_files; ?>uploads/'+data.file+'" target="_blank">View File</a>',
                        '<a href="<?php echo $api_url_files; ?>uploads/'+data.sign+'" target="_blank">View File</a>',
                        '<a href="<?php echo $api_url_files; ?>uploads/'+data.dealer_sign+'" target="_blank">View File</a>'
                        
                       
                    ]).draw(false);
                });
            })
            .catch(error => console.log('error', error));


    }

    function load_all_select() {

        $.ajax({
            url: '<?php echo $api_url;?>get/get_tm.php?key=03201232927',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#zm').empty();

                // Iterate through the data and append options to the select element
                $.each(data, function(index, item) {
                    $('#tm').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));
                });

                // Refresh the Select2 element to display the newly added options
                $('#tm').trigger('change.select2');
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });

        $.ajax({
            url: '<?php echo $api_url;?>get/get_zm.php?key=03201232927',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#zm').empty();
                console.log('ZM')
                console.log(data)
                // Iterate through the data and append options to the select element
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




    }
    </script>
</body>


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

</html>