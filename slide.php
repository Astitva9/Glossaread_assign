<!DOCTYPE html>
<html lang="en">
<head>
  <title>Glossaread Assignment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="/glossaread_assignment/copyright.js"></script>
      <!------ Include the above in your HEAD tag ---------->


  <style type="text/css">



html, body {
  background: #F7F5E6;
  height: 100%;
  margin: 0;
  padding: 0;
  width: 100%;
}

.slider {
  margin: 0 auto;
  max-width: 940px;
}

.slide_viewer {
    height: 350px;
    margin-top: 25%;
    overflow: hidden;
    position: relative;
}

.slide_group {
  height: 100%;
  position: relative;
  width: 100%;
  overflow: auto;
  background: #D1D1D4;
}

.slide {
  display: none;
  height: 100%;
  position: absolute;
  width: 100%;
  text-align: center;
  font-size: 36px;
  font-weight: 600;
  color: #090915;
  padding-top: 0%;
}
.top-file input {
    background: #43464c;
    color: #fff;
    border: 1px solid #000;
    padding: 10px 20px;
}

.slide:first-child {
  display: block;
}

.slide:nth-of-type(1) {
  background: #D1D1D4;
}

.slide:nth-of-type(2) {
  background: #D1D1D4;
}

.slide:nth-of-type(3) {
  background: #D1D1D4;
}

.slide:nth-of-type(4) {
  background: #D1D1D4;
}

.slide_buttons {
  left: 0;
  position: absolute;
  right: 0;
  text-align: center;
}

a.slide_btn {
  color: #474544;
  font-size: 42px;
  margin: 0 0.175em;
  -webkit-transition: all 0.4s ease-in-out;
  -moz-transition: all 0.4s ease-in-out;
  -ms-transition: all 0.4s ease-in-out;
  -o-transition: all 0.4s ease-in-out;
  transition: all 0.4s ease-in-out;
}

.slide_btn.active, .slide_btn:hover {
  color: #428CC6;
  cursor: pointer;
}

.directional_nav {
  height: 340px;
  margin: 0 auto;
  max-width: 940px;
  position: relative;
  top: -340px;
}

.previous_btn {
  bottom: 0;
  left: 100px;
  margin: auto;
  position: absolute;
  top: 0;
}

.next_btn {
  bottom: 0;
  margin: auto;
  position: absolute;
  right: 100px;
  top: 0;
}

.previous_btn, .next_btn {
  cursor: pointer;
  height: 65px;
  opacity: 0.5;
  -webkit-transition: opacity 0.4s ease-in-out;
  -moz-transition: opacity 0.4s ease-in-out;
  -ms-transition: opacity 0.4s ease-in-out;
  -o-transition: opacity 0.4s ease-in-out;
  transition: opacity 0.4s ease-in-out;
  width: 65px;
}

.previous_btn:hover, .next_btn:hover {
  opacity: 1;
}
.top-file {
    position: absolute;
    left: 42%;
    top: 25%;
}

@media only screen and (max-width: 767px) {
  .previous_btn {
    left: 50px;
  }
  .next_btn {
    right: 50px;
  }
}

  </style>

</head>
<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
include ( 'PdfToText.phpclass' ) ;

if(isset($_FILES['pfile'])){
  $errors= array();
  $file_name = $_FILES['pfile']['name'];
  $file_size =$_FILES['pfile']['size'];
  $file_tmp =$_FILES['pfile']['tmp_name'];
  $file_type=$_FILES['pfile']['type'];

  function  output ( $message ){
    if  ( php_sapi_name ( )  ==  'cli' )
      echo ( $message ) ;
    else
      echo ( nl2br ( $message ) ) ;
    }
    
  if(empty($errors)==true){

    $file_dest="pdfs/".$file_name;

    move_uploaded_file($file_tmp, $file_dest);
   

    $pdf = new PdfToText($file_dest, PdfToText :: PDFOPT_DECODE_IMAGE_DATA);
     
     
  }else{
     print_r($errors);
  }
}




?>
<body>

<div class="container">
<h2>Glossaread Assignment To upload PHP and prevent it from <br> copy,cut,paste,save,print and temparing data </h2>

<div class="slider">

<form method="POST" action="" name="form-pdf" enctype="multipart/form-data">

  <div class="top-file">

    <input type="file" name="pfile" id="pfile">

    <input type="submit" name="submit" value="submit">

  </div>

</form>


  <div class="slide_viewer">
    <div class="slide_group">

      <?php foreach( $pdf -> Pages as $page_number => $page_contents): ?>
       
        <div class="slide">
        
        <?php echo "\n".($page_contents)?$page_contents:"No Content Available!!"."\n"; ?>
        
        <center>Page No. : <?php echo $page_number; ?></center>

        </div>
      
      <?php endforeach;?> 

       
      <?php  $image_count 	=  count ( $pdf -> Images ) ;
	
          if  ( $image_count ){ ?>
           <p>
           <?php  
            for  ( $i = 0 ; $i  <  $image_count ; $i ++ )
              {
                $img		=  $pdf -> Images [$i] ;			// This is an object of type PdfImage
                $imgindex 	=  sprintf ( "%02d", $i + 1 ) ;
                $output_image	=  "$file_dest.$imgindex.jpg" ;

                $textcolor	=  imagecolorallocate ( $img -> ImageResource, 0, 0, 255 ) ;

                imagestring ( $img -> ImageResource, 5, 0, 0, "Hello world #$imgindex", $textcolor ) ;

                $img -> SaveAs ( $imgindex."jpg" ) ;

                ?>
                  <img src="/glossaread_assignment/<?php echo $imgindex."jpg";?>">
                <?php
              }
           ?>
            </p>  

        <?php }  ?>
      
    </div>
  </div>
</div>
<!-- End // .slider -->

<div class="slide_buttons">
</div>


</div>
<!-- End // .directional_nav -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript">
  $('.slider').each(function() {
  var $this = $(this);
  var $group = $this.find('.slide_group');
  var $slides = $this.find('.slide');
  var bulletArray = [];
  var currentIndex = 0;
  var timeout;
  
  function move(newIndex) {
    var animateLeft, slideLeft;
    
    //advance();
    
    if ($group.is(':animated') || currentIndex === newIndex) {
      return;
    }
    
    bulletArray[currentIndex].removeClass('active');
    bulletArray[newIndex].addClass('active');
    
    if (newIndex > currentIndex) {
      slideLeft = '100%';
      animateLeft = '-100%';
    } else {
      slideLeft = '-100%';
      animateLeft = '100%';
    }
    
    $slides.eq(newIndex).css({
      display: 'block',
      left: slideLeft
    });
    $group.animate({
      left: animateLeft
    }, function() {
      $slides.eq(currentIndex).css({
        display: 'none'
      });
      $slides.eq(newIndex).css({
        left: 0
      });
      $group.css({
        left: 0
      });
      currentIndex = newIndex;
    });
  }
  
  function advance() {
    clearTimeout(timeout);
    timeout = setTimeout(function() {
      if (currentIndex < ($slides.length - 1)) {
        move(currentIndex + 1);
      } else {
        move(0);
      }
    }, 4000);
  }
  
  $('.next_btn').on('click', function() {
    if (currentIndex < ($slides.length - 1)) {
      move(currentIndex + 1);
    } else {
      move(0);
    }
  });
  
  $('.previous_btn').on('click', function() {
    if (currentIndex !== 0) {
      move(currentIndex - 1);
    } else {
      move(3);
    }
  });
  
  $.each($slides, function(index) {
    var $button = $('<a class="slide_btn">&#8226;</a>');
    
    if (index === currentIndex) {
      $button.addClass('active');
    }
    $button.on('click', function() {
      move(index);
    }).appendTo('.slide_buttons');
    bulletArray.push($button);
  });
  
 // advance();
});
</script>

</body>
</html>
