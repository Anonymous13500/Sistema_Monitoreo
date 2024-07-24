var select = document.getElementById("opcion");
var fechaSeleccionada = document.getElementById("fechaSeleccionada");
var barraNavegacion = document.getElementById("barraNavegacion");
var mostrarDatos = document.getElementById("mostrarDatos");
var graficasContainer = document.getElementById("graficasContainer");
var container = document.getElementsByClassName("card");
var diariaData = {}; // Almacena los datos para gráficas diarias
var mensualData = {}; // Almacena los datos para gráficas mensuales
var anualData = {}; // Almacena los datos para gráficas anuales
var diariasCharts = [];
var mensualesCharts = [];
var anualesCharts = [];

function mostrarDatos2() {
    var opcionSeleccionada = select.value;
    console.log('Mostrando datos para la opción seleccionada:', opcionSeleccionada);
    RecogerDatos(opcionSeleccionada);
}

function RecogerDatos(opcionSeleccionada) { 
    switch (opcionSeleccionada) {
        case "diaria":
            document.getElementById("barraNavegacionAnual").style.display = "none";
            document.getElementById("barraNavegacionparaAnual").style.display = "none";
            document.getElementById("barraNavegacion").style.display = "block";
            limpiarGraficas();
            generarGraficasDiarias();
            break;
        case "mensual":
            document.getElementById("barraNavegacionparaAnual").style.display = "none";
            document.getElementById("barraNavegacionAnual").style.display = "block";
            document.getElementById("barraNavegacion").style.display = "none";
            limpiarGraficas();
            generarGraficasMensuales();
            break;
        case "anual":
            document.getElementById("barraNavegacionAnual").style.display = "none";
            document.getElementById("barraNavegacion").style.display = "none";
            document.getElementById("barraNavegacionparaAnual").style.display = "block";
            limpiarGraficas();
            generarGraficasAnuales();
        default:
            mensaje = "Opción no reconocida.";
    }  
};


generarGraficasDiarias({
    rutaBase: '/DEV-2.0/src/',
    archivo: 'obtener_datos_diarios.php',
    parametros: {
        idinversor: 'inversor' 
    }
});


function generarGraficasDiarias(config){
    limpiarGraficas();
    var fechaSeleccionada = document.getElementById("fechaSeleccionada").value;
    var parametros={
        fechaSeleccionada: fechaSeleccionada
    };
    if(config.parametros){
        for (var key in config.parametros){
            if (config.parametros.hasOwnProperty(key)){
                var element = document.getElementById(config.parametros[key]).value;
                parametros[key] = element;
            }
        }
    }
    var urlParams = new URLSearchParams(parametros).toString();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            generarGraficas(data);
        }
    };
    var rutaBase = config.rutaBase || '/DEV-2.0/src/';
    var archivo = config.archivo || 'obtener_datos_diarios.php';
    xhttp.open("GET", rutaBase + archivo + "?" + urlParams, true);
    xhttp.send();
    console.log("dd: ", fechaSeleccionada);
}
function generarGraficas(data){
    limpiarGraficas();
    console.log("data generarGraficas: ", data);
    if (data && data.length > 0){
        var labels = [];
        var voltageData = [];
        var currentData = [];
        var powerData = [];
        var energyData = [];
        var frequencyData = [];
        var pfData = [];
        var esDiario = data[0].hasOwnProperty('timestamp');
        var esMensual = data[0].hasOwnProperty('mes_truncado');
        var esAnual = data[0].hasOwnProperty('year');
        if (esDiario) {
            labels = data.map(function(item) {
                return new Date(item.timestamp).toLocaleTimeString();
            });
        } 
        
        if (esDiario) {
            voltageData = data.map(function(item) {
                return item.voltage;
            });
            currentData = data.map(function(item) {
                return item.current;
            });
            powerData = data.map(function(item) {
                return item.power;
            });
            energyData = data.map(function(item) {
                return item.energy;
            });
            frequencyData = data.map(function(item) {
                return item.frequency;
            });
            pfData = data.map(function(item) {
                return item.pf;
            });
        } 
         var ctxVoltage = document.getElementById('voltageChart').getContext('2d');
         var ctxCurrent = document.getElementById('currentChart').getContext('2d');
         var ctxPower = document.getElementById('powerChart').getContext('2d');
         var ctxEnergy = document.getElementById('energyChart').getContext('2d');
         var ctxFrequency = document.getElementById('frequencyChart').getContext('2d');
         var ctxPf = document.getElementById('pfChart').getContext('2d');


         if (esDiario) {
            //bucle 6 
                    MapearChart({labels:labels, label:"Voltaje", data:voltageData,contenedor:ctxVoltage,borderColor:"rgba(75, 192, 192, 1)"})
                    MapearChart({labels:labels, label:"Corriente", data:currentData, contenedor:ctxCurrent, borderColor:"rgba(255, 99, 132, 1)"})
                    MapearChart({labels:labels, label:"Energia", data:powerData, contenedor:ctxPower, borderColor:"rgba(54, 162, 235, 1)"})
                    MapearChart({labels:labels, label:"Potencia", data:energyData, contenedor:ctxEnergy, borderColor:"rgba(255, 206, 86, 1)"})
                    MapearChart({labels:labels, label:"Frecuencia", data:frequencyData, contenedor:ctxFrequency, borderColor:"rgba(153, 102, 255, 1)"})
                    MapearChart({labels:labels, label:"Factor de Potencia", data:pfData, contenedor:ctxPf, borderColor:"rgba(255, 159, 64, 1)"})
            //
        }
    } else {
        console.error('No se han recibido datos válidos para generar las gráficas.');
    }
}

function MapearChart({contenedor = "", label = "", data = [], borderColor= "",labels= [] }){
    if(contenedor == ""){
        console.error("No agregaste el contenedor!");
    }
    diariasCharts.push = [
        new Chart(contenedor, { type: 'line', data: { labels: labels, datasets: [{ label: label, data: data, fill: false, borderColor: borderColor, borderWidth: 2 }] }, options: chartOptions }),    ];
}
function filtrarEdificios() {
    var campusSeleccionado = document.getElementById("campus").value;
    var edificioSelect = document.getElementById("edificio");
    edificioSelect.innerHTML = '<option value="">Cargando...</option>';
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var edificios = JSON.parse(this.responseText);
            edificioSelect.innerHTML = '<option value="">Seleccione un edificio</option>';
            edificios.forEach(function(edificio) {
                edificioSelect.innerHTML += '<option value="' + edificio.iditem + '">' + edificio.nombre + '</option>';
            });
        }
    };
    var rutaBase = '/DEV-2.0/src/';
    xhttp.open("GET", rutaBase + "obtener_edificios.php?campus=" + campusSeleccionado, true);
    xhttp.send();
}

function filtrarInversores() {
    var edificioSeleccionado = document.getElementById("edificio").value;
    var inversorSelect = document.getElementById("inversor");
    inversorSelect.innerHTML = '<option value="">Cargando...</option>';
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var inversores = JSON.parse(this.responseText);
            inversorSelect.innerHTML = '<option value="">Seleccione un inversor</option>';
            inversores.forEach(function(inversor) {
                inversorSelect.innerHTML += '<option value="' + inversor.idinversor + '">' + inversor.idinversor + '</option>';
            });
        }
    };
    var rutaBase = '/DEV-2.0/src/';
    xhttp.open("GET", rutaBase + "obtener_inversores.php?edificio=" + edificioSeleccionado, true);
    xhttp.send();
}

function limpiarGraficas() {
    diariasCharts.forEach(function(chart) {
        chart.destroy();
    });
    diariasCharts = [];
    mensualesCharts.forEach(function(chart) {
        chart.destroy();
    });
    mensualesCharts = [];
    anualesCharts.forEach(function(chart) {
        chart.destroy();
    });
    anualesCharts = [];
}

var chartOptions = {
    responsive: true,
    maintainAspectRatio: false
};
generarGraficasDiarias();