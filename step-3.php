<?php

require "helpers/helper-functions.php";
require "helpers/validation-functions.php";

session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact_number = trim($_POST['contact_number']);
    $program = trim($_POST['program']);
    $agree = isset($_POST['agree']) ? true : false;

    $data = [
        'contact_number' => $contact_number,
        'program' => $program,
        'agree' => $agree
    ];

    validate_form_data($data, $errors);

    if (!$agree) {
        $errors['agree'] = 'You must agree to the terms and conditions.';
    }

    if (empty($errors)) {
        $_SESSION['contact_number'] = $contact_number;
        $_SESSION['program'] = $program;
        $_SESSION['agree'] = $agree;
        header("Location: thank-you.php");
        exit();
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />   
</head>
<body>

<section class="p-section--hero">
  <div class="row--50-50-on-large">
    <div class="col">
      <div class="p-section--shallow">
        <h1>
          Registration (Step 3/3)
        </h1>
      </div>
      <div class="p-section--shallow">

        <form action="step-3.php" method="POST">
          <fieldset>
            <label>Contact Number</label>
            <input type="text" name="contact_number" placeholder="+639123456789" value="<?php echo htmlspecialchars($_POST['contact_number'] ?? '', ENT_QUOTES); ?>" />
            <?php if (isset($errors['contact_number'])) echo '<p style="color:red;">' . $errors['contact_number'] . '</p>'; ?>

            <label>Program</label>
            <select name="program">
              <option disabled="disabled" selected="">Select an option</option>
              <option value="cs" <?php echo (isset($_POST['program']) && $_POST['program'] === 'cs') ? 'selected' : ''; ?>>Computer Science</option>
              <option value="it" <?php echo (isset($_POST['program']) && $_POST['program'] === 'it') ? 'selected' : ''; ?>>Information Technology</option>
              <option value="is" <?php echo (isset($_POST['program']) && $_POST['program'] === 'is') ? 'selected' : ''; ?>>Information Systems</option>
              <option value="se" <?php echo (isset($_POST['program']) && $_POST['program'] === 'se') ? 'selected' : ''; ?>>Software Engineering</option>
              <option value="ds" <?php echo (isset($_POST['program']) && $_POST['program'] === 'ds') ? 'selected' : ''; ?>>Data Science</option>
            </select>
            <?php if (isset($errors['program'])) echo '<p style="color:red;">' . $errors['program'] . '</p>'; ?>

            <label class="p-checkbox--inline">
            <input type="checkbox" name="agree" <?php echo isset($_POST['agree']) ? 'checked' : ''; ?>>
            </label>
            I agree to the terms and conditions...
            <?php if (isset($errors['agree'])) echo '<p style="color:red;">' . $errors['agree'] . '</p>'; ?>

            <br />
            <br />

            <button type="submit" class="p-button--positive">Finish</button>
          </fieldset>
        </form>

      </div>
    </div>

    <div class="col">
      <div class="p-image-container--3-2 is-cover">
        <img class="p-image-container__image" src="https://www.auf.edu.ph/home/images/ittc.jpg" alt="">
      </div>
    </div>

  </div>
</section>

</body>
</html>
