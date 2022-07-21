@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Zarejestruj się') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @if($errors)
                            @foreach ($errors->all() as $error)
                            
                                <div>{{$error}}</div>
                                dupa
                            </span>
                                
                            @endforeach
                        @endif
                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('Imię') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Nazwisko') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pesel" class="col-md-4 col-form-label text-md-end">{{ __('PESEL') }}</label>

                            <div class="col-md-6">
                                <input id="pesel" type="text" class="form-control @error('pesel') is-invalid @enderror" name="pesel" value="{{ old('pesel') }}" required autocomplete="pesel" autofocus>

                                @error('pesel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Hasło') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Potwierdź hasło') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div id="languages">
                            
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Język programowania') }}</label>
                                <div class="col-auto">
                                    <input type="text" class="form-control" name="langs[]" required autocomplete>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-danger mb-3 remove-select" >Usuń</button>
                                  </div>   
                            </div>
                        </div>
                        
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-10">
                                <button type="button" id="add-lang" class="btn btn-success">
                                    {{ __('Dodaj język') }}
                                </button>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Zarejestruj się') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="input-lang" class="row mb-3" hidden>
    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Język programowania') }}</label>
    <div class="col-auto">
        <input type="text" class="form-control" name="langs[]" required autocomplete>
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-danger mb-3 remove-select" >Usuń</button>
      </div>   
</div>
@endsection
@push('scripts')


<script> 
    $(document).on('click', '.remove-select', function(){
        $(this).parent('div').parent('div').remove();
    });
    $("#add-lang").click(function(){
        input = $("#input-lang").html();
        $("#languages").append('<div class="row mb-3">'+input+'</div>');
    });

</script>
@endpush

