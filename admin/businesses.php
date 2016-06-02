<!DOCTYPE html>
<html>
  <head>
    <title>Admin Dashboard</title>

    <link rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
      integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
      crossorigin="anonymous">

  </head>
  <body>

    <div class="modal fade" tabindex="-1" role="dialog" id="newBusinessModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal"
              aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

            <h4 class="modal-title">Add New Mission</h4>
          </div>

          <form>

            <div class="modal-body">

              <div class="form-group">
                <label for="#inputName">Name</label>
                <input type="text" class="form-control" id="inputName"
                  name="name">
              </div>

              <div class="form-group">
                <label for="#inputAddr">Address</label>
                <input type="text" class="form-control" id="inputAddr"
                  name="addr">
              </div>

              <div class="form-group">
                <label for="#inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail"
                  name="email">
              </div>

              <div class="form-group">
                <label for="#inputPhone">Phone</label>
                <input type="text" class="form-control" id="inputPhone"
                  name="phone">
              </div>

              <div class="form-group">
                <label for="#inputSpeed">Speed</label>
                <input type="text" class="form-control" id="inputSpeed"
                  name="speed">
              </div>

              <div class="form-group">
                <label for="#inputPhone">Phone</label>
                <input type="text" class="form-control" id="inputPhone"
                  name="phone" ng-model="phone">
              </div>

              <div class="form-group">
                <label for="#inputWebsite">Website</label>
                <input type="text" class="form-control" id="inputWebsite"
                  name="website">
              </div>

              <div class="form-group">
                <label for="#inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip"
                  name="zip">
              </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

          </form>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="container">

      <div class="page-header">
        <h1>Business Admin</h1>
        <p class="lead">
          <a href="#newBusinessModal" data-toggle="modal">Add New Business</a>
        </p>
      </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
      integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
      crossorigin="anonymous">
    </script>

  <body>
</html>
