<!DOCTYPE html>
<html>
<head>
    <title>BusinessAdmin</title>
    <link rel="stylesheet" href="lib/css/adminStyle.css"/>
</head>
<body>
<?php require_once("lib/navbar.php") ?>
<div class="container">
    <h2>Business Submition Page</h2>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form>
                <div class="form-group">
                    <label for="Name">Name</label>
                    <div id="">
                    <input type="text" class="form-control" id="name" name="Name">
                        </div>
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <div>
                    <input type="text" class="form-control" id="address" name="Address">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <div>
                    <input type="text" class="form-control" id="email" name="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Phone">Phone</label>
                    <div>
                    <input type="number" class="form-control" id="phone" name="Phone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Speed">Website</label>
                    <div>
                    <input type="text" class="form-control" id="speed" name="Speed">
                </div>
                <div class="form-group">
                    <label for="Zip">Zip Code</label>
                    <div>
                    <input type="number" class="form-control" id="zip" name="Zip">
                    </div>
                </div>
                <div class="form-group">
                   <label for="Images">Images</label>
                   <input type="image" class="form-control" id="images" name="Images">
               </div>
                <div class="form-group">
                    <label for="Submit">Submit</label>
                    <div>
                    <input type="submit" class="form-control" id="submit" name="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="table">
    <table class="businessAdminTable" align="center">
        <tr>
            <td>Business Table</td>
            <td></td>
        </tr>
        <tr>
            <td>BusinessID</td>
            <td>FAKE INFO</td>
        </tr>
        <tr>
            <td>Business Name</td>
            <td>Stuff here</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>Stuff</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>Stuff</td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>Stuff</td>
        </tr>
        <tr>
            <td>Website</td>
            <td>Stuff</td>
        </tr>
        <tr>
            <td>Images</td>
            <td>Stuff</td>
        </tr>
        <tr>
            <td>Zip Code</td>
            <td>Stuff</td>
        </tr>
    </table>
</div>
</body>
</html>