<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dealers Reconciliation |
        <?php echo $_SESSION['user_name']; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PUMA" name="description" />
    <meta content="PUMA" name="author" />

    <!-- Ensure the jQuery and SweetAlert scripts are loaded securely -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

    <!-- Include your CSS and other scripts -->
    <?php include 'css_script.php'; ?>
</head>

<body>
    <div id="layout-wrapper">
        <!-- Include the layout components -->
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Main content -->
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
                            <h3>Reconciliation Analyzing Report</h3>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12" style="overflow: auto;">
                                        <!-- <button id="exportButton" class="btn btn-success">Export to Excel</button> -->

                                        <table id="recon_table" style="width:100%" class="table table-bordered">
                                            <thead>
                                                <!-- <tr>
                                                    <th colspan="9"></th>
                                                    <th colspan="6" class="table-active text-center">Diesel</th>
                                                    <th colspan="6" class="table-success text-center">Gasoline</th>
                                                    <th colspan="6" class="table-success text-center">Gasoline 95</th>
                                                </tr> -->
                                                <tr>
                                                    <th>S #</th>
                                                    <th>Site</th>
                                                    <th>TM</th>
                                                    <!-- <th>Territory</th> -->
                                                    <th>Region</th>
                                                    <th>Product </th>
                                                    <th>Tank Behaviour</th>
                                                    <th>External Dumping</th>
                                                    <th>External Upliftment</th>
                                                    <!-- <th>Opening Date</th>
                                                    <th>Closing Date</th> -->
                                                    <th>No of Days</th>
                                                    <th>Daily Sales-L</th>
                                                    <th>Opening Stock</th>
                                                    <th>Physical Stock</th>
                                                    <th>Receipts</th>
                                                    <th>Sales</th>
                                                    <th>Book</th>
                                                    <th>Variance</th>
                                                    <th>Variance %</th>
                                                    <th>Remark</th>
                                                    

                                                </tr>
                                            </thead>
                                            <tbody id="data-table-body">
                                                <!-- Data will be populated here by JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" id="dealer_recon_container" style="overflow: auto;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>

    <!-- Overlay for right sidebar -->
    <div class="rightbar-overlay"></div>

    <!-- Offcanvas sidebar for reconciliation form -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasRightLabel">Reconciliation</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid">
                <div class="form-row mb-4">
                    <div class="form-group col-md-12">
                        <label for="dealers" class="col-md-2 col-form-label">TM</label>
                        <input type="checkbox" id="selectAllTm"> Select All

                        <select class="w-100 multiple_select" id="dealers" name="dealers[]" multiple="multiple"
                            required>
                            <!-- <option value="">Select TM</option> -->
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="products" class="col-md-2 col-form-label">Products</label>
                        <select class="w-100 form-control" id="products" name="products[]" required>
                            <option value="">Select Product</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="from" class="col-md-2 col-form-label">From</label>
                        <input type="date" class="form-control" id="from" name="from" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="to" class="col-md-2 col-form-label">To</label>
                        <input type="date" class="form-control" id="to" name="to" required>
                    </div>
                </div>
                <div class="col-12">
                    <input type="hidden" name="row_id" id="row_id" value="0">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-10 col-form-label"></label>
                        <div class="col-md-12 text-center">
                            <input class="btn rounded-pill btn-primary" type="button" onclick="getRecon_new()"
                                name="insert" id="insert" value="Save">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include additional scripts -->
    <?php include 'script_tags.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>

    <script>
    var recon_table = '';

    $(document).ready(function() {
        all_dealers();
        all_products();
        initializeDataTable();
        $('.multiple_select').select2();
        // $("#exportButton").click(function() {
        //     var now = new Date();
        //     var formattedDateTime = formatDateTime(now);
        //     var wb = XLSX.utils.table_to_book(document.getElementById('recon_table'), {
        //         sheet: "Sheet1"
        //     });
        //     XLSX.writeFile(wb, 'Recon-Report-' + formattedDateTime + '.xlsx');


        // });

        $('#add_btn').click(function() {
            $('#row_id').val("");
        });
        $('#selectAllTm').change(function() {
            if ($(this).is(':checked')) {
                // Select all options
                $('#dealers > option').prop('selected', true);
                $('#dealers').trigger('change'); // Update the Select2 dropdown
            } else {
                // Deselect all options
                $('#dealers > option').prop('selected', false);
                $('#dealers').trigger('change'); // Update the Select2 dropdown
            }
        });

        // $("#dealers").select2(); // Initialize the select2 for dealers dropdown
    });

    function formatDateTime(date) {
        var year = date.getFullYear();
        var month = ("0" + (date.getMonth() + 1)).slice(-2);
        var day = ("0" + date.getDate()).slice(-2);
        var hours = ("0" + date.getHours()).slice(-2);
        var minutes = ("0" + date.getMinutes()).slice(-2);
        var seconds = ("0" + date.getSeconds()).slice(-2);
        return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
    }

    function all_dealers() {
        fetch(
                "<?php echo $api_url; ?>get/get_asm.php?key=03201232927&pre=<?php echo $_SESSION['privilege'] ?>&user_id=<?php echo $_SESSION['user_id'] ?>"
            )
            .then(response => response.json())
            .then(response => {
                response.forEach(data => {
                    $('#dealers').append(new Option(data.name, data.id)).trigger('change');
                });
            })
            .catch(error => console.log('Error fetching dealers:', error));
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
                var products_name = $("#products");



                $.each(result, function(index, data) {
                    console.log('all products')
                    console.log(data.name)
                    products_name.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));


                });
            })
            .catch(error => console.log('error', error));
    }

    async function getRecon_new() {
        var dealers = $('#dealers').val();
        var from = $('#from').val();
        var to = $('#to').val();
        var products = $('#products').val();

        $('#dealer_recon_container').empty(); // Clear previous results
        recon_table.clear().draw(); // Clear the table

        if (dealers.length > 0 && from !== "" && to !== "") {
            blocking(); // Block the UI while processing

            try {
                var di = 1; // Counter for row numbers

                for (var i = 0; i < dealers.length; i++) {
                    let tm_id = dealers[i];

                    // Fetch dealer information for each dealer
                    let dealerData = await $.ajax({
                        url: `<?php echo $api_url; ?>get/all_dealers_department_users.php?key=03201232927&is_role=0&user_id=${tm_id}`,
                        method: 'GET',
                        dataType: 'json'
                    });

                    if (dealerData.length > 0) {
                        for (const item of dealerData) {
                            let dealer_id = item.id;

                            // Fetch recon data for each dealer and product
                            try {
                                console.log(
                                    `<?php echo $api_url; ?>get/get_dealers_recons_product_wise_new.php?key=03201232927&dealer_id=${dealer_id}&from=${from}&to=${to}&products=${products}&tm_id=${tm_id}`
                                );
                                let reconResponse = await fetch(
                                    `<?php echo $api_url; ?>get/get_dealers_recons_product_wise_new.php?key=03201232927&dealer_id=${dealer_id}&from=${from}&to=${to}&products=${products}&tm_id=${tm_id}`
                                );

                                let reconData = await reconResponse.json();

                                if (reconData.length > 0) {
                                    // Populate the table with recon data
                                    reconData.forEach((data, index) => {

                                        recon_table.row.add([
                                            di,
                                            data.site,
                                            data.tm,
                                            // data.territory,
                                            data.region,
                                            data.product_name,
                                            // data.opening_date,
                                            // data.closing_date,
                                            `<span style="color: transparent;">${data.tank_beharior}</span>
        ${(data.tank_beharior === false) 
            ? '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpYbUIFfRi0gF6G2i5iC3NasuR-00Cvn8fLg&s" alt="description" width="10" height="10">' 
            : '<img src="https://i.pinimg.com/736x/ae/39/6e/ae396e7d69a673158406ce2359206097.jpg" alt="description" width="10" height="10">'}`,

                                            // Updated condition for 'external_dumping' with dynamic image URL
                                            `<span style="color: transparent;">${data.external_dumping}</span>
        ${(data.external_dumping === false) 
            ? '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpYbUIFfRi0gF6G2i5iC3NasuR-00Cvn8fLg&s" alt="description" width="10" height="10">' 
            : '<img src="https://i.pinimg.com/736x/ae/39/6e/ae396e7d69a673158406ce2359206097.jpg" alt="description" width="10" height="10">'}`,

                                            // Updated condition for 'external_upliftment' with dynamic image URL
                                            `<span style="color: transparent;">${data.external_upliftment}</span>
        ${(data.external_upliftment === false) 
            ? '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpYbUIFfRi0gF6G2i5iC3NasuR-00Cvn8fLg&s" alt="description" width="10" height="10">' 
            : '<img src="https://i.pinimg.com/736x/ae/39/6e/ae396e7d69a673158406ce2359206097.jpg" alt="description" width="10" height="10">'}`,
                                            data.no_os_days,
                                            data.daily_sales,
                                            data.opening_stock,
                                            data.physical_stock,
                                            data.receipts,
                                            data.sales,
                                            data.book_stock,
                                            data.variance,
                                            data.variance_percentage,
                                            data.remark,
                                           
                                            // data.tank_beharior,
                                            // data.external_dumping,
                                            // data.external_upliftment
                                        ]).draw(false);
                                        di++; // Increment row counter
                                    });
                                }
                            } catch (error) {
                                console.error('Error fetching recon data:', error);
                            }
                        }
                    } else {
                        alert('No Dealers Found');
                    }
                }
            } catch (error) {
                console.error('Error fetching dealer data:', error);
            } finally {
                // replaceText();  // Replace any specific text in the document if necessary
                $.unblockUI(); // Unblock the UI after all operations are complete
            }
        } else {
            alert("Please select all required fields (dealers, dates, and products).");
            $.unblockUI(); // Unblock UI if input validation fails
        }
    }


    function initializeDataTable() {
        recon_table = $('#recon_table').DataTable({
            ordering: false,
            dom: 'Bfrtip',
            pageLength: 50,
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ],
            initComplete: function() {
                // Add search input to the first 4 columns
                this.api().columns([1, 2, 3, 4,5,6,7]).every(function() {
                    var column = this;
                    var input = $('<input type="text" placeholder="Search">').appendTo($(column
                            .header()))
                        .on('keyup change', function() {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                });
            },
            createdRow: function(row, data, dataIndex) {
                // Assuming the 15th column contains tank_beharior
                // if (data[15] === true) {
                //     // If true, set the background color to green
                //     $('td', row).eq(15).css('background-color', 'green');
                // } else {
                //     // Otherwise, set the background color to white
                //     $('td', row).eq(15).css('background-color', 'white');
                // }
            }
        });
    }


    function blocking() {
        $.blockUI({
            message: '<div class="spinner-border text-primary" role="status"></div>',
            overlayCSS: {
                backgroundColor: '#ffffff',
                opacity: 0.8
            },
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: 'transparent',
                color: '#fff',
                width: '100px',
                height: '100px'
            }
        });
    }

    function replaceText() {
        function replaceInTextNodes(element) {
            element.contents().each(function() {
                if (this.nodeType === Node.TEXT_NODE) {
                    this.nodeValue = this.nodeValue
                        .replace(/PMG/gi, 'Gasoline')
                        .replace(/HSD/gi, 'Diesel');
                } else if (this.nodeType === Node.ELEMENT_NODE) {
                    replaceInTextNodes($(this));
                }
            });
        }

        replaceInTextNodes($('body'));
    }
    </script>
</body>

</html>