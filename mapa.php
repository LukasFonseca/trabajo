<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JQVMap - Mapa Argentina</title>

  <link href="../dist/jqvmap.css" media="screen" rel="stylesheet" type="text/css"/>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../dist/jquery.vmap.js"></script>
  <script type="text/javascript" src="../dist/maps/jquery.vmap.argentina.js" charset="utf-8"></script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script>
    jQuery(document).ready(function () {
      jQuery('#vmap').vectorMap({
        map: 'argentina_en',
        hoverColor: '#F66193',
        selectedColor: '#F00353',
        borderOpacity: 0.5,
        borderWidth: 1,
        enableZoom: true,
        onRegionClick: function (element, code, region) {
          //MOSTRAR CARD CON INFO DE REGION
          var region_name = region;
          var region_code = code;
          var region_info = '<p class="card-text">' + region_name + '</p>';
          jQuery('#region_info').html(region_info);
        }
      });
    });
  </script>

  <script>
    // Filter table
      $(document).ready(function(){
        $("#tableSearch").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $(".accordion").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
  </script>

  <style>
    .card-body span{
      font-weight: 600;
    }
    .card-body p{
      font-weight: 600;
    }
    .card-header span{
      font-weight: 600;
      font-size: 1em;
    }
    path {
      transition: 0.35s;
    }
    path:hover {
      opacity: 1;
      transform: scale(1);
      transform: translateY(-1%);
    }
  </style>
</head>

  <body>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-4">
            <div id="vmap" style="width: 100%; height: 700px;"></div>
          </div>
          <div class="col-md-8">
            <div class="row">
              <div class="container">
                <div class="col-md-12" style="padding-bottom: 30px">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Provincia seleccionada</h3>
                    </div>
                    <div class="card-body">
                      <p id="region_info" class="card-text text-uppercase">
                        Seleccione una provincia para más información          
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <span class="card-title text-uppercase">Agencias multimarcas relevadas: 157</span>
                    </div>
                    <!-- Buscador de localidades -->
                    <div class="container">
                      <div class="pt-4">
                        <input class="form-control mb-4" id="tableSearch" type="text" placeholder="Buscador de localidad">
                      </div>
                    </div>

                    <div class="accordion" id="accordionExample1">
                      <div class="card">
                        <div class="card-header" id="headingOne1">
                          <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                              JUNIN
                            </button>
                          </h5>
                        </div>

                        <div id="collapseOne1" class="collapse" aria-labelledby="headingOne1" data-parent="#accordionExample1">
                          <div class="card">
                            <div class="card-header" id="headingOne1">
                              <h5 class="mb-0">
                                <button class="btn btn-link text-align-center" type="button" data-toggle="collapse" data-target="#collapseOne11" aria-expanded="true" aria-controls="collapseOne11">
                                  LUCIA "CAPA DE OZONO" BELLOME
                                </button> 
                            </div>
                            <div id="collapseOne11" class="collapse" aria-labelledby="headingOne11" data-parent="#accordionExample11">
                              <div class="card-body">
                                <a href="#" style="color: black;"><img style="width: 15px;" src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="btn-wpp"> Consultar</a>
                                <button class="btn btn-primary ml-4" href="#" style="color: black;">Ver perfil</button>
                              </div>
                            </div>
                          </div>

                          <div class="card">
                            <div class="card-header" id="headingOne1">
                              <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne33" aria-expanded="true" aria-controls="collapseOne33">
                                  DANI "EL CARNICERO MIMOSO"
                                </button>
                              </h5>
                            </div>
                            <div id="collapseOne33" class="collapse" aria-labelledby="headingOne33" data-parent="#accordionExample33">
                              <div class="card-body">
                                <a href="#" style="color: black;"><img style="width: 15px;" src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="btn-wpp"> Consultar</a>
                                <button class="btn btn-primary ml-4" href="#" style="color: black;">Ver perfil</button>
                              </div>
                            </div>
                          </div>

                          <div class="card">
                            <div class="card-header" id="headingOne1">
                              <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne22" aria-expanded="true" aria-controls="collapseOne22">
                                  JOACO "EL PIQUETERO REBELDE" GOMEZ
                                </button>
                              </h5>
                            </div>
                            <div id="collapseOne22" class="collapse" aria-labelledby="headingOne11" data-parent="#accordionExample22">
                              <div class="card-body">
                                <a href="#" style="color: black;"><img style="width: 15px;" src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="btn-wpp"> Consultar</a>
                                <button class="btn btn-primary ml-4" href="#" style="color: black;">Ver perfil</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="card">
                        <div class="card-header" id="headingOne1">
                          <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                              BRAGADO
                            </button>
                          </h5>
                        </div>

                        <div id="collapseOne1" class="collapse" aria-labelledby="headingOne1" data-parent="#accordionExample1">
                          <div class="card">
                            <div class="card-header" id="headingOne1">
                              <h5 class="mb-0">
                                <button class="btn btn-link text-align-center" type="button" data-toggle="collapse" data-target="#collapseOne11" aria-expanded="true" aria-controls="collapseOne11">
                                  DANI "CAPA DE OZONO" BASEOTTO
                                </button> 
                            </div>
                            <div id="collapseOne11" class="collapse" aria-labelledby="headingOne11" data-parent="#accordionExample11">
                              <div class="card-body">
                                <a href="#" style="color: black;"><img style="width: 15px;" src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="btn-wpp"> Consultar</a>
                                <button class="btn btn-primary ml-4" href="#" style="color: black;">Ver perfil</button>
                              </div>
                            </div>
                          </div>

                          <div class="card">
                            <div class="card-header" id="headingOne1">
                              <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne33" aria-expanded="true" aria-controls="collapseOne33">
                                  JOACO "EL PIQUETERO REBELDE" GOMEZ
                                </button>
                              </h5>
                            </div>
                            <div id="collapseOne33" class="collapse" aria-labelledby="headingOne33" data-parent="#accordionExample33">
                              <div class="card-body">
                                <a href="#" style="color: black;"><img style="width: 15px;" src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="btn-wpp"> Consultar</a>
                                <button class="btn btn-primary ml-4" href="#" style="color: black;">Ver perfil</button>
                              </div>
                            </div>
                          </div>

                          <div class="card">
                            <div class="card-header" id="headingOne1">
                              <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne22" aria-expanded="true" aria-controls="collapseOne22">
                                  LUCIA "CAPA DE OZONO" BELLOME
                                </button>
                              </h5>
                            </div>
                            <div id="collapseOne22" class="collapse" aria-labelledby="headingOne11" data-parent="#accordionExample22">
                              <div class="card-body">
                                <a href="#" style="color: black;"><img style="width: 15px;" src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="btn-wpp"> Consultar</a>
                                <button class="btn btn-primary ml-4" href="#" style="color: black;">Ver perfil</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <span class="card-title text-uppercase">Agencias oficiales relevadas: 17</span>
                    </div>
                      
                    <div class="accordion" id="accordionExample3">
                      <div class="card">
                        <div class="card-header" id="headingOne3">
                          <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="true" aria-controls="collapseOne3">
                              ALBERTI AUTOMOTORES
                            </button>
                          </h5>
                        </div>
                        <div id="collapseOne3" class="collapse" aria-labelledby="headingOne3" data-parent="#accordionExample3">
                          <div class="card-body">
                            <a href="#" style="color: black;"><img style="width: 15px;" src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="btn-wpp"> Consultar</a>
                            <button class="btn btn-primary ml-4" href="#" style="color: black;">Ver perfil</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="accordion" id="accordionExample4">
                      <div class="card">
                        <div class="card-header" id="headingOne4">
                          <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="true" aria-controls="collapseOne4">
                              ALBERTI AUTOMOTORES
                            </button>
                          </h5>
                        </div>
                        <div id="collapseOne4" class="collapse" aria-labelledby="headingOne4" data-parent="#accordionExample4">
                          <div class="card-body">
                            <a href="#" style="color: black;"><img style="width: 15px;" src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="btn-wpp"> Consultar</a>
                            <button class="btn btn-primary ml-4" href="#" style="color: black;">Ver perfil</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>