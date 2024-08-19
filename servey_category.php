<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

<head>

    <meta charset="utf-8" />
    <title>
        Survey Category |
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
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 7px;
        left: 0;
        right: 8px;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(21px);
        -ms-transform: translateX(21px);
        transform: translateX(21px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
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
                            <h3>Survey Category</h3>

                            <table id="myTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Category</th>
                                        <th>Active/Inactive</th>
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
                            <label for="inputEmail4">Category</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category"
                                required>
                        </div>






                    </div>

                    <div class="col-12">
                        <input type="hidden" name="row_id" id="row_id" value="">
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
                // alert("Name")
                var data = new FormData(this);

                $.ajax({
                    url: "<?php echo $api_url; ?>create/create_survey_category.php",
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


                            setTimeout(function () {
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

            });
            load_all_select();
        })



        function fetchtable() {

            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };

            fetch("<?php echo $api_url; ?>get/get_survey_category.php?key=03201232927&id=<?php echo $_SESSION['user_id'] ?>", requestOptions)
                .then(response => response.json())
                .then(response => {
                    console.log(response)

                    table.clear().draw();
                    $.each(response, function (index, data) {
                        table.row.add([
                            index + 1,
                            data.name,


                            '<label class="switch"><input type="checkbox" id="checkbox" onclick="check(' + data.id + ')" ' +
                            (data.status == 0 ? '' : 'checked') + '> <span class="slider round"></span></label>'

                        ]).draw(false);
                    });
                })
                .catch(error => console.log('error', error));


        }

        function check(id) {
            // Get the value of the checkbox (0 for unchecked, 1 for checked)
            var checkboxValue = $('#checkbox').is(':checked') ? 1 : 0;

            $.ajax({
                type: 'POST',
                url: '<?php echo $api_url; ?>update/survey_cat_update.php', // Replace with the path to your PHP script
                data: {
                    checkboxValue: checkboxValue,
                    id: id
                },
                success: function (response) {
                    console.log('Record updated successfully.');
                    alert('success!')
                },
                error: function (error) {
                    console.error('Error updating database:', error);
                }
            });
            // You can use the checkboxValue variable as needed
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