<div class="register-options">
    <div class="login-option">
        <h2><a href="#fb-login" class="custom-button3">Registrera dig genom Facebook <img src="_assets/_img/fb.png"/></a></h2>
    </div>
    <div class="login-option">
        <h2><a href="#gmail-login" class="custom-button3">Registrera dig genom Gmail  <img src="_assets/_img/gmail.png"/></a></h2>
    </div>
    <!--<div class="login-option">
        <h2 class="text-center">Eller</h2>
    </div>-->
    <form name="register" action="_process/process-register.php" target="_self" method="POST" class="login-option">
        <div class="form-login-divider">
            <input type="text" name="first-name" class="custom-input1 split-input" placeholder="Förnamn"/>
            <input type="text" name="last-name" class="custom-input1 split-input" placeholder="Efternamn"/>
        </div>
        <div class="form-login-divider">
            <input type="password" name="pwd" class="custom-input1 split-input" placeholder="Lösenord"/>
            <input type="password" name="re-pwd" class="custom-input1 split-input" placeholder="Upprepa Lösenord"/>
        </div>
        <div class="form-login-divider">
            <input type="text" name="email" class="custom-input1" placeholder="E-post"/>    
        </div>
        <div class="form-login-divider">
            <select name="gender" class="custom-input1" >
                    <option value="none" disabled selected>Kön</option>
                    <option value=1>Man</option>
                    <option value=2>Kvinna</option>
                    <option value=0>Annat</option>
            </select>
            <select name="year" class="custom-input1" >
                <option value="none" disabled selected>År</option>
                    <?php   
                        $x = 2002;
                        while($x > 1950){
                            echo "<option value=$x>$x</option>";
                            $x--;
                        }
                    ?>
            </select> 
            <select name="month" class="custom-input1">
                <option value="none" disabled selected>Månad</option>
                    <?php                                
                        $x = 1;
                        while($x <= 12){
                            $monthName = strftime('%B', mktime(0, 0, 0, $x));
                            $monthNames = strftime("%B");
                            echo "<option value=$x>$monthName</option>";
                            $x++;
                        }
                    ?>
            </select> 
            <select name="day" class="custom-input1" >
                <option value="none" disabled selected>Dag</option>
                    <?php   
                        $x = 1;
                        while($x <= 31){
                            echo "<option value=$x>$x</option>";
                            $x++;
                        }
                    ?>
            </select>
        </div>
        <div class="form-login-divider">
            <a href="index.php" class="custom-button1 split-buttons">Tillbaka till login</a>
            <input class="custom-button1 split-buttons" type="submit" id="create-account" />
        </div>
    </form>
</div>