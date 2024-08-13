<?php

require "helpers/helper-functions.php";
require "helpers/validation-functions.php";

session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $birthdate = trim($_POST['birthdate']);
    $sex = trim($_POST['sex']);
    $address = trim($_POST['address']);

    $data = [
        'birthdate' => $birthdate,
        'sex' => $sex,
        'address' => $address
    ];

    validate_form_data($data, $errors);

    if (empty($errors)) {
        $_SESSION['birthdate'] = date("F d Y", strtotime($birthdate));
        $_SESSION['sex'] = $sex;
        $_SESSION['address'] = $address;
        header("Location: step-3.php");
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
          Registration (Step 2/3)
        </h1>
      </div>
      <div class="p-section--shallow">

        <form action="step-2.php" method="POST">
          <fieldset>
            <label>Birthdate</label>
            <input type="date" name="birthdate" value="<?php echo htmlspecialchars($_POST['birthdate'] ?? '', ENT_QUOTES); ?>">
            <?php if (isset($errors['birthdate'])) echo '<p style="color:red;">' . $errors['birthdate'] . '</p>'; ?>

            <label>Sex</label>
            <br />
            <input type="radio" name="sex" value="male" <?php echo (isset($_POST['sex']) && $_POST['sex'] === 'male') ? 'checked' : ''; ?>>Male
            <br />
            <input type="radio" name="sex" value="female" <?php echo (isset($_POST['sex']) && $_POST['sex'] === 'female') ? 'checked' : ''; ?>>Female
            <br />
            <?php if (isset($errors['sex'])) echo '<p style="color:red;">' . $errors['sex'] . '</p>'; ?>

            <label>Complete Address</label>
            <textarea name="address" rows="3"><?php echo htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES); ?></textarea>
            <?php if (isset($errors['address'])) echo '<p style="color:red;">' . $errors['address'] . '</p>'; ?>

            <button type="submit">Next</button>
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
