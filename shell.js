var cmdhistory = [];
var cmdindex = 0;
var environment = {"path":"/"};

$(document).ready(function(){
    $("#shell").keyup(function(event) {
       if(event.which == 13)
       {
           var lines  = $("#shell").val().split("\n");
           var input  = lines[lines.length-2];
           var cmd 	  = input.split(" ")[1];
           var params = "";
           var parts  = input.split(" ");
           for(i=2;i<parts.length;i++)
           {
        	   params += parts[i]+" ";
           }
           parts.shift();
           cmdhistory.push(parts.join(" "));
           cmdindex = cmdhistory.length;
           var environmentString = "{";
           for(envvar in environment)
           {
        	   environmentString += '"'+envvar+'":"'+eval("environment."+envvar)+'",';
           }
           environmentString = environmentString.substr(0,environmentString.length-1)+"}";
         
           $.getJSON("app_proxy.php",
        		   {'app':cmd,'environment':environmentString,'params':params},
        		   function(data) {
               environment = data.environment;
        	   $("#shell").val($("#shell").val()+data.data);
               $("#shell").val($("#shell").val()+environment.path+"> ");
               $("#shell").scrollTo("100%",150);
           });
//Alternative request for debugging, if Response-JSON is invalid.
/*
           $.get("app_proxy.php",
        		   {'app':cmd,'environment':environmentString,'params':params},
        		   function(data) {
        			   alert(data);
           });
*/           
       }
    });
});