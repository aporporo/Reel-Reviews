<?php require_once 'app/views/templates/header.php' ?>

<style>
    .hero-image {
      background-image: url("https://images.unsplash.com/photo-1513106580091-1d82408b8cd6?q=80&w=2076&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
      background-color: #cccccc;
      
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }

    

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
    
</style>

<div class="hero-image position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
      <h1 class="display-3 fw-bold " style="color: white">Community for movie lovers</h1>
      <h3 class="fw-normal mb-3"  style="color: white">Find and rate any movie you want</h3>
      
    </div>
    
  </div>
<div class="container marketing">

    


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">Gemini API. <span class="text-body-secondary">Google's largest and most capable AI model.</span></h2>
        <p class="lead">Reviews are enhanced with the magic of Gemini.</p>
      </div>
      <div class="col-md-5">
        <img src="https://miro.medium.com/v2/resize:fit:1400/1*-KkJmzvv3jNhh88TWxIBJg.png" alt="Generic placeholder image" width="300" height="300">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading fw-normal lh-1">The Open Movie Database. <span class="text-body-secondary">A RESTful web service to obtain movie information.</span></h2>
        <p class="lead">Users can search for any movie thanks to the expansive database available at OMDb API</p>
      </div>
      <div class="col-md-5 order-md-1">
          <img src="https://avatars.githubusercontent.com/u/30566448?v=4" width="300" height="300">
      </div>
    </div>

    

    <!-- /END THE FEATURETTES -->

  </div>
    
    

    

    <?php require_once 'app/views/templates/footer.php' ?>
