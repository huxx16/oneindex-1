<?php
require __DIR__.'/init.php';

////////////////////////////////系统初始化///////////
    if (!file_exists(ROOT.'config/base.php')) {
        $default_config = array(
            
            'qqlogin' => '',
            
            'cssstyle' => '',
            'guestpreload' => '1',
            'adminpreload'=>"1",
            
            'bgimg' => 'https://cdn.jsdelivr.net/gh/SeireiA/Seirei@latest/usr/uploads/2020/07/1366416900.png',
            'mobileimg' => 'https://cdn.jsdelivr.net/gh/SeireiA/Seirei@latest/usr/uploads/2020/07/1366416900.png',
            'update' => 'on',
            'guestupload' => '',
            'site_name' => 'OneIndex',
            'title_name' => '',
            'appbar' => '',
            'password' => 'oneindex',
            'drawer' => '',
            'style' => 'nexmoe',
            'onedrive_root' => '',
            'cache_type' => 'filecache',
            'cache_expire_time' => 3600,
            'cache_refresh_time' => 600,
            'page_item' => 50,
            'root_path' => '',
            'show' => array(
            'stream' => ['txt', 'html'],
            'image' => ['bmp', 'jpg', 'jpeg', 'png', 'gif', 'webp'],
            'video5' => [],
            'video' => ['mpg', 'mpeg', 'mov', 'flv', 'mp4', 'webm', 'mkv', 'm3u8'],
            'video2' => ['avi', 'rm', 'rmvb', 'wmv', 'asf', 'ts'],
            'audio' => ['ogg', 'mp3', 'wav', 'flac', 'aac', 'm4a', 'ape'],
            'code' => ['php', 'css', 'go', 'java', 'js', 'json', 'txt', 'sh', 'md'],
            'doc' => ['csv', 'doc', 'docx', 'odp', 'ods', 'odt', 'pot', 'potm', 'potx', 'pps', 'ppsx', 'ppsxm', 'ppt', 'pptm', 'pptx', 'rtf', 'xls', 'xlsx'],
             ),
            'images' => ['home' => false, 'public' => false, 'exts' => ['jpg', 'png', 'gif', 'bmp']],
    );

        config('@base', $default_config);
        setcookie('admin', 'oneindex');
        header('refresh: 1');
        echo '初始化成功';
        exit;
    }

///////////////// 权限认证/////////////

        if ($_COOKIE['admin'] !== config('password@base')) {
            echo '<a href="/admin">登陆</a>';
            die('未授权');
        }

if ($_GET['filename']) {
    if ($_GET['drivestype'] == 'cn') {
        $data = array(
        'drivestype' => 'cn',   
        'share' => 'on',
        'onedrive_root'=>'/',
        'client_secret' => 'v4[Nq:4=rmFS78BwYi[@x3sGk-iY.U:S',
        'client_id' => '3447f073-eef3-4c60-bb68-113a86f2c39a',
        'redirect_uri' => 'https://coding.mxin.ltd/',
        'api' => 'https://microsoftgraph.chinacloudapi.cn/v1.0/me/drive/root',
        'api_url' => 'https://microsoftgraph.chinacloudapi.cn/v1.0',
        'oauth_url' => 'https://login.partner.microsoftonline.cn/common/oauth2/v2.0',);
        
    } 
    else{
        $data = array(
        'drivestype' => 'us',
        'share' => 'on',
        'onedrive_root'=>'/',
        'client_secret' => '~ZkpvnVoMysK36v0_Og1EPp.l3JA_NY-9a',
        'client_id' => '02be423f-f28c-48de-b265-09327e1a04eb',
        'redirect_uri' => 'https://coding.mxin.ltd/',
        'api' => 'https://graph.microsoft.com/v1.0/me/drive/root',
        'api_url' => 'https://graph.microsoft.com/v1.0',
        'oauth_url' => 'https://login.microsoftonline.com/common/oauth2/v2.0',
        
            );
    }

    if (!file_exists(ROOT.'config/default.php')) {
        $_GET['filename'] = 'default';
    }

    config('@'.$_GET['filename'], $data);

    echo '配置成功点此授权';
    echo '<a href="'.$_GET['filename'].'/" >配置成功点此授权</a>';

    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
	<title>OneIndex 系统安装</title>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui@0.4.1/dist/css/mdui.min.css" >
    	<script src="https://cdn.jsdelivr.net/npm/mdui@0.4.1/dist/js/mdui.min.js" ></script>
	<style>
		.mdui-appbar .mdui-toolbar{
			height:56px;
			font-size: 16px;
		}
		.mdui-toolbar>*{
			padding: 0 6px;
			margin: 0 2px;
			opacity:0.5;
		}
		.mdui-toolbar>.mdui-typo-headline{
			padding: 0 16px 0 0;
		}
		.mdui-toolbar>i{
			padding: 0;
		}
		.mdui-toolbar>a:hover,a.mdui-typo-headline,a.active{
			opacity:1;
		}
		.mdui-container{
			max-width:980px;
		}
		.mdui-list-item{
			-webkit-transition:none;
			transition:none;
		}
		.mdui-list>.th{
			background-color:initial;
		}
		.mdui-list-item>a{
			width:100%;
			line-height: 48px
		}
		.mdui-list-item{
			margin: 2px 0px;
			padding:0;
		}
		.mdui-toolbar>a:last-child{
			opacity:1;
		}
		@media screen and (max-width:980px){
			.mdui-list-item .mdui-text-right{
				display: none;
			}
			.mdui-container{
				width:100% !important;
				margin:0px;
			}
			.mdui-toolbar>*{
				display: none;
			}
			.mdui-toolbar>a:last-child,.mdui-toolbar>.mdui-typo-headline,.mdui-toolbar>i:first-child{
				display: block;
			}
		}
	</style>
</head>
<body class="mdui-theme-primary-blue-grey mdui-theme-accent-blue">
	<header class="mdui-appbar mdui-color-theme">
		<div class="mdui-toolbar mdui-container">
			<a href="/" class="mdui-typo-headline">OneIndex</a>
					
		</div>
	</header>
	
	<div class="mdui-container">
    	

<div class="mdui-container-fluid">
	<div class="mdui-typo">
	  <h1>系统安装 <small></small></h1>
	</div>





	<form action="" method="get">
	
 <label class="mdui-radio">
    <input type="radio" name="drivestype" value="us"/>
    <i class="mdui-radio-icon"></i>
     国际
  </label>
  
  <label class="mdui-radio">
    <input type="radio" name="drivestype"  value="cn" checked/>
    <i class="mdui-radio-icon"></i>
    世纪互联
  </label>

  
  </div>
  <div class="mdui-textfield mdui-textfield-floating-label">
  <label class="mdui-textfield-label">配置名称</label>
  <input class="mdui-textfield-input" type="text" name=filename pattern="[a-zA-Z]+" required/>
 <div class="mdui-textfield-error">名称只能是英文</div>
		
		




<br>
 <a class="mdui-btn mdui-btn-raised mdui-float-left" href="?step=0">上一步</a>
	 <button class="mdui-btn mdui-color-theme-accent mdui-ripple mdui-float-right" type="submit">下一步</button>


</div>
	</div>
	
	</form>



  
</body>
</html>
