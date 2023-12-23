<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Registration Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <!-- Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">Register</div>
        <div class="card-body">
          <form id="registerForm">
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password: <span class="text-danger">(Min 6 characters)</span></label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="button" class="btn btn-primary" id="registerBtn">Simpan</button>
            <button type="button" class="btn btn-success" id="loginBtn">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
  
  $("#loginBtn").click(function () {
    window.location.href = "<?php echo base_url('front/auth/login'); ?>";
  })

  $("#password").on("input", function () {
      var passwordLength = $(this).val().length;
      if (passwordLength < 6) {
          $(this).addClass("is-invalid");
      } else {
          $(this).removeClass("is-invalid");
      }
  });
  
  $("#password").on("input", function () {
      var passwordLength = $(this).val().length;
      if (passwordLength < 6) {
          $(this).addClass("is-invalid");
      } else {
          $(this).removeClass("is-invalid");
      }
  });

  $("#email").on("input", function () {
    var emailValue = $(this).val();
    if (emailValue.length < 6 || emailValue.indexOf('@') === -1) {
        $(this).addClass("is-invalid");
    } else {
        $(this).removeClass("is-invalid");
    }
  });



  $("#registerBtn").click(function () {
    var email = $("#email").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var formData = $("#registerForm").serialize();
    var userData = {
        email: email,
        username: username,
        password: password
    };

    $.ajax({
        type: "POST",
        url: "<?php echo base_url('register'); ?>",
        data: userData,
        dataType: "json",
        success: function (response) {
            saveTokenToLocalStorage(response.access_token);
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Akun anda telah terdaftar, silahkan login",
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = "<?php echo base_url('front/auth/login'); ?>";
            });

        },
        error: function (error) {
          console.error("Error during registration:", error);
        }
      });

    });

    function saveTokenToLocalStorage(token) {
      localStorage.setItem('jwtToken', token);
    }

    function getTokenFromLocalStorage() {
        return localStorage.getItem('jwtToken');
    }

</script>

</body>
</html>
