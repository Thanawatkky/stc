<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>STC ONLINE</title>

</head>
<body>
    
    <div id="loader" class="vh-100 d-flex justify-content-center align-items-center position-relative opacity-25 hidden" style="background-color: #ccc;">
        <div class="spinner-border text-secondary m-auto d-block" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div id="content">
        
    <?php 
            include('navbar.php');
        ?>

        <?php 
            if (isset($_REQUEST['p'])) {
                include($_REQUEST['p']. '.php');
            }else {
        ?>

        <?php 
            include('dashboard.php');
            }
        ?>

        <?php 
            include('footer.php');
        ?>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#content").addClass("d-none");
            setTimeout(() => {
                $("#content").removeClass("d-none");
                $("#loader").addClass("d-none");
            }, 800);
        })
    </script>
</body>
</html>