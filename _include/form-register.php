<div class="register-options">
    <div class="login-option">
        <h2><a href="#fb-login" class="custom-button3"><?php echo $lang["reg-form"]["fb-login"]; ?> <img src="_assets/_img/fb.png"/></a></h2>
    </div>
    <div class="login-option">
        <h2><a href="#gmail-login" class="custom-button3"><?php echo $lang["reg-form"]["gmail-login"]; ?>  <img src="_assets/_img/gmail.png"/></a></h2>
    </div>
    <!--<div class="login-option">
        <h2 class="text-center">Eller</h2>
    </div>-->
    <form name="register" action="_process/process-register.php" target="_self" method="POST" class="login-option">
        <div class="form-login-divider">
            <input type="text" name="first-name" class="custom-input1 split-input" placeholder='<?php echo $lang["reg-form"]["placeholder"]["fname"]; ?>' >
            <input type="text" name="last-name" class="custom-input1 split-input" placeholder='<?php echo $lang["reg-form"]["placeholder"]["lname"]; ?>' >
        </div>
        <div class="form-login-divider">
            <input type="password" name="pwd" class="custom-input1 split-input" placeholder='<?php echo $lang["reg-form"]["placeholder"]["pwd"]; ?>' >
            <input type="password" name="re-pwd" class="custom-input1 split-input" placeholder='<?php echo $lang["reg-form"]["placeholder"]["repwd"]; ?>' >
        </div>
        <div class="form-login-divider">
            <input type="text" name="email" class="custom-input1" placeholder='<?php echo $lang["reg-form"]["placeholder"]["email"]; ?>' >    
        </div>
        <div class="form-login-divider">
            <select name="gender" class="custom-input1" >
                    <option value="none" disabled selected><?php echo $lang["reg-form"]["placeholder"]["gender"]["default"]; ?></option>
                    <option value=1><?php echo $lang["reg-form"]["placeholder"]["gender"]["m"]; ?></option>
                    <option value=2><?php echo $lang["reg-form"]["placeholder"]["gender"]["f"]; ?></option>
                    <option value=0><?php echo $lang["reg-form"]["placeholder"]["gender"]["o"]; ?></option>
            </select>
            <select name="year" class="custom-input1" >
                <option value="none" disabled selected><?php echo $lang["reg-form"]["placeholder"]["dob"]["y"]; ?></option>
                    <?php   
                        $x = 2002;
                        while($x > 1950){
                            echo "<option value=$x>$x</option>";
                            $x--;
                        }
                    ?>
            </select> 
            <select name="month" class="custom-input1">
                <option value="none" disabled selected><?php echo $lang["reg-form"]["placeholder"]["dob"]["m"]; ?></option>
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
                <option value="none" disabled selected><?php echo $lang["reg-form"]["placeholder"]["dob"]["d"]; ?></option>
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
            <a href="index.php" class="custom-button1 split-buttons"><?php echo $lang["reg-form"]["back-button"]; ?></a>
            <input class="custom-button1 split-buttons" type="submit" id="create-account" value = '<?php echo $lang["reg-form"]["register-button"]; ?>'/>
        </div>
    </form>
</div>