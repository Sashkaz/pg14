<form name="register" class="form-layout"> 
    <table class="table-layout">
        <tbody>
            <tr>
                <th colspan="2">
                    <h3>Skappa ett konto</h3>
                </th>
            </tr>
            <tr>
                <td><label for="uname">Förnamn:</label></td>
                <td><input type="text" name="uname" /></td>
            
            </tr>
            <tr>
                <td><label for="uname">Efternamn:</label></td>
                <td><input type="text" name="uname" /></td>
            
            </tr>
            <tr>
                <td><label for="email">E-post:</label></td>
                <td><input type="text" name="email" /></td>
            
            </tr>
            <tr>
                <td><label for="pwd">Lösenord:</label></td>
                <td><input type="password" name="pwd" /></td>
            
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
            
            </tr>
            <tr>
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

                <td><a href="index.php">Tillbaka till login</a></td>
                <td class="text-align-r"><input type="button" value="Skappa konto" id="create-account" /></td>
            </tr>
        </tbody>
    </table>
</form>
