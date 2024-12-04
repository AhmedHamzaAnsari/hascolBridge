<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Recon Report |
        <?php echo $_SESSION['user_name']; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Byco" name="description" />
    <meta content="Byco" name="author" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php include 'css_script.php'; ?>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 10px;
    }


    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
        font-size: 10px;
    }

    th {
        background-color: #f2f2f2;
        font-size: 10px;
    }

    .product-table {
        margin-bottom: 40px;
    }
</style>

<body>
    <div id="layout-wrapper">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>

        <?php include 'right_siebar.php'; ?>

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
                            <h3>Dealers Reconciliation</h3>
                            <div class="container-fluid">
                                <button id="export-excel" class="btn btn-primary">Export to Excel</button>
                                <button class="btn btn-primary" id="exportBtn">Export to
                                    PDF</button>
                                <div class="row mt-4">

                                    <div class="col-md-12" id="table-container"></div>
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
            <h5 id="offcanvasRightLabel">Recon</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid">
                <div class="form-row mb-4">
                    <div class="form-group col-md-12">
                        <label for="dealers" class="col-md-2 col-form-label">Dealers</label>
                        <select class="w-100 form-control" id="dealers" name="dealers[]" required>
                            <option value="">Select</option>
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
                            <input class="btn rounded-pill btn-primary" type="button" onclick="get_recon()"
                                name="insert" id="insert" value="Save">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'script_tags.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <script>
        var table;
        var type;
        var subtype;

        $(document).ready(function () {
            all_dealers();
            // $('.multiple_select').select2();



            $('#export-excel').click(function () {
                var currentDate = new Date();
                var formattedDate = currentDate.toLocaleString();

                var wb = XLSX.utils.table_to_book(document.getElementById('table-container'));
                XLSX.writeFile(wb, 'Recon-Report-' + formattedDate + '.xlsx');
            });
        });




        function all_dealers() {
            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };

            fetch("<?php echo $api_url; ?>get/dealers.php?key=03201232927&pre=<?php echo $_SESSION['privilege'] ?>&user_id=<?php echo $_SESSION['user_id'] ?>",
                requestOptions)
                .then(response => response.json())
                .then(response => {
                    $.each(response, function (index, data) {
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

        function get_recon() {
            event.preventDefault();
            var dealers = $('#dealers').val();
            var from = $('#from').val();
            var to = $('#to').val();
            $('#table-container').empty();
            if (dealers != "" && from != "" && to != "") {


                var requestOptions = {
                    method: 'GET',
                    redirect: 'follow'
                };
                // console.log("<?php echo $api_url; ?>get/get_datewise_dealer_recon.php?key=03201232927&dealer_id=" +
                //     dealers +
                //     "&from=" + from + "&to=" + to)

                fetch("<?php echo $api_url; ?>get/get_datewise_dealer_recon_with_firstday_new.php?key=03201232927&dealer_id=" +
                    dealers +
                    "&from=" + from + "&to=" + to, requestOptions)
                    .then(response => response.json())
                    .then(response => {

                        if (response.length > 0) {

                            $.each(response, function (index, data) {

                                createTable(data);

                            });
                        } else {

                            $('#table-container').append('No Recon Found');
                        }


                    })
                    .catch(error => console.log('error', error));

            } else {
                $('#table-container').append('Data Not Founds');

            }
        }
        function createTable(product) {
            var container = $('<div class="product-table"></div>');

            var table = $('<table></table>');
            var thead = $('<thead></thead>');
            var tbody = $('<tbody></tbody>');

            // Create a unique list of nozzles
            var nozzlesMap = {};
            var totalnozzlesMap = {};

            product.recons.forEach(function (recon) {
                JSON.parse(recon.nozzel).forEach(function (nozzle) {
                    if (!nozzlesMap[nozzle.name]) {
                        nozzlesMap[nozzle.name] = {};
                    }
                });

                JSON.parse(recon.is_totalizer_data).forEach(function (nozzle) {
                    if (!totalnozzlesMap[nozzle.name]) {
                        totalnozzlesMap[nozzle.name] = {};
                    }
                });
            });

            // Product and Dealer Information Header
            thead.append(
                $('<tr></tr>')
                    .append($('<th></th>').text('Site'))
                    .append($('<td></td>').text(product.dealer_name))
                    .append($('<th></th>').text('Product'))
                    .append($('<td></td>').text(product.product_name))
            );

            // Date Headers
            var headerRow = $('<tr></tr>').append($('<th></th>').text('Nozzle Name'));
            product.dates.forEach(function (date) {
                headerRow.append($('<th></th>').text(date.planed_date));
            });
            headerRow.append($('<th></th>').text('Total'));
            thead.append(headerRow);
            table.append(thead);

            // Populate Nozzle Map with Opening and Closing Values
            var first_noz = 0;
            product.recons.forEach(function (recon) {
                JSON.parse(recon.nozzel).forEach(function (nozzle) {
                    var dateStr = product.dates.find(d => first_noz === 0 || d.id === recon.task_id).planed_date;
                    nozzlesMap[nozzle.name][dateStr] = first_noz === 0 ? nozzle.opening : nozzle.closing;
                });
                first_noz++;
            });

            var total_first_noz = 0;
            product.recons.forEach(function (recon) {
                JSON.parse(recon.is_totalizer_data).forEach(function (nozzle) {
                    var dateStr = product.dates.find(d => total_first_noz === 0 || d.id === recon.task_id).planed_date;
                    totalnozzlesMap[nozzle.name][dateStr] = total_first_noz === 0 ? nozzle.closing : nozzle.closing;
                });
                total_first_noz++;
            });

            // Generate Rows for Nozzles and Totalizer Changes
            [nozzlesMap, totalnozzlesMap].forEach(function (map, index) {
                Object.keys(map).forEach(function (nozzleName) {
                    var row = $('<tr></tr>');
                    row.append($('<td></td>').text(index === 0 ? nozzleName : `${nozzleName} Totalizer Changed`));
                    var totalSum = 0;

                    product.dates.forEach(function (date) {
                        var closing = map[nozzleName][date.planed_date] || '-';
                        row.append($('<td></td>').text(closing));
                        if (closing !== '-') totalSum += parseFloat(closing);
                    });

                    row.append($('<td></td>').text(""));
                    tbody.append(row);
                });
            });

            // Helper function for adding data rows
            function addDataRow(title, key, sumCallback = null, extraCalculation = null) {
                var row = $('<tr></tr>').append($('<th></th>').text(title));
                var totalSum = 0;

                product.dates.forEach(function (date) {
                    var recon = product.recons.find(r => r.task_id === date.id);
                    var value = recon ? parseFloat(recon[key] || 0) : 0;
                    row.append($('<td></td>').text(value.toFixed(2)));
                    totalSum += value;
                });

                if (extraCalculation) {
                    totalSum = extraCalculation(totalSum);
                }

                row.append($('<td></td>').text(totalSum.toFixed(2)));
                tbody.append(row);

                return totalSum;
            }
            var totalSalesSum = addDataRow('Total Sales', 'total_sales');
            ['Dip', 'Stocks'].forEach(function (metric, isStock) {
                var row = $('<tr></tr>').append($('<th></th>').text(metric));
                var totalSum = 0;
                var first = true;

                product.dates.forEach(function (date) {
                    var recon = product.recons.find(r => first || r.task_id === date.id);
                    var tanks = recon ? JSON.parse(recon.tanks || '[]') : [];
                    var sum = tanks.reduce((acc, tank) => acc + parseFloat(tank[isStock ? (first ? 'opening' : 'closing') : (first ? 'opening_dip' : 'closing_dip')] || 0), 0);

                    row.append($('<td></td>').text(sum.toFixed(2)));
                    totalSum += sum;
                    first = false;
                });

                row.append($('<td></td>').text(totalSum.toFixed(2)));
                tbody.append(row);
            });
            // Add Data Rows for Metrics
          
            addDataRow('Receipts', 'total_recipt');
            addDataRow('Book Stock', 'book_value');
            var totalVariance = addDataRow('Variance', 'variance');
            addDataRow('Var %', 'variance_of_sales', null, () => (totalVariance / totalSalesSum) * 100);
            var totalDays = addDataRow('Days', 'total_days');
            addDataRow('P/D Sale', 'average_daily_sales', null, () => totalSalesSum / totalDays);

            // Dip and Stock Calculations
           

            table.append(tbody);
            container.append(table);
            $('#table-container').append(container);
        }


        function getPDF() {
            var currentDate = new Date();

            // Format the date as needed
            var formattedDate = currentDate.toLocaleString();
            var element = document.getElementById('table-container');
            var opt = {
                margin: 0.5, // Decrease the margin
                filename: 'Recon-Report-' + formattedDate + '.pdf',
                image: {
                    type: 'text',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2 // Adjust scale for better resolution
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A4',
                    orientation: 'landscape',
                    userUnit: 1.0 // Disable text selection
                }
            };

            html2pdf().from(element).set(opt).save();
            $('#exportBtn').prop('disabled', false);

            setTimeout(function () {
                $('#exportBtn').text('Export PDF');
            }, 2000);



        };

        // Attach click event to the export button
        $('#exportBtn').on('click', function () {
            console.log("Click");
            $('#exportBtn').prop('disabled', true).text('Downloading');

            getPDF();
        });
    </script>
</body>

</html>