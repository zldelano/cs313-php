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
               <input type="radio" name="major" value="Computer Science">Computer Science<br>            
               <input type="radio" name="major" value="Web Design & Development">Web Design & Development<br>            
               <input type="radio" name="major" value="Computer Information Technology">Computer Information Technology<br>
               <input type="radio" name="major" value="Computer Engineering">Computer Engineering<br>
            <label>Continents visited: </label><br>            
               <input type="checkbox" name="continents[]" value="North America"> North America
               <input type="checkbox" name="continents[]" value="South America"> South America
               <input type="checkbox" name="continents[]" value="Europe"> Europe 
               <input type="checkbox" name="continents[]" value="Asia"> Asia 
               <input type="checkbox" name="continents[]" value="Australia"> Australia 
               <input type="checkbox" name="continents[]" value="Africa"> Africa 
               <input type="checkbox" name="continents[]" value="Antarctica"> Antarctica 
            <label>Comments: </label>
            <textarea name="comments" id="comments">Enter text here...</textarea><br><br>
            <input type="submit" name="submit" value="Send" id="submit">
         </form>
      </div>
   </body>
</html>