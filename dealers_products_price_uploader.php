<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

<head>

    <meta charset="utf-8" />
    <title>
        Import Dealers Products  Rate |
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
                            <h3>Import Dealers Products  Rate</h3>

                            <table id="myTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th class="text-center">Dealer Name</th>
                                        <th class="text-center">Product</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Indent Price</th>
                                        <th class="text-center">Nozel Price</th>
                                        <th class="text-center">Freight</th>
                                        <th class="text-center">Update Time</th>
                                        <!-- <th>Edit</th>
                                        <th>Delete</th> -->

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
            <h5 id="offcanvasRightLabel">Import Dealers Products  Rate</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid">
                <form id="uploadForm" enctype="multipart/form-data">


                    <div class="form-row mb-4">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Rate File (CSV)</label>
                            <input type="file" name="csv_file" id="csv_file" accept=".csv" required>
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




        table = $('#myTable').DataTable({
            dom: 'Bfrtip',


            buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

        });
        fetchtable();


        $('#uploadForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = new FormData(this); // Create FormData object to handle file upload

            // Send the file via AJAX to the backend
            $.ajax({
                url: '<?php echo $api_url; ?>create/excel/import_dealers_product_rate.php', // PHP API URL
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#insert').val("Saving");
                    $('#insert').prop("disabled", true); // Disable the button
                },
                success: function(data) {
                    console.log(data); // Log response to console for debugging

                    if (data.status === "success") {
                        alert(data.message); // Success message
                        Swal.fire(
                            'Success!',
                            data.message,
                            'success'
                        );
                        setTimeout(function() {
                            location
                                .reload(); // Optionally reload the page after a delay
                        }, 2000);
                    } else {
                        // Show all errors
                        Swal.fire(
                            'Server Error!',
                            "Errors: " + data.errors.join(", "),
                            'error'
                        );
                        $('#insert').val("Save");
                        $('#insert').prop("disabled", false); // Enable the button again
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors
                    console.error(xhr, status, error); // Log error to console
                    Swal.fire(
                        'Error!',
                        'Error uploading file! Please try again.',
                        'error'
                    );
                    $('#insert').val("Save");
                    $('#insert').prop("disabled", false); // Enable the button again
                }
            });
        });

    });







    function fetchtable() {

        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };
        console.log("<?php echo $api_url; ?>get/all_dealers_product.php?key=03201232927&id=<?php echo $_SESSION['user_id'] ?>")
        fetch("<?php echo $api_url; ?>get/all_dealers_product.php?key=03201232927&id=<?php echo $_SESSION['user_id'] ?>",
                requestOptions)
            .then(response => response.json())
            .then(response => {
                console.log(response)

                table.clear().draw();
                $.each(response, function(index, data) {
                    table.row.add([
                        index + 1,
                        data.dealer_name,
                        data.product_name,
                        data.from,
                        data.to,
                        data.indent_price,
                        data.nozel_price,
                        data.freight_value,
                        data.update_time
                    ]).draw(false);
                });
            })
            .catch(error => console.log('error', error));


    }
    </script>
</body>


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

</html>