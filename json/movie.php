<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $jsonfile = file_get_contents("movies.json");
    ?>
<div>
    year:
    <select name="" id="year" onchange="createlist()">
    <option value="">N/A</option>
    </select><br>

    Movie:
    <select name="" id="movie" onchange="create_mdetail()">
    <option value="">N/A</option>
    </select>
</div>

    <script>
        var jsonEx = <?php echo $jsonfile ?>;
        var doc = document.getElementById("year");
        var ref_year = new Set();

        for(i=0;i<jsonEx.length;i++){
            ref_year.add(jsonEx[i].year);
        }//alert("total year ="+ref_year.size);
        
        const val = ref_year.values();
        for(i=0;i<ref_year.size;i++){
            var option = document.createElement("option");
            option.text=val.next().value;
            doc.add(option);
        }

        function createlist(){
            var movie = document.getElementById("movie");
            movie.innerHTML="";
            for(i=0;i<jsonEx.length;i++){
                if(document.getElementById("year").value==jsonEx[i].year){
                    var option = document.createElement("option");
                    option.text=jsonEx[i].title;
                    movie.add(option);
                }
            }
        }


        function create_mdetail(){
            alert("total year ="+ref_year.size);
        }
    </script>


</body>
</html>