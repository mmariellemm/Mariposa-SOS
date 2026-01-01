@extends('master.page')

@section('css_externos')
    
@endsection

@section('js_externos')
<script src="https://js.stripe.com/v2/"></script>


<script src="{{asset('public/chunk-vendors.9cab6087.js')}}"></script>
<script src="{{asset('public/app.bf0b9f4e.js')}}"></script>

@endsection

@section('contenido')
<script>
    var dinero={{$dinero}};
    var idusuario={{$idusuario}};
    var idproducto={{$idproducto}};
    var url_pago='{{$url_pago}}';
    var nombreproducto ='{{$nombreproducto}}';
    
</script>
<div class="container">
    <div id="app">
    </div>

</div>

@endsection
