<form name="login" class="form-layout"> 
    <table class="table-layout">
        <tbody>
            <tr>
                <th colspan="2">
                    <h3>Logga in</h3>
                </th>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td><label for="pwd">Password</label></td>
                <td><input type="password" name="pwd"></td>
            </tr>
            <tr>
                <!--<input type="button" value="Need an account ?" id="form-register"/>-->
                <td><a href="?register=true">Create a account</a></td>
                <td class="text-align-r"><input type="button" id="login" value="Logga in"/></td>
            </tr>
        </tbody>
    </table>
</form>