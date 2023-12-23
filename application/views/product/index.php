<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Produk</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<style>
    .logout-btn {
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>

<div class="container mt-5">
    <button onclick="logout()" class="btn btn-primary logout-btn">Logout</button>
    <button onclick="tambah()" class="btn btn-success">Tambah Data</button>
    <div class="list-barang"></div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var jwtToken = getTokenFromLocalStorage();

    $(document).ready(function () {
        if (jwtToken) {
            getProduct();
        } else {
            window.location.href = "<?php echo base_url('front/auth/login'); ?>";
        }
    });

    function logout() {
        localStorage.removeItem('jwtToken');
        location.reload();
    }

    function getTokenFromLocalStorage() {
        return localStorage.getItem('jwtToken');
    }

    function showCardItem({ name, price, id }) {
        return `
    <tr>
        <td>${name}</td>
        <td>${price}</td>
        <td><button class="btn btn-primary" onclick="ubah_data('${id}')">Ubah</button>
        <button class="btn btn-danger" onclick="hapus_data('${id}')">Hapus</button></td>
    </tr>`;
    }

    function ubah_data(id) {
        window.location.href = `<?php echo base_url('front/product/ubah'); ?>/${id}`
    }

    function hapus_data(id) {
        $.ajaxSetup({
            headers: {
                'Authorization': jwtToken,
            }
        });

        $.ajax({
            type: "DELETE",
            url: `<?php echo base_url('product'); ?>/${id}`,
            dataType: "json",
            success: function (response) {
                console.log("Data deleted successfully:", response);
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Data Berhasil Dihapus",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function () {
                    window.location.href = "<?php echo base_url('front/product'); ?>";
                });
            },
            error: function (error) {
                console.error("Error deleting data:", error);
            }
        });
    }


    function getProduct() {
        $.ajaxSetup({
            headers: {
                'Authorization': jwtToken
            }
        });
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('product'); ?>",
            data: {},
            dataType: "json",
            success: function (response) {
                console.log(response);

                let item = "";
                response.forEach(element => {
                    item += showCardItem(element);
                });

                if (!item) item = "<tr><td colspan='3'>Barang Tidak Tersedia!</td></tr>";
                console.log(item);
                $(".list-barang").html(`
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${item}
                    </tbody>
                </table>`);
            },
            error: function (error) {
                console.error("Error regrestrasi:", error);
            }
        });
    }

    function tambah() {
        window.location.href = "<?php echo base_url('front/product/tambah'); ?>"
    }
</script>
</body>
</html>
