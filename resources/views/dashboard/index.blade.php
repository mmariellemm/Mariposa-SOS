@extends('master.page')
@section('css_externos')
    <link rel="stylesheet" href="{{asset('public/apexcharts.css')}}">
@endsection

@section('js_externos')
    <script src="{{asset('public/apexcharts.min.js')}}"></script>
    <script src="{{asset('public/vue.js')}}"></script>
    <script src="{{asset('public/vue-apexcharts.js')}}"></script>
    <script src="{{asset('public/ColumnBase.js')}}"></script>
    <script src="{{asset('public/PieBase.js')}}"></script>
@endsection

@section('titulo')
    Dashboard Ventas
@endsection

@section('contenido')
    <div id="appl" class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Ventas por producto (Unidades)</h3>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column">
                                <label for="">Seleccione un año</lLabel>
                                <select v-model="filtro_chart1" name="" id="">
                                    @foreach($anios as $anio)
                                        <option value="{{$anio}}">{{$anio}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column">
                                <label for="">Seleccione un canal</Label>
                                <select v-model="filtro_chart1_canal" name="" id="">
                                    <option value="">Todos</option>
                                    <option value="Unity">Unity</option>
                                    <option value="Android">Android</option>
                                    <option value="WEB">Web</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="chart1">
                                <apexcharts
                                    :width="380"
                                    :height="380"
                                    :options="options_chart1"
                                    :series="options_chart1.series">
                                </apexcharts>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Ventas por producto (Ingreso)</h3>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="d-flex flex-column">
                        <label for="">Seleccione un año</label>
                        <select v-model="filtro_chart2" name="" id="">
                            @foreach($anios as $anio)
                                <option value="{{$anio}}">{{$anio}}</option>
                            @endforeach
                        </select>

                        <div class="col-lg-6">
                            <div class="d-flex flex-column">
                                <label for="">Seleccione un canal</Label>
                                <select v-model="filtro_chart2_canal" name="" id="">
                                    <option value="">Todos</option>
                                    <option value="Unity">Unity</option>
                                    <option value="Android">Android</option>
                                    <option value="WEB">Web</option>
                                </select>
                            </div>
                        </div>
                        <div id="chart2">
                            <apexcharts
                                :width="380"
                                :height="380"
                                :options="options_chart2"
                                :series="options_chart2.series">
                            </apexcharts>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Generos de los jugadores</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex flex-column">
                        <label for="select-rango">Seleccione un Rango</label>
                        <select v-model="filtro_chart3_edad" name="" id="select-rango">
                            <option value="">Todos</option>
                            <option value="1">6-12 años</option>
                            <option value="2">12-18 años</option>
                            <option value="3">18-24 años</option>
                        </select>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <apexcharts
                        :width="380"
                        :height="380"
                        :options="options_chart3"
                        :series="options_chart3.series">
                    </apexcharts>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Edades de los jugadores</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex flex-column">
                        <label for="">Seleccione un Genero</label>
                        <select v-model="filtro_chart4_genero" name="" id="">
                            <option value="">Todos</option>
                            <option value="M">Maculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <apexcharts
                        :width="380"
                        :height="380"
                        :options="options_chart4"
                        :series="options_chart4.series">
                    </apexcharts>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Ventas por Canal (Ingreso)</h3>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="d-flex flex-column">
                        <label for="">Seleccione un año</label>
                        <select v-model="filtro_chart5" name="" id="">
                            @foreach($anios as $anio)
                                <option value="{{$anio}}">{{$anio}}</option>
                            @endforeach
                        </select>
                        <div id="chart5">
                            <apexcharts
                                :width="380"
                                :height="380"
                                :options="options_chart5"
                                :series="options_chart5.series">
                            </apexcharts>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Ventas por Canal (Unidades)</h3>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="d-flex flex-column">
                        <label for="">Seleccione un año</label>
                        <select v-model="filtro_chart6" name="" id="">
                            @foreach($anios as $anio)
                                <option value="{{$anio}}">{{$anio}}</option>
                            @endforeach
                        </select>
                        <div id="chart6">
                            <apexcharts
                                :width="380"
                                :height="380"
                                :options="options_chart6"
                                :series="options_chart6.series">
                            </apexcharts>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_internos')
    <script>
        Vue.use(VueApexCharts);
        var app = new Vue({
            el: '#appl',
            components: {
                apexcharts: VueApexCharts,
            },
            data: function() {
                return {
                    series_chart1:[],
                    categorias_chart1:[],
                    filtro_chart1:'',
                    filtro_chart1_canal:'',
                    series_chart2:[],
                    categorias_chart2:[],
                    filtro_chart2:'',
                    filtro_chart2_canal:'',
                    series_chart3:[],
                    labels_chart3:[],
                    filtro_chart3_edad:'',
                    series_chart4:[],
                    labels_chart4:[],
                    filtro_chart4_genero:'',
                    series_chart5:[],
                    categorias_chart5:[],
                    filtro_chart5:'',
                    series_chart6:[],
                    categorias_chart6:[],
                    filtro_chart6:''
                }
            },
            watch:{
                filtro_chart1: function(value) {
                    this.info_chart1();
                },
                filtro_chart2:function(value) {
                    this.info_chart2();
                },
                filtro_chart1_canal: function(value) {
                    this.info_chart1();
                },
                filtro_chart2_canal: function(value) {
                    this.info_chart2();
                },
                filtro_chart3_edad:function(value){
                this.info_chart3();
                },
                filtro_chart4_genero:function(value){
                this.info_chart4();
                },
                filtro_chart5:function(value) {
                    this.info_chart5();
                },
                filtro_chart6:function(value) {
                    this.info_chart6();
                }
            },
            methods:{
                info_chart1: function(){
                    var xhr = new XMLHttpRequest();
                    var vu=this;
                    xhr.open('POST', '{{action('DashboardController@dame_ventas_mes')}}', true);
                    var mapa_series=new Map();
                    var lista_categorias=[];
                    this.series_chart1.splice(0,this.series_chart1.length) ;
                    this.categorias_chart1.splice(0,this.categorias_chart1.length) ;
                    xhr.onreadystatechange = function() {
                        if (this.readyState==4) {
                            if(this.status == 200){
                                datos=JSON.parse(this.responseText) ;
                                for (i=0; i<datos.length; i++) {
                                    if (!mapa_series.has(datos[i].nombre)){
                                        mapa_series.set(datos[i].nombre,[]);
                                    }
                                    mapa_series.get(datos[i].nombre).push(datos[i]);
                                    if(!lista_categorias.includes(datos[i].fecha)){
                                        lista_categorias.push(datos[i].fecha);
                                    }
                                }
                                vu.categorias_chart1=lista_categorias;
                                for (var [nom_producto, lista_valores] of mapa_series.entries()) {
                                    var tmp={
                                        name: ''
                                        ,data:[]
                                    };
                                    tmp.name=nom_producto;
                                    for(j=0; j<lista_valores.length; j++) {
                                        tmp.data.push(lista_valores[j].total_unidades) ;
                                    }
                                    vu.series_chart1.push(tmp) ;
                                }
                            }
                            else{
                                console.log('Algo tronó, habla con el programador');
                            }
                        }
                    };
                    var data = new FormData();
                    data.append('_token', '{{csrf_token()}}');
                    data.append('anio', this.filtro_chart1);
                    data.append('canal', this.filtro_chart1_canal);
                    xhr.send(data);
                },
                info_chart2:function(){
                    var xhr = new XMLHttpRequest();
                    var vu=this;
                    xhr.open('POST', '{{action('DashboardController@dame_ventas_mes')}}', true);
                    var mapa_series=new Map();
                    var lista_categorias=[];
                    this.series_chart2.splice(0,this.series_chart2.length) ;
                    this.categorias_chart2.splice(0,this.categorias_chart2.length) ;
                    xhr.onreadystatechange = function() {
                        if (this.readyState==4) {
                            if(this.status == 200){
                                datos=JSON.parse(this.responseText) ;
                                for (i=0; i<datos.length; i++) {
                                    if (!mapa_series.has(datos[i].nombre)){
                                        mapa_series.set(datos[i].nombre,[]);
                                    }
                                    mapa_series.get(datos[i].nombre).push(datos[i]);
                                    if(!lista_categorias.includes(datos[i].fecha)){
                                        lista_categorias.push(datos[i].fecha);
                                    }
                                }
                                vu.categorias_chart2=lista_categorias;
                                for (var [nom_producto, lista_valores] of mapa_series.entries()) {
                                    var tmp={
                                        name: ''
                                        ,data:[]
                                    };
                                    tmp.name=nom_producto;
                                    for(j=0; j<lista_valores.length; j++) {
                                        tmp.data.push(lista_valores[j].total_ventas) ;
                                    }
                                    vu.series_chart2.push(tmp) ;
                                }
                            }
                            else{
                                console.log('Algo tronó, habla con el programador');
                            }
                        }
                    };
                    var data = new FormData();
                    data.append('_token', '{{csrf_token()}}');
                    data.append('anio', this.filtro_chart2);
                    data.append('canal', this.filtro_chart2_canal);
                    xhr.send(data);
                },
                info_chart3:function(){
                    var xhr = new XMLHttpRequest();
                    var vu=this;
                    xhr.open('POST', '{{action('DashboardController@dame_total_genero')}}',true);
                    this.series_chart3.splice(0,this.series_chart3.length) ;
                    this.labels_chart3.splice(0, this.labels_chart3.length) ;
                    xhr.onreadystatechange = function() {
                        if (this.readyState==4) {
                            if(this.status == 200){
                            datos=JSON.parse(this.responseText);

                            console.log("Datos del chart3", datos);

                            for(i=0;i<datos.length;i++){
                                vu.series_chart3.push(datos[i].total);
                                if(datos[i].genero=='F')
                                    vu.labels_chart3.push('Femenino');
                                else
                                    vu.labels_chart3.push('Masculino');
                            }
                            }
                            else{
                            console.log('Algo trono, hablale al programador');
                            }
                        }
                    };
                    var data = new FormData();
                    data.append('_token', '{{csrf_token()}}');
                    data.append('edad',this.filtro_chart3_edad);
                    xhr.send(data);
                },
                info_chart4:function(){
                    var xhr = new XMLHttpRequest();
                    var vu=this;
                    xhr.open('POST', '{{action('DashboardController@dame_total_edad')}}',true);
                    this.series_chart4.splice(0,this.series_chart4.length) ;
                    this.labels_chart4.splice(0, this.labels_chart4.length) ;
                    xhr.onreadystatechange = function() {
                    //Validamos que el proceso ya termino
                    if (this.readyState==4) {
                        //Validamos que el proceso se termino correctamente
                        if(this.status == 200){
                            datos=JSON.parse(this.responseText) ;
                            for (i=0; i<datos. length; i++) {
                                vu.series_chart4.push(datos[i].total);

                                if(datos[i].edad==1){
                                vu.labels_chart4.push("6-12");
                                }
                                if(datos[i].edad==2){
                                vu.labels_chart4.push("12-18");
                                }
                                if(datos[i].edad==3){
                                    vu.labels_chart4.push("18-24");
                                }
                            }
                        }
                        else{
                        console.log('Algo trono, hablale al programador');
                        }
                    }
                }
                    var data = new FormData();
                    data.append('_token', '{{csrf_token()}}');
                    data.append('genero',this.filtro_chart4_genero);
                    xhr.send(data);
                },
                info_chart5:function(){
                    var xhr = new XMLHttpRequest();
                    var vu=this;
                    xhr.open('POST', '{{action('DashboardController@dame_ventas_canal')}}', true);
                    var mapa_series=new Map();
                    var lista_categorias=[];
                    this.series_chart5.splice(0,this.series_chart5.length) ;
                    this.categorias_chart5.splice(0,this.categorias_chart5.length) ;
                    xhr.onreadystatechange = function() {
                        if (this.readyState==4) {
                            if(this.status == 200){
                                datos=JSON.parse(this.responseText) ;
                                for (i=0; i<datos.length; i++) {
                                    if (!mapa_series.has(datos[i].nombre)){
                                        mapa_series.set(datos[i].nombre,[]);
                                    }
                                    mapa_series.get(datos[i].nombre).push(datos[i]);
                                    if(!lista_categorias.includes(datos[i].fecha)){
                                        lista_categorias.push(datos[i].fecha);
                                    }
                                }
                                vu.categorias_chart5=lista_categorias;
                                for (var [nom_producto, lista_valores] of mapa_series.entries()) {
                                    var tmp={
                                        name: ''
                                        ,data:[]
                                    };
                                    tmp.name=nom_producto;
                                    for(j=0; j<lista_valores.length; j++) {
                                        tmp.data.push(lista_valores[j].total_ventas) ;
                                    }
                                    vu.series_chart5.push(tmp) ;
                                }
                            }
                            else{
                                console.log('Algo tronó, habla con el programador');
                            }
                        }
                    };
                    var data = new FormData();
                    data.append('_token', '{{csrf_token()}}');
                    data.append('anio', this.filtro_chart5);
                    xhr.send(data);
                },
                info_chart6:function(){
                    var xhr = new XMLHttpRequest();
                    var vu=this;
                    xhr.open('POST', '{{action('DashboardController@dame_ventas_canal')}}', true);
                    var mapa_series=new Map();
                    var lista_categorias=[];
                    this.series_chart6.splice(0,this.series_chart6.length) ;
                    this.categorias_chart6.splice(0,this.categorias_chart6.length) ;
                    xhr.onreadystatechange = function() {
                        if (this.readyState==4) {
                            if(this.status == 200){
                                datos=JSON.parse(this.responseText) ;
                                for (i=0; i<datos.length; i++) {
                                    if (!mapa_series.has(datos[i].nombre)){
                                        mapa_series.set(datos[i].nombre,[]);
                                    }
                                    mapa_series.get(datos[i].nombre).push(datos[i]);
                                    if(!lista_categorias.includes(datos[i].fecha)){
                                        lista_categorias.push(datos[i].fecha);
                                    }
                                }
                                vu.categorias_chart6=lista_categorias;
                                for (var [nom_producto, lista_valores] of mapa_series.entries()) {
                                    var tmp={
                                        name: ''
                                        ,data:[]
                                    };
                                    tmp.name=nom_producto;
                                    for(j=0; j<lista_valores.length; j++) {
                                        tmp.data.push(lista_valores[j].total_unidades) ;
                                    }
                                    vu.series_chart6.push(tmp) ;
                                }
                            }
                            else{
                                console.log('Algo tronó, habla con el programador');
                            }
                        }
                    };
                    var data = new FormData();
                    data.append('_token', '{{csrf_token()}}');
                    data.append('anio', this.filtro_chart6);
                    xhr.send(data);
                }
            },
            computed: {
                options_chart1:function(){
                    var tmp=ColumnBase();
                    tmp.series=this.series_chart1;
                    tmp.xaxis.categories=this.categorias_chart1;
                    return tmp;
                },
                options_chart2:function(){
                    var tmp=ColumnBase();
                    tmp.series=this.series_chart2;
                    tmp.xaxis.categories=this.categorias_chart2;
                    return tmp;
                },
                options_chart3:function(){
                    var tmp=PieBase();
                    tmp.series=this.series_chart3;
                    tmp.labels=this.labels_chart3;
                    return tmp;
                },
                options_chart4:function(){
                    var tmp=PieBase();
                    tmp.series=this.series_chart4;
                    tmp.labels=this.labels_chart4;
                    return tmp;
                },
                options_chart5:function(){
                    var tmp=ColumnBase();
                    tmp.series=this.series_chart5;
                    tmp.xaxis.categories=this.categorias_chart5;
                    return tmp;
                },
                options_chart6:function(){
                    var tmp=ColumnBase();
                    tmp.series=this.series_chart6;
                    tmp.xaxis.categories=this.categorias_chart6;
                    return tmp;
                }
            },
            created(){
                this.filtro_chart1='{{$anio_actual}}';
                this.filtro_chart2='{{$anio_actual}}';
                this.filtro_chart3_edad = '';
                this.info_chart3();
                this.filtro_chart4_genero = '';
                this.info_chart4();
                this.filtro_chart5='{{$anio_actual}}';
                this.filtro_chart6='{{$anio_actual}}';
            }
        });
    </script>
@endsection
