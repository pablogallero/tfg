//Funcion: Contiene las funciones necesarias para las validaciones en los formularios  Autor:"5stkct" Fecha de creación:29/10/2018
function validarVacio(campo) {//Funcion que comprueba si el campo pasado por parametro es vacio;
    var camp=document.getElementById(campo).value;//Guarda en la variable camp el valor del parametro pasado a la funcion
    if (camp =="") {//Comprueba si el valor es vacio, si lo es devuelve false y pone el borde del campo en rojo,si no lo es devuelve true y pone el borde en verde
        document.getElementById(campo).style.borderColor="red";
        document.getElementById("parrafovalidacion").innerHTML="El campo "+document.getElementById(campo).name +" no puede estar vacío";
        $('#exampleModal').modal('toggle');
        return false;
    }
    else { 
        document.getElementById(campo).style.borderColor="green";
        return true; }
}

function comprobarVacio(campo) {//Funcion que comprueba si el campo pasado por parametro es vacio;
    var camp=document.getElementById(campo).value;//Guarda en la variable camp el valor del parametro pasado a la funcion
    if (camp =="") {//Comprueba si el valor es vacio, si lo es devuelve false y pone el borde del campo en rojo,si no lo es devuelve true y pone el borde en verde
        document.getElementById(campo).style.borderColor="red";
       
        return false;
    }
    else { 
        document.getElementById(campo).style.borderColor="green";
        return true; }
}
function comprobarTexto(campo, size) {//funcion que comprueba si el campo cumple la expresion regular y se ajusta al tamaño indicado
    var camp=document.getElementById(campo).value;//Guarda en la variable camp el valor del parametro pasado a la funcion
    var exprreg = /^([^\s\t]+)+$/;//Expresion regular que acepta 1 o mas ocurrencias de todo tipo de caracteres excepto de espacios en blanco
    if (!validarVacio(campo)) { return false; }//Comprueba si el campo esta vacio
    else {
        if (camp.length > size || camp.length < 5 ) {//Comprueba si el campo no supera el valor pasado como parametro
            document.getElementById(campo).style.borderColor="red";
            document.getElementById("parrafovalidacion").innerHTML="El tamaño del valor del campo de texto "+document.getElementById(campo).name +"  es incorrecto. Recuerda que no puede ser menor que 5.";
                $('#exampleModal').modal('toggle');
           // alert("El campo excede el tamaño máximo");
            return false;
        }
        if (!comprobarExpresionRegular(campo, exprreg, size)) {//Comprueba si el campo no cumple la expresion regular
            document.getElementById("parrafovalidacion").innerHTML="El formato del campo de texto "+document.getElementById(campo).name +"  es incorrecto. No puede contener espacios en blanco.";
                $('#exampleModal').modal('toggle');


            return false;
        }
        else { //Si el campo no entro en ninguno de los ifs anteriores quiere decir que es valido, por lo que devuelve true y su borde se pone de color verde
            document.getElementById(campo).style.borderColor="green";
            return true; }
    }

}

function comprobarExpresionRegular(campo, exprreg, size) {//Funcion que comprueba que el campo pasado cumpla la expresion regular pasada como parametro y el tamaño
    var camp=document.getElementById(campo).value;//Guarda en la variable camp el valor del parametro pasado a la funcion
    if (exprreg.test(camp)) {//Si el campo cumple la expresion regular devuelve true
        return true;
    }
    if (camp.length > size) {//Si el campo es mayor que el tamaño pasado como parametro devuelve false,pone el borde rojo y lanza una alerta
        document.getElementById(campo).style.borderColor="red";
       // alert("El campo excede el tamaño");
        return false;
    }
    else {//Los demas casos seran en los que tengan el tamaño adecuado pero no cumplan la expresion regular,asi que devuelve false,pone el borde del campo en rojo y lanza una añerta
        document.getElementById(campo).style.borderColor="red";
       // alert("El campo no cumple los requisitos");
        return false;
    }
}

function comprobarEntero(campo, valormenor, valormayor) {//Funcion para comprobar que el campo pasado por parametro es un numero entero que se encuentra entre los valores pasados tambien como parametros
    var camp;
    var exprreg = /^[0-9]+$/;//Expresion regular que se cumple si hay una ocurrencia o mas de un digito 
    camp = document.getElementById(campo).value;//Guarda en la variable camp el valor del parametro pasado a la funcion
    if (!validarVacio(campo)) { return false; }//Comprobamos si el campo esta vacio
    else{
    if (comprobarExpresionRegular(campo, exprreg, campo.length)) {//Comprobamos si cumple la expresion regular
        if (camp >= valormenor && camp <= valormayor) {//Comprobamos si el valor del campo se encuentra entre el valor menor y el valor mayor pasados como parametro,si es asi devuelve true y pone el borde en verde
            document.getElementById(campo).style.borderColor="green";
            return true;
        }
        else { //Si no cumple los requisitos anteriores devuelve false,pone el borde en rojo y lanza una alerta
            document.getElementById(campo).style.borderColor="red";
          //  alert("El campo no cumple los requisitos"); 
            return false; }
    }}
}
function comprobarReal(campo, numerodecimales, valormenor, valormayor) {//Funcio para comprobar que el campo pasado como parametro es un numero real con el umero de decimales pasado como parametro y se encuentra entre los valores pasados tambien como parametros
    var camp;
    var exprreg = /^[0-9]+[\.]{1}[0-9]+$/;//Expresion regular que se cumple si hay 1 o mas ocurrencias de un digito seguidas del caracter punto y seguidas de 1 o mas ocurrencias de un digito
    camp = document.getElementById(campo).value;//Guarda en la variable camp el valor del parametro pasado a la funcion
    
    if (comprobarExpresionRegular(campo, exprreg, campo.length) && camp.charAt(camp.length-1 + numerodecimales)=='.') {//Comprobamos si cumple la expresion regular y si tiene el numero de decimales correcto
        if (camp >= valormenor && camp <= valormayor) {//Comprobamos si el valor del campo se encuentra entre el valor menor y el valor mayor pasados como parametro,si es asi devuelve true y pone el borde en verde
            document.getElementById(campo).style.borderColor="green";
            return true;
        }
        else { //Si no cumple lo anterior, devuelve false
            return false; }
    }

}

function comprobarNuevaPass(campo){
if(!comprobarVacio(campo) || comprobarTexto(campo)){

    document.getElementById(campo).style.borderColor="green";
return true;
}
else{
    document.getElementById(campo).style.borderColor="red";
                document.getElementById("parrafovalidacion").innerHTML="El formato de la contraseña es incorrecto";
                $('#exampleModal').modal('toggle');
    return false;}

}
function comprobarDNI(campo) {//Funcion para ver si el campo pasado como parametro es un dni valido
    var camp;
    var exprreg = /^[0-9]{8}[A-Za-z]{1}$/;//Expresion regular que se cumple si hay 8 ocurrencias de digitos seguidas de una letra mayuscula o minuscula
    camp = document.getElementById(campo).value;//Guarda en la variable camp el valor del parametro pasado a la funcion
    numero = camp.substr(0, camp.length - 1);//Realizamos un substring que guardamos en numero para quedarnos solamente con el numero del dni
    if (!validarVacio(campo)) { return false; }//Comprobamos que no este vacio
    else {
        if (!comprobarExpresionRegular(campo, exprreg, 9)) {//Comprobamos si no cumple la expresion regular
            document.getElementById("parrafovalidacion").innerHTML="El formato del DNI es incorrecto";
                $('#exampleModal').modal('toggle');
            return false;
        }
        else {
            if ("TRWAGMYFPDXBNJZSQVHLCKE".charAt(numero % 23) == camp.charAt(8)) { //Teniendo en cuenta que cumple la expresion regular, comprobamos que la letra se corresponda con el numero
                document.getElementById(campo).style.borderColor="green";
                return true; }
            else {//Si no lo hace devuelve false,pone el borde rojo y lanza una alerta
                document.getElementById(campo).style.borderColor="red";
                document.getElementById("parrafovalidacion").innerHTML="La letra no coincide";
                $('#exampleModal').modal('toggle');
             //   alert("El DNI es incorrecto");
                return false;
            }
        }
    }
}

function comprobarTelf(campo) {//Funcion para comprobar que el campo pasado por parametro es un telefono español
    var exprreg = /^(\+34|34)?[\s|\-|\.]?[6|7|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$/;//Expresion regular que se cumple si hay 0 o 1 ocurrencias de "+34" o "34",seguida de 0 o 1 ocurrencias de distintos separadores,seguida de un "6" un "7" o un "9"(con o sin separadores) seguida de 8 digitos mas(con o sin separadores)
    if (!validarVacio(campo)) { return false; }//Comprobamos que no este vacio
    else {
        if (!comprobarExpresionRegular(campo, exprreg, 15)) {//Comprobamos si no cumple la expresion regular
            document.getElementById("parrafovalidacion").innerHTML="El formato del teléfono es incorrecto";
            $('#exampleModal').modal('toggle');
            return false;
        }
        else { //Si la cumple devuelve true y pone el borde verde
            document.getElementById(campo).style.borderColor="green";
            return true; }
    }
}
function comprobarEmail(campo) {//Funcion para comprobar que el campo pasado como parametro es un email valido
    var exprreg = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/;//Expresion regular que se cumple si hay una o mas ocurrencias de caracteres que no sean ni "@" ni espacios en blanco,seguidas de "@",seguidas de una o mas ocurrencias de caracteres que no sean ni "@" ni espacios en blanco ni ".",seguidas de "." y seguidas de una o mas ocurrencias de caracteres que no sean ni "@" ni espacios en blanco ni "."
    if (!validarVacio(campo)) { return false; }//Comprueba que el campo no este vacio
    else {
        if (!comprobarExpresionRegular(campo, exprreg, 50)) {//Comprueba que no se cumpla la expresion regular
            document.getElementById("parrafovalidacion").innerHTML="El formato del email es incorrecto";
            $('#exampleModal').modal('toggle');
            return false;
        }
        else { //Si la expresion regular se cumple,devuelve true y pone el borde del campo verde
            document.getElementById(campo).style.borderColor="green";
            return true; }
    }
}

function comprobarAlfabetico(campo, size) {//Funcion que comprueba que el campo pasado como parametro sean solo caracteres alfabeticos
    var exprreg = /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/;//Expresion regular que se cumple si hay 1 ocurrencia de una mayuscula(con o sin tilde),seguida de 1 o mas ocurrencias de minusculas(con o sin tilde) y seguidas de 0 o 1 espacios.Repitiendose esta expresion regular 1 o mas veces.
    
    if (!validarVacio(campo)) { return false; }//Comprueba que el campo no este vacio
    else {
        if (!comprobarExpresionRegular(campo, exprreg, size)) {//Comprueba que el campo no cumpla la expresion regular
           // alert("El formato es incorrecto, recuerde que debe comenzar por mayúscula.")
           document.getElementById("parrafovalidacion").innerHTML="El formatode "+document.getElementById(campo).name +" es incorrecto, recuerde que debe comenzar por mayúscula";
            $('#exampleModal').modal('toggle');
            return false;
        }
        else { //Si cumple la expresion regular devuelve true y el borde se pone verde
            document.getElementById(campo).style.borderColor="green";
            return true; }
    }


}
function fechaIncorrecta(diainicio,horainicio,diafin,horafin){

    var dateTimeInicio = document.getElementById(diainicio).value+' '+document.getElementById(horainicio).value;
    var dateTimeFin = document.getElementById(diafin).value+' '+document.getElementById(horafin).value;
    dateinicio= new Date(dateTimeInicio);
    datefin= new Date(dateTimeFin);
    
  if(dateinicio.getTime() >=datefin.getTime()){
        document.getElementById("parrafovalidacion").innerHTML="La fecha de inicio no puede ser igual o mayor a la fecha de fin";
        $('#exampleModal').modal('toggle');
        return false;
    }
    if(dateinicio.getTime() < datefin.getTime()) { //Si cumple la expresion regular devuelve true y el borde se pone verde
        return true ; }
        
}
function validarformularioadduser(){//Funcion para comprobar que se cumple todas las funciones del formulario 

if(comprobarTexto('username',25) && comprobarTexto('passwd',50) && comprobarDNI('dni') && comprobarTelf('telefono') && comprobarEmail('email') && validarVacio('direccion') ){
return true;
}
else{//Si no se cumplen todas devuelve faslse y lanza una alerta
   
    return false;
}
}

function validarformularioedituser(){//Funcion para comprobar que se cumple todas las funciones del formulario 

    if(comprobarTexto('username',25) && comprobarTexto('passwd',50) && comprobarNuevaPass('passwdnueva',50) && comprobarDNI('dni') && comprobarTelf('telefono') && comprobarEmail('email') && validarVacio('direccion') ){
    return true;
    }
    else{//Si no se cumplen todas devuelve faslse y lanza una alerta
       
        return false;
    }
    }

function validarformulariocontacto(){//Funcion para comprobar que se cumple todas las funciones del formulario 

    if(comprobarAlfabetico('nombre',50) && comprobarAlfabetico('apellidos',50) &&  validarVacio('fotoperfil')  &&  comprobarTelf('telefono') && comprobarEmail('email') && comprobarTexto('twitter',25) ){
    return true;
    }
    else{//Si no se cumplen todas devuelve false y lanza una alerta
       
        return false;
    }
    }

    function validarformulariocontactoedit(){//Funcion para comprobar que se cumple todas las funciones del formulario 

        if(comprobarAlfabetico('nombre',50) && comprobarAlfabetico('apellidos',50)  &&  comprobarTelf('telefono') && comprobarEmail('email') && comprobarTexto('twitter',25) ){
        return true;
        }
        else{//Si no se cumplen todas devuelve false y lanza una alerta
           
            return false;
        }
        }
function validarformulariocontactar(){//Funcion para comprobar que se cumple todas las funciones del formulario 

        if(comprobarAlfabetico('nombre',50)  && comprobarEmail('email') && validarVacio('asunto') && validarVacio('mensaje') ){
        return true;
        }
        else{//Si no se cumplen todas devuelve false y lanza una alerta
          
            return false;
        }
        }
function validarformulariopatrocinador(){//Funcion para comprobar que se cumple todas las funciones del formulario 

            if(validarVacio('nombre')  && validarVacio('imagen') ){
            return true;
            }
            else{//Si no se cumplen todas devuelve false y lanza una alerta
               
                return false;
            }
            }      
            
function validarformulariopatrocinadoredit(){//Funcion para comprobar que se cumple todas las funciones del formulario 

                if(validarVacio('nombre')  ){
                return true;
                }
                else{//Si no se cumplen todas devuelve false y lanza una alerta
               
                    return false;
                }
                }        
    

function validarformulariocategoria(){//Funcion para comprobar que se cumple todas las funciones del formulario 

            if(validarVacio('nombre')  && validarVacio('color') ){
             return true;
             }
             else{//Si no se cumplen todas devuelve false y lanza una alerta
             
                 return false;
                }
             }        
function validarformulariocolaborar(){//Funcion para comprobar que se cumple todas las funciones del formulario 

             if(validarVacio('titulo')  && validarVacio('mytextarea') ){
            return true;
            }
            else{//Si no se cumplen todas devuelve false y lanza una alerta
          
                 return false;
                 }
                 }     

function validarformularioedit(){//Funcion para comprobar que se cumple todas las funciones del formulario edit

    if(comprobarTexto('loginedt',25) && comprobarTexto('passwordedt',20)&& comprobarTexto('passwordedt2',20) && comprobarDNI('dniedt') && comprobarTelf('telefonoedt') && comprobarEmail('emailuseredt') && comprobarAlfabetico('nombreuseredt',25) && comprobarAlfabetico('apellidosuseredt',50) && comprobarEntero('cursoacademicouseredt',1,4) && comprobarAlfabetico('titulacionuseredt',50)){
    return true;
    }
    else{//Si no se cumplen todas devuelve faslse y lanza una alerta
      
        return false;
    }
    }


    function validarformularioproyecto(){//Funcion para comprobar que se cumple todas las funciones del formulario 

        if(validarVacio('titulo')  && validarVacio('imagen')  && validarVacio('mytextarea') && validarVacio('mytextarea1') && validarVacio('mytextarea2') && validarVacio('mytextarea3')){
       return true;
       }
       else{//Si no se cumplen todas devuelve false y lanza una alerta
          
            return false;
            }
            }     


            function validarformularioproyectoedit(){//Funcion para comprobar que se cumple todas las funciones del formulario 

                if(validarVacio('titulo')   && validarVacio('mytextarea') && validarVacio('mytextarea1') && validarVacio('mytextarea2') && validarVacio('mytextarea3')){
               return true;
               }
               else{//Si no se cumplen todas devuelve false y lanza una alerta
            
                    return false;
                    }
                    }     

    function validarformulariocalendarioadd(){//Funcion para comprobar que se cumple todas las funciones del formulario 

                if(validarVacio('title') && fechaIncorrecta('start_datef','start_hourf','end_datef','end_hourf') ){
               return true;
               }
               else{//Si no se cumplen todas devuelve false y lanza una alerta
           
                    return false;
                    }
                    }     

    function validarformulariocalendarioedit(){//Funcion para comprobar que se cumple todas las funciones del formulario 

                        if(validarVacio('titleed') && fechaIncorrecta('start_dateed','start_houred','end_dateed','end_houred')){
                       return true;
                       }
                       else{//Si no se cumplen todas devuelve false y lanza una alerta
                
                            return false;
                            }
                            }     


    function validarformulariocalendariodel(){//Funcion para comprobar que se cumple todas las funciones del formulario 

                                if(validarVacio('titledel') && fechaIncorrecta('start_datedel','start_hourdel','end_datedel','end_hourdel') ){
                               return true;
                               }
                               else{//Si no se cumplen todas devuelve false y lanza una alerta
                         
                                    return false;
                                    }
                                    }     


function validarformularionoticias(){//Funcion para comprobar que se cumple todas las funciones del formulario 

             if(validarVacio('titulo')  && validarVacio('imagen')  && validarVacio('cuerponoticia')  ){
            return true;
            }
            else{//Si no se cumplen todas devuelve false y lanza una alerta
          
                 return false;
                 }
                 }   

                 function validarformularionoticiasedit(){//Funcion para comprobar que se cumple todas las funciones del formulario 

                    if(validarVacio('titulo')   && validarVacio('cuerponoticia')  ){
                   return true;
                   }
                   else{//Si no se cumplen todas devuelve false y lanza una alerta
                
                        return false;
                        }
                        }   

function validarformulariovideotutoriales(){//Funcion para comprobar que se cumple todas las funciones del formulario 

             if(validarVacio('titulo')  && validarVacio('enlace')  && validarVacio('descripcion')  ){
            return true;
            }
            else{//Si no se cumplen todas devuelve false y lanza una alerta
            
                 return false;
                 }
                 }   

function validarformularioGaleria(){//Funcion para comprobar que se cumple todas las funciones del formulario 

             if(validarVacio('titulo')  && validarVacio('imagen')  ){
            return true;
            }
            else{//Si no se cumplen todas devuelve false y lanza una alerta
          
                 return false;
                 }
                 }   

function validarformularioComentario(){//Funcion para comprobar que se cumple todas las funciones del formulario 

             if(validarVacio('cuerpocoment') ){
            return true;
            }
            else{//Si no se cumplen todas devuelve false y lanza una alerta
          
                 return false;
                 }
                 }   