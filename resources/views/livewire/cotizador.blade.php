<div>


    <div class="container">
    

        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="img/logo.png">
            <h2>REGISTRO PAGO AGENCIAS DE VIAJES</h2>
            <p>Adjunte los datos del deposito o pago en WebPay para gestionar su reserva</p>
            <p>Link de pago con WebPay</p>

            
        <div class="row">
            <div class="col-12 text-center">
               <!-- Button trigger modal -->
                <button type="button"  class="btn btn-info" data-bs-toggle="modal" data-bs-target="#CuentasDeposito">
                  Ver cuentas deposito
                </button>

          </div>
        </div>
    
        </div>

      

        <div class="row g-5">
            <div class="col-md-7 col-lg-8">                        
              
                    <div class="row g-3">
                       {{--  {{ var_dump( $productoPagado) }}
                       <div wire:loading>
                        Processing Payment...
                    </div>  --}}
                        <div class="col-sm-12">
                            <label for="salesman" class="form-label">Vendedor que maneja el expediente (*)</label>
                            <select wire:model="vendedor" class="form-select" required>
                                <option value="" selected>Seleccionar Vendedor...</option>
                                <?php
                                foreach ($vendedores as $row) {
                                    $valor = $row->id;
                                    $vendedor = $row->vendedor;
                                    echo "<option value=" . $valor . ">" . $vendedor . "</option>";
                                }
                                ?>
                            </select>
                            @error('vendedor') <span class="text-red-500">{{ $message }}</span> @enderror 
                        </div>

                        <div class="col-sm-12">
                            <label for="agency" class="form-label">Nombre de agencia pagadora (*)</label>
                            <input type="text" wire:model="nombreAgenciaPagadora" class="form-control" id="agency"  placeholder="Nombre de la Agencia"  required>
                            @error('nombreAgenciaPagadora') <span class="text-red-500">{{ $message }}</span> @enderror 
                        </div>

                        <div class="col-sm-12">
                            <label for="expedient" class="form-label">Numero de expediente, ingresar solo los 8 digitos</label><br>
                            <div class="input-group">
                    
                              <input type="text"  class="form-control" id="expedient" wire:model="numeroExpediente" aria-describedby="inputGroupExpedient" maxlength="8" required pattern="[0-9]{8}">
                           
                                      @if($numeroExpediente )
                                       <button class="btn btn-primary" type="button" wire:click.prevent="addInput">Agregar expediente</button>
                                        @else
                                        <button disabled  class="btn btn-primary" type="button" wire:click.prevent="addInput">Agregar expediente</button>
                                        @endif
                              
                            </div>
                            <br>
                            <div class="container">
                                @foreach ($inputs as $key => $value)
                                    <div class="d-inline-block col-3 m-2  position-relative">
                                        <div class="bg-light rounded p-2">{{ $value }}</div>
                                        
                                          <button  class="btn btn-danger btn-sm position-absolute top-0 right-0 mt-2 mr-2" type="button" wire:click.prevent="removeInput({{ $key }})">X</button>  
                                        
                                    </div>
                                @endforeach
                            </div>
                            
                            @error('numeroExpediente') <span class="text-red-500">{{ $message }}</span> @enderror 
                          </div>
                          

                        <div class="col-sm-12">
                            <label for="paymentType" class="form-label">Tipo de pago (*)</label>
                            <select wire:model="tipoPagoValor" class="form-select" id="paymentType" required>
                                <option value=""  selected>Seleccionar tipo de pago...</option>
                                <?php
                                foreach ($tipoPago as $row) 
                                {
                                    $valor = $row->id;
                                    $tipoPago = $row->tipoPago;
                                    echo "<option value=" . $valor . ">" . $tipoPago . "</option>";
                                }
                                ?>
                            </select>
                            @error('tipoPagoValor') <span class="text-red-500">{{ $message }}</span> @enderror 
                        </div>

                        <div class="col-sm-12">
                            {{ $productoPagado }}
                            <label for="paidProduct" class="form-label">Producto pagado (*)</label>
                            <select wire:model="productoPagado" class="form-select" id="product" name="product" required>
                                <option value=""  selected>Seleccionar producto pagado...</option>
                                <?php
                                foreach ($tiposProducto as $key => $row) {
                                    $valor = $row["id"];
                                    $tipoProducto = $row["tipoProducto"];
                                    echo "<option value=" . $valor . ">" . $tipoProducto . "</option>";
                                }
                                ?>
                            </select>
                            @error('productoPagado') <span class="text-red-500">{{ $message }}</span> @enderror 
                        </div>

                        <div class="col-sm-12">
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
                        </div>

                        <div class="col-sm-12">
                            <label for="paymentAmount" class="form-label">Monto pagado en <span id="referencePaymentCurrency">{{ $moneda ? $moneda : 'Seleccione moneda'}}</span> (*)</label>
                            <input wire:model="monto" type="text" class="form-control" id="paymentAmount" name="paymentAmount" placeholder="" value="" required>
                            @error('monto') <span class="text-red-500">{{ $message }}</span> @enderror 
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
                            <label for="paymentDate" class="form-label">Fecha del deposito o pago con tarjeta de credito (*)</label>
                        
                            <input class="form-control" wire:model="fechaDeposito" type="date" id="date" name="date">
                            @error('fechaDeposito') <span class="text-red-500">{{ $message }}</span> @enderror 
                        </div>

                        <div class="col-sm-12">
                            <label for="php artisan serve
                            aymentFile" class="form-label">Cargar el comprobante de TRANSBANK o deposito bancario  "Imagen o PDF"(*)</label>

                            <input type="file"  class="form-control" wire:model="comprobante" accept="image/jpeg,image/jpg,image/png,image/webp,application/pdf">
                            @error('comprobante') <span class="text-red-500">{{ $message }}</span> @enderror 
        
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

                        <div class="col-sm-12">
                            <button class="w-100 btn btn-tm btn-lg" onclick="sucess()" wire:click="SaveRegistro()">Enviar</button>
                        </div>

        
                        <div id="return-false" class="col-sm-12 text-center text-danger">
                            
                        </div>
            </div>
        </div>
 
</div>


<livewire:modales.mostrar-cuentas-deposito/>




</div>
