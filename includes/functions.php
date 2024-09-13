<?php
// Path to the JSON data file
define('DATA_FILE', __DIR__ . '/../data/iot_data.json');

/**
 * Get the current IoT data from the JSON file.
 *
 * @return array
 */
function getIotData() {
    if (!file_exists(DATA_FILE)) {
        return [];
    }
    $json = file_get_contents(DATA_FILE);
    return json_decode($json, true) ?: [];
}

/**
 * Update the status of an IoT device by its ID.
 *
 * @param string $id
 * @param string $status
 * @return void
 */
function updateIotStatus($id, $status) {
    $iot_data = getIotData();
    $updated = false;
    foreach ($iot_data as &$iot) {
        if ($iot['id'] === (int)$id) {
            $iot['status'] = $status;
            $updated = true;
            break;
        }
    }
    if ($updated) {
        file_put_contents(DATA_FILE, json_encode($iot_data, JSON_PRETTY_PRINT));
    }
}
?>
