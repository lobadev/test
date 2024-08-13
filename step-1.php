<?php

require "helpers/helper-functions.php";
require "helpers/validation-functions.php";

session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $data = [
        'fullname' => $fullname,
        'email' => $email,
        'password' => $password
    ];

    validate_form_data($data, $errors);

    if (empty($errors)) {
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = password_hash($password, PASSWORD_DEFAULT);
        header("Location: step-2.php");
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
      Registration (Step 1/3)
      </h1>
      </div>
      <div class="p-section--shallow">

        <form action="step-1.php" method="POST">
            <fieldset>
                <label>Complete Name</label>
                <input type="text" name="fullname" placeholder="John Doe" value="<?php echo htmlspecialchars($_POST['fullname'] ?? '', ENT_QUOTES); ?>">
                <?php if (isset($errors['fullname'])) echo '<p style="color:red;">' . $errors['fullname'] . '</p>'; ?>

                <label>Email address</label>
                <input type="email" name="email" placeholder="example@canonical.com" autocomplete="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>">
                <?php if (isset($errors['email'])) echo '<p style="color:red;">' . $errors['email'] . '</p>'; ?>

                <label>Password</label>
                <input type="password" name="password" placeholder="******" autocomplete="current-password">
                <?php if (isset($errors['password'])) echo '<p style="color:red;">' . $errors['password'] . '</p>'; ?>

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
