<!DOCTYPE>
<html>
<head>
    <link rel="stylesheet" href="/lib/css/styleindex.css">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
          integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ=="
          crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="short icon" href="lib/images/Logo_converted.ico">
</head>

<style>

  html, body {
    height: 100%;
  }

  .tweet-carousel {
    height: 25%;
  }

  .tweet-carousel .right {
    padding-left: 0;
  }

  .tweet-carousel .carousel-indicators li {
    background-color: #FF0000;
  }

  .tweet-carousel .carousel-control {
    background-image: none;
    color: #FF0000;
  }
</style>

<body ng-app="fastcasualfine">

    <?php require_once("lib/navbar.php")?>

    <div class="container" id="margin-tweet">

      <div class="row">

        <div class="col-md-4">
            <img class="logo" src="lib/images/FastCasualFinelogo.jpg"/>
        </div>

        <div class="col-md-8">

          <h2>FastCasualFine @ Twitter</h2>
          <p class="lead">Mention us on Twitter, show up on our homepage!</p>

          <div id="tweetCarousel" class="carousel tweet-carousel slide"
            data-ride="carousel" ng-controller="TweetCtrl" ng-init="getTweets()">
            <!-- Indicators -->
            <ol class="carousel-indicators">

              <li data-target="#tweetCarousel" data-slide-to="{{ $index }}"
                ng-repeat="tweet in tweets track by $index" ng-class="{active: $index === 0}"></li>

            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

              <div class="item" ng-repeat="tweet in tweets track by $index" ng-class="{active: $index === 0}">
                <h3 class="text-center">{{ tweet.text }}</h3>
              </div>

            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#tweetCarousel" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#tweetCarousel" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

        </div>

      </div>
    </div>

    <hr/>

    <div class="container">
        <div class="col-md-12">
            <div class="vertical-text"><h1>Fast</h1></div>
            <div class="well well-background">
                <div id="myCarousel" class="carousel slide">

                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-2"><a href=""><img src="/lib/imagesfast/taco.jpg" alt="Image" class="img-responsive"></a>
                                    <p>Taco Bell</p>
                                    <p>2100 W. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href=""><img src="/lib/imagesfast/arbys.jpg" alt="Image" class="img-responsive"></a>
                                    <p>Arby's</p>
                                    <p>1825 E. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/blakes.png" alt="Image" class="img-responsive"></a>
                                    <p>Blakes Lotaburger</p>
                                    <p>1611 W. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/burgerking.jpg" alt="Image" class="img-responsive"></a>
                                    <p>Blakes Lotaburger</p>
                                    <p>1611 W. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/churchs.png" alt="Image" class="img-responsive"></a>
                                    <p>Churchs Chicken</p>
                                    <p>2711 E. 20th st.   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/corndogsplus.jpg" alt="Image" class="img-responsive"></a>
                                    <p>Corn Dogs Plus</p>
                                    <p>3000 E. 20th st.   Farmington , N.M.</p>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                        <!--/item-->
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/dominos1.png" alt="Image" class="img-responsive"></a>
                                    <p>Domino's Pizza</p>
                                    <p>3000 E. 20th st.   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/dq.jpg" alt="Image" class="img-responsive"></a>
                                    <p>Dairy Queen</p>
                                    <p>721 E. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/dunkind.png" alt="Image" class="img-responsive"></a>
                                    <p>Dunkin' Donuts</p>
                                    <p>3030 E. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/famouswok.jpg" alt="Image" class="img-responsive"></a>
                                    <p>Famous Wok</p>
                                    <p>Animas Valley Mall   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/fatboy.jpg" alt="Image" class="img-responsive"></a>
                                    <p>Fat Boys Deli</p>
                                    <p>1301 20th st.   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/freddys.png" alt="Image" class="img-responsive"></a>
                                    <p>Chester's Chicken</p>
                                    <p>3125 Bloomfield Hwy   Farmington, N.M.</p>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                        <!--/item-->
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/hometown.jpg" alt="Image" class="img-responsive"></a>
                                    <p>Hometown Hamburgers</p>
                                    <p>2133 E. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/jimmyjohn.png" alt="Image" class="img-responsive"></a>
                                    <p>Jimmy John's Gourmet Sandwiches</p>
                                    <p>3060 E. 20th. st. Suite #B   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/kfc1.jpg" alt="Image" class="img-responsive"></a>
                                    <p>Kentucky Fried Chicken</p>
                                    <p>532 E. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/mcd1.png" alt="Image" class="img-responsive"></a>
                                    <p>McDonald's</p>
                                    <p>2215 E. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/p9.png" alt="Image" class="img-responsive"></a>
                                    <p>Pizza 9</p>
                                    <p>685 S. Scott Ave.   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/papam.png" alt="Image" class="img-responsive"></a>
                                    <p>Papa Murphy's Take 'N' Bake Pizza</p>
                                    <p>3554 E. Main   Farmington, N.M.</p>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                        <!--/item-->
                    </div>
                    <!--/carousel-inner--> <a class="left" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>

                    <a class="right" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                </div>
                <!--/myCarousel-->
            </div>
            <!--/well-->
        </div>
    </div>


    <div class="container">
        <div class="col-md-12">
            <div class="container text">
                <div class="vertical-text"><h1>Casual</h1></div>
            </div>
            <div class="well">
                <div id="myother" class="carousel slide">

                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-3"><a href="#"><img src="/lib/imagescasual/A&W.jpg" alt="Image" class="img-responsive"></a>
                                    <h2>A & W Rootbeer Drive In</h2>
                                    <p>908 W. Aztec Blvd   Aztec, N.M.</p>
                                </div>
                                <div class="col-sm-3"><a href="#x"><img src="/lib/imagescasual/costavida.png" alt="Image" class="img-responsive"></a>
                                    <h2>Costa Vida</h2>
                                    <p>4009 E. Main   Farmington,N.M.</p>
                                </div>
                                <div class="col-sm-3"><a href="#x"><img src="/lib/imagescasual/cecilias.jpg" alt="Image" class="img-responsive"></a>
                                    <h2>Cecilia's Hispanic & Mexican Restaurant</h2>
                                    <p>2501 E. 20th st.   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-3"><a href="#x"><img src="/lib/imagescasual/djs.jpg" alt="Image" class="img-responsive"></a>
                                    <h2>DJ's Pizza</h2>
                                    <p>410 W. Broadway   Bloomfield, N.M.</p>
                                </div>
                            </div>
                        </div>
                        <!--/carousel-inner--> <a class="left" href="#myother" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>

                        <a class="right" href="#myother" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                    </div
                </div>
                </div>
            </div>
        </div>


    <div class="container">
        <div class="col-md-12">
            <div class="vertical-text"><h1>Fine</h1></div>
            <div class="well">
                <div id="myCarousel" class="carousel slide">

                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-2"><a href=""><img src="/lib/imagesfast/505burgers.png" alt="Image" class="img-responsive"></a>
                                    <p>505 Burgers & Wings</p>
                                    <p>820 Sullivan Ave.   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href=""><img src="/lib/imagesfast/Arby's.png" alt="Image" class="img-responsive"></a>
                                    <h2>Arby's</h2>
                                    <p>1825 E. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/blakes.png" alt="Image" class="img-responsive"></a>
                                    <h2>Blakes Lotaburger</h2>
                                    <p>1611 W. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/burgerking.jpg" alt="Image" class="img-responsive"></a>
                                    <h2>Blakes Lotaburger</h2>
                                    <p>1611 W. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/churchs.png" alt="Image" class="img-responsive"></a>
                                    <h2>Churchs Chicken</h2>
                                    <p>2711 E. 20th st.   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/corndogsplus.jpg" alt="Image" class="img-responsive"></a>
                                    <h2>Corn Dogs Plus</h2>
                                    <p>3000 E. 20th st.   Farmington , N.M.</p>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                        <!--/item-->
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/dominos1.png" alt="Image" class="img-responsive"></a>
                                    <h2>Domino's Pizza</h2>
                                    <p>3000 E. 20th st.   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/dq.jpg" alt="Image" class="img-responsive"></a>
                                    <h2>Dairy Queen</h2>
                                    <p>721 E. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/dunkind.png" alt="Image" class="img-responsive"></a>
                                    <h2>Dunkin' Donuts</h2>
                                    <p>3030 E. Main   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/famouswok.jpg" alt="Image" class="img-responsive"></a>
                                    <h2>Famous Wok</h2>
                                    <p>Animas Valley Mall   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/fatboy.jpg" alt="Image" class="img-responsive"></a>
                                    <h2>Fat Boys Deli</h2>
                                    <p>1301 20th st.   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/freddys.png" alt="Image" class="img-responsive"></a>
                                    <p>Chester's Chicken</p>
                                    <p>3125 Bloomfield Hwy   Farmington, N.M.</p>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                        <!--/item-->
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/hometown.jpg" alt="Image" class="img-responsive"></a>
                                    <p>Chester's Chicken</p>
                                    <p>3125 Bloomfield Hwy   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/jimmyjohn.png" alt="Image" class="img-responsive"></a>
                                    <p>Chester's Chicken</p>
                                    <p>3125 Bloomfield Hwy   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/kfc1.jpg" alt="Image" class="img-responsive"></a>
                                    <p>Chester's Chicken</p>
                                    <p>3125 Bloomfield Hwy   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/mcd1.png" alt="Image" class="img-responsive"></a>
                                    <p>Chester's Chicken</p>
                                    <p>3125 Bloomfield Hwy   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/p9.png" alt="Image" class="img-responsive"></a>
                                    <p>Chester's Chicken</p>
                                    <p>3125 Bloomfield Hwy   Farmington, N.M.</p>
                                </div>
                                <div class="col-sm-2"><a href="#x"><img src="/lib/imagesfast/papam.png" alt="Image" class="img-responsive"></a>
                                    <p>Chester's Chicken</p>
                                    <p>3125 Bloomfield Hwy   Farmington, N.M.</p>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                        <!--/item-->
                    </div>
                    <!--/carousel-inner--> <a class="left" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>

                    <a class="right" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                </div>
                <!--/myCarousel-->
            </div>
            <!--/well-->
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.6/angular.min.js"></script>
    <script src="lib/js/carousel.js"></script>
    <script src="/lib/js/tweetwall.js"></script>

</body>

</html>
