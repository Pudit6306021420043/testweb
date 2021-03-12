<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="loadDoc()">
    <script>
        function loadDoc(){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            console.log(this.readyState);
            if(this.readyState==4 && this.status==200){
            console.log(this.responseText);
            let data = JSON.parse(this.responseText);
            console.log(data); 
                   }
        }
            xhttp.open("GET","02 rest.php",true);
            xhttp.send();
    }
    </script>
</body>
</html>