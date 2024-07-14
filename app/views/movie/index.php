<?php require_once 'app/views/templates/header.php' ?>

<style>
    .col-md-7 {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;

    }

    .col-md-5 {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .featurette {
        padding: 1rem 0;
    }
</style>
<div class="container">
    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">Check out some movies. <span class="text-body-secondary">Rate and review!</span></h2>
        <p class="lead">Below are just some of the movies you can search and learn more about.</p>
      </div>
      <div class="col-md-5">
        <img src="https://images.unsplash.com/photo-1472457847783-3d10540b03d7?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" width="474" height="316">
      </div>
    </div>

    <hr class="featurette-divider">

    <h1 class="display-5">Just some of our movies</h1>
    
        
    <div class="row row-cols-1 row-cols-md-3 g-4">
        
        <div class="col">
            <div class="card h-100">
                <form action="/movie/search" method="post" id="search-movie">
                    <input type="hidden" name="search" value="<?php echo $data['movie1']['Title'] ?>">
                    <a href="#" onclick="document.getElementById('search-movie').submit();"><img src="<?php echo $data['movie1']['Poster'] ?>" class="card-img-top"></a>
                </form>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['movie1']['Title'] ?></h5>
                    <p class="card-text"><?php echo $data['movie1']['Plot'] ?></p>
                </div>
            </div>
        </div>
      <div class="col">
        <div class="card h-100">
            <form action="/movie/search" method="post" id="search-movie2">
                <input type="hidden" name="search" value="<?php echo $data['movie2']['Title'] ?>">
                <a href="#" onclick="document.getElementById('search-movie2').submit();"><img src="<?php echo $data['movie2']['Poster'] ?>" class="card-img-top"></a>
            </form>
          <div class="card-body">
            <h5 class="card-title"><?php echo $data['movie2']['Title'] ?></h5>
            <p class="card-text"><?php echo $data['movie2']['Plot'] ?></p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
            <form action="/movie/search" method="post" id="search-movie3">
                <input type="hidden" name="search" value="<?php echo $data['movie3']['Title'] ?>">
                <a href="#" onclick="document.getElementById('search-movie3').submit();"><img src="<?php echo $data['movie3']['Poster'] ?>" class="card-img-top"></a>
            </form>
          <div class="card-body">
            <h5 class="card-title"><?php echo $data['movie3']['Title'] ?></h5>
            <p class="card-text"><?php echo $data['movie3']['Plot'] ?></p>
          </div>
        </div>
      </div>
        </form>
      </div>
    </div>
        


    <?php require_once 'app/views/templates/footer.php' ?>