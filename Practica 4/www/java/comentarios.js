var cnt = 0;

function mostrar(){

  if(cnt == 0){
    document.getElementById("comentarios").style.display = "block" ;
    cnt = 1;
    
  }
  else{
    document.getElementById("comentarios").style.display = "none" ;
    cnt = 0;
  }
        
}
  
  function crear_comentario() {

    var fecha = new Date() ;
    var texto_comentario = "<div class=\"comentario\">";
    texto_comentario += "<h4>" + document.getElementById("nick").value + " ,<br>" + fecha.getDate() + "/" + fecha.getMonth() + "/" + fecha.getFullYear() + " " + fecha.getHours() +  ":" + fecha.getMinutes() + "</h4>\n" ;
    texto_comentario += "<p>" + document.getElementById("texto").value + "</p>\n" ;
    texto_comentario += "</div>";
  
    document.getElementById("lista_comentarios").innerHTML += texto_comentario ;
  
  }
  
  function revisar_comentario(){
    if(document.getElementById("nick").value === "")
      alert ("El campo Nickname es obligatorio.") ;
    
    else if(document.getElementById("texto").value === "")
      alert ("El campo Tu Comentario es obligatorio.") ;
    
    else
      crear_comentario() ;
  }
  
  function revisar_correo(mail) {

    var formato = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return formato.test(mail) ? true : false;

  }
  
  function palabras_prohibidas(prohibidas){
    
    var contenido = document.getElementById("texto").value ;
    
    for (i=0; i<prohibidas.length; i++){
      if (contenido.toLowerCase().includes(prohibidas[i])){
        document.getElementById("texto").value = document.getElementById("texto").value.replace(prohibidas[i],'*'.repeat(prohibidas[i].length)) ;
      }
    }

  }
