<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

<head>

    <meta charset="utf-8" />
    <title>
        COCO Orders | <?php echo $_SESSION['user_name'];?>
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
                        <div class="col-md-3">
                            <label for="inputEmail4">Date</label>

                            <input type="date" class="form-control" name="fromdate" id="fromdate"
                                value="<?php echo date('Y-m-d') ?>">

                        </div>

                        <div class="col-md-3">

                            <input type="btn" class="btn btn-primary mt-3" name="btn_get" id="btn_get" value="Get"
                                onclick="fetchtable()">

                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">

                        <!-- <div class="col-md-6">
                            <button class="btn btn-soft-primary waves-effect waves-light" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" id="add_btn"
                                aria-controls="offcanvasRight"><i
                                    class="bx bxs-add-to-queue font-size-16 align-middle me-2 cursor-pointer"></i>Add</button>
                        </div> -->
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3 id="report_header">Orders Current Day of <span id="report_date"></span></h3></span>

                            <table id="myTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- <th>S.No</th> -->
                                        <th>JD Code</th>
                                        <th>Region</th>
                                        <th>Site Name</th>
                                        <th>Depot</th>
                                        <th>PMG</th>
                                        <th>HSD</th>
                                        <th>HASRON</th>

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
                            <input type="number" class="form-control" id="name" name="name" required>
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
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons Extension -->
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script> <!-- Print Button -->
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>

<!-- JSZip for Excel Export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!-- PDFMake for PDF Export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script>
    var table;
    var type;
    var subtype;
    $(document).ready(function() {
        var table;

        // Initialize the DataTable with export buttons
        table = $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    title: function() {
                        return 'Orders Current Day of ' + $('#report_date').text();
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: function() {
                        return 'Orders Current Day of ' + $('#report_date').text();
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: function() {
                        return 'Orders Current Day of ' + $('#report_date').text();
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: function() {
                        return 'Orders Current Day of ' + $('#report_date').text();
                    },
                    orientation: 'landscape',
                    pageSize: 'A4',
                    customize: function(doc) {
                        doc.content[1].table.widths = ['20%', '15%', '20%', '15%', '10%', '10%',
                            '10%'
                        ];
                    }
                },
                {
                    extend: 'print',
                    title: function() {
                        return 'Orders Current Day of ' + $('#report_date').text();
                    }
                }
            ],
            paging: false, // Disable pagination
            pageLength: -1,
            ordering: false
        });

        // Fetch table data for the selected date
        fetchtable();

        // Reload table data when 'Get' button is clicked
        $('#btn_get').click(function() {
            fetchtable();
        });

        function fetchtable() {
            var rettypes = "RT";
        // var rettypes = "CO ";
            var fromdate = $('#fromdate').val();
            $('#report_date').text(fromdate);

            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };

            fetch("<?php echo $api_url; ?>get/current_data_coco_orders.php?key=03201232927&id=<?php echo $_SESSION['user_id'] ?>&from=" +
                    fromdate + "&rettype="+rettypes+"", requestOptions)
                .then(response => response.json())
                .then(response => {
                    table.clear().draw();
                    $.each(response, function(index, data) {
                        table.row.add([
                            data.dealer_sap,
                            data.dealer_region,
                            data.dealer_name,
                            data.dealers_depots,
                            (data.PMG / 1000),
                            (data.HSD / 1000),
                            (data.HASRON / 1000),
                        ]).draw(false);
                    });
                })
                .catch(error => console.log('error', error));
        }
    });

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

    function fetchtable1() {
        // var rettypes = "RT";
        var rettypes = "CO ";
        var fromdate = $('#fromdate').val();
        $('#report_date').text(fromdate);
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };
        console.log("<?php echo $api_url; ?>get/current_data_coco_orders.php?key=03201232927&id=<?php echo $_SESSION['user_id'] ?>&from=" + fromdate + "&rettype="+rettypes+"");
        fetch("<?php echo $api_url; ?>get/current_data_coco_orders.php?key=03201232927&id=<?php echo $_SESSION['user_id'] ?>&from=" + fromdate + "&rettype="+rettypes+"",
                requestOptions)
            .then(response => response.json())
            .then(response => {
                console.log(response)

                table.clear().draw();
                $.each(response, function(index, data) {
                    table.row.add([
                        // index + 1,
                        data.dealer_sap,
                        data.dealer_region,
                        data.dealer_name,
                        data.dealers_depots,
                        (data.PMG) / 1000 + ' KL',
                        (data.HSD) / 1000 + ' KL',
                        (data.HASRON) / 1000 + ' KL',

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