
function load(str)
{
var xmlhttp;

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","proc.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("q="+str);
}
$(function(){
  $('#search').focus();
  

  $('#search').keyup(function(){
    var envio = $('#search').val();

    
    $('#re').html('<h2><img src="img/loading.gif" width="20" alt="" /> Cargando</h2>');

    $.ajax({
      type: 'POST',
      url: 'static/buscador.php',
      data: ('search='+envio),
      success: function(resp){
        if(resp!=""){
          $('#re').html(resp);
        }
      }
    })
  })
})
