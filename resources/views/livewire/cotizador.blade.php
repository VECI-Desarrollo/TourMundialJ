<div>



    <div class="container">
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

        <div class="py-5 text-center">


            <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


            <div x-data="{ activeCountry: 'fi-cl' }" id="countryBox">
                <i @click="activeCountry = 'fi-cl'" :class="{ 'active': activeCountry === 'fi-cl' }"
                    class="fi fi-cl fis rounded-circle fs-3 me-1" wire:click="switchCountry('cl')"></i>
                <i @click="activeCountry = 'fi-mx'" :class="{ 'active': activeCountry === 'fi-mx' }"
                    class="fi fi-mx fis rounded-circle fs-3 me-1" wire:click="switchCountry('mx')"></i>
            </div>
            <div wire:loading wire:target="switchCountry">
                <div class="lds-ellipsis">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>

            <style>
                #countryBox {}

                .fi {
                    cursor: pointer;
                    filter: grayscale(100%);
                    /* Por defecto, los iconos están en blanco y negro */
                }

                .active {
                    color: darkblue;
                    /* Color oscuro activo */
                    filter: grayscale(0%);
                    /* Icono activo en color */
                }

                .inactive {
                    color: lightgray;
                    /* Color desactivado */
                }
            </style>
            <img class="d-block mx-auto mb-4" src="img/logo.png">
            <h2>REGISTRO PAGO AGENCIAS DE VIAJES</h2>
            <p>Adjunte los datos del deposito o pago en WebPay para gestionar su reserva</p>

              @if($switchCountry === 152) 
      
            <p>
                <a target="_blank" href="https://www.webpay.cl/company/32574"
                    style="background-color: #4CAF50; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold;">
                    Link de pago con WebPay
                </a>
            </p>


            <div class="row">
                <div class="col-12 text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#CuentasDeposito">
                        Ver cuentas deposito
                    </button>
                    {{--  <a href="{{ route('RegistroPagos') }}" class="btn btn-primary">Panel de control</a>  --}}


                </div>
            </div>

        </div>
        @else
        <h5> No hay cuentas configuradas </h5>
        <br>
        <hr>

        @endif




        <div class="row g-5">
            <div class="col-md-7 col-lg-8">

                <div class="row g-3">

                    <!---Vendedor --->
                    <div class="col-sm-12">
                        <label for="salesman" class="form-label">Vendedor que maneja el expediente (*)</label>
                        <select wire:model="vendedor" class="form-select" required>
                            <option value="" selected>Seleccionar Vendedor...</option>
                            <?php
                            foreach ($vendedores as $row) {
                                $vendedor = $row->nombre;
                                echo '<option value=' . $row->id . '>' . $vendedor . '&nbsp;' . $row->apellido . '</option>';
                            }
                            ?>
                        </select>
                        @error('vendedor')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!---Agencia Pagadora --->
                    <div class="col-sm-12">
                        <label for="agency" class="form-label">Nombre de agencia pagadora (*)</label>
                        <input type="text" wire:model="nombreAgenciaPagadora" class="form-control" id="agency"
                            placeholder="Nombre de la Agencia" required>

                        @if (!is_null($agenciasPagadoras) && count($agenciasPagadoras))
                            <div id="menuDesp" class="mt-2"
                                style="max-height: 200px; overflow-y: scroll; background-color: white;">
                                @foreach ($agenciasPagadoras as $agenciaPagadora)
                                    <div wire:click="seleccionarAgenciaPagadora('{{ $agenciaPagadora->nombre }}')"
                                        style="padding: 5px; transition: background-color 0.3s ease;">
                                        {{ $agenciaPagadora->nombre }}</div>
                                @endforeach
                            </div>
                        @endif
                        @error('nombreAgenciaPagadora')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>



                    <!---Nombre del Agente de viajes --->
                    <div class="col-sm-12">
                        <label for="agency" class="form-label">Nombre del Agente de viajes (*)</label>
                        <input type="text" wire:model="nombreAgenteViajes" class="form-control" id="agente"
                            placeholder="Nombre del Agente de viajes" required>
                        @if (!is_null($agentesDeViajes) && count($agentesDeViajes))
                            <div id="menuDesp" class="mt-2"
                                style="max-height: 200px; overflow-y: scroll; background-color: white;">
                                @foreach ($agentesDeViajes as $agente)
                                    <div wire:click="seleccionarAgentesDeViajes('{{ $agente->nombre }}')"
                                        style="padding: 5px; transition: background-color 0.3s ease;">
                                        {{ $agente->nombre }}</div>
                                @endforeach
                            </div>
                        @endif


                        @error('nombreAgenteViajes')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>


                    <!--- Numero de expediente --->
                    <div class="col-sm-12">
                        <label for="expedient" class="form-label">Numero de expediente, ingresar solo los 8
                            digitos</label><br>
                        <div class="input-group">

                            <input type="text" class="form-control" id="expedient" wire:model="numeroExpediente"
                                aria-describedby="inputGroupExpedient" maxlength="8" required pattern="[0-9]{8}">

                            @if ($numeroExpediente)
                                <button class="btn btn-primary" type="button" wire:click.prevent="addInput">Agregar
                                    expediente</button>
                            @else
                                <button disabled class="btn btn-primary" type="button"
                                    wire:click.prevent="addInput">Agregar expediente</button>
                            @endif

                        </div>
                        <br>
                        <div class="container">
                            @foreach ($inputs as $key => $value)
                                <div class="d-inline-block col-3 m-2  position-relative">
                                    <div class="bg-light rounded p-2">{{ $value }}</div>

                                    <button class="btn btn-danger btn-sm position-absolute top-0 right-0 mt-2 mr-2"
                                        type="button" wire:click.prevent="removeInput({{ $key }})">X</button>

                                </div>
                            @endforeach
                        </div>

                        @error('numeroExpediente')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <hr>
                    <!--- Tipo de pago seccion--->
                    <div class="col-sm-12">
                        <label for="paymentType" class="form-label">Tipo de pago (*)</label>
                        <select wire:model="tipoPagoValor" class="form-select" id="paymentType" required>
                            <option value="" selected>Seleccionar tipo de pago...</option>
                            <?php
                            foreach ($tipoPago as $row) {
                                $tipoPago = $row->tipoPago;
                                echo "<option value=\"" . trim($tipoPago) . "\">" . $tipoPago . '&nbsp;&nbsp;&nbsp;' . '(' . $row->moneda . ')' . '</option>';
                            }
                            ?>
                        </select>
                        @error('tipoPagoValor')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- - secion hidden selec bancos/ se activa al selecionar deposito --}}
                    @if (stripos($tipoPagoValor, 'deposito') !== false)
                        <div class="col-sm-12">
                            {{--  {{ $productoPagado }}  --}}
                            <label for="banco" class="form-label">Selecione Banco </label>
                            <select wire:model.defer="banco" class="form-select">
                                <option value="" selected>Seleccionar banco..</option>
                                <?php
                                foreach ($listaBancos as $b) {
                                    echo "<option value=\"" . trim($b->nombre) . "\">" . $b->nombre . '</option>';
                                }
                                ?>
                            </select>
                            @error('productoPagado')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <!--- Tipo de pago end seccion--->

                    <div class="col-sm-12">
                        {{--  {{ $productoPagado }}  --}}
                        <label for="paidProduct" class="form-label">Producto pagado (*)</label>
                        <select wire:model.defer="productoPagado" class="form-select" required>
                            <option value="" selected>Seleccionar producto pagado...</option>
                            <?php
                            foreach ($tiposProducto as $t) {
                                $tipoProducto = $t->tipoProducto;
                                echo "<option value=\"" . trim($tipoProducto) . "\">" . $tipoProducto . '</option>';
                            }
                            ?>
                        </select>
                        @error('productoPagado')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{--  <div class="col-sm-12">
                            <label for="paymentCcurrency" class="form-label">Moneda de pago (*)</label>


                            <div class="form-check">
                                <input  wire:model="moneda" id="clp" value="CLP" name="paymentCurrency" type="radio" class="form-check-input" checked required>
                                <label class="form-check-label" for="credit">CLP</label>
                            </div>
                            <div class="form-check">
                                <input wire:model="moneda" id="usd" value="USD" name="paymentCurrency" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="debit">USD</label>
                            </div>
                            <div class="form-check">
                                <input wire:model="moneda" id="eur" value="EUR" name="paymentCurrency" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="paypal">EUR</label>
                            </div>
                            @error('moneda') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>  --}}

                    <div class="col-sm-12">
                        <label for="paymentAmount" class="form-label">Monto pagado en <span
                                id="referencePaymentCurrency">{{ $MonedaMontoPagado ? $MonedaMontoPagado : 'Seleccione tipo de pago' }}</span>
                            (*)</label>
                        <input wire:model.defer="monto" type="text" class="form-control" id="paymentAmount"
                            name="paymentAmount" placeholder="" oninput="formatAmount(this)" required>
                        @error('monto')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror

                    </div>

                    {{--  <div id="containerExchangeRate" class="col-sm-12 d-none">
                            <label for="exchangeRate" class="form-label">Tipo de cambio en CLP(*)</label>
                            <input type="text" class="form-control" id="exchangeRate" name="exchangeRate" placeholder="" value="">
                            <div>
                                <small id="conversion" class="text-secondary"></small>
                            </div>
                            <div class="invalid-feedback">
                                Favor ingresar tipo de cambio.
                            </div>
                        </div>  --}}

                    <div class="col-sm-12">
                        <label for="paymentDate" class="form-label">Fecha del deposito o pago con tarjeta de credito
                            (*)</label>

                        <input class="form-control" wire:model.defer="fechaDeposito" type="date" id="date"
                            name="date">
                        @error('fechaDeposito')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12">
                        <label for="php artisan serve
                            aymentFile"
                            class="form-label">Cargar el comprobante de TRANSBANK o deposito bancario "JPG, JPEG, PNG,
                            TIF o PDF"(*)</label>

                        <input type="file" id="comprobante" class="form-control" wire:model="comprobante"
                            accept="image/jpeg,image/jpg,image/png,image/webp,application/pdf">
                        @error('comprobante')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="col-sm-12">
                        <label for="php artisan serve
                            aymentFile"
                            class="form-label">Comentarios </label>

                        <textarea wire:model.defer="comentario_general" name="textarea" rows="7" rows="10" cols="50">Escribe tus comentarios</textarea>
                        @error('comprobante')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror

                    </div>


                    <!--
                        <div class="col-sm-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="acceptTermsConditions" required>
                                <label class="form-check-label" for="acceptTermsConditions">Acepta los terminos y condiciones del servicio</label>
                            </div>
                            <div class="invalid-feedback">
                                Debe aceptar los terminos y condiciones del servicio.
                            </div>
                        </div>
                        -->
                    <br>
                    <span style="color: red;">{{ $h }}</span>

                    <div wire:ignore>
                        <label for="captcha">Captcha:</label>
                        {!! NoCaptcha::display(['data-callback' => 'onCallback']) !!}
                        {!! NoCaptcha::renderJs() !!}
                        <script type="text/javascript">
                            var onCallback = function() {

                                @this.
                                set('recaptcha', grecaptcha.getResponse());
                            };
                        </script>
                    </div>



                    <div class="col-sm-12">

                        <button class="w-100 btn btn-tm btn-lg" onclick="sucess()"
                            wire:click="SaveRegistro()">Guardar Pago</button>
                    </div>
                    <div wire:loading wire:target="SaveRegistro"
                        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: white; z-index: 9999;">
                        <img src="img/loading.gif"
                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    </div>


                    <br>


                    <div id="return-false" class="col-sm-12 text-center text-danger">

                    </div>
                </div>
            </div>

        </div>



        <livewire:modales.mostrar-cuentas-deposito />



        <script>
            window.addEventListener('successfully', event => {
                location.reload();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Se guardo ticket con exito',
                    showConfirmButton: false,
                    timer: 3000
                })
            });
        </script>
