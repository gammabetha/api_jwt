<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
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
        <div class="card-header">Login</div>
        <div class="card-body">
          <form id="loginForm">
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="button" class="btn btn-primary" id="loginBtn">Login</button>
            <button type="button" class="btn btn-success" id="registerBtn">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {
    $("#loginBtn").click(function () {
        var username = $("#username").val();
        var password = $("#password").val();
        var formData = $("#loginForm").serialize();
        var userData = {
              username: username,
              password: password
        };

        $.ajax({
            type: "POST",
            url: "<?= 'http://localhost/server_api_jwt/login'; ?>",
            data: userData,
            dataType: "json",
            success: function (response) {
                saveTokenToLocalStorage(response.access_token);
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Berhasil Login",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "<?php echo base_url('product'); ?>";
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

    $("#registerBtn").click(function () {
        window.location.href = "<?php echo base_url('auth/register'); ?>";
    })
  });


</script>

</body>
</html>
