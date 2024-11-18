<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

<head>

    <meta charset="utf-8" />
    <title>
        TM Monthly Targets |
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
                            <h3>TM Monthly Targets</h3>

                            <table id="myTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>TM</th>
                                        <th>Product</th>
                                        <th>Month</th>
                                        <th>Target</th>
                                        <th>Description</th>

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
            <h5 id="offcanvasRightLabel">Set Targets</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid">
                <form method="post" id="targeted_from" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">TM</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="asm" name="asm">

                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Month</label>
                                <div class="col-md-10">
                                    <input type="month" class="form-control" id='month_name' name='month_name' required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Target (Ltr)</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" id='targeted_amount'
                                        name='targeted_amount' required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Product</label>
                                <div class="col-md-10">
                                    <select name="targeted_product" class="form-select" id="targeted_product">

                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Description</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="products_description" name="products_description"
                                        rows="4" cols="50" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-12" style="text-align: right;">
                            <input type="hidden" name="user_id" id="user_id"
                                value="<?php echo $_SESSION['user_id']; ?>">
                            <input type="hidden" name="dealer_id" value="">
                            <input type="hidden" name="row_id" id="row_id">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-bs-dismiss="modal">Close</button>
                            <input class="btn btn-primary waves-effect waves-light" type="submit" name="target_btn"
                                id="target_btn" value="Save">
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


        table = $('#myTable').DataTable({
            dom: 'Bfrtip',


            buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

        });
        fetchtable();
       

        $('#targeted_from').on("submit", function(event) {
            event.preventDefault();
            // alert("Name")
            var formData = $(this).serialize();
            console.log(formData);
            $.ajax({
                url: "<?php echo $api_url; ?>create/create_monthly_target_for_tm.php",
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('#target_btn').val("Saving");
                    document.getElementById("target_btn").disabled = true;

                },
                success: function(data) {
                    console.log(data)

                    if (data != 1) {
                        Swal.fire(
                            'Server Error!',
                            'Record Not Created',
                            'error'
                        )
                        $('#target_btn').val("Save");
                        document.getElementById("target_btn").disabled = false;
                    } else {


                        setTimeout(function() {
                            Swal.fire(
                                'Success!',
                                'Record Created Successfully',
                                'success'
                            )
                            $('#targeted_from')[0].reset();

                            // facilities();
                            $('#target_btn').val("Save");
                            document.getElementById("target_btn").disabled = false;
                            location.reload();


                        }, 2000);

                    }

                },
                error: function(xhr, status, error) {
                    // Handle API errors
                    Swal.fire(
                        'Server Error!',
                        'Duplicate Month Entry',
                        'error'
                    )
                    $('#target_btn').val("Save");
                    document.getElementById("target_btn").disabled = false;
                    console.log('Error:', error);
                    console.log('Status:', status);
                    console.log('Response:', xhr.responseText);
                }

            });

        });
        load_all_select();
        all_products();
        get_asm();
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

    function get_asm() {
        // alert(id)
        $.ajax({
            url: '<?php echo $api_url; ?>get/get_asm.php?key=03201232927',
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

    function all_products() {
        // alert('Hamza')
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };

        fetch("<?php echo $api_url; ?>get/get_all_products.php?key=03201232927",
                requestOptions)
            .then(response => response.json())
            .then(result => {
                var products_name = $("#targeted_product");

                products_name.append($('<option>', {
                    value: '',
                    text: 'Select Product'
                }));

                $.each(result, function(index, data) {
                    console.log('all products')
                    console.log(data.name)
                    products_name.append($('<option>', {
                        value: data.name,
                        text: data.name
                    }));


                });
            })
            .catch(error => console.log('error', error));
    }

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
            "url": "<?php echo $api_url; ?>get/get_order_product_qty.php?key=03201232927&id=" + id + "",
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

        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };

        fetch("<?php echo $api_url; ?>get/get_tm_monthly_target.php?key=03201232927&id=<?php echo $_SESSION['user_id'] ?>",
                requestOptions)
            .then(response => response.json())
            .then(response => {
                console.log(response)

                table.clear().draw();
                $.each(response, function(index, data) {
                    table.row.add([
                        index + 1,
                        data.name,
                        data.product_id,
                        data.date_month,
                        data.target_amount,
                        data.description

                        // '<button type="button" id="edit" name="edit" onclick="editData(' +
                        // data.id +
                        // ')" class="btn btn-soft-danger waves-effect waves-light"><i class="bx bx-edit-alt font-size-16 align-middle"></i></button>',


                        // '<button type="button" id="delete" name="delete" onclick="deleteData(' +
                        // data.id +
                        // ')" class="btn btn-soft-danger waves-effect waves-light"><i class="bx bx-trash-alt font-size-16 align-middle"></i></button>'
                    ]).draw(false);
                });
            })
            .catch(error => console.log('error', error));


    }

    function load_all_select() {

        $.ajax({
            url: '<?php echo $api_url; ?>get/get_tm.php?key=03201232927',
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
            url: '<?php echo $api_url; ?>get/get_zm.php?key=03201232927',
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