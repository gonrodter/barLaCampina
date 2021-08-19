function ValidarProveedores(){
	
	var nombre = document.getElementById("NOMBREPROVEEDORES").value;
	var apellidos = document.getElementById("APELLIDOSPROVEEDORES").value;
	var correo = document.getElementById("CORREOPROVEEDORES").value;
	var telefono = document.getElementById("TELEFONOPROVEEDORES").value;
	var error = "Existen los siguientes errores: ";
	var regexCorreo = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var regexTel = /^[9|6]{1}[\d]{8}$/;
	var existe_error = false;
	
	if(nombre==""){
		existe_error = true;
		var error = error + "\r - El nombre está vacío ";
	}
	if(apellidos==""){
		existe_error = true;
		var error = error +  "\r - El apellido está vacío ";
	}
	if(correo==""){
		existe_error = true;
		var error = error + "\r - El correo está vacío ";		
	}else if(regexCorreo.test(correo) == false){
		existe_error = true;
		var error = error + "\r - El correo no concuerda con el formato válido ";	
	}


	if(telefono==""){
		existe_error = true;
		var error = error + "\r - El teléfono está vacío ";
	}else if(regexTel.test(telefono) == false){
		existe_error = true;
		var error = error + "\r - El teléfono debe constar de 9 números ";	
	}
	if(existe_error){
	
	
	alert(error);
	}
}


function ValidarReservas(){
	
	var nombre = document.getElementById("NOMBRECLIENTES").value;
	var apellidos = document.getElementById("APELLIDOSCLIENTES").value;
	var telefono = document.getElementById("TELEFONOCLIENTES").value;
	var numeroPersonas = document.getElementById("NUMEROPERSONA").value;
	var hora = document.getElementById("HORARESERVA").value;
	var regexTel = /^[9|6]{1}[\d]{8}$/;
	var regexNum = /[\d]+/;
	var regexHora = /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
	var error = "Existen los siguientes errores: ";
	var existe_error = false;
	
	if(nombre==""){
		existe_error = true;
		var error = error + "\r - El nombre está vacío ";
	}
	if(apellidos==""){
		existe_error = true;
		var error = error +  "\r - El apellido está vacío ";
	}
	if(telefono==""){
		existe_error = true;
		var error = error + "\r - El teléfono está vacío ";		
	}else if(regexTel.test(telefono) == false){
		existe_error = true;
		var error = error + "\r - El teléfono debe constar de 9 números ";	
	}
	if(numeroPersonas==""){
		existe_error = true;
		var error = error + "\r - El número de personas está vacío ";
	}else if(regexNum.test(numeroPersonas) == false){
		existe_error = true;
		var error = error + "\r - Introduzca solo números en el campo de Nº PERSONAS ";	
	}
	if(hora==""){
		existe_error = true;
		var error = error + "\r - La hora está vacía ";
	}else if(regexHora.test(hora) == false){
		existe_error = true;
		var error = error + "\r - La hora de reserva no responde al formato correcto. Por favor introdúzcala según se muestra en el espacio para escribirla (Hora:Minutos) ";	
	}
	if(existe_error){
		
	
	alert(error);
	}
}
	
function ValidarEmpleado(){
	var nombre = document.getElementById("NOMBREEMPLEADOS").value;
	var apellidos = document.getElementById("APELLIDOSEMPLEADOS").value;
	var fecha = document.getElementById("FECHANACIMIENTO").value;
	var telefono = document.getElementById("TELEFONOEMPLEADOS").value;
	var correo = document.getElementById("CORREOEMPLEADOS").value;
	var salario = document.getElementById("SALARIO").value;
	var regexCorreo = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var regexTel = /^[9|6]{1}[\d]{8}$/;
	var regexNum = /[\d]+/;
	var error = "Existen los siguientes errores: ";
	var existe_error = false;
	
	if(nombre==""){
		existe_error = true;
		var error = error + "\r - El nombre está vacío ";
	}
	if(apellidos==""){
		existe_error = true;
		var error = error +  "\r - El apellido está vacío ";
	}
	if(fecha==""){
		existe_error = true;
		var error = error + "\r - La fecha esta vacía ";		
	}
	if(telefono==""){
		existe_error = true;
		var error = error + "\r - El teléfono está vacío ";		
	}else if(regexTel.test(telefono) == false){
		existe_error = true;
		var error = error + "\r - El teléfono debe constar de 9 números ";	
	}
	if(correo==""){
		existe_error = true;
		var error = error + "\r - El correo está vacío ";		
	}else if(regexCorreo.test(correo) == false){
		existe_error = true;
		var error = error + "\r - El correo no concuerda con el formato válido ";	
	}
	if(salario==""){
		existe_error = true;
		var error = error + "\r - Salario ";
	}else if(regexNum.test(salario) == false){
		existe_error = true;
		var error = error + "\r - Introduzca un salario válido ";	
	}
	if(existe_error){
		
	
	alert(error);
	}
}

function ValidarCuenta(){
	var oidbeb = document.getElementById("OIDBEB").value;
	var oidtap = document.getElementById("OIDTAP").value;
	var cantidad = document.getElementById("CANTIDADLC").value;
	var mes = document.getElementById("MESLC").value;
	var nCuenta = document.getElementById("NCUENTA").value;
	var regexNum = /[\d]+/;
	var error = "Existen los siguientes errores: ";
	var existe_error = false;
	var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
	
	if(oidbeb=="" && oidtap ==""){
		existe_error = true;
		var error = error + "\r - Rellene alguno de los dos campos de números de tapa o bebida ";
	}
	if(oidbeb!="" && oidtap!=""){
		existe_error = true;
		var error = error +  "\r - Rellene solo uno de los dos campos de números de tapa o bebida ";
	}
	if(cantidad==""){
		existe_error = true;
		var error = error + "\r - La cantidad esta vacía ";		
	}else if(regexNum.test(cantidad) == false){
		existe_error = true;
		var error = error + "\r - La cantidad no puede ser ni una letra ni un caracter especial ";	
	}
	if(mes==""){
		existe_error = true;
		var error = error + "\r - El mes está vacío ";		
	}else if(meses.includes(mes) != true){
		existe_error = true;
		var error = error + "\r - El mes no es válido ";	
	}
	if(nCuenta==""){
		existe_error = true;
		var error = error + "\r - El nº de cuenta está vacío ";		
	}else if(regexNum.test(nCuenta) == false){
		existe_error = true;
		var error = error + "\r - El nº de cuenta no puede ser ni una letra ni un caracter especial ";	
	}

	if(existe_error){
		
	
	alert(error);
	}
}

function ValidarPedido(){
	var nProd = document.getElementById("OIDPROD").value;
	var cantidad = document.getElementById("CANTIDADLP").value;
	var precio = document.getElementById("PRECIOLP").value;
	var mes = document.getElementById("MESLP").value;
	var nPedido = document.getElementById("NPEDIDO").value;
	var regexNum = /[\d]+/;
	var error = "Existen los siguientes errores: ";
	var existe_error = false;
	var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
	
	if(nProd==""){
		existe_error = true;
		var error = error + "\r - El nº de producto está vacío ";
	}
	if(cantidad==""){
		existe_error = true;
		var error = error + "\r - La cantidad esta vacía ";		
	}else if(regexNum.test(cantidad) == false){
		existe_error = true;
		var error = error + "\r - La cantidad no puede ser ni una letra ni un caracter especial ";	
	}
	if(precio==""){
		existe_error = true;
		var error = error + "\r - El precio esta vacío ";		
	}else if(regexNum.test(precio) == false){
		existe_error = true;
		var error = error + "\r - Introduzca un precio válido ";	
	}
	if(mes==""){
		existe_error = true;
		var error = error + "\r - El mes está vacío ";		
	}else if(meses.includes(mes) != true){
		existe_error = true;
		var error = error + "\r - El mes no es válido ";	
	}
	if(nPedido==""){
		existe_error = true;
		var error = error + "\r - El nº de pedido está vacío ";		
	}else if(regexNum.test(nPedido) == false){
		existe_error = true;
		var error = error + "\r - El nº de pedido no puede ser ni una letra ni un caracter especial ";	
	}

	if(existe_error){
		
	
	alert(error);
	}
}

function ValidarBebida(){
	var precio = document.getElementById("PRECIOBEBIDAS").value;
	var nombre = document.getElementById("NOMBREBEBIDAS").value;	
	var error = "Existen los siguientes errores: ";
	var regexNum = /[\d]+/;
	var regexLetra = /[\D]+/;
	var existe_error = false;
	
	if(precio==""){
		existe_error = true;
		var error = error + "\r - El precio está vacío ";
	}else if(regexNum.test(precio) == false){
		existe_error = true;
		var error = error + "\r - El precio no es válido ";	
	}
	if(nombre==""){
		existe_error = true;
		var error = error +  "\r - El nombre de la bebida está vacío ";
	}else if(regexLetra.test(nombre) == false){
		existe_error = true;
		var error = error + "\r - El nombre de la bebida no es válida ";	
	}
	
	if(existe_error){
		
	
	alert(error);
	}
}

function ValidarTapa(){
	var precio = document.getElementById("PRECIOTAPAS").value;
	var nombre = document.getElementById("NOMBRETAPAS").value;	
	var error = "Existen los siguientes errores: ";
	var regexNum = /[\d]+/;
	var regexLetra = /[\D]+/;
	var existe_error = false;
	
	if(precio==""){
		existe_error = true;
		var error = error + "\r - El precio está vacío ";
	}else if(regexNum.test(precio) == false){
		existe_error = true;
		var error = error + "\r - El precio no es válido ";	
	}
	if(nombre==""){
		existe_error = true;
		var error = error +  "\r - El nombre de la tapa está vacío ";
	}else if(regexLetra.test(nombre) == false){
		existe_error = true;
		var error = error + "\r - El nombre de la tapa no es válida ";	
	}
	
	if(existe_error){
		
	
	alert(error);
	}
}

function ValidarProducto(){
	var nProv = document.getElementById("OID_PROV").value;
	var nombre = document.getElementById("NOMBREPRODUCTOS").value;	
	var cantidad = document.getElementById("CANTIDADPRODUCTOS").value;
	var error = "Existen los siguientes errores: ";
	var regexNum = /[\d]+/;
	var regexLetra = /[\D]+/;
	var existe_error = false;
	
	if(nProv==""){
		existe_error = true;
		var error = error + "\r - El nº de proveedor está vacío ";
	}else if(regexNum.test(nProv) == false){
		existe_error = true;
		var error = error + "\r - El nº de proveedor puede ser una letra o un caracter especial ";	
	}
	
	if(nombre==""){
		existe_error = true;
		var error = error +  "\r - El nombre del producto está vacío ";
	}else if(regexLetra.test(nombre) == false){
		existe_error = true;
		var error = error + "\r - El nombre del producto no es válida ";	
	}
	
	if(cantidad==""){
		existe_error = true;
		var error = error + "\r - La cantidad está vacía ";
	}else if(regexNum.test(cantidad) == false){
		existe_error = true;
		var error = error + "\r - La cantidad no es válida ";	
	}

	
	
	if(existe_error){
		
	
	alert(error);
	}
}

function ValidaraGastosVariables(){
	var precio = document.getElementById("PRECIOBEBIDAS").value;
	var nombre = document.getElementById("NOMBREBEBIDAS").value;	
	var error = "Existen los siguientes errores: ";
	var regexNum = /[\d]+/;
	var regexLetra = /[\D]+/;
	var existe_error = false;
	
	if(precio==""){
		existe_error = true;
		var error = error + "\r - El precio está vacío ";
	}else if(regexNum.test(precio) == false){
		existe_error = true;
		var error = error + "\r - El precio no es válido ";	
	}
	if(nombre==""){
		existe_error = true;
		var error = error +  "\r - El nombre de la bebida está vacío ";
	}else if(regexLetra.test(nombre) == false){
		existe_error = true;
		var error = error + "\r - El nombre de la bebida no es válida ";	
	}
	
	if(existe_error){
		
	
	alert(error);
	}
}