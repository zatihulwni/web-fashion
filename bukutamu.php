<?php 
// Include config file 
require_once "config.php"; 
 
// Define variables and initialize with empty values 
$nama = $email = $judul = $pesan =""; 
$nama_err = $email_err = $judul_err = $pesan_err = ""; 
 
// Processing form data when the form is submitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Validate Judul 
    $input_nama = trim($_POST["nama"]); 
    if (empty($input_nama)) { 
        $nama_err = "Masukkan nama."; 
    } else { 
        $nama = $input_nama; 
    } 
 
    // Validate Pengarang 
    $input_email = trim($_POST["email"]); 
    if (empty($input_email)) { 
        $email_err = "Masukkan email."; 
    } else { 
        $email = $input_email; 
    } 
 
    // Validate Tahun Terbit 
    $input_judul = trim($_POST["judul"]); 
    if (empty($input_judul)) { 
        $judul_err = "Masukkan judul."; 
    } else { 
        $judul = $input_judul; 
    } 
 
     // Validate Tahun Terbit 
     $input_pesan = trim($_POST["pesan"]); 
     if (empty($input_pesan)) { 
         $pesan_err = "Masukkan pesan."; 
     } else { 
         $pesan = $input_pesan; 
     } 
 
 
    // Check input errors before inserting into the database 
    if (empty($nama_err) && empty($email_err) && empty($judul_err) && empty($pesan_err)) { 
        // Prepare an insert statement 
        $sql = "INSERT INTO Buku (nama, email, judul, pesan) VALUES (?, ?, ?, ?)"; 
 
        if ($stmt = mysqli_prepare($link, $sql)) { 
            // Bind variables to the prepared statement as parameters 
            mysqli_stmt_bind_param($stmt, "ssss", $param_nama, $param_email, $param_judul, $param_pesan); 
 
            // Set parameters 
            $param_nama = $nama; 
            $param_email = $email; 
            $param_judul = $judul; 
            $param_pesan = $pesan; 
 
            // Attempt to execute the prepared statement 
            if (mysqli_stmt_execute($stmt)) { 
                // Records created successfully. Redirect to the landing page 
                header("location: bukutamu.php"); 
                exit(); 
            } else { 
                echo "Something went wrong. Please try again later."; 
            } 
        } 
 
        // Close statement 
        mysqli_stmt_close($stmt); 
    } 
 
    // Close connection 
    mysqli_close($link); 
} 
?> 
 
 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="bootstrap-5.1.3-dist\css\bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-6.0.0-web\css\all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Alkalami' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="style.css">
<style>
    body{
        background-image: url(img1/A5.jpg);
        font-family: 'Alkalami';font-size: 22px;
    }
</style>
</head>
<body> 
    <?php
    include 'navbar.php';
?>

    <!--Buku Tamu--->
  <div class="wrapper" id=#artikel> 
        <div class="container py-5 mt-5"> 
            <div class="row"> 
                <div class="col-md-12"> 
                    <div class="page-header"> 
                        <h2>Buku Tamu</h2> 
                    </div> 
                    <p>silahkan masukkan data anda</p> 
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                        <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>"> 
                            <label>Nama</label> 
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>"> 
                            <span class="help-block"><?php echo $nama_err;?></span> 
                        </div> 
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>"> 
                            <label>Email</label> 
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>"> 
                            <span class="help-block"><?php echo $email_err;?></span> 
                        </div> 
                        <div class="form-group <?php echo (!empty($judul_err)) ? 'has-error' : ''; ?>">

                            <label>Judul</label> 
                            <input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>"> 
                            <span class="help-block"><?php echo $judul_err;?></span> 
                        </div> 
                        <div class="form-group <?php echo (!empty($pesan_err)) ? 'has-error' : ''; ?>"> 
                        <label>Pesan</label> 
                        <textarea name="pesan" class="form-control"><?php echo $pesan; ?></textarea> 
                        <span class="help-block"><?php echo $pesan_err; ?></span> 
                        </div> 
 
                       <div class="mt-3"> 
                        <input type="submit" class="btn btn-danger" value="Send Message">
                        <a href="view.php" class="btn btn-danger">View</a> 
                    </form> 
                </div> 
            </div> 
        </div> 
    </div> 
    <!--end Buku Tamu-->




</body> 
</html>