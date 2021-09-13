function mostrar(){
  if(document.getElementById("zona_comentarios").style.display === "none")
      document.getElementById("zona_comentarios").style.display = "block" ;
  else
      document.getElementById("zona_comentarios").style.display = "none" ;
}

function crear_comentario() {
  var fecha = new Date() ;
  var text = "<div class=\"info-comments\">";
  text += "<h3>" + document.getElementById("nombre").value + ", " + fecha.getDate() + "/" + fecha.getMonth() + "/" + fecha.getFullYear() + " " + fecha.getHours() +  ":" + fecha.getMinutes() + "</h3>\n" ;
  text += "<p>" + document.getElementById("texto").value + "</p>\n" ;
  text += "</div>";

  document.getElementById("comments").innerHTML += text ;
}

function validar_comentario(){
  if(document.getElementById("nombre").value === "")
    alert ("Tienes que poner tu nombre") ;
  else
    if(document.getElementById("mail").value === "")
      alert ("Tienes que poner tu correo electrónico") ;
    else
      if(!validar_correo(document.getElementById("mail").value))
        alert ("El correo no es válido") ;
      else
      if(document.getElementById("texto").value === "")
        alert ("No has puesto ningun comentario") ;
      else
        crear_comentario() ;
}

function validar_correo(mail) {
  var estructura = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return estructura.test(mail) ? true : false;
}

function palabras_baneadas(){
  var eliminadas = ["gilipollas","retrasada","retrasado","noob","estupido","estupida", "imbecil", "mierda","joder","inutil", "tonto","tonta"];
  var texto_com = document.getElementById("texto").value ;
  var bans = "" ;
  for (i=0; i<eliminadas.length; i++){
    if (texto_com.toLowerCase().includes(eliminadas[i])){
      document.getElementById("texto").value = document.getElementById("texto").value.replace(eliminadas[i],'*'.repeat(eliminadas[i].length)) ;
    }
  }
}
