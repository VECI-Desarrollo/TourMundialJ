<div>
    <link href="{{ asset('css/estiloCuentas.css') }}" rel="stylesheet">
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="CuentasDeposito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cuentas de deposito </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">



              <div class="wrapper">
                <div class="title">
                  <p >  CUENTAS CORRIENTES : Operadora de Turismo S.A.

                    RUT:96.952.300-0

                    EMAIL : contabilidad4@tourmundia.cl</p>
                </div>
                <div class="tabs_wrap">
                  <ul>
                    <li data-tabs="cls" class="active" ><small>DEPOSITOS EN PESOS</small></li>
                    <li data-tabs="usd"><small> EN DOLARES AMERICANOS </small></li>
                    <li data-tabs="eur" ><small>DEPOSITOS EN EUROS</small></li>
                  </ul>
                </div>
                <div class="container">
                  <ul >
                    <li class="item_wrap cls">
                      <div class="item">
                        <div class="item_left">

                          <div class="data">
                            <p class="name">Banco Santander
                               <br>  Cuenta Corriente N°: 0-000-6155070-4</p>
                               <p class="name">Banco ITAU
                                <br>  Cuenta Corriente N°: 0210464950</p>

                          </div>
                        </div>

                      </div>
                    </li>


                    <li class="item_wrap usd ">
                      <div class="item">
                        <div class="item_left">

                          <div class="data">
                            <p class="name">Banco Santander
                                <br> Cuenta Corriente N°: 0-051-0005848-2</p>
                                <p class="name">Banco ITAU
                                 <br> Cuenta Corriente N°: 1200196079</p>
                          </div>
                        </div>

                      </div>
                    </li>


                    <li class="item_wrap eur">
                      <div class="item">
                        <div class="item_left">

                          <div class="data">
                            <p class="name">Banco Santander
                                <br> Cuenta Corriente N°: 0-051-0005849-0</p>
                                <p class="name">Banco ITAU
                                 <br> Cuenta Corriente N°: 1200196089</p>
                          </div>
                        </div>

                      </div>
                    </li>
                  </ul>
                </div>
              </div>


          </div>

          </div>
        </div>
      </div>
    </div>



    <style>



    </style>

    <script>

        var tabs = document.querySelectorAll(".tabs_wrap ul li");
        var cls = document.querySelectorAll(".cls");
        var usd = document.querySelectorAll(".usd");
        var eur = document.querySelectorAll(".eur");
        var all = document.querySelectorAll(".item_wrap");

        // Agrega la clase "active" al primer elemento li
        tabs[0].classList.add("active");

        ///// establece todos lo elementos li como none
        var all = document.querySelectorAll(".item_wrap");
        for (var i = 0; i < all.length; i++) {
          all[i].style.display = "none";
        }

        // Obtiene el valor del atributo "data-tabs" del primer elemento li y muestra los elementos correspondientes
        var firstTabVal = tabs[0].getAttribute("data-tabs");
        if (firstTabVal === "cls") {
            cls.forEach((cl) => {
                cl.style.display = "block";
            });
        }


        tabs.forEach((tab) => {
            tab.addEventListener("click", () => {
                tabs.forEach((tab) => {
                    tab.classList.remove("active");
                });
                tab.classList.add("active");
                var tabval = tab.getAttribute("data-tabs");

                all.forEach((item) => {
                    item.style.display = "none";
                });

                if (tabval === "cls") {
                    cls.forEach((cl) => {
                        cl.style.display = "block";
                    });
                } else if (tabval === "usd") {
                    usd.forEach((us) => {
                        us.style.display = "block";
                    });
                } else if (tabval === "eur") {
                    eur.forEach((eu) => {
                        eu.style.display = "block";
                    });
                } else {
                    all.forEach((item) => {
                        item.style.display = "block";
                    });
                }
            });
        });

    </script>

</div>


