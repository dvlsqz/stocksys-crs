<html lang="en">
<head>
    <style>
        @page {
            margin: 0;
            padding: 0;
            size: Letter landscape;
        }
        @media print {
  html, body {
    width: 8.5in;
            height: 5.5in;
  }
}

        body {
            overflow: auto;
            position: relative;
            margin: 0;
            padding: 0;
            border: 0;
            display: flex;
        }
        .page {
            overflow: hidden;
            position: relative;
            width: 8.5in;
            height: 5.5in;
            page-break-after: auto;
        }
        .widget {
            position: absolute;
            left: 0px;
            top: 0px;
            width: calc(8.5in / 2);
            height: 5.5in;
        }
        .widgetScaled {
            opacity: 0.6;
            position: absolute;
            left: calc(8.5in / 2);
            top: 0px;
            width: calc(8.5in * 2);
            height: calc(5.5in * 2);
            transform-origin: 0px 0px;
            transform: scale(1);
        }
        .title {
            font-size: 96px;
        }
    </style>
</head>
<body>
<div class="page">
@foreach($despachos as $d)
        <div style="float: right; margin-top: 80px; margin-right: -50px;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->codigo}}           
        </div>
        <div style="float: right; margin-top: 95px; margin-right: -275px;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->racion->nombre}}           
        </div>
        <div style="float: right; margin-top: 127px; margin-right: -130px;  width: 100px; height: 10px; font-size: 12px;" >
            {{ obtenerMeses(null, $d->solicitud->entrega->mes_inicial).' - '.obtenerMeses(null, $d->solicitud->entrega->mes_final).' '.$d->solicitud->entrega->year}}           
        </div>
        <div style="float: left; margin-top: 127px; margin-left: 175px;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->nombre}}           
        </div>
        <div style="float: left; margin-top: 145px; margin-left: -300px;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->director }}  
        </div>
        <div style="float: right; margin-top: 175px; margin-right: -225px;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->ubicacion->nombre}}           
        </div>
        <div style="float: right; margin-top: 195px; margin-right: -225px;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->ruta_asignada->ruta->ubicacion->nomenclatura.'0'.$d->escuela->ruta_asignada->ruta->correlativo }}           
        </div>

        <div style="float: left; margin-top: 270px; margin-left: -250px;  width: 500px; height: 10px; font-size: 12px;" >
            @foreach($d->detalles as $det)
                
                    {{ $det->alimento_bodega_socio->nombre}} 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ $det->pl}}  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ $det->no_unidades}}     
                    <br>       
                
            @endforeach        
        </div>
    @endforeach
   
</div>
</body>
</html>