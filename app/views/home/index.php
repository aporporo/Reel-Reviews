<?php require_once 'app/views/templates/header.php' ?>


<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1 style="color: white">Welcome, <?php echo $_SESSION['username'] ?></h1>
                <p class="lead" style="color: white"> <?= date("F jS, Y"); ?></p>

                
            </div>
        </div>
    </div>

    

    <div class="row">
        <div class="col-lg-12">
            <p> <a href="/logout">Click here to logout</a></p>
        </div>
    </div>

    <br>

    

    <?php require_once 'app/views/templates/footer.php' ?>
