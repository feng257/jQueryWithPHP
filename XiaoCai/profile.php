<?php require('header.php'); ?>
<?php error_reporting(E_ALL & ~E_NOTICE); ?>

<div class="login-main-page">
	
<header>
	<nav style="padding-top: 8px;padding-bottom:30px;">
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">填写资料</div>
		</div>
	</nav>
</header>
<?php 
	$root=explode('profile.php', $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
	$root='http://'.$root[0];
	//http://114.215.189.210/api.php/Api/Public/changeData1
?>
<form style="visibility:hidden;margin-top:-100px;" class="uploadhhh" action="changedata1.php" method="post" enctype="multipart/form-data">
	<input type="text" name="token_id">
	<input type="text" name="nickname">
	<input type="file" id="file_head" name="image" onchange="fileChanged()">
	<input type="submit" id="confirm_update">
</form>

<script type="text/javascript">
	$('.uploadhhh input:first-child').attr('value',localStorage.tokenID);
</script>

<section style="margin-top: -84px!important;">
	<div style="margin-top: 50.274%;" class="logo-area register-area profile-upload-photo">
		<div class="profile-phtot-uploaded" style="padding-top:8px;padding-left:6px;" id="localImag">
		    <?php  
  
			/*//上传文件类型列表  
			$uptypes=array(  
			    'image/jpg',  
			    'image/jpeg',  
			    'image/png',  
			    'image/pjpeg',  
			    'image/gif',  
			    'image/bmp',  
			    'image/x-png'  
			);  
			  
			$max_file_size=2000000;     //上传文件大小限制, 单位BYTE  
			$destination_folder="uploadimg/"; //上传文件路径  
			$watermark=0;      //是否附加水印(1为加水印,其他为不加水印);  
			$watertype=1;      //水印类型(1为文字,2为图片)  
			$waterposition=1;     //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);  
			$waterstring="http://www.xiaocai101.com/";  //水印字符串  
			$waterimg="xplore.gif";    //水印图片  
			$imgpreview=1;      //是否生成预览图(1为生成,其他为不生成);  
			$imgpreviewsize=1/2;    //缩略图比例  
			?>
			  
			<?php  
			if ($_SERVER['REQUEST_METHOD'] == 'POST')  
			{  
			    if (!is_uploaded_file($_FILES["upfile"][tmp_name]))  
			    //是否存在文件  
			    {  
			         echo "<script>displayALertForm('图片不存在')</script>";  
			         exit;  
			    }  
			  
			    $file = $_FILES["upfile"];  
			    if($max_file_size < $file["size"])  
			    //检查文件大小  
			    {  
			        echo "<script>displayALertForm('文件太大')</script>";  
			        exit;  
			    }  
			  
			    if(!in_array($file["type"], $uptypes))  
			    //检查文件类型  
			    {  
			        echo "<script>displayALertForm('文件类型不对".$file["type"]."')</script>";  
			        exit;  
			    }  
			  
			    if(!file_exists($destination_folder))  
			    {  
			        mkdir($destination_folder);  
			    }  
			  
			    $filename=$file["tmp_name"];  
			    $image_size = getimagesize($filename);  
			    $pinfo=pathinfo($file["name"]);  
			    $ftype=$pinfo['extension'];  
			    $destination = $destination_folder.time().".".$ftype;
			  
			    if(!move_uploaded_file ($filename, $destination))  
			    {  
			        echo "<script>displayALertForm('移动文件出错')</script>";  
			        exit;  
			    }  
			  
			    $pinfo=pathinfo($destination);  
			    $fname=$pinfo[basename];

			    echo "<script>displayALertForm('上传成功')</script>";

			    if($watermark==1)  
			    {  
			        $iinfo=getimagesize($destination,$iinfo);  
			        $nimage=imagecreatetruecolor($image_size[0],$image_size[1]);  
			        $white=imagecolorallocate($nimage,255,255,255);  
			        $black=imagecolorallocate($nimage,0,0,0);  
			        $red=imagecolorallocate($nimage,255,0,0);  
			        imagefill($nimage,0,0,$white);  
			        switch ($iinfo[2])  
			        {  
			            case 1:  
			            $simage =imagecreatefromgif($destination);  
			            break;  
			            case 2:  
			            $simage =imagecreatefromjpeg($destination);  
			            break;  
			            case 3:  
			            $simage =imagecreatefrompng($destination);  
			            break;  
			            case 6:  
			            $simage =imagecreatefromwbmp($destination);  
			            break;  
			            default:  
			            die("不支持的文件类型");  
			            exit;  
			        }  
			  
			        imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);  
			        imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);  
			  
			        switch($watertype)  
			        {  
			            case 1:   //加水印字符串  
			            imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);  
			            break;  
			            case 2:   //加水印图片  
			            $simage1 =imagecreatefromgif("xplore.gif");  
			            imagecopy($nimage,$simage1,0,0,0,0,85,15);  
			            imagedestroy($simage1);  
			            break;  
			        }  
			  
			        switch ($iinfo[2])  
			        {  
			            case 1:  
			            //imagegif($nimage, $destination);  
			            imagejpeg($nimage, $destination);  
			            break;  
			            case 2:  
			            imagejpeg($nimage, $destination);  
			            break;  
			            case 3:  
			            imagepng($nimage, $destination);  
			            break;  
			            case 6:  
			            imagewbmp($nimage, $destination);  
			            //imagejpeg($nimage, $destination);  
			            break;  
			        }  
			  
			        //覆盖原上传文件  
			        imagedestroy($nimage);  
			        imagedestroy($simage);  
			    }  
			  
			    if($imgpreview==1){  
			    	$root=explode('profile.php', $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
			    	$root='http://'.$root[0];
				    // echo "<img width=\"95\" id=\"user-profile-photo\" height=\"95\" src=\"".$root."$destination\" \/>";
				    echo "<div src=".$root.$destination." style=\"width:95px!important;height:95px!important;background:url(".$root.$destination.") no-repeat scroll 50% 50% transparent;background-size:cover;\"></div>"; 
			    	echo "<script>$('.uploadhhh input:nth-child(3)').attr('value','".$root.$destination."');</script>";
			    }
			}*/

			?>		
		</div>
		<span>上传头像</span>
	</div>

	<div class="profile_update_camera">
		<img src="images/camera.png">
	</div>

	<!-- <form style="display:none;" enctype="multipart/form-data" method="post" name="upform">  
		<input name="upfile" id="file_head" style="display:none" onchange="javascript:setImagePreview();" type="file">  
		<input type="submit" id="upload_btn" style="display:none" value="上传"><br> 
	</form> -->
	
	<div class="setting-list change-password-input">
		<ul>
			<li id="wechat-nickname"><input placeholder="昵称" /></li>
		</ul>
	</div>

	<div class="change-password-submit-button">
		<a id="profile-confirm" class="button button-caution button-pill">确定</a>
	</div>

	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>

	<img style="display:none" id="preview" src="">
	
</section>

</div>

<script type="text/javascript">

	function setImagePreview() {  
	    var docObj=document.getElementById("file_head");  
	    var imgObjPreview=document.getElementById("preview");  
	    if(docObj.files && docObj.files[0]){  
	        //火狐下，直接设img属性  
	        imgObjPreview.style.display = 'none';  
	        imgObjPreview.style.width = '300px';  
	        imgObjPreview.style.height = '120px';                      
	        //imgObjPreview.src = docObj.files[0].getAsDataURL();  
	          
	        //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式    
	        imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);

	        $('.profile-phtot-uploaded div').remove();
	        $('.profile-phtot-uploaded').append('<div src="'+imgObjPreview.src+'" style="width:95px!important;height:95px!important;background:url('+imgObjPreview.src+') no-repeat scroll 50% 50% transparent;background-size:cover;"></div>');
	    }else{  
	        //IE下，使用滤镜  
	        docObj.select();  
	        var imgSrc = document.selection.createRange().text;  
	        // var localImagId = document.getElementById("localImag");  
	        // //必须设置初始大小  
	        // localImagId.style.width = "300px";  
	        // localImagId.style.height = "120px";  
	        //图片异常的捕捉，防止用户修改后缀来伪造图片  
	        try{  
	            localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";  
	            localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;  
	        }catch(e){  
	            alert("您上传的图片格式不正确，请重新选择!");  
	            return false;  
	        }  
	        imgObjPreview.style.display = 'none';  
	        document.selection.empty();  
	    }  
	    return true;  
	}

	var isFileChanged=false;

	function fileChanged(){
		isFileChanged=true;
		setImagePreview();
	}

	$(document).ready(function(){

		var _headimgurl=getQueryString('headimgurl');
		var _error=getQueryString('error');

		if(_error=='1'){
			localStorage.nickname=localStorage.nickname_;
			localStorage.headimgurl=_headimgurl;
			window.location.href="index.php?redirect=profile";
		}else{
			if(_error!=null){
				displayALertForm('设置失败,请检查是否登录或图片名是否包含中文',3000);
			}
		}

		var pupMarginTop=$('.profile-upload-photo').css('margin-top');
		pupMarginTop=pupMarginTop.substring(0,3);
		var cameraDocHeight=$(document).width()/2;

		$('.profile_update_camera').css({
			'top':parseInt(pupMarginTop)+$('.profile-upload-photo').height()-130+'px',
			'left':($(document).width()/2)+20+'px'
		});

		var fileInput=document.getElementById("file_head");
		var confirm=document.getElementById('confirm_update');

		$('.header-back').click(function(){
			history.go(-1);
		});

		$('.profile-phtot-uploaded').append('<div src="'+localStorage.headimgurl+'" style="width:95px!important;height:95px!important;background:url('+localStorage.headimgurl+') no-repeat scroll 50% 50% transparent;background-size:cover;"></div>');
		$('.change-password-input #wechat-nickname input').attr('value',localStorage.nickname);

		$('#profile-confirm').click(function(){
			if(inputInfoIsNull('.change-password-input ul li')){
				displayALertForm('正在为您处理,请稍候...');
				var nickname=$('.change-password-input ul #wechat-nickname input').val();
				localStorage.nickname_=nickname;
				if($('.uploadhhh input:nth-child(3)').attr('value')==''){
					$('.uploadhhh input:nth-child(3)').attr('value',localStorage.headimgurl);
				}
				$('.uploadhhh input:nth-child(2)').attr('value',nickname);
				if(!isFileChanged){
					displayALertForm('您未选择图片');
					if(getQueryString('register')=='1'){
						window.location.href="index.php?redirect=profile";
					}
					return;
				}else{
					confirm.click();
				}
			}else{
				displayALertForm('请完整填写信息');
			}
		});

		$('.profile-upload-photo,.profile_update_camera img').click(function(){
			fileInput.click();
		});

		$('footer').hide();

	});

</script>

<?php require('footer.php'); ?>

<script type="text/javascript">
	$('.profile-upload-photo').css('margin-top','40.274%!important');
</script>
