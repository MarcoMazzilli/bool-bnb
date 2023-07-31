@extends('layouts.app')

@section('content-log-reg')
    <div class="bg-image" id="form-new-user">

        <div class="container">

            <div class="row justify-content-center">
              {{-- per modificare il responsive cambiare la larghezza della colonna --}}
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card">
                        <div class="card-header">{{ __('Registrazione nuovo utente') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                {{-- Input nome --}}
                                <div class="mb-4 row">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Inserisci il tuo nome">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Input cognome --}}
                                <div class="mb-4 row">
                                    <label for="last_name"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>
                                    {{-- TODO: Gestire il messaggio di errore --}}
                                    <div class="col-md-6">
                                        <input id="last_name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="last_name"
                                            value="{{ old('last_name') }}" required autocomplete="name" autofocus placeholder="Inserisci il tuo cognome">

                                        {{-- TODO: Gestire il messaggio di errore --}}
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Input data di nascita --}}
                                <div class="mb-4 row">
                                    <label for="date_of_birth"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Data di nascita') }}</label>
                                    {{-- TODO: Gestire il messaggio di errore --}}
                                    <div class="col-md-6">
                                        <input id="date_of_birth" type="date"
                                            class="form-control @error('name') is-invalid @enderror" name="date_of_birth"
                                            value="{{ old('date_of_birth') }}" required autocomplete="name" autofocus>

                                        {{-- TODO: Gestire il messaggio di errore --}}
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Input email --}}
                                <div class="mb-4 row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" placeholder="Inserisci la tua mail">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Input password --}}
                                <div class="mb-4 row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password" placeholder="Min 8 caratteri">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Input conferma password --}}
                                <div class="mb-4 row">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password" placeholder="Conferma la tua password">
                                    </div>
                                </div>

                                <div class="mb-4 row mb-0">
                                    <div class="col-md-6 offset-md-4 d-flex justify-content-end gap-3">
                                        {{-- button back to home --}}
                                        <a href="{{ route('home') }}"><button type="button" class="btn">Torna alla
                                                home</button></a>

                                        {{-- button register --}}
                                        <button disabled id="submit-btn"type="submit" class="btn">
                                            {{ __('Registrati') }}
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DATA
        const password = document.getElementById('password') ;
        const password_confirm = document.getElementById('password-confirm');
        const name = document.getElementById('name');
        const last_name = document.getElementById('last_name');
        const date_of_birth = document.getElementById('date_of_birth');
        const submit_btn = document.getElementById('submit-btn')

        // FUNCTION
        function comparePassword(){
            return password.value === password_confirm.value
        }

        function pswdValidation(){

            if (comparePassword()) {
                //psw uguale
                password.classList.add("is-valid");
                password_confirm.classList.add("is-valid");
                password_confirm.classList.remove("is-invalid");
            }else{
                //psw diversa
                password.classList.remove("is-valid");
                password_confirm.classList.remove("is-valid");
                password_confirm.classList.add("is-invalid");
                //psw vuota
                if(password_confirm.value == ""){
                    password_confirm.classList.remove("is-invalid")
                };
            }
        }

        function errorSpecialCharacter(text, input){
            const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;

            specialChars.test(text) ? input.classList.add('is-invalid') : input.classList.add('is-valid')
            !specialChars.test(text) ? input.classList.remove('is-invalid') : input.classList.remove('is-valid')
            return !specialChars.test(text)
        }

        function lenghtControl(text,input){
            text.length >= 3 ? input.classList.add('is-valid') : input.classList.add('is-invalid')
            return text.length >= 3
        }

        function ageCalculator(){
            const y_of_birth = new Date(date_of_birth.value)

            const now = new Date()
            let current_year = now.getFullYear()

            if(current_year - y_of_birth.getFullYear() >= 18){
                date_of_birth.classList.remove('is-invalid')
                date_of_birth.classList.add('is-valid')
            }else{
                date_of_birth.classList.remove('is-valid')
                date_of_birth.classList.add('is-invalid')
            }

            // console.log(current_year - y_of_birth.getFullYear() >= 18)
            return current_year - y_of_birth.getFullYear() >= 18

        }

        function agreeSubmit(){
            if(
                comparePassword() &&
                errorSpecialCharacter(name.value, name) &&
                errorSpecialCharacter(last_name.value, last_name) &&
                lenghtControl(name.value, name)&&
                lenghtControl(last_name.value, last_name)&&
                lenghtControl(password.value, name)&&
                lenghtControl(password_confirm.value, last_name)&&
                ageCalculator()
                ){
                    submit_btn.removeAttribute('disabled')

                }else{
                    submit_btn.setAttribute('disabled',true)
                    console.log('comparePassword()',comparePassword())
                    console.log('errorSpecialCharacter(name.value, name)',errorSpecialCharacter(name.value, name))
                    console.log('errorSpecialCharacter(name.value, name)',errorSpecialCharacter(last_name.value, last_name))
                    console.log('lenghtControl(name.value, name)',lenghtControl(name.value, name))
                    console.log('lenghtControl(last_name.value, last_name)',lenghtControl(last_name.value, last_name))
                    console.log('ageCalculator()',ageCalculator())
                }
        }

        //EVENT
        password_confirm.addEventListener('keyup', ()=>{
            pswdValidation();
            agreeSubmit();
        })

        password.addEventListener('keyup', ()=>{
            pswdValidation();
            agreeSubmit();
        });

        name.addEventListener('keyup',()=> {
            errorSpecialCharacter(name.value, name);
            lenghtControl(name.value, name);
            agreeSubmit();
        })

        last_name.addEventListener('keyup',()=> {
            errorSpecialCharacter(last_name.value, last_name);
            lenghtControl(last_name.value, last_name);
            agreeSubmit();
        })

        date_of_birth.addEventListener('change',()=>{
            ageCalculator();
            agreeSubmit();
        })


    </script>
@endsection
