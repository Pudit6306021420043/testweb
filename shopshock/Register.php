<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<br>
<br>

<body onload="loadDoc()">
    <center>
        <hr>
        Name:
        <input type="text" id="name"><br>
        Nickname:
        <input type="text" id="user"><br>
        Password:
        <input type="text" id="pass"><br>
        Confirm Password:
        <input type="text" id="pass2"><br>
        <hr>
        <button onclick="add_data()">submit</button>
        <button onclick="reset()">reset</button>

    <div id="out"></div>
    </center>
    
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
            xhttp.open("GET","rest.php",true);
            xhttp.send();

    function add_data(){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
                console.log(this.responseText);
                data = JSON.parse(this.responseText);
                console.log(data.length);
                create_table(data);
            }
        }
        name = document.getElementById("name");
        user = document.getElementById("user");
        pass = document.getElementById("pass");
        pass2 = document.getElementById("pass2");
        xhttp.open("POST","rest.php",true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("name="+name.value+"&user='"+user.value+"'"+"&pass"+pass.value);
    }    

    function create_table(data){
        out = document.getElementById("out");
        out.innerHTML = "";
        text = "<table border='1'>";
        for(i=0;i<data.length;i++){
            for(inf in data[i]){
                text += "<td>"+data[i][inf]+"</td>";
            }
            text = "<tr>"+ text + "</tr>";
        }
        out.innerHTML = text + "</table>";
    }    
    

}
    </script>
    
</body>
</html>