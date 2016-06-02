<!DOCTYPE html>
<html>
  <head>
    <title>Admin Dashboard</title>

    <link rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
      integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
      crossorigin="anonymous">

    <link type="text/css"
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

  </head>
  <body ng-app="FCFBusiness">

    <!-- Modal for Adding / Editing Businesses -->
    <div class="modal fade" tabindex="-1" role="dialog" id="newBusinessModal"
      ng-controller="BusinessFormCtrl">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal"
              aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

            <h4 class="modal-title">Add New Business</h4>
          </div>

          <form ng-submit="sendBusiness()">

            <div class="modal-body">

              <div class="form-group">
                <label for="#inputName">Name</label>
                <input type="text" class="form-control" id="inputName"
                  name="name" ng-model="businessName">
              </div>

              <div class="form-group">
                <label for="#inputAddr">Address</label>
                <input type="text" class="form-control" id="inputAddr"
                  name="addr" ng-model="address">
              </div>

              <div class="form-group">
                <label for="#inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip"
                  name="zip" ng-model="zip">
              </div>

              <div class="form-group">
                <label for="#inputPhone">Phone</label>
                <input type="text" class="form-control" id="inputPhone"
                  name="phone" ng-model="phone">
              </div>

              <div class="form-group">
                <label for="#inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail"
                  name="email" ng-model="email">
              </div>

              <div class="form-group">
                <label for="#inputWebsite">Website</label>
                <input type="text" class="form-control" id="inputWebsite"
                  name="website" ng-model="website">
              </div>

              <div class="form-group">
                <label for="#inputSpeed">Speed</label>
                <input type="text" class="form-control" id="inputSpeed"
                  name="speed" ng-model="speed">
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

    <!-- Modal for Deleting Businesses -->
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteBusinessModal"
      ng-controller="DeleteBizCtrl">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">

          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal"
              aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

            <h4 class="modal-title">Delete Business</h4>
          </div>

          <div class="modal-body">

            <p class="text-center">Are you sure you want to delete
              <strong>{{ business.name }}</strong>?</p>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-danger" ng-click="delete()">
              Delete
            </button>
          </div>

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

      <table class="table" ng-controller="BusinessTable"
        ng-init="getBusinesses()">

        <caption>Stored Businesses</caption>

        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Address</th>
            <th>Zip</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Website</th>
            <th>Speed</th>
            <th>Edit</th>
          </tr>
        </thead>

        <tbody>
          <tr ng-repeat="business in businesses">
            <td>{{ business.businessId }}</td>
            <td>{{ business.name }}</td>
            <td>{{ business.address}}</td>
            <td>{{ business.zip }}</td>
            <td>{{ business.phone }}</td>
            <td>{{ business.email }}</td>
            <td>{{ business.website}}</td>
            <td>{{ business.speed }}</td>
            <td>

              <a href="#" ng-click="editBusiness(business)">
                <i class="fa fa-pencil"></i>
              </a>

              <a href="#" ng-click="deleteBusiness(business)">
                <i class="fa fa-times"></i>
              </a>

            </td>
          </tr>
        </tbody>

      </table>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
      integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
      crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.6/angular.min.js"></script>
    <script src="/lib/js/admin-missions.js"></script>

  <body>
</html>
