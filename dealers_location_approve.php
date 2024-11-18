<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Products | <?php echo $_SESSION['user_name']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNyJWb04pByaU1CTmimoWNl3b86VV6qZ8&callback=initMap&libraries=drawing&v=weekly"
        defer></script>

    <!-- Include CSS Scripts -->
    <?php include 'css_script.php'; ?>

    <style>
    .gm-ui-hover-effect {
        display: none !important;
    }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'header.php'; ?>
        <!-- Left Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- Right Sidebar -->
        <?php include 'right_siebar.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="map-canvas" style="width: 100%; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>

    <div class="rightbar-overlay"></div>

    <!-- Include Additional JavaScript Scripts -->
    <?php include 'script_tags.php'; ?>

    <script>
    let map, gmarkers = [],
        circle, flightPath;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map-canvas"), {
            center: {
                lat: 24.8607,
                lng: 67.0011
            },
            zoom: 6
        });

        var req_loc = "<?php echo $_GET['id']; ?>";
        console.log('<?php echo $api_url; ?>get/get_dealer_location_request.php?key=03201232927&id=' + req_loc);

        $.ajax({
            url: '<?php echo $api_url; ?>get/get_dealer_location_request.php?key=03201232927&id=' + req_loc,
            type: 'POST',
            success: function(data) {
                console.log(data);
                $.each(data, function(index, item) {
                    var id = item.id;
                    var consignee = item.name;
                    var coordinates = item.coordinates;
                    var created_by = item.username;
                    var created_at = item.created_at;

                    var coords = coordinates.split(',');
                    marker_creation(parseFloat(coords[0].trim()), parseFloat(coords[1].trim()),
                        consignee, created_by, created_at, id);
                });
            }
        });
    }

    function marker_creation(lat, lng, consignee, created_by, created_at, id) {
        const image = "https://www.freeiconspng.com/uploads/fuel-pump-icon-23.png";
        var position = new google.maps.LatLng(lat, lng);

        var marker = new google.maps.Marker({
            position: position,
            map: map,
            icon: {
                url: image,
                scaledSize: new google.maps.Size(40, 40)
            }
        });

        map.setCenter(position);
        map.setZoom(15);

        var infowindow = new google.maps.InfoWindow({
            content: '<p>Details:</p>' +
                '<p>Request By: ' + created_by + '</p>' +
                '<p>Request At: ' + created_at + '</p>' +
                '<p>Consignee #: ' + consignee + '</p>' +
                '<button onclick="updateLocation(' + id +
                ')" class="btn btn-info" id="insert">Update Location</button>'
        });

        infowindow.open(map, marker);

        // Keep the info window open even if the user clicks elsewhere on the map
        google.maps.event.addListener(map, 'click', function() {
            infowindow.open(map, marker);
        });
    }

    function updateLocation(id) {
        const isConfirmed = confirm("Are you sure you want to update the location?");
        if (isConfirmed) {
            if (id ) {
                var user_id = "<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>";

                if (!user_id) {
                    Swal.fire('Error!', 'User ID is not available in session.', 'error');
                    return;
                }

                $.ajax({
                    url: "<?php echo $api_url; ?>update/update_dealer_location.php?id="+id+"&user_id="+user_id+"",
                    method: "GET",
                    cache: false,
                    beforeSend: function() {
                        $('#insert').val("Saving...").prop("disabled", true);
                    },
                    success: function(data) {
                        console.log(data);
                        if (data != 1) {
                            Swal.fire('Server Error!', 'Record Not Updated', 'error');
                            $('#insert').val("Save").prop("disabled", false);
                        } else {
                            Swal.fire('Success!', 'Record Updated Successfully', 'success');
                            setTimeout(function() {
                                window.location.href = "dealer_location_request.php";
                            }, 2000);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                        console.error("AJAX Error:", status);
                        console.error("AJAX Error:", xhr);
                        Swal.fire('Error!', 'Something went wrong while updating the location.', 'error');
                        $('#insert').val("Save").prop("disabled", false);
                    }
                });
            } else {
                Swal.fire('Invalid Input', 'The ID provided is empty or invalid.', 'warning');
            }
        }
    }
    </script>
</body>

</html>