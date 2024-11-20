<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

<head>

    <meta charset="utf-8" />
    <title>
        Lubes Products |
        <?php echo $_SESSION['user_name']; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Byco" name="description" />
    <meta content="Byco" name="author" />
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
                            <h3>Lubes Products</h3>

                            <table id="myTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Grade </th>
                                        <th>Pack Size (Ltrs & Kg.) </th>
                                        <th>Ctn Size (Ltrs) </th>
                                        <th>Packs in CTN</th>
                                        <th>Created At</th>
                                        <th>Edit</th>
                                        <!-- <th>Delete</th> -->

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
    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasRightLabel">Products</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid">
                <form method="post" id="insert_form" enctype="multipart/form-data">

                    <div class="container-fluid">
                        <div class="row">
                            <div class=" col-md-4">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmail4">Code</label>
                                <input type="text" class="form-control" id="code" name="code" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmail4">Grade</label>
                                <select class="form-control  " name="category" id="category"
                                    placeholder="This is a search placeholder">
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmail4">Pack Sizes</label>
                                <select class="form-control  " name="sizes" id="sizes"
                                    placeholder="This is a search placeholder">
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmail4">Price</label>
                                <input type="text" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmail4">Image</label>
                                <input type="file" class="form-control" id="product_image" name="product_image"
                                    required>
                            </div>


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
        $(document).ready(function () {
            // $('.js-example-basic-multiple').select2();


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
                event.preventDefault();

                // Create FormData object from the form
                var data = new FormData(this);

                $.ajax({
                    url: "<?php echo $api_url; ?>create/lubes/creatw_lubes_products.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: "POST",
                    data: data,
                    beforeSend: function () {
                        // Disable the save button and change text to 'Saving'
                        $('#insert').val("Saving");
                        document.getElementById("insert").disabled = true;
                    },
                    success: function (response) {
                        console.log(response);

                        // Check for success (assuming '1' is returned on success)
                        if (response != 1) {
                            Swal.fire(
                                'Server Error!',
                                'Record Not Created',
                                'error'
                            );
                            $('#insert').val("Save");
                            document.getElementById("insert").disabled = false;
                        } else {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Record Created Successfully',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            setTimeout(function () {
                                // Reset the form, close modal, and reload the table
                                $('#insert_form')[0].reset();
                                // If you're using Bootstrap Offcanvas or Modal, uncomment the line below
                                // $('#offcanvasRight').modal('hide');

                                // Reload the page to reflect changes
                                location.reload();

                                // Optional: If you are using a function to refresh the data table, you can use:
                                // fetchtable();

                                $('#insert').val("Save");
                                document.getElementById("insert").disabled = false;
                            }, 2000);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle API errors
                        Swal.fire(
                            'Error!',
                            'An error occurred. Please try again later.',
                            'error'
                        );
                        console.log('Error:', error);
                        console.log('Status:', status);
                        console.log('Response:', xhr.responseText);

                        $('#insert').val("Save");
                        document.getElementById("insert").disabled = false;
                    }
                });
            });

            load_all_select();
        })


        function deleteData(id) {

            var settings = {
                "url": "<?php echo $api_url; ?>delete/delete_container_size.php?key=03201232927&id=" + id + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax({
                ...settings,
                statusCode: {
                    200: function (response) {
                        Swal.fire(
                            'Success!',
                            'Record Deleted Successfully',
                            'success'
                        )
                        setTimeout(function () {

                            // location.reload();


                        }, 2000);

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
                }
            })

        }

        function editData(id) {

            var settings = {
                "url": "<?php echo $api_url; ?>get/get_product_id.php?key=03201232927&id=" + id + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax({
                ...settings,
                statusCode: {
                    200: function (response) {

                        $('#row_id').val(response[0]['id'])
                        $('#name').val(response[0]['name']);
                        $('#code').val(response[0]['code']);
                        $('#category').val(response[0]['cat_id']);
                        $('#sizes').val(response[0]['size_id']);
                        $('#price').val(response[0]['price']);

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

            fetch("<?php echo $api_url; ?>get/lubes/get_all_lubes_product.php?key=03201232927&id=<?php echo $_SESSION['user_id'] ?>",
                requestOptions)
                .then(response => response.json())
                .then(response => {
                    console.log(response)

                    table.clear().draw();
                    $.each(response, function (index, data) {
                        table.row.add([
                            index + 1,
                            '<img src="<?php echo $api_url; ?>../hascolBridge_files/uploads/' + data.image + '" alt="Product Image" style="width:50px;height:50px;">',
                            data.name,
                            data.code,
                            data.category,
                            data.size_name,
                            data.ctn_size,
                            data.ctn_qty,
                            data.created_at,
                            '<button type="button" id="edit" name="edit" onclick="editData(' + data.id + ')" class="btn btn-soft-danger waves-effect waves-light"><i class="bx bx-edit-alt font-size-16 align-middle"></i></button>',
                            // '<button type="button" id="delete" name="delete" onclick="deleteData(' + data.id + ')" class="btn btn-soft-danger waves-effect waves-light"><i class="bx bx-trash-alt font-size-16 align-middle"></i></button>'
                        ]).draw(false);

                    });
                })
                .catch(error => console.log('error', error));

            $.ajax({
                url: "<?php echo $api_url; ?>get/lubes/get_all_lubes_categories.php?key=03201232927&id=<?php echo $_SESSION['user_id'] ?>",
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#category').empty();
                    $('#category').append($('<option>', {
                        value: '',
                        text: 'Select'
                    }));
                    // Iterate through the data and append options to the select element
                    $.each(data, function (index, item) {
                        $('#category').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });

                    // Refresh the Select2 element to display the newly added options
                    $('#category').trigger('change.select2');
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }

            });

            $.ajax({
                url: "<?php echo $api_url; ?>get/lubes/get_all_lubes_sizes.php?key=03201232927&id=<?php echo $_SESSION['user_id'] ?>",
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#sizes').empty();
                    $('#sizes').append($('<option>', {
                        value: '',
                        text: 'Select'
                    }));
                    // Iterate through the data and append options to the select element
                    $.each(data, function (index, item) {
                        $('#sizes').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });

                    // Refresh the Select2 element to display the newly added options
                    $('#sizes').trigger('change.select2');
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function load_all_select() {

            $.ajax({
                url: '<?php echo $api_url; ?>get/get_tm.php?key=03201232927',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#zm').empty();

                    // Iterate through the data and append options to the select element
                    $.each(data, function (index, item) {
                        $('#tm').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });

                    // Refresh the Select2 element to display the newly added options
                    $('#tm').trigger('change.select2');
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });

            $.ajax({
                url: '<?php echo $api_url; ?>get/get_zm.php?key=03201232927',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#zm').empty();
                    console.log('ZM')
                    console.log(data)
                    // Iterate through the data and append options to the select element
                    $.each(data, function (index, item) {
                        $('#zm').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });

                    // Refresh the Select2 element to display the newly added options
                    $('#zm').trigger('change.select2');
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });




        }
    </script>
</body>


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

</html>