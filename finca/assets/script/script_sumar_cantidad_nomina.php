<script>
	function sumar_cantidad() {
    var sueldo=Number(document.getElementById("txt_sueldo").value);
    var mercado=Number(document.getElementById("txt_mercado").value);
    var seguro=Number(document.getElementById("txt_seguro").value);
    var gastos_per=Number(document.getElementById("txt_gastos_per").value);
    var servicios=Number(document.getElementById("txt_servicios").value);
    var herramientas=Number(document.getElementById("txt_herramientas").value);
    var prestamos=Number(document.getElementById("txt_prestamos").value);
    var inasistencia=Number(document.getElementById("txt_inasistencia").value);
    var pasajes=Number(document.getElementById("txt_pasajes").value);
    var liqudacion=Number(document.getElementById("txt_liquidacion").value);
    var otros=Number(document.getElementById("txt_otros").value);
    var prestaciones=Number(document.getElementById("txt_prestaciones").value);
    var incapacidad=Number(document.getElementById("txt_incapacidad").value);
    var trabajos_varios=Number(document.getElementById("txt_trabajo_varios").value);
    var total_final=sueldo-mercado-seguro-gastos_per-servicios-herramientas-prestamos-inasistencia-pasajes+liqudacion+otros+prestaciones+incapacidad+trabajos_varios;
    document.getElementById("txt_valor_final").value =(total_final);
}
</script>