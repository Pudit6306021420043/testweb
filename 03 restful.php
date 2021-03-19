<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="loadDoc()">
    add ID name <br>
    <input type="text" id="new_id"><input type="text" id="new_name">
    <button onclick="add_data()">add</button>
    <div id="out"></div>
    
    <script>
        function loadDoc(){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            console.log(this.readyState+", "+this.status);
            if(this.readyState==4 && this.status==200){
                console.log(this.responseText);
                data = JSON.parse(this.responseText);
                console.log(data.length);
                create_table(data);
            }
        }
            xhttp.open("GET","02 rest.php",true);
            xhttp.send();
    }

    function add_data(){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
                console.log(this.responseText);
                data=JSON.parse(this.responseText);
                create_table(data);
            }
        }
        new_id   = document.getElementById("new_id");
        new_name = document.getElementById("new_name");
        xhttp.open("POST","02 rest.php",true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("new_id="+new_id.value+"&new_name='"+new_name.value+"'");
    }

    function create_table(data){
        out = document.getElementById("out");
        out.innerHTML="";
        text="<table border='1'>";
            for(i=0;i<data.length;i++){
                    for(inf in data[i]){
                       text+="<td>"+data[i][inf]+"</td>";
                    }
                    text="<tr>"+text+"</tr>";
                }
                out.innerHTML= text+"</table>";
    }
    </script>
</body>
</html>