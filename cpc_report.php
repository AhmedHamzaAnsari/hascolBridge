<?php

include 'session/session_input.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dealers CPC Report |
        <?php echo htmlspecialchars($_SESSION['user_name']); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PUMA" name="description" />
    <meta content="PUMA" name="PUMA" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <?php include 'css_script.php'; ?>
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-soft-primary waves-effect waves-light" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" id="add_btn"
                                aria-controls="offcanvasRight">
                                <i class="bx bxs-add-to-queue font-size-16 align-middle me-2 cursor-pointer"></i>Search
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h3>Dealers CPC Report</h3>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12" style="overflow: auto;">

                                        <table id="myTable" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Date</th>
                                                    <th>Day</th>
                                                    <th>TM</th>
                                                    <th>Planned</th>
                                                    <th>Actual</th>
                                                    <th>Remarks</th>
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
                </div>
                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>

    <div class="rightbar-overlay"></div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasRightLabel">Visit Report</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid">
                <div class="form-row mb-4">
                    <div class="form-group col-md-12">
                        <label for="dealers" class="col-md-2 col-form-label">TM</label>
                        <select class="w-100 form-control" id="dealers" name="dealers[]" required>
                            <option value="">Select TM</option>
                        </select>
                    </div>

                </div>
                <div class="form-group col-md-12">
                    <label for="Month" class="col-md-2 col-form-label">Month</label>
                    <input type="month" class="form-control" id="Month" name="Month" required>
                </div>
                <div class="col-12">
                    <input type="hidden" name="row_id" id="row_id" value="0">
                    <input type="hidden" name="user_id" id="user_id"
                        value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-10 col-form-label"></label>
                        <div class="col-md-12 text-center">
                            <input class="btn rounded-pill btn-primary" type="button" onclick="getRecon()" name="insert"
                                id="insert" value="Save">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'script_tags.php'; ?>

    <script>
    var table;
    $(document).ready(function() {
        all_dealers();
        $('.multiple_select').select2();



        $('#add_btn').click(function() {
            $('#row_id').val("");
        });

        table = $('#myTable').DataTable({
            dom: 'Bfrtip',


            buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

        });
    });



    function all_dealers() {
        fetch(
                "<?php echo $api_url; ?>get/get_asm.php?key=03201232927&pre=<?php echo htmlspecialchars($_SESSION['privilege']); ?>&user_id=<?php echo htmlspecialchars($_SESSION['user_id']); ?>"
            )
            .then(response => response.json())
            .then(response => {
                $.each(response, function(index, data) {
                    var newOption = $('<option>', {
                        value: data.id,
                        text: data.name
                    });
                    $('#dealers').append(newOption);
                    $('#dealers').trigger('change');
                });
            })
            .catch(error => console.log('error', error));
    }

    function getRecon() {
        var dealers = $('#dealers').val(); // This should be the TM ID
        var month = $('#Month').val(); // Use month input value

        if (dealers.length > 0 && month !== '') {
            // blocking();
            $.ajax({
                url: "<?php echo $api_url; ?>get/get_tm_dealers_visits_new.php?key=03201232927&tm_id=" +dealers+"&month="+month,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.length > 0) {


                        table.clear().draw();

                        $.each(response, function(index, data) {
                            table.row.add([
                                index + 1,
                                data.date,
                                data.day,
                                data.user_name,
                                data.inspection_dealers,
                                data.casual_dealers,
                                '',




                            ]).draw(false);
                        });



                        // $.unblockUI();
                    } else {
                        alert('No Dealers Found');
                        // $.unblockUI();
                    }
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                    // $.unblockUI();
                }
            });
        } else {
            alert("Please select a dealer and month");
            // $.unblockUI();
        }
    }

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

</html>