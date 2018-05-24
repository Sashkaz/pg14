<link rel="stylesheet" type="text/css" href="_include/form-register.css">
<div class="login-option">
    <h2><a href="#fb-login" class="custom-button2">Registrera dig genom Facebook <img src="_assets/_img/fb.png"/></a></h2>
</div>
<div class="login-option">
    <h2><a href="#gmail-login" class="custom-button2">Registrera dig genom Gmail  <img src="_assets/_img/gmail.png"/></a></h2>
</div>
<hr>
<div class="login-option">
    <h2 class="text-center">Eller</h2>
    <form name="register" action="_process/process-register.php" target="_self" method="POST">
        <table class="table-layout text-justify">
            <tbody>
                <tr>
                    <td><label for="first-name">Förnamn:</label></td>
                    <td><input type="text" name="first-name" /></td>
                    <td><label for="last-name">Efternamn:</label></td>
                    <td><input type="text" name="last-name" /></td>
                </tr>
                <tr>
                    <td><label for="email">E-post:</label></td>
                    <td colspan="3"><input type="text" name="email" /></td>
                </tr>
                <tr>
                    <td><label for="pwd">Lösenord:</label></td>
                    <td><input type="password" name="pwd" /></td>
                    <td><label for="re-pwd">Skriv om Lösenord:</label></td>
                    <td><input type="password" name="re-pwd" /></td>
                </tr>
                <tr>
                    <td><label for="pwd">Kön:</label></td>
                        <td>
                            <select id="gender">
                                <option value="none">Välj</option>
                                <option value="m">Kille</option>
                                <option value="f">Tjej</option>
                                <option value="o">Annat</option>
                            </select> 
                    </td>
                    <td><label for="pwd">Födelsedatum:</label></td>
                    <td>
                        <select id="year">
                            <?php   
                                $x = 2018;
                                while($x > 1950){
                                    echo "<option value=$x>$x</option>";
                                    $x--;
                                }
                            ?>
                        </select> 
                        <select id="month">
                            <?php   
                                $x = 1;
                                while($x <= 12){
                                    echo "<option value=$x>$x</option>";
                                    $x++;
                                }
                            ?>
                        </select> 
                        <select id="day">
                            <?php   
                                $x = 1;
                                while($x <= 31){
                                    echo "<option value=$x>$x</option>";
                                    $x++;
                                }
                            ?>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="index.php" class="custom-button1">Tillbaka till login</a></td>
                    <td class="text-align-r"><input class="custom-button1" type="submit" id="create-account" /></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>