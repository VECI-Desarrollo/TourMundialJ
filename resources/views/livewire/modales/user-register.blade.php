<div>
    
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="userRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registro </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
    <div class="modal-body" ><!-- modal-body -->
       <div>
        <x-validation-errors class="mb-4" />
       </div>

        @php
        use App\Models\roles;
        use App\Models\pais;
        
        $roles = roles::all();
        $paises = pais::all();
        @endphp
  
    
        

                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" required autofocus autocomplete="name" />
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <x-label for="name" value="Apellido" />
                        <x-input id="name" class="block mt-1 w-full" type="text" wire:model="lastName" required autofocus autocomplete="lastName" />
                        @error('lastName') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
        
        
                    <div>
                        <x-label for="yankee" value="{{ __('Yankee') }}" />
                        <x-input id="yankee" class="block mt-1 w-full" type="text" wire:model="yankee" required autofocus autocomplete="yankee" />
                        @error('yankee') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
        
                    <div>
                        <x-label for="name" value="{{ __('Rol') }}" />
                       <select   wire:model="rol" class="block mt-1 w-full" >
                        <option selected>--Selecciona Rol-- </option>
                       @foreach ($roles as $rol)
                       <option value= {{ $rol->rol }}> {{ $rol->rol }} </option>
                       @endforeach
                       </select>
                       @error('rol') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
        
                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input  class="block mt-1 w-full" type="email" wire:model="email" required autocomplete="username" />
                        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
        
{{--                      
                    <div class="mt-4">
                        <x-label for="pais" value="{{ __('Pais') }}" />
                       <select  wire:model="country"  class="block mt-1 w-full" >
                        <option selected>--Selecciona pais-- </option>
                       @foreach ($paises as $pais)
                       <option value= {{ $pais->id }}> {{ $pais->nombre }} </option>
                       @endforeach
                       </select>
                    </div>  --}}
        
                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input class="block mt-1 w-full" type="password" wire:model="password" required autocomplete="new-password" />
                        @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
        
                    {{--  <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
          --}}
                   
        
                    <div class="flex items-center justify-end mt-4">
                   
        
                        <button class="ml-4" wire:click="save()">
                         Registrar
                        </button>
                    </div>
              
 
        





          

    </div> <!-- /.modal-body -->
         

          </div>
        </div>
      </div>






</div>
