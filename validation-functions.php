<?php
function validate_form_data($data, &$errors) {
    foreach ($data as $key => $value) {
        if (empty($value)) {
            $errors[$key] = 'This field is required.';
        }
    }
}
?>
