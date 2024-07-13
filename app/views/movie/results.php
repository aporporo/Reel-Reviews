
<?php require_once 'app/views/templates/header.php' ?>

<style>
    .list-inline {
      display:block;
      
    }
    .list-inline li {
      display:inline-block;
    }
    .list-inline li:not(:last-child)::after {
      content:'|';
      margin:0 10px;
    }

    .icon {
        width: 50px;
        height: 50px;
    }

    @media (max-width: 768px) {
        .icon {
            width: 40px;
            height: 40px;
        }

        .ratings-row {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .ratings-row .col-lg-3 {

            flex: 0 0 auto;
            width: auto;
            text-align: center;
        }

        .col-md-6 {
            text-align: center;
        }

        .list-inline {
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .icon {
            width: 30px;
            height: 30px;
        }

        .ratings-row {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .ratings-row .col-lg-3 {
            
            flex: 0 0 auto;
            width: auto;
            text-align: center;
        }

        .col-md-6 {
            text-align: center;
        }

        .list-inline {
            text-align: center;
        }

        
        
    }

    .page-header {
        margin-top:20px;
    }
    section {
        margin-top:30px;
    }
    

    .bi-star {
        transition: fill 0.3s ease;
    }
    .bi-star:hover {
        fill: #FF8C00;
    }

    .modal-body {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .form-check-inline {
        text-align: center;
    }

    
    
    
</style>
<div class="container">
    <div class="page-header" id="banner">
        
        <div class="row border-bottom justify-content-between">
            <div class="col-md-6">
                <h1 class="display-4"><?php echo $data['movie']['Title'] ?></h1>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        
                        <?php echo $data['movie']['Year'] ?>
                    </li>
                    <li class="list-inline-item">
                        <?php echo $data['movie']['Rated'] ?>
                    </li>
                    <li class="list-inline-item">
                        <?php echo $data['movie']['Runtime'] ?>
                     </li>
                    
                    
                </ul>
            </div>
            <div class="col-md-5 d-flex align-items-center justify-content-end ratings-row">
                <div class="row">
                    <div class="col-6 col-sm-3 col-lg-3 text-center">
                        
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cc/IMDb_Logo_Square.svg/128px-IMDb_Logo_Square.svg.png?20200218171646" alt="IMDb Logo" class="icon"></img>
                        <br>
                        <?php echo $data['movie']['imdbRating']?>/10
                    </div>
                    <div class="col-6 col-sm-3 col-lg-3 text-center">
                        
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/Metacritic.svg/88px-Metacritic.svg.png?20150314054830" alt="IMDb Logo" class="icon"></img>
                        <br>
                        <?php echo $data['movie']['Metascore']?>
                    </div>
                    <div class="col-6 col-sm-3 col-lg-3 text-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Rotten_Tomatoes_alternative_logo.svg/144px-Rotten_Tomatoes_alternative_logo.svg.png?20180315205910" alt="IMDb Logo" class="icon"></img>
                        
                        <br>
                        <?php echo $data['movie']['Ratings'][1]->Value?>
                    </div>
                    <div class="col-6 col-sm-3 col-lg-3 text-center">
                        <a class="d-block text-body-emphasis text-decoration-none" data-bs-toggle="modal" href="#exampleModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-star icon" viewBox="0 0 16 16">
                              <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                            </svg>
                            <br>
                            Rate
                        </a>
                        

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="/movie/rating/" method="post">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $data['movie']['Title'] ?> - Your Rating!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body justify-content-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1" value="1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value="2">
                              <label class="form-check-label" for="inlineRadio2" value="2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value="3">
                              <label class="form-check-label" for="inlineRadio3" value="3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value="4">
                              <label class="form-check-label" for="inlineRadio4" value="4">4</label>
                            </div>
                        <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value="5">
                              <label class="form-check-label" for="inlineRadio5" value="5">5</label>
                        </div>
        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    
                    
            
                </form>
            </div>
            </div>
        </div>
        <section id="main-content">
            <div class="row">
                <div class="col-lg-4 text-center mb-3">
                    <img src="<?php echo $data['movie']['Poster'] ?>"></img>
                </div>
                <div class="col-lg-8 d-flex flex-column justify-content-center">
                    <div class="d-flex">
                        <p class="lead">
                            <?php echo $data['movie']['Plot'] ?>
                        </p>
                    </div>
                    
                    <div class="d-flex">
                        <dl class="row">
                            <dt class="col-sm-3">
                                Genre
                            </dt>
                            <dd class="col-sm-9"><?php echo $data['movie']['Genre'] ?></dd>
                            <dt class="col-sm-3">
                                Director
                            </dt>
                            <dd class="col-sm-9"><?php echo $data['movie']['Director'] ?></dd>
                            <dt class="col-sm-3">
                                Writer
                            </dt>
                            <dd class="col-sm-9"><?php echo $data['movie']['Writer'] ?></dd>
                            <dt class="col-sm-3">
                                Actors
                            </dt>
                            <dd class="col-sm-9"><?php echo $data['movie']['Actors'] ?></dd>
                            <dt class="col-sm-3">
                                Language
                            </dt>
                            <dd class="col-sm-9"><?php echo $data['movie']['Language'] ?></dd>
                            <dt class="col-sm-3">
                                Country
                            </dt>
                            <dd class="col-sm-9"><?php echo $data['movie']['Country'] ?></dd>
                            <dt class="col-sm-3">
                                Awards
                            </dt>
                            <dd class="col-sm-9"><?php echo $data['movie']['Awards'] ?></dd>
                            <dt class="col-sm-3">
                                Released
                            </dt>
                            <dd class="col-sm-9"><?php echo $data['movie']['Released'] ?></dd>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="review-content">
            <h1 class="display-6">Reviews</h1>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <div class="card border-light mb-3" style="max-width: 30rem;">
                      <div class="card-header">Header</div>
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $data['review'][0][0] ?>/5</h5>
                        <p class="card-text"><?php echo $data['review'][1][0] ?></p>
                      </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-light mb-3" style="max-width: 30rem;">
                      <div class="card-header">Header</div>
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $data['review'][0][1] ?>/5</h5>
                          <p class="card-text"><?php echo $data['review'][1][1] ?></p>
                      </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-light mb-3" style="max-width: 30rem;">
                      <div class="card-header">Header</div>
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $data['review'][0][2] ?>/5</h5>
                          <p class="card-text"><?php echo $data['review'][1][2] ?></p>
                      </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-light mb-3" style="max-width: 30rem;">
                      <div class="card-header">Header</div>
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $data['review'][0][3] ?>/5</h5>
                          <p class="card-text"><?php echo $data['review'][1][3] ?></p>
                      </div>
                    </div>
                </div>
            </div>
        </section>
            
    </div>

    



    

    



    <?php require_once 'app/views/templates/footer.php' ?>