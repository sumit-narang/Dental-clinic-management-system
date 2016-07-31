<?php
  $db = new mysqli('localhost','admin','admin','dentalclinic');//set your database handler
  $query = "SELECT regdate,id FROM appointement GROUP BY regdate";
  $result = $db->query($query);

  while($row = $result->fetch_assoc()){
    $categories[] = array("id" => $row['id'], "val" => $row['regdate']);
  }

  $query = "SELECT id,regdate,regtime FROM appointement ";
  $result = $db->query($query);

  while($row = $result->fetch_assoc()){
    $subcats[$row['id']][] = array("id" => $row['id'], "val" => $row['regtime']);
  }

  $jsonCats = json_encode($categories);
  $jsonSubCats = json_encode($subcats);

?>

<!docytpe html>
<html>

  <head>
    <script type='text/javascript'>
      <?php
        echo "var categories = $jsonCats; \n";
        echo "var subcats = $jsonSubCats; \n";
      ?>
      function loadCategories(){
        var select = document.getElementById("categoriesSelect");
        select.onchange = updateSubCats;
        for(var i = 0; i < categories.length; i++){
          select.options[i] = new Option(categories[i].val,categories[i].id);          
        }
      }
      function updateSubCats(){
        var catSelect = this;
        var catid = this.value;
        var subcatSelect = document.getElementById("subcatsSelect");
        subcatSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < subcats[catid].length; i++){
          subcatSelect.options[i] = new Option(subcats[catid][i].val,subcats[catid][i].id);
        }
      }
    </script>

  </head>

  <body onload='loadCategories()'>
    <select id='categoriesSelect'>
    </select>

    <select id='subcatsSelect'>
    </select>
  </body>
</html>





