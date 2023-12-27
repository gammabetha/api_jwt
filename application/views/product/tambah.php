<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Product</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <h3>Tambah Data</h3><hr>
    </div>
    <div class="col-md-12">
      <form id="form-tambah">
        <div class="form-group">
          <label for="productName">Nama Produk</label>
          <input type="text" class="form-control" id="productName">
        </div>
        <div class="form-group">
          <label for="productPrice">Harga</label>
          <input type="text" class="form-control" id="productPrice">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" id="back" class="btn btn-success">Kembali</button>
      </form>
    </div>
  </div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>

  var jwtToken=getTokenFromLocalStorage();
  
  $(document).ready(function () {
      
  })
  
  function getTokenFromLocalStorage() {
    return localStorage.getItem('jwtToken');
  }

    $("#form-tambah").submit(function (event) {
      event.preventDefault();

      var formData = {
        name: $("#productName").val(),
        price: $("#productPrice").val()
      };

      $.ajaxSetup({
            headers: {
              'Authorization': jwtToken,
              name: $("#productName").val(),
              price: $("#productPrice").val()
            }
          });
    
      $.ajax({
        type: "POST", 
        url: `http://localhost/server_api_jwt/product`, 
        data: formData,
        dataType: "json",
        success: function (response) {
          console.log("Data ditambahkan successfully:", response);
          Swal.fire({
                position: "center",
                icon: "success",
                title: "Data Berhasil Ditambahkan",
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = "<?php echo base_url('product'); ?>";
            });
        },
        error: function (error) {
          console.error("Error tambah data:", error);
        }
      });
    });

    $("#back").click(function () {
      window.location.href = `<?php echo base_url('product'); ?>`
    })
  </script>
</body>
</html>
