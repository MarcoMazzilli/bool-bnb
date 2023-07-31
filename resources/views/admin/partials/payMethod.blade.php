@extends('layouts.app')

@section('content')
{{-- BRAIN TREEEEEEE --}}

<div class="container">
  <h1 class="py-3">Scegli il metodo di pagamento</h1>
  @if (session('success_message'))
      <div class="alert alert-success">
          {{ session('success_message') }}
      </div>
  @endif

  @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <div class="row flex-column">
    {{-- RIEPILOGO PAGAMENTO --}}
    {{-- <div class="col col-6">
      <div class="card border-dark" style="max-width: 30rem;">
        <div class="card-header">Riepilogo</div>
        <div class="card-body">
          <h5 class="card-title">Dark card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div> --}}
    {{-- RIEPILOGO PAGAMENTO --}}


    <div class="col col-6">
      <div class="flex-center position-ref full-height">
          <div class="content">
              <form method="post" id="payment-form" action="{{ route('sponsorship.checkout',['data'=> $jsonData]) }}">
                  @csrf
                  <section>
                      <label for="amount">
                          <span class="input-label">Importo</span>
                          <div class="input-wrapper amount-wrapper">
                              <input class="form-label" id="amount" name="amount" type="tel" min="1" placeholder="Importo"
                                  value="{{$sponsorship->price}}" readonly>
                          </div>
                      </label>

                      <div class="bt-drop-in-wrapper">
                          <div id="bt-dropin"></div>
                      </div>
                  </section>

                  <input id="nonce" name="payment_method_nonce" type="hidden" />
                  <button class="btn mvm-button" type="submit"><span>Procedi al pagamento</span></button>
              </form>
          </div>
      </div>
    </div>
  </div>

</div>
<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
<script>
    var form = document.querySelector('#payment-form');
    var client_token = "{{ $token }}";

    braintree.dropin.create({
      authorization: client_token,
      selector: '#bt-dropin',
      // paypal: {
      //   flow: 'vault'
      // }
    }, function (createErr, instance) {
      if (createErr) {
        console.log('Create Error', createErr);
        return;
      }
      form.addEventListener('submit', function (event) {
        event.preventDefault();

        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            return;
          }

          // Add the nonce to the form and submit
          document.querySelector('#nonce').value = payload.nonce;
          form.submit();
        });
      });
    });
</script>
@endsection
