<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<!DOCTYPE>
    <html>

    <head>
        <title>Blog Page</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/adminstyles.css">
        <link rel="stylesheet" href="css/publicstyles.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.2.1.min.js"></script>
        <style>
            body{
                background-color: azure;
            }
            
        </style>
    </head>
        <body>
            <div style="height:10px; background: #27aae1;"></div>
            <nav class="navbar navbar-inverse" role="navigation">
                
                 <div  class="container">
                     <div class="navbar-header">
                         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                         <span class="sr-only">Toggle Navigation</span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                         </button>
                         <div class="collapse navbar-collapse" id="collapse">
                     <ul class="nav navbar-nav">
                         <li><a href="#">Home</a></li>
                         <li class="active"><a href="#">Blog</a></li>
                         <li><a href="#">About Us</a></li>
                         <li><a href="#">Services</a></li>
                         <li><a href="#">Contact Us</a></li>
                         <li><a href="#">Feature</a></li>
                         </ul>
                         <form action="blog.php" class="navbar-form navbar-right">
                         <div class="form-group">
                             <input type="text" class="form-control" placeholder="SEARCH" name="Search">
                             </div>
                             <button class="btn btn-default" name="SearchButton">Go</button>
                             
                         </form>
                             </div>
                     </div>
                
                     </div> </nav>
            <div style="margin-top: -20px; height:10px; background: #27aae1;"></div>
            <div class="container"> <!--Container-->
            <div class="blog-header">
                <h1>The Complete Responsive CMS Blog</h1>
                <p class="lead">The Complete blog using PHP by Javeria Gauhar Khan</p>
                </div>
                <div class="row"> <!-- Row -->
                <div class="col-sm-8"> <!-- Main Blog Area -->
                   <?php
                    global $ConnectingDB;
                    if(isset($_GET['SearchButton'])){
                        $Search=$_GET['Search'];
                        $ViewQuery="SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
                    }
                    // col-sm-3 query when category is active on url tab
                    elseif(isset($_GET["Category"])){
                        $Category=$_GET["Category"];
                    $ViewQuery="SELECT * FROM admin_panel WHERE category='$Category' ORDER BY datetime desc";
                    }
                    elseif(isset($_GET['Page'])){
                        $Page=$_GET['Page'];
                        if($Page==0 || $Page<1){
                            $ShowPostFrom=0;
                        }
                        else{
                            $ShowPostFrom=($Page*5)-5; }
                        $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT $ShowPostFrom,5";
                        }
                    
                    else{
                    $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc";}
                    $Execute=mysql_query($ViewQuery);
                    while($Datarows=mysql_fetch_array($Execute)){
                        $Postid=$Datarows['id'];
                        $DateTime=$Datarows['datetime'];
                        $Title=$Datarows['title'];
                        $Category=$Datarows['category'];
                        $Admin=$Datarows['author'];
                        $Image=$Datarows['image'];
                        $Post=$Datarows['post'];
                
                    ?>
                    <div class="col-sm-8">
                    <div class="blogpost thumbnail">
                    <img class="img-responsive img-rounded" src="upload/<?php echo $Image;?>">
                    
                    <div class="caption">
                    <h1 id="heading"> <?php echo htmlentities($Title);?></h1>
                        <p class="description">Category: <?php echo htmlentities($Category);?> Published on <?php echo htmlentities($DateTime);?></p>
                        <p class="post"><?php 
                        if(strlen($Post)>150) {
                            $Post=substr($Post,0,150).'...';
                        }
                        echo $Post; ?></p>
                        </div>
                        <a href="fullpost.php?id=<?php echo $Postid; ?>"><span class="btn btn-info">Read More &rsaquo; &rsaquo;</span></a>
                    </div>
                    <?php } ?>
                    <nav>
                    <ul class="pagination pull-left pagination-lg">
                        <?php
                        if(isset($Page)){
                            if($Page>1){
                        ?>
                        <li><a href="blog.php?Page=<?php echo $Page-1;?>"> &laquo;</a></li>
                        <?php } }?>
                    <?php 
                    global $ConnectingDB;
                    $QueryPagination="SELECT COUNT(*) FROM admin_panel";
                    $ExecutePagination=mysql_query($QueryPagination);
                    $RowPagination=mysql_fetch_array($ExecutePagination);
                    $TotalPosts=array_shift($RowPagination);
                    $PostPagination=$TotalPosts/5;
                    $PostPagination=ceil($PostPagination);
                    for($i;$i<=$PostPagination;$i++){
                        if(isset($Page)){ 
                            if($i==$Page){
                    ?>
                        <li class=""active><a href="blog.php?Page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php } else{ ?>
                        <li><a href="blog.php?Page=<?php echo $i;?>"><?php echo $i;?></a></li>
                    <?php } }  } ?>
                        <?php 
                        if(isset($Page)){
                            if($Page+1<=$PostPagination){
                        
                        ?>
                        <li><a href="blog.php?Page=<?php echo $Page+1;?>"></a></li>
                        <?php } }?>
                        </ul>
                    </nav>
                    </div> <!-- ending of main area -->
                    <div class="col-sm-offset-1 col-sm-3"> <!-- side area -->
                        <h2>About Me</h2>
                        <img class="img-responsive img-circle imageicon" src="images/bunny.jpg"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="panel-title">Categories</h2>
                            </div>
                            <div class="panel-body">
                            <?php 
                                $ViewQuery="SELECT * FROM category ORDER BY datetime desc LIMIT 0,5";
                                $Execute=mysql_query($ViewQuery);
                                while($DataRows=mysql_fetch_array($Execute)){
                                    $Id=$DataRows['id'];
                                    $Category=$DataRows['name'];
                                
                                ?>
                                <a href="blog.php?Category=<?php echo $Category;?>">
                                    <span id="heading"><?php echo $Category."<br>";?></span> </a>
                                <?php } ?>
                            </div>
                            <div class="panel-footer">
                            
                            </div>
                        </div>
                         <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="panel-title">Recent Posts</h2>
                            </div>
                            <div class="panel-body background">
                            <?php 
                                $ConnectingDB;
                                $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc ";
                                $Execute=mysql_query($ViewQuery);
                                while($DataRows=mysql_fetch_array($Execute)){
                                    $Id=$DataRows["id"];
                                    $Title=$DataRows["title"];
                                    $DateTime=$DataRows["datetime"];
                                    $Image=$DataRows["image"];
                                if(strlen($DateTime)>11){
                                    $DateTime=substr($DateTime,0,11);}
                                
                                ?>
                                <img class="pull-left" style="margin-top:10px; margin-left:10px; width:70; height:70;" src="upload/<?php echo $Image?>"><a href="fullpost.php?id=<?php echo $Id;?>">
                                <p id="heading" style="margin-left:90px;"><?php echo htmlentities($Title);?></p> </a>
                              <p class="description" style="margin-left:90px;"> <?php echo htmlentities($DateTime);?></p> 
                                <hr>
                                     
                            </div>
                             <?php } ?>
                            <div class="panel-footer">
                            
                            </div>
                        </div>
                    </div>
                    <!-- Ending Of Side Area -->
                </div> <!-- row ending -->
            </div><!--Container ending -->
            
            <div id="footer">
            <hr> <p> Theme By | Jiya Khan | &copy;2017-2020 --- All Rights Reserved.</p>
                <a style="color:white; text-decoration:none; cursor:pointer font-weight:bold;" href="#"> <p>This site is only used for study purpose javeriakhan.com have all the rights. no one is allowed to discopy other than <br>&trade; Udemy ; &trade; Skillshare ; &trade; Stackskills</p></a>
            </div>
            </div>
        </body>
        
        
</html>