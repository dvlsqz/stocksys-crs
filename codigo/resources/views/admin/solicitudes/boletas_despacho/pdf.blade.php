<html lang="en">
<head>
    <style>
        @page {
            size: 140mm 216mm landscape;
            height: 216mm;
            width: 140mm;
            margin: 0;
        }

        @media print {
            @page {
                size: 140mm 216mm;
            }
        }


        html {
            width: 140mm;
            height: 216mm;
            margin: 0;
        }

        body {
            width: 140mm;
            height: 216mm;
            margin: 0;
            padding: 0;
            width: 100%;
        }
    </style>
</head>
<body style="background-image: url('/static/imagenes/crs_1.png'); ">
    @foreach($despachos as $d)
        

        <div style="position: relative; top: 31.8mm; left: 48mm;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->nombre}}           
        </div>

        <div style="position: relative; top: 33.8mm; left: 35.6mm;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->director }}  
        </div>

        <div style="position: relative; top: 21.3mm; left: 153.2mm;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->codigo}}           
        </div>

        <div style="position: relative; top: 21.2mm; left: 156mm;  width: 250px; height: 10px; font-size: 12px;">
            {{ $d->racion->nombre}}           
        </div>

        <div style="position: relative; top: 34mm; left: 156mm;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->ubicacion->nombre}}           
        </div>

        <div style="position: relative; top: 38mm; left: 150mm;  width: 250px; height: 10px; font-size: 12px;"  >
            {{ $d->escuela->ruta_asignada->ruta->ubicacion->nomenclatura.'0'.$d->escuela->ruta_asignada->ruta->correlativo }}           
        </div>

        @foreach($d->detalles as $det)
            <div style="position: relative; top: 47mm; left: 17mm;  width: 250px; height: 10px; font-size: 12px;" >
                {{ $det->alimento_bodega_socio->nombre}} 
            </div>
                
            <div style="position: relative; top: 47mm; left: 90mm;  width: 250px; height: 10px; font-size: 12px;" >  
                {{ $det->pl}}  
            </div>

            <div style="position: relative; top: 47mm; left: 171mm;  width: 250px; height: 10px; font-size: 12px;" >
                {{ $det->no_unidades}}    
            </div> 
            
        @endforeach        

        <div style="position: relative; top: 101mm; left: 150mm;  width: 250px; height: 10px; font-size: 12px;"  >
            {{ $d->escuela->ruta_asignada->ruta->ubicacion->nomenclatura.'0'.$d->escuela->ruta_asignada->ruta->correlativo }}           
        </div>
        
        
    @endforeach
    
   

</body>
</html>