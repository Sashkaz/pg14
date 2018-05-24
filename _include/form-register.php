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
    <form name="register" action="_process/process-register.php" target="_self" method="POST" class="main-form">
        <table class="table-layout" width="100%">
            <tbody>
                <tr>
                    <td><input type="text" name="first-name" placeholder="Förnamn"/></td>
                    <td><input type="text" name="last-name" placeholder="Efternamn"/></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="text" name="email" placeholder="E-post"/></td>
                </tr>
                <tr>
                    <td><input type="password" name="pwd" placeholder="Lösenord"/></td>
                    <td><input type="password" name="re-pwd" placeholder="Upprepa Lösenord"/></td>
                </tr>
                <tr>
                    <td>
                        <select name="gender">
                            <option value="none" disabled selected>Kön</option>
                            <option value=1>>Kille</option>
                            <option value=2>Tjej</option>
                            <option value=0>Annat</option>
                        </select> 
                    </td>
                    <td>
                        <select name="year">
                        <option value="none" disabled selected>År</option>
                            <?php   
                                $x = 2002;
                                while($x > 1950){
                                    echo "<option value=$x>$x</option>";
                                    $x--;
                                }
                            ?>
                        </select> 
                        <select name="month">
                        <option value="none" disabled selected>Månad</option>
                            <?php
                                 
                                $x = 1;
                                while($x <= 12){
                                    $monthName = date('F', mktime(0, 0, 0, $x, 10));  
                                    echo "<option value=$x>$monthName</option>";
                                    $x++;
                                }
                            ?>
                        </select> 
                        <select name="day">
                        <option value="none" disabled selected>Dag</option>
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
                    <td><a href="index.php" class="custom-button2">Tillbaka till login</a></td>
                    <td class="text-align-r"><input class="custom-button2" type="submit" id="create-account" /></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>