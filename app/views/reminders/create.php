<?php require_once 'app/views/templates/header.php'?>
<style>
    body {
        background-image: url('https://images-assets.nasa.gov/image/PIA01539/PIA01539~orig.jpg?w=1479&h=1159&fit=clip&crop=faces%2Cfocalpoint');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    .breadcrumb .breadcrumb-item a {
        color: white; 
        text-decoration: none; 
      }

      .breadcrumb .breadcrumb-item::before {
        color: white;
      }

      .breadcrumb .breadcrumb-item.active {
        color: #bbb; 
      }

      .breadcrumb .breadcrumb-item a:hover {
        color: #ddd; 
      } 
</style>
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/reminders">Reminders</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Create</li>
                  </ol>
                </nav>
                <h1 style="color: white">Create a reminder</h1>
                
            </div>
        </div>
    </div>

<section>
    <div class="vh-50">
        <div class="container py-2 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div style="border-radius: 1rem; background-color: #6c757d;">
                        <div class="card-body p-5 text-center">
                            
                            <h1 class="mb-4" style="color: white">Create a Reminder</h1>
                            <form action="/reminders/new_reminder" method="post" >
                            <fieldset>
                              <div data-mdb-input-init class="form-outline mb-3">

                                <input required type="text" class="form-control form-control-lg" name="subject" placeholder="Reminder">
                              </div>
                              

                                <button type="submit" class="btn btn-primary btn-lg">Create Reminder</button>
                            </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <?php require_once 'app/views/templates/footer.php' ?>