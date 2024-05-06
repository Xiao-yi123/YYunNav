<?php /*a:19:{s:73:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\index\index.html";i:1713879467;s:80:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\IndexLayout.html";i:1714485850;s:86:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\component\loading.html";i:1713879467;s:85:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\template\sidebar.html";i:1713879467;s:107:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\component\sidebar-top-menu-mini-header.html";i:1713879467;s:91:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\component\sidebar-item.html";i:1713879467;s:91:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\template\header-banner.html";i:1713879467;s:91:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\template\header-author.html";i:1713879467;s:91:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\template\header-search.html";i:1713879467;s:85:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\component\search.html";i:1713879467;s:91:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\component\bulletin_box.html";i:1713879467;s:95:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\index\component\card\default-card.html";i:1713879467;s:92:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\index\component\card\mini-card.html";i:1713879467;s:92:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\index\component\card\book-card.html";i:1713879467;s:91:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\index\component\card\app-card.html";i:1713879467;s:89:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\template\main-footer.html";i:1713879467;s:84:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\template\footer.html";i:1713879467;s:90:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\template\search-modal.html";i:1713879467;s:91:"E:\DevelopmentSourceCode\php\YYunNav-main\app\index\view\layout\component\search-modal.html";i:1713879467;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?php echo sysconfig('site','site_name'); ?>|<?php echo sysconfig('site','site_title'); ?></title>
  <meta property="url" content="<?php echo htmlentities(app('request')->domain()); ?>">
  <meta property="title" content="<?php echo sysconfig('site','site_title'); ?>">
  <meta property="site_name" content="<?php echo sysconfig('site','site_name'); ?>">
  <meta name="theme-color" content="#f9f9f9">
  <meta name="keywords" content="<?php echo sysconfig('site','site_keywords'); ?>">
  <meta name="description" content="<?php echo sysconfig('site','site_description'); ?>">

  <link rel="icon" type="image/x-ico" href="<?php echo sysconfig('site','logo_image'); ?>">
  <link rel='stylesheet' id='wp-block-library-css' href='/static/index/wp-includes/css/dist/block-library/style.min-5.6.2.css'
        type='text/css' media='all'>
  <link rel='stylesheet' id='iconfont-css' href='/static/index/wp-content/themes/onenav/css/iconfont-3.03029.1.css' type='text/css' media='all'>
  <link rel='stylesheet' id='iconfontd-css' href='https://at.alicdn.com/t/font_2768144_khli9xs79g.css' type='text/css' media='all'>
  <link rel='stylesheet' id='my-iconfont' href='/static/index/wp-content/themes/onenav/css/my-iconfont.css' type='text/css' media='all'>


  <link rel='stylesheet' id='bootstrap-css' href='/static/index/wp-content/themes/onenav/css/bootstrap.min-3.03029.1.css'
        type='text/css' media='all'>
  <link rel='stylesheet' id='lightbox-css' href='/static/index/wp-content/themes/onenav/css/jquery.fancybox.min-3.03029.1.css'
        type='text/css' media='all'>
  <link rel='stylesheet' id='style-css' href='/static/index/wp-content/themes/onenav/css/style-3.03029.1.css' type='text/css'
        media='all'>
  <script type='text/javascript' src='/static/index/wp-content/themes/onenav/js/jquery.min-3.03029.1.js' id='jquery-js'></script>
  <style>
    #footer-tools [data-v-db6ccf64][data-v-41ba7e2c] {
      top: unset !important;
      bottom: 0 !important;
      right: 44px !important
    }

    .io.icon-fw,
    .iconfont.icon-fw {
      width: 1.15em;
    }

    .io.icon-lg,
    .iconfont.icon-lg {
      font-size: 1.5em;
      line-height: .75em;
      vertical-align: -.125em;
    }

    .screenshot-carousel .img_wrapper a {
      display: contents
    }

    .fancybox-slide--iframe .fancybox-content {
      max-width: 1280px;
      margin: 0
    }

    .fancybox-slide--iframe.fancybox-slide {
      padding: 44px 0
    }

    .navbar-nav .menu-item-286 a {
      background: #ff8116;
      border-radius: 50px !important;
      padding: 5px 10px !important;
      margin: 5px 0 !important;
      color: #fff !important;
    }

    .navbar-nav .menu-item-286 a i {
      position: absolute;
      top: 0;
      right: -10px;
      color: #f13522;
    }

    .io-black-mode .navbar-nav .menu-item-286 a {
      background: #ce9412;
    }

    .io-black-mode .navbar-nav .menu-item-286 a i {
      color: #fff;
    }
    /*底部相关*/
    .customize-width {
      max-width: 1850px;
    }
    .footer-mini-img{
      width: 90px;
      margin: 0 10px;
      text-align: center;
      vertical-align: text-top;
      display: inline-block;
    }
    .footer-links>a+a:before, .footer-nav-links>li+li:before {
      content: "";
      width: 4px;
      height: 4px;
      margin: 0 0.5em;
      border-radius: 50%;
      display: inline-block;
      vertical-align: middle;
      background: #888;
      opacity: .3;
      vertical-align: 0.2em;
    }
    .footer-social>a {
      position: relative;
      display: inline-block;
      margin: 5px;
      width: 35px;
      height: 35px;
      line-height: 35px;
      text-align: center;
    }
    .fab, .far {
      font-weight: 400;
    }
    .footer-mini-img img{
      width:100%;
    }
    /*验证码相关*/
    .image-captcha-group {
      position: relative;
    }
    .image-captcha-group .form-control {
      min-width: 200px;
    }
    .image-captcha-group .image-captcha {
      position: absolute;
      cursor: pointer;
      top: 50%;
      right: 2px;
      transform: translateY(-50%);
    }
    .image-captcha-group img {
      width: auto;
      height: 32px;
      border-radius: 4px;
    }

    @media screen and (max-width: 767.98px){
      .post-top {
        padding-bottom: 60px;
      }
    }
  </style><!-- 自定义代码 -->
  <!-- end 自定义代码 -->
</head>
<body class="io-grey-mode">


<div id="loading">
  <style>
    .loader {
      width: 250px;
      height: 50px;
      line-height: 50px;
      text-align: center;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-family: helvetica, arial, sans-serif;
      text-transform: uppercase;
      font-weight: 900;
      color: #f1404b;
      letter-spacing: 0.2em
    }

    .loader::before,
    .loader::after {
      content: "";
      display: block;
      width: 15px;
      height: 15px;
      background: #f1404b;
      position: absolute;
      animation: load .7s infinite alternate ease-in-out
    }

    .loader::before {
      top: 0
    }

    .loader::after {
      bottom: 0
    }

    @keyframes load {
      0% {
        left: 0;
        height: 30px;
        width: 15px
      }

      50% {
        height: 8px;
        width: 40px
      }

      100% {
        left: 235px;
        height: 30px;
        width: 15px
      }
    }
  </style>
  <div class="loader">一个有范的导航</div>
</div>


<div class="page-container">


  
<div id="sidebar" class="sticky sidebar-nav fade mini-sidebar" style="width: 60px;">
    <div class="modal-dialog h-100  sidebar-nav-inner">

        
        <div class="sidebar-logo border-bottom border-color">
            <!-- logo -->
            <div class="logo overflow-hidden">
                <a href="" class="logo-expanded">
                    <img src="/static/logo/yiyunnavlogo.png" height="40" class="logo-light"
                         alt="<?php echo sysconfig('site','site_name'); ?>">
                    <img src="/static/logo/yiyunnavlogo.png"  height="40" class="logo-dark d-none"
                         alt="<?php echo sysconfig('site','site_name'); ?>">
                </a>
                <a href="" class="logo-collapsed">
                    <img src="/static/logo/yiyunlogo.png" height="40" class="logo-light"
                         alt="<?php echo sysconfig('site','site_name'); ?>">
                    <img src="/static/logo/yiyunlogo.png" height="40" class="logo-dark d-none"
                         alt="<?php echo sysconfig('site','site_name'); ?>">
                </a>
            </div>
            <!-- logo end -->
        </div>

        <div class="sidebar-menu flex-fill">
            <div class="sidebar-scroll">
                <div class="sidebar-menu-inner">
                    <ul>
						
<li class="sidebar-item top-menu">
	<a href="javascript:;" class="smooth change-href">
		<i class="iconfont icon-category icon-fw icon-lg mr-2"></i>
		<span>站点推荐</span>
		<i class="iconfont icon-arrow-r-m sidebar-more text-sm"></i>
	</a>
	<ul class="navbar-nav site-menu" style="margin-right: 16px;">
		<?php foreach($HeaderMenu as $key=>$vo): ?>
		
		<li	class="menu-item <?php echo htmlentities($vo->HasChildren); ?>">
			<a href="<?php echo htmlentities($vo->url); ?>">
				<span><?php echo htmlentities($key); ?></span></a>
			<?php if(!(empty($vo->HasChildren) || (($vo->HasChildren instanceof \think\Collection || $vo->HasChildren instanceof \think\Paginator ) && $vo->HasChildren->isEmpty()))): ?>
			<ul class="sub-menu">
				<?php foreach($vo->children as $key1=>$vo1): ?>

				<li class="menu-item">
					<a href="<?php echo htmlentities($vo1->url); ?>"><?php echo htmlentities($vo1->name); ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</li>
		<?php endforeach; ?>
	</ul>
</li>



                        <?php foreach($SidebarItem as $key=>$vo): ?>
                            
<li class="sidebar-item">
	<a href="#term-<?php echo htmlentities($vo['id']); ?>" class="smooth change-href" data-change="#term-<?php echo htmlentities($vo['id']); ?>">
		<i class="iconfont icon-lg mr-2 <?php echo $vo['icon']; ?>">
		</i>
		<span><?php echo htmlentities($vo['name']); ?></span>
		<?php if(!(empty($vo['two_data']) || (($vo['two_data'] instanceof \think\Collection || $vo['two_data'] instanceof \think\Paginator ) && $vo['two_data']->isEmpty()))): ?>
		<i class="iconfont icon-arrow-r-m sidebar-more text-sm"></i>
		<?php endif; ?>
	</a>
	<?php if(!(empty($vo['two_data']) || (($vo['two_data'] instanceof \think\Collection || $vo['two_data'] instanceof \think\Paginator ) && $vo['two_data']->isEmpty()))): ?>
	<ul>
		<?php foreach($vo['two_data'] as $key1=>$vo1): ?>
		<li>
			<a href="#term-<?php echo htmlentities($vo1['id']); ?>" class="smooth">
				<span><?php echo htmlentities($vo1['name']); ?></span>
			</a>
		</li>

		<?php endforeach; ?>

	</ul>
	<?php endif; ?>
</li>

                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-top py-2 border-color">
            <div class="flex-bottom">
                <ul>
                    <?php foreach($SidebarTopItem as $key=>$vo): ?>
                    <li	class="menu-item menu-item-type-post_type menu-item-object-pagesidebar-item">
                        <a href="<?php echo htmlentities($vo->href); ?>">
                            <i class="iconfont <?php echo htmlentities($vo->icon); ?> icon-fw icon-lg mr-2"></i>
                            <span><?php echo htmlentities($key); ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>


  <div class="main-content flex-fill">

    
<div class="big-header-banner">
  <div id="header" class="page-header sticky">
    <div class="navbar navbar-expand-md">
      <div class="container-fluid p-0">

        
        <a href="/" class="navbar-brand d-md-none" title="<?php echo sysconfig('site','site_name'); ?>">
          <img src="/static/logo/yiyunnavlogo.png" class="logo-light"
               alt="<?php echo sysconfig('site','site_name'); ?>">
          <img src="/static/logo/yiyunlogo.png" class="logo-dark d-none"
               alt="<?php echo sysconfig('site','site_name'); ?>">
        </a>

        <div class="collapse navbar-collapse order-2 order-md-1">

          
          <div class="header-mini-btn">
            <label>
              <input id="mini-button" type="checkbox">
              <svg viewbox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <path class="line--1" d="M0 40h62c18 0 18-20-17 5L31 55"></path>
                <path class="line--2" d="M0 50h80"></path>
                <path class="line--3" d="M0 60h62c18 0 18 20-17-5L31 45"></path>
              </svg>
            </label>

          </div>
          <ul class="navbar-nav site-menu" style="margin-right: 16px;">
            <?php foreach($HeaderMenu as $key=>$vo): ?>
              
              <li	class="menu-item <?php echo htmlentities($vo->HasChildren); ?>">
                <a href="<?php echo htmlentities($vo->url); ?>">
                  <span><?php echo htmlentities($key); ?></span></a>
                <?php if(!(empty($vo->HasChildren) || (($vo->HasChildren instanceof \think\Collection || $vo->HasChildren instanceof \think\Paginator ) && $vo->HasChildren->isEmpty()))): ?>
                <ul class="sub-menu">
                  <?php foreach($vo->children as $key1=>$vo1): ?>

                  <li class="menu-item">
                    <a href="<?php echo htmlentities($vo1->url); ?>"><?php echo htmlentities($vo1->name); ?></a>
                  </li>
                  <?php endforeach; ?>
                </ul>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
          
          <div class="rounded-circle weather">
            <div id="he-plugin-simple" style="display: contents;"></div>
            <script>WIDGET = { CONFIG: { "modules": "12034", "background": 5, "tmpColor": "888", "tmpSize": 14, "cityColor": "888", "citySize": 14, "aqiSize": 14, "weatherIconSize": 24, "alertIconSize": 18, "padding": "10px 10px 10px 10px", "shadow": "1", "language": "auto", "borderRadius": 5, "fixed": "false", "vertical": "middle", "horizontal": "left", "key": "a922adf8928b4ac1ae7a31ae7375e191" } }</script>
            <script src="//widget.heweather.net/simple/static/js/he-simple-common.js?v=1.1"></script>
          </div>
        </div>

        <ul class="nav navbar-menu text-xs order-1 order-md-2">

          
          <li class="nav-item mr-3 mr-lg-0 d-none d-lg-block">
            <script>
              fetch('https://v1.hitokoto.cn')
                      .then(response => response.json())
                      .then(data => {
                        const hitokoto = document.getElementById('hitokoto_text')
                        hitokoto.href = 'https://hitokoto.cn/?uuid=' + data.uuid
                        hitokoto.innerText = data.hitokoto
                      })
                      .catch(console.error)
            </script>
            <div id="hitokoto"><a href="#" target="_blank" id="hitokoto_text">我爱你，洛千婷</a></div>
          </li>
          
          <li class="nav-search ml-3 ml-md-4">
            <a href="javascript:" data-toggle="modal" data-target="#search-modal"><i
                    class="iconfont icon-search icon-2x"></i></a>
          </li>
          
          <li class="nav-item d-md-none mobile-menu ml-3 ml-md-4">
            <a href="javascript:" id="sidebar-switch" data-toggle="modal"
               data-target="#sidebar"><i class="iconfont icon-classification icon-2x"></i></a>
          </li>
        </ul>
      
	  </div>
    </div>
  </div>
  <div class="placeholder" style="height:50px"></div>
</div>

    <div class='<?php if(isset($AuthorInfo)): ?>user-bg d-flex<?php else: ?>header-big  post-top css-color mb-4<?php endif; ?>'
         style="background-image: linear-gradient(45deg, #8618db 0%, #d711ff 50%, #460fdd 100%);">
      <?php if(isset($AuthorInfo)): ?>
        
<div class="container d-flex align-items-end position-relative mb-4">
  <img alt="" src="<?php echo htmlentities($AuthorInfo['head_img']); ?>"
       class=" avatar avatar-70 current-author photo" height="70" width="70">
  <div class="author-meta-r ml-0 ml-md-3">
    <div class="h2 text-white mb-2">
        <?php echo htmlentities($AuthorInfo['systemuserinfo']['nickname']); ?>
      <small class="text-xs">
				<span class="badge vc-violet2 btn-outline mt-2">
					管理员
				</span>
      </small>
    </div>
    <div class="text-white text-sm">
        <?php echo htmlentities((isset($AuthorInfo['systemuserinfo']['sign']) && ($AuthorInfo['systemuserinfo']['sign'] !== '')?$AuthorInfo['systemuserinfo']['sign']:"这个人很懒，什么都没留下")); ?>
    </div>
  </div>
</div>
      <?php else: if($IsSSearch): ?>
<div class="s-search">
  <div id="search" class="s-search mx-auto">
    
<div id="search-list-menu" class="hide-type-list">
  <div class="s-type text-center">
    <div class="s-type-list big">
      <div class="anchor" style="position: absolute; left: 50%; opacity: 0;"></div>

      <?php foreach($SearchData as $key=>$vo): ?>
      <label for="type-<?php echo htmlentities($vo[0]->e_name); ?>" class="">
        <span><?php echo htmlentities($key); ?></span>
      </label>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<form action="https://nav.iowen.cn?s=" method="get" target="_blank" class="super-search-fm">
  <input type="text" id="search-text" class="form-control smart-tips search-key" placeholder="输入关键字搜索" style="outline:0" autocomplete="off" />
  <button type="submit"><i class="iconfont icon-search"></i></button>
</form>
<div id="search-list" class="hide-type-list">
  <?php foreach($SearchData as $key=>$vo): ?>
  <div class="search-group">
    <ul class="search-type">

      <?php $__FOR_START_1937118707__=0;$__FOR_END_1937118707__=count($vo);for($i=$__FOR_START_1937118707__;$i < $__FOR_END_1937118707__;$i+=1){ ?>
      <li>
        <input checked="checked" hidden="" type="radio" name="type" id="type-<?php echo htmlentities($vo[$i]->e_name); ?>" value="<?php echo htmlentities($vo[$i]->link); ?>" data-placeholder="<?php echo htmlentities($vo[$i]->placeholder); ?>" for="type-<?php echo htmlentities($vo[$i]->name); ?>">
        <label for="type-<?php echo htmlentities($vo[$i]->e_name); ?>">
          <span class="text-muted"><?php echo htmlentities($vo[$i]->name); ?></span>
        </label>
      </li>
      <?php } ?>
    </ul>
  </div>
  <?php endforeach; ?>
</div>

    <div class="card search-smart-tips" style="display: none">
      <ul></ul>
    </div>
  </div>
</div>
<?php if(!(empty($Bulletin) || (($Bulletin instanceof \think\Collection || $Bulletin instanceof \think\Paginator ) && $Bulletin->isEmpty()))): ?>
<div class="bulletin-big mx-3 mx-md-0">
  
<div id="bulletin_box" class="card my-2">
  <div class="card-body py-1 px-2 px-md-3 d-flex flex-fill text-xs text-muted">
	<div><i class="iconfont icon-bulletin" style="line-height:25px"></i></div>
	<div class="bulletin mx-1 mx-md-2 carousel-vertical">
	  <div class="carousel slide" data-ride="carousel" data-interval="3000">
		<div class="carousel-inner" role="listbox">
			<?php foreach($Bulletin as $key=>$vo): ?>
		  <div class="carousel-item <?php if($key==0): ?>active<?php endif; ?>">
			  <a class="overflowClip_1" href="Bulletin?id=<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['title']); ?></a>
		  </div>
			<?php endforeach; ?>
		</div>
	  </div>
	</div>
	<div class="flex-fill"></div>
	<a title="关闭" href="javascript:;" rel="external nofollow" class="bulletin-close"
	   onclick="$('#bulletin_box').slideUp('slow');"><i class="iconfont icon-close"
														style="line-height:25px"></i></a>
  </div>
</div>

</div>
<?php endif; ?>
<?php endif; ?>
      <?php endif; ?>

    </div>

    <div id="content" class="content-site customize-site">
    <?php foreach($ContentLink as $OneLinkVo): ?>
    <div class="d-flex flex-fill ">
        
        <h4 class="text-gray text-lg mb-4">
            <i class="site-tag iconfont icon-tag icon-lg mr-1" id="term-<?php echo htmlentities($OneLinkVo['id']); ?>"></i>
            <?php echo htmlentities($OneLinkVo['name']); ?>
        </h4>

    </div>

    <?php if(!(empty($OneLinkVo['two_data']) || (($OneLinkVo['two_data'] instanceof \think\Collection || $OneLinkVo['two_data'] instanceof \think\Paginator ) && $OneLinkVo['two_data']->isEmpty()))): ?>
    <div class="d-flex flex-fill flex-tab">
        <div class="d-flex slider-menu-father">
            <div class='overflow-x-auto slider_menu mini_tab ajax-list-home' slidertab="sliderTab" data-id="<?php echo htmlentities($OneLinkVo['id']); ?>">

                <ul class="nav nav-pills menu" role="tablist">
                    <?php foreach($OneLinkVo['two_data'] as $key=>$TwoNode): ?>
                    
                    <li class="pagenumber nav-item">
                        <a id="term-<?php echo htmlentities($TwoNode['id']); ?>" class="nav-link <?php if($key==0): ?>active<?php endif; ?>" data-action="load_home_tab" data-taxonomy="favorites" data-id="<?php echo htmlentities($TwoNode['id']); ?>"><?php echo htmlentities($TwoNode['name']); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="ajax-<?php echo htmlentities($OneLinkVo['id']); ?> mt-4" style="position: relative;">

    <?php if(empty($OneLinkVo['link_data']) || (($OneLinkVo['link_data'] instanceof \think\Collection || $OneLinkVo['link_data'] instanceof \think\Paginator ) && $OneLinkVo['link_data']->isEmpty())): ?>
    <div class="tab-pane active">
        <div class="row io-mx-n2 mt-4 ajax-list-body position-relative">
            <div class="col-lg-12 customize_nothing">
                <div class="nothing mb-4">无数据</div>
            </div>
        </div>
    </div>

    <?php else: ?>
        <div class="row">
            <?php switch($OneLinkVo['display_type']): case "1": foreach($OneLinkVo['link_data'] as $LinkDataVo): ?>
                    
<div class="url-card col-6  col-sm-6 col-md-4 col-xl-5a col-xxl-6a   ">

    <div class="url-body default">
        <a href="/go?url=<?php echo encryptDecrypt('url',$LinkDataVo['url'],0); ?>" data-id="<?php echo htmlentities($LinkDataVo['id']); ?>" data-url="<?php echo htmlentities($LinkDataVo['url']); ?>" class="card no-c  mb-4 site-<?php echo htmlentities($LinkDataVo['id']); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo htmlentities($LinkDataVo['description']); ?>">
            <div class="card-body">
                <div class="url-content d-flex align-items-center">
                    <div class="url-img rounded-circle mr-2 d-flex align-items-center justify-content-center">
                        <img class="lazy" src="<?php echo htmlentities($LinkDataVo['image_path']); ?>" onerror="javascript:this.src='https://nav.iowen.cn/wp-content/themes/onenav/images/favicon.png'" alt="<?php echo htmlentities($LinkDataVo['name']); ?>">
                    </div>
                    <div class="url-info flex-fill">
                        <div class="text-sm overflowClip_1">
                            <strong><?php echo htmlentities($LinkDataVo['name']); ?></strong>
                        </div>
                        <p class="overflowClip_1 m-0 text-muted text-xs"><?php echo htmlentities($LinkDataVo['description']); ?>
                        </p>
                    </div>
                </div>
            </div>
        </a>
        <a href="/go?url=<?php echo htmlentities($LinkDataVo['url']); ?>" class="togo text-center text-muted is-views" target="_blank" data-id="<?php echo htmlentities($LinkDataVo['id']); ?>" data-toggle="tooltip" data-placement="right" title="直达" rel="nofollow"><i class="iconfont icon-goto"></i></a>
    </div>
</div>
                <?php endforeach; break; case "2": foreach($OneLinkVo['link_data'] as $LinkDataVo): ?>
                    
<div class="url-card col-6 col-2a col-sm-2a col-md-4a col-lg-5a col-xl-6a col-xxl-10a col-xxl-10a ">

    <div class="url-body mini ">
        <a href="/go?url=<?php echo encryptDecrypt('url',$LinkDataVo['url'],0); ?>" target="_blank" data-id="537" data-url="<?php echo htmlentities($LinkDataVo['url']); ?>" class="card mb-3 site-537" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo htmlentities($LinkDataVo['description']); ?>">
            <div class="card-body">
                <div class="url-content d-flex align-items-center">
                    <div class="url-img rounded-circle mr-2 d-flex align-items-center justify-content-center">
                        <img class="lazy unfancybox loaded" src="<?php echo htmlentities($LinkDataVo['image_path']); ?>" height="auto" width="auto" alt="<?php echo htmlentities($LinkDataVo['description']); ?><" data-was-processed="true"></div>
                    <div class="url-info flex-fill" style="padding-top: 2px">
                        <div class="text-sm overflowClip_1">
                            <strong><?php echo htmlentities($LinkDataVo['name']); ?></strong></div>
                    </div>
                </div>
            </div>
        </a>
        <a href="/go?url=<?php echo htmlentities($LinkDataVo['url']); ?>" target="_blank" rel="external nofollow noopener" title="" class="togo text-center text-muted is-views" data-id="537" data-toggle="tooltip" data-placement="right" data-original-title="直达">
            <i class="iconfont icon-goto"></i>
        </a>
    </div>
</div>
                <?php endforeach; break; case "3": foreach($OneLinkVo['link_data'] as $LinkDataVo): ?>
                    
<div class="io-px-2 col-6 col-sm-4 col-md-3 col-lg-2 col-xxl-8a ">

  <div class="card-book list-item">
    <div class="media media-5x7 p-0 rounded">
      <a class="media-content" href="<?php echo htmlentities($LinkDataVo['url']); ?>" target="_blank" data-bg="url(<?php echo htmlentities($LinkDataVo['image_path']); ?>)" data-was-processed="true" style="background-image: url(<?php echo htmlentities($LinkDataVo['image_path']); ?>);"></a>
    </div>
    <div class="list-content">
      <div class="list-body">
        <a href="<?php echo htmlentities($LinkDataVo['url']); ?>" target="_blank" class=" list-title text-md overflowClip_1"><?php echo htmlentities($LinkDataVo['name']); ?></a>
        <div class="mt-1">
          <div class="list-subtitle text-muted text-xs overflowClip_1"><?php echo htmlentities($LinkDataVo['description']); ?></div></div>
      </div>
    </div>
  </div>
</div>
                <?php endforeach; break; case "4": foreach($OneLinkVo['link_data'] as $LinkDataVo): ?>
                    
<div class="io-px-2 col-4 col-md-3 col-lg-2 col-xl-8a col-xxl-10a pb-1 ">

  <div class="card-app default list-item">
    <div class="media p-0 app-rounded" style="background-image: linear-gradient(130deg, #f9f9f9, #e8e8e8);">
      <a class="media-content" href="<?php echo htmlentities($LinkDataVo['url']); ?>" target="_blank" data-bg="url(<?php echo htmlentities($LinkDataVo['image_path']); ?>)" style="background-size: 70%; background-image: url(<?php echo htmlentities($LinkDataVo['image_path']); ?>);" data-was-processed="true"></a>
    </div>
    <div class="list-content text-center pt-2">
      <div class="list-body ">
        <a href="<?php echo htmlentities($LinkDataVo['url']); ?>" target="_blank" class=" list-title text-md overflowClip_1"><?php echo htmlentities($LinkDataVo['name']); ?></a>
        <div class="mt-1">
          <div class="list-subtitle text-muted text-xs overflowClip_1"><?php echo htmlentities($LinkDataVo['description']); ?></div></div>
      </div>
    </div>
  </div>
</div>
                <?php endforeach; break; default: ?>
            <?php endswitch; ?>
        </div>
    <?php endif; ?>
    </div>

    <?php endforeach; ?>



    <h4 class="text-gray text-lg mb-4">
        <i class="iconfont icon-book-mark-line icon-lg mr-2" id="friendlink"></i>友情链接
    </h4>
    <div class="friendlink text-xs card">
        <div class="card-body">
            
            <?php if(is_array($friendlink) || $friendlink instanceof \think\Collection || $friendlink instanceof \think\Paginator): $i = 0; $__LIST__ = $friendlink;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo htmlentities($vo->href); ?>" title="<?php echo htmlentities($vo->description); ?>" target="_blank"><?php echo htmlentities($vo->name); ?></a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>


</div>

<script type="text/javascript">
    $('ul[role="tablist"]').find('li:eq(0)').click();
    console.log($('ul[role="tablist"]').find('li:eq(0)').text())
    $('ul.nav-pills').find('li:eq(1)').click();
</script>

    
<div class="main-footer footer-stick container container-fluid customize-width pt-4 pb-3 footer-type-big" style="">
  <div class="footer-inner card rounded-xl m-0">
    <div class="footer-text card-body text-muted text-center text-md-left">
      <div class="row my-4">
        <div class="col-12 col-md-4 mb-4 mb-md-0">
          <a class="footer-logo" href="https://www.mgnav.com" title="马哥导航">
            <img src="/static/logo/yiyunnavlogo.png" class="logo-light mb-3" alt="马哥导航" height="40">
            <div class="text-sm"><?php echo sysconfig('site','site_name'); ?>为您提供最全面的资源导航，导航就来<?php echo sysconfig('site','site_name'); ?>。注意：本站仅收录网站，不对其网站内容或交易负责。若收录的站点侵害到您的利益，请联系我们删除收录</div></a>
        </div>
        <div class="col-12 col-md-5 mb-4 mb-md-0">
          <p class="footer-links text-sm mb-3">
            <a href="/Disclaimer">免责声明</a>
            <a href="/WebSubmit">友链申请</a>
            <a href="/WebSubmit">网站提交</a>
          <div class="footer-social">
            <a class="rounded-circle bg-light" href="https://api.btstu.cn/qqtalk/api.php?qq=<?php echo htmlentities((isset($AdminInfo['systemUserInfo__qq']) && ($AdminInfo['systemUserInfo__qq'] !== '')?$AdminInfo['systemUserInfo__qq']:'')); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="" rel="external noopener nofollow" data-original-title="QQ">
              <i class="iconfont icon-qq"></i>
            </a>
            <a class="rounded-circle bg-light" href="https://t.me" target="_blank" data-toggle="tooltip" data-placement="top" title="" rel="external noopener nofollow" data-original-title="Telegram">
              <i class="iconfont icons8-Telegram"></i>
            </a>
            <a class="rounded-circle bg-light qr-img" href="javascript:;" data-toggle="tooltip" data-placement="top" data-html="true" title="" data-original-title="<img src='/static/logo/wechat.jpg' height='100' width='100'>">
              <i class="icons8-WeChat"></i>
            </a>
            <a class="rounded-circle bg-light" href="mailto:<?php echo htmlentities((isset($AdminInfo['systemUserInfo__email']) && ($AdminInfo['systemUserInfo__email'] !== '')?$AdminInfo['systemUserInfo__email']:'')); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="" rel="external noopener nofollow" data-original-title="Email">
              <i class="icons8-mail"></i>
            </a>
          </div>
        </div>
        <div class="col-12 col-md-3 text-md-right mb-4 mb-md-0">
          <div class="footer-mini-img" data-toggle="tooltip" title="" data-original-title="扫码添加站长微信">
            <p class="bg-light rounded-lg p-1">
              <img class=" " src="/static/logo/wechat.jpg" alt="扫码添加站长微信"></p>
            <span class="text-muted text-ss mt-2">扫码添加站长微信</span></div>
          <div class="footer-mini-img" data-toggle="tooltip" title="" data-original-title="扫码加QQ群">
            <p class="bg-light rounded-lg p-1">
              <img class=" " src="/static/logo/QQGroup.jpg" alt="扫码加QQ群"></p>
            <span class="text-muted text-ss mt-2">扫码加QQ群</span></div>
        </div>
      </div>
      <div class="footer-copyright text-xs">Copyright © 2024
        <a href="/" title="<?php echo sysconfig('site','site_name'); ?>" class="" rel="home"><?php echo sysconfig('site','site_name'); ?></a>&nbsp;
        <a href="https://beian.miit.gov.cn/" target="_blank" class="" rel="link noopener"><?php echo sysconfig('site','site_beian'); ?></a>
      </div>
    </div>
  </div>
</div>

  </div><!-- main-content end -->
  
<footer>
  <div id="footer-tools" class="d-flex flex-column">
    <a href="javascript:" id="go-to-up" class="btn rounded-circle go-up m-1" rel="go-top">
      <i class="iconfont icon-to-up"></i>
    </a>
    <!-- 天气  -->
    <a href="javascript:" data-toggle="modal" data-target="#search-modal" class="btn rounded-circle m-1"
       rel="search" one-link-mark="yes">
      <i class="iconfont icon-search"></i>
    </a>
    <a href="mini" class="btn rounded-circle kefu m-1" target="_blank" data-toggle="tooltip" data-placement="left" title="" data-original-title="mini 书签">
      <i class="iconfont icon-24gf-table"></i>
    </a>
    <!-- 天气 end -->
    <a href="javascript:;" id="switch-mode" class="btn rounded-circle m-1"
       data-toggle="tooltip" data-placement="left" title="夜间模式">
      <i class="mode-ico iconfont icon-light"></i>
    </a>
  </div>
</footer>
<script type='text/javascript' id="footer">
  $("#switch-mode").on("click",function () {
    if($(this).attr('data-placement')=="left"){
      $(this).attr('data-original-title',"日间模式");
      $(this).attr('data-placement',"right");
      $("body").attr("class",'io-black-mode');
    }else{
      $(this).attr('data-original-title',"夜间模式");
      $(this).attr('data-placement',"left");
      $("body").attr("class",'io-grey-mode');
    }
  })
</script>
</div><!-- page-container end -->


<div class="modal fade search-modal" id="search-modal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        
<div id="search" class="s-search mx-auto my-4">
  <div id="search-list" class="hide-type-list">
    <div class="s-type">
      <span></span>
      <div class="s-type-list">
        <?php foreach($SearchData as $key=>$vo): ?>
        <label for="m_type-<?php echo htmlentities($vo[0]->e_name); ?>" class=""><?php echo htmlentities($key); ?></label>
        <?php endforeach; ?>
      </div>
    </div>
    <?php foreach($SearchData as $key=>$vo): ?>
    <div class="search-group">
      <span class="type-text text-muted"><?php echo htmlentities($key); ?></span>
      <ul class="search-type">
        <?php $__FOR_START_424613991__=0;$__FOR_END_424613991__=count($vo);for($i=$__FOR_START_424613991__;$i < $__FOR_END_424613991__;$i+=1){ ?>
        <li>
          <input checked="checked" hidden="" type="radio" name="type2" id="m_type-<?php echo htmlentities($vo[$i]->e_name); ?>" value="<?php echo htmlentities($vo[$i]->link); ?>" data-placeholder="<?php echo htmlentities($vo[$i]->placeholder); ?>" for="m_type-<?php echo htmlentities($vo[$i]->name); ?>">
          <label for="m_type-<?php echo htmlentities($vo[$i]->e_name); ?>">
            <span class="text-muted"><?php echo htmlentities($vo[$i]->name); ?></span>
          </label>
        </li>
        <?php } ?>
      </ul>
    </div>
    <?php endforeach; ?>
  </div>
  <form action="https://nav.iowen.cn?s=" method="get" target="_blank" class="super-search-fm">
    <input type="text" id="m_search-text" class="form-control smart-tips search-key" zhannei="" autocomplete="off" placeholder="输入关键字搜索" style="outline:0" />
    <button type="submit"><i class="iconfont icon-search"></i></button>
  </form>
  <div class="card search-smart-tips" style="display: none">
    <ul></ul>
  </div>
</div>

        <div class="px-1 mb-3">
          <i class="text-xl iconfont icon-hot mr-1" style="color:#f1404b;"></i>
          <span class="h6">热门推荐： </span>
        </div>
        <div class="mb-3">
          <li id="menu-item-333" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-333"><a href="https://www.iotheme.cn/">导航主题</a></li>
          <li id="menu-item-335" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-335"><a href="https://igoutu.cn/">图标</a></li>
        </div>
      </div>
      <div style="position: absolute;bottom: -40px;width: 100%;text-align: center;">
        <a href="javascript:" data-dismiss="modal"><i class="iconfont icon-close-circle icon-2x" style="color: #fff;"></i></a>
      </div>
    </div>
  </div>
</div>

<script type='text/javascript' src='/static/index/ajax/libs/jqueryui/1.12.1/jquery-ui.min-3.03029.1.js'
        id='jquery-ui-js'></script>
<script type='text/javascript' src='/static/index/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min-3.0302.js'
        id='jqueryui-touch-js'></script>
<script type='text/javascript' src='/static/index/wp-includes/js/clipboard.min-5.6.2.js' id='clipboard-js'></script>
<script type='text/javascript' id='popper-js-extra'>
  /* <![CDATA[ */
  // var theme = {"ajaxurl":"https:\/\/nav.iowen.cn\/wp-admin\/admin-ajax.php","addico":"https:\/\/nav.iowen.cn\/wp-content\/themes\/onenav\/images\/add.png","order":"asc","formpostion":"top","defaultclass":"io-grey-mode","isCustomize":"1","icourl":"https:\/\/api.iowen.cn\/favicon\/","icopng":".png","urlformat":"1","customizemax":"10","newWindow":"0","lazyload":"1","minNav":"1","loading":"1","hotWords":"baidu","classColumns":" col-sm-6 col-md-4 col-xl-5a col-xxl-6a ","apikey":"TWpBeU1UVTNOekk1TWpVMEIvZ1M2bFVIQllUMmxsV1dZelkxQTVPVzB3UW04eldGQmxhM3BNWW14bVNtWk4="};
  var theme = {"ajaxurl":"/\ajax.php","addico":"https:\/\/nav.iowen.cn\/wp-content\/themes\/onenav\/images\/add.png","order":"asc","formpostion":"top","defaultclass":"io-grey-mode","isCustomize":"1","icourl":"https:\/\/api.iowen.cn\/favicon\/","icopng":".png","urlformat":"1","customizemax":"10","newWindow":"0","lazyload":"1","minNav":"1","loading":"1","hotWords":"baidu","classColumns":" col-sm-6 col-md-4 col-xl-5a col-xxl-6a ","apikey":"TWpBeU1UVTNOekk1TWpVMEIvZ1M2bFVIQllUMmxsV1dZelkxQTVPVzB3UW04eldGQmxhM3BNWW14bVNtWk4="};
  /* ]]> */
</script>
<script type='text/javascript' src='/static/index/wp-content/themes/onenav/js/popper.min-3.03029.1.js' id='popper-js'></script>
<script type='text/javascript' src='/static/index/wp-content/themes/onenav/js/bootstrap.min-3.03029.1.js'
        id='bootstrap-js'></script>
<script type='text/javascript' src='/static/index/wp-content/themes/onenav/js/theia-sticky-sidebar-3.03029.1.js'
        id='sidebar-js'></script>
<script type='text/javascript' src='/static/index/wp-content/themes/onenav/js/lazyload.min-3.03029.1.js'
        id='lazyload-js'></script>
<script type='text/javascript' src='/static/index/wp-content/themes/onenav/js/jquery.fancybox.min-3.03029.1.js'
        id='lightbox-js-js'></script>
<script type='text/javascript' src='/static/index/wp-content/themes/onenav/js/app-3.03029.1.js' id='appjs-js'></script>
<script type="text/javascript">
  $(document).ready(function(){
    var siteWelcome = $('#loading');
    siteWelcome.addClass('close');
    setTimeout(function() {
      siteWelcome.remove();
    }, 600);
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function () {
      if ($('a.smooth[href="' + window.location.hash + '"]')[0]) {
        $('a.smooth[href="' + window.location.hash + '"]').click();
      }
      else if (window.location.hash != '') {
        $("html, body").animate({
          scrollTop: $(window.location.hash).offset().top - 90
        }, {
          duration: 500,
          easing: "swing"
        });
      }
    }, 300);
    $(document).on('click','a.smooth',function(ev) {
      ev.preventDefault();
      if($('#sidebar').hasClass('show') && !$(this).hasClass('change-href')){
        $('#sidebar').modal('toggle');
      }
      if($(this).attr("href").substr(0, 1) == "#"){
        $("html, body").animate({
          scrollTop: $($(this).attr("href")).offset().top - 90
        }, {
          duration: 500,
          easing: "swing"
        });
      }
      if($(this).hasClass('go-search-btn')){
        $('#search-text').focus();
      }
      if(!$(this).hasClass('change-href')){
        var menu =  $("a"+$(this).attr("href"));
        menu.click();
        toTarget(menu.parent().parent(),true,true);
      }
    });
    $(document).on('click','a.tab-noajax',function(ev) {
      var url = $(this).data('link');
      if(url)
        $(this).parents('.d-flex.flex-fill.flex-tab').children('.btn-move.tab-move').show().attr('href', url);
      else
        $(this).parents('.d-flex.flex-fill.flex-tab').children('.btn-move.tab-move').hide();
    });
  });
</script>
<!-- 自定义代码 -->
<!-- end 自定义代码 -->
</body>

</html>