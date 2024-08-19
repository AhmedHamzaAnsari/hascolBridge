<?php

$currnt_date = $_GET['from'];
$tommorrow = $_GET['to'];

$active_class = 0;
$category_html = '';
$product_html = '';
$modal_zoom = '';

$total_trips = 0;
$withtracker = 0;
$withouttracker = 0;

$curl = curl_init();

curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => 'http://151.106.17.246:8080/hascolbridgeApis/get/puma_sap_order/get_sap_order_data.php?key=03201232927&from=' . $currnt_date . '&to=' . $tommorrow . '',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    )
);

$response = curl_exec($curl);

$array = json_decode($response, true);

// print_r($response);

foreach ($array as $category) {
    $current_tab = "";
    $current_content = "";
    if (!$active_class) {
        $active_class = 1;
        $current_tab = 'active';
        $current_content = 'in active';
    }
    $total_trips++;
    if ($category['tracker_status'] == 'With-Tracker') {
        $withtracker++;

    } else {
        $withouttracker++;


    }

    // echo $category['order_no'];
    $category_html .= '<a class="nav-link border border-dark ' . $current_tab . ' mb-3" id="v-line-pills-home-tab' . $category['id'] . '"
        data-toggle="pill" href="#v-line-pills-home' . $category['id'] . '" role="tab"
        aria-controls="v-line-pills-home' . $category['id'] . '" aria-selected="true">
        <div class="container-fluid my-3">
            <div class="row ">
                <div class="col-md-3" style="">
                    <i class="fa fas fa-truck-moving" style="font-size:12px"></i>
                </div>
                <div class="col-md-9 text-left " style="margin: auto;font-size:12px;font-weight: bold;color:#3e3ea7;">
                    ' . $category['vehicle_name'] . '</div>
            </div>
            <div class="row ">
                <div class="col-md-3" style="">
                    <i class="fa fas fa-user" style="font-size:12px"></i>
                </div>
                <div class="col-md-9 text-left " style="margin: auto;font-size:12px;font-weight: bold;color:#3e3ea7;">
                    ' . $category['depot_name'] . '</div>
            </div>
            <div class="row ">
                <div class="col-md-3" style="">
                    <i class="fa fa-shopping-cart" style="font-size:12px"></i>
                </div>
                <div class="col-md-9 text-left " style="margin: auto;font-size:12px;font-weight: bold;color:#3e3ea7;">
                    ' . $category['order_no'] . '</div>
            </div>
            <div class="row  ">
                <div class="col-md-3" style="">
                    <i class="fa fas fa-route" style="font-size:12px"></i>
                </div>
                <div class="col-md-9 text-left " style="margin: auto;font-size:12px;">' . $category['tracker_status'] . ' Trips
                </div>
            </div>
            <div class="row  ">
                <div class="col-md-3" style="">
                    <i class="fa fas fa-clock" style="font-size:12px"></i>
                </div>
                <div class="col-md-9 text-left " style="margin: auto;font-size:12px;">' . $category['created_at'] . ' 
                </div>
            </div>
            <div class="row  ">
                <div class="col-md-3" style="">
                    <i class="fa fas fa-box" style="font-size:12px"></i>
                </div>
                <div class="col-md-9 text-left " style="margin: auto;font-size:12px;">' . $category['product_name'] . ' - ' . number_format(floatval($category['quantity']))  . ' - ' . $category['rate'] . '</div>
            </div>
        </div>
    </a>';

    $product_html .= '<div class="tab-pane fade show  ' . $current_content . '" id="v-line-pills-home' . $category["id"] . '" role="tabpanel" aria-labelledby="v-line-pills-home-tab' . $category["id"] . '">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table mb-4">
                        <thead>
                            <tr>
                            <th>Site Name</th>
                            <th>JD Code</th>
                            <th>Material</th>
                            <th>Order #</th>
                            <th>Invoice #</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Driver Sign</th>
                            <th>Shortage</th>
                            <th>Status</th>
                            <th>Map</th>
                            <th>Distance</th>
                            <th>Active Time</th>
                            <th>ETA</th>
                            <th>Close Time</th>
                            </tr>
                        </thead>
                        <tbody>';

    $cat_id = $category["id"];
    $order_no = $category["order_no"];
    $tracker_status = $category["tracker_status"];

    $sub_data = get_sub($order_no);
    $product_detail = json_decode($sub_data, true);

    foreach ($product_detail as $product) {
        $sub_id = $product["sub_id"];
        $salesapNo = '';
        $salesapstatus = $product["status"];
        $current_status = $product["current_status"];

        $map_btn = '<button type="button" class=" btn btn-outline-info btn-rounded mb-2" style="width: max-content;font-size: 12px;padding: 2px 12px;" onclick="my_markers(' . $sub_id . ',' . $salesapNo . ');"> Focused
        On Map</button>';
        $status_btn = ($tracker_status == 'With-Tracker') ? $map_btn : "---";
        $product_rate = is_numeric($product["product_rate"]) ? $product["product_rate"] : 0;
        $quantity = is_numeric($product["quantity"]) ? $product["quantity"] : 0;

        // Calculate the total
        $total = $product_rate * $quantity;

        // Output the total
        // echo $total;
        $shortage_json = $product["product_json"];
        $quantity_less_L = '---';
        // Decode JSON string to PHP array

        $sign = '';
        if ($product["sign"] != "" || $category['tracker_status'] == 'With-Tracker Trips') {
            $sign = '<a href="http://151.106.17.246:8080/hascolbridgeApis/uploads/' . $product["sign"] . '" target="_blank">View Sign</a>';
            $data = json_decode($shortage_json, true);

            // Check if json_decode succeeded
            if (json_last_error() === JSON_ERROR_NONE) {
                // Access the first element in the array and get the value of quantity_less_L
                $quantity_less_L = $data[0]['quantity_less_L'];

                // Output the value
                // echo 'quantity_less_L: ' . $quantity_less_L;
            } else {
                // Handle JSON decode error
                // echo 'JSON decode error: ' . json_last_error_msg();
                $quantity_less_L = '---';
            }

        } else {
            $sign = '---';
        }
        // echo $quantity_less_L;
        $product_html .= '<tr style="background-color:#FFF">
                                <td class="text-center">' . $product["name"] . '</td>
                                <td>' . $product["dealer_sap"] . '</td>
                                <td>' . $product["product_name"] . '</td>
                                <td>' . $product["order_no"] . '</td>
                                <td>' . $product["invoice"] . '</td>
                                <td>' . number_format(floatval($product["quantity"])) . '</td>
                                <td>' . $product["product_rate"] . '</td>
                                <td>' . number_format(floatval($total)) . '</td>
                                <td>' . $sign . '</td>
                                <td>' . $quantity_less_L . '</td>
                                <td>' . $current_status . '</td>
                                <td>' . $status_btn . '</td>
                                <td>' . $product["distance"] . '</td>
                                <td>' . $product["start_time"] . '</td>
                                <td>' . $product["eta"] . '</td>
                                <td>' . $product["close_time"] . '</td>'
        ;
    }

    $product_html .= '</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="clear_both"></div>
    </div>';
}

curl_close($curl);

function get_sub($id)
{
    $curl = curl_init();
    // echo 'http://151.106.17.246:8080/hascolbridgeApis/get/puma_sap_order/get_sap_order_subtripdata.php?key=03201232927&id=' . $id . '';
    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => 'http://151.106.17.246:8080/hascolbridgeApis/get/puma_sap_order/get_sap_order_subtripdata.php?key=03201232927&id=' . $id . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        )
    );

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}

?>