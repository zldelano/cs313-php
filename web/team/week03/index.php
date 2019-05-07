<!DOCTYPE html>
<html>
   <head></head>
   <body>
      <div class="content">
         <form action="processform.php" id="the_form" method="POST">
            <label>Name: </label>
            <input type="text" name="name" size="25"/><br>
            <label>Email: </label>
            <input type="text" name="email" size="25"/><br>
            <label>Major: </label><br>
               <?php
                  $majors = array("Computer Science",
                                  "Web Design & Development",
                                  "Computer Information Technology",
                                  "Computer Engineering");
                  foreach ($majors as $major) {
                     echo "<input type=\"radio\" name=\"major\" value=\"$major\">$major<br>";
                  }
               ?>
            <label>Places visited: </label><br>
               <input type="checkbox" name="continents[]" value="na"> North America<br>
               <input type="checkbox" name="continents[]" value="sa"> South America<br>
               <input type="checkbox" name="continents[]" value="eu"> Europe<br>
               <input type="checkbox" name="continents[]" value="as"> Asia<br>
               <input type="checkbox" name="continents[]" value="au"> Australia<br>
               <input type="checkbox" name="continents[]" value="af"> Africa<br>
               <input type="checkbox" name="continents[]" value="an"> Antarctica<br>
            <label>Comments: </label>
            <textarea name="comments" id="comments">Enter text here...</textarea><br><br>
            <input type="submit" name="submit" value="Send" id="submit">
         </form>
      </div>
   </body>
</html>