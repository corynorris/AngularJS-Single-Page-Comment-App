<!-- app/views/index.php -->

<!doctype html> <html lang="en"> <head> <meta charset="UTF-8"> <title>Laravel and Angular Comment System</title>

<!-- CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> <!-- load bootstrap via cdn -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- load fontawesome -->
<style>
    body        { padding-top:30px; }
    form        { padding-bottom:20px; }
    .comment    {
        position: relative;
        margin-bottom:20px;
    }
    .details {
        border-left: 4px solid #DDD;
        padding: 1em;
    }
    .author {
        display: inline-block;
    }
    .comment footer {
        position: absolute;
        right: 5px;
        bottom: 0;
    }
    form .ng-dirty.ng-invalid {
        border-color: red;
    }
    form .ng-dirty.ng-valid {
        border-color: green;
    }


</style>

<!-- JS -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
<script src="https://code.angularjs.org/1.5.0/angular-resource.min.js"></script>


<!-- ANGULAR -->
<!-- all angular resources will be loaded from the /public folder -->
<script src="/js/services/commentService.js"></script> <!-- load our service -->
<script src="/js/controllers/commentController.js"></script> <!-- load our controller -->
<script src="/js/app.js"></script> <!-- load our application -->


</head>
<!-- declare our angular app and controller -->
<body class="container" ng-app="commentApp" ng-controller="commentCtrl">
    <div class="col-md-8 col-md-offset-2">

        <header>
            <h1>Simple AngularJS Comment App</h1>
            <small>Based on <a href="https://scotch.io/tutorials/create-a-laravel-and-angular-single-page-comment-application">this</a> but with many improvements including: resource instead of http, filter, search, backend and response handling different angular code and laravel 5.2</small>
        </header>
        <hr>
        <section class="new-comment panel panel-default">
            <div class="panel-heading">New Comment</div>
            <div class="panel-body">
                <form name="newCommentForm" ng-submit="newCommentForm.$valid && submitComment()" novalidate> <!-- ng-submit will disable the default form action and use our function -->

                    <div class="form-group">
                        <input type="text" class="form-control input-sm" name="author" ng-model="newComment.author" placeholder="Name" ng-minlength="2" required>

                    </div>

                    <div class="form-group">
                        <textarea type="text" class="form-control" name="comment" ng-model="newComment.text" placeholder="Your thoughts" rows="5" ng-minlength="10" required></textarea>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </section>
        <hr>
        <section class="filters">
            <div class="form-inline">
                <div class="form-group">
                    <label for="search">Search: </label>
                    <input id="search" class="form-control" ng-model="query">
                </div>
                <div class="form-group">
                    <label for="sort">Sort: </label>
                    <select id="sort" class="form-control" ng-model="orderProp">
                      <option value="author">Author</option>
                      <option value="-created_at">Newest</option>
                  </select>
              </div>
          </div>
      </section>
      <hr>
      <article class="comment" ng-hide="loading" ng-repeat="comment in comments | filter:query | orderBy:orderProp">
        <header>
           <small class="date">posted at: {{ comment.created_at }}</small>
        </header>
        <div class="details">
            <p>{{ comment.text }}</p>
            <div class="author">by {{ comment.author }}</div>
        </div>
        <footer>
            <a href="#" ng-click="deleteComment(comment)" class="text-muted">Delete</a>
        </footer>
    </article>
</section>
</div>
</body>
</html>
