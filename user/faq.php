<?php include('partials_front/header.php'); ?>
<?php 
	if(isset($_SESSION['user'])){
		$rescheck=mysqli_query($conn,"SELECT * from customer where cstatus=1 and cusID='".$_SESSION['user']."'");
		if(mysqli_num_rows($rescheck)!=1){
			unset($_SESSION['user']);
			$_SESSION['inactive']="Your account is inactive!";
			header("location:".SITEURL."user/login-register.php");
		}
	}
?>
<div class="main-content main-content-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="trail-item trail-end active">
                            FAQs
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area content-about col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="site-main">
                    <div class="page-main-content" style="margin-top:450px; margin-bottom:120px;">    
                    <div class="accordion">
                        <h2 class="custom-blog-title">Frequently Asked Questions</h2>
                        <div class="item">
                        <div class="question">
                            Can I choose the delivery date & time?
                        </div>
                        <div class="answer">
                            <p>Yes, you can. During checkout, you can choose your preferred delivery date and the time in advance of 3 days. 

                        We delivery from Sunday to Saturday. Our time delivery is 8:00 am- 10:00pm.

                            </p>
                        </div>
                        </div>
                        
                        <div class="item">
                        <div class="question">
                            How do I check my order status?
                        </div>
                        <div class="answer">
                            <p>Under ‘My Orders’, choose your current order to check your order status.</p>
                        </div>
                        </div>
                        <div class="item">
                        <div class="question">
                            Why is my order delayed?
                        </div>
                        <div class="answer">
                            <p>Delayed delivery could be caused by a number of hindrances such as operational issues, road issues, or bad weather. We will endeavour to notify you of such delays.

                            You may contact our customer service for more.</p>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('partials_front/footer.php'); ?>

<style>

* {
  margin:0px;
  padding:0px;
  box-sizing:border-box;
}

body {
  background:#fdfdfd;
}
.accordion {
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
  padding:25px;
  background:#fff;
  width:100%;
  max-width:500px;
  border-radius:10px;
  box-shadow:0px 5px 10px 2px rgba(0,0,0,0.05);
}
.accordion h2 {
  margin:10px 2px 25px;
  font-size:18px;
  color:#111;
}
.accordion .item {
  margin:15px 0px;
  border-radius:5px;
  overflow:hidden;
}
.accordion > div:nth-child(2){
  background:#e8eef5;
  border-left:4px solid #21b1ea;
}
.accordion > div:nth-child(3){
  background:#f5e8e8;
  border-left:4px solid #ea2121;
}
.accordion > div:nth-child(4){
  background:#efeeed;
  border-left:4px solid #eaa421;
}
.accordion > div:nth-child(5){
  background:#eee3ef;
  border-left:4px solid #df21ea;
}
.accordion > div:nth-child(6){
  background:#eaeae0;
  border-left:4px solid #c5c51c;
}
.accordion .item .question {
  position:relative;
  padding:10px 0px;
  padding-left:40px;
  font-size:15px;
  font-weight:600;
  color:#222;
  cursor:pointer;
}
.accordion .item .question:before {
  content:"+";
  position:absolute;
  top:50%;
  left:20px;
  transform:translate(-50%,-50%) rotate(0deg);
  width:20px;
  height:20px;
  font-size:20px;
  line-height:20px;
  font-weight:400;
  color:#555;
  text-align:center;
  transition:all 300ms ease-in-out;
}
.accordion .item .answer {
  max-height:0px;
  overflow:hidden;
  font-size:15px;
  color:#222;
  transition:max-height 300ms linear;
}
.accordion .item .answer > * {
  margin:5px 40px 15px;
}
.accordion .item.active .question:before {
  transform:translate(-50%,-50%) rotate(145deg);
}
.accordion .item.active .answer {
  max-height:500px;
}
</style>
<script>
let accordion = document.querySelector(".accordion");
let accordionItems = accordion.querySelectorAll(".item");

for(let i=0;i<accordionItems.length;i++){
  let questionItem = accordionItems[i].querySelector(".question");
  questionItem.addEventListener("click",function(){
    if(accordionItems[i].classList.contains("active")){
      accordionItems[i].classList.remove("active");
    } else {
      try {
        accordion.querySelector(".active").classList.remove("active");
      } catch(msg){}
      accordionItems[i].classList.add("active");
    }
  });
}
</script>
</body>
</html>