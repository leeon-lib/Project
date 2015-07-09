<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>阅读列表</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/Index/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/Index/read-style.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/Index/read-list.css">
</head>
<body>
	<!-- 顶栏导航 begin -->
	<div class="header">
		<div class="global-nav">
			<ul>
				<li><a href="">豆瓣</a></li>
				<li><a href="">读书</a></li>
				<li><a href="">电影</a></li>
				<li><a href="">阅读</a></li>
				<li><a href="">东西</a></li>
			</ul>
		</div>
		<div class="global-info">
			<a href="">登录</a>
			<a href="">注册</a>
		</div>
		
	</div>
	<!-- 顶部导航 end -->
	<!-- 栏目头部 begin -->
	<div class="nav">
		<div class="warp">
			<div class="primary">
				<div class="logo">
					<a href="">豆瓣阅读</a>
				</div>
				<div class="search">
					<form action="">
						<input type="text" placeholder="书名、作者、ISBN">
						<input type="submit" value="Search">
					</form>
				</div>
			</div>
		</div>
		<div class="secondary">
			<div class="memu">
				<ul>
					<li><a href="">原创作品</a></li>
					<li><a href="">电子图书</a></li>
					<li><a href="">专栏</a></li>
					<li><a href="">连载</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 栏目头部 end -->
	<!-- 内容容器 begin -->
	<div class="container">
		<!-- 内容tab begin -->
		<div class="tab">
			<a href="">按标签浏览</a>
			<a href="">按提供方浏览</a>
		</div>
		<!-- 内容tab end -->
		<!-- 左部边栏 begin -->
		<div class="aside">
			<!-- 性质分类 begin -->
			<div class="kind">
				<ul>
					<li>
						<a href="">全部</a>
					</li>
					<li>
						<a href="">虚构</a>
					</li>
					<li>
						<a href="">非虚构</a>
					</li>
				</ul>
			</div>
			<!-- 性质分类 end -->
			<!-- 属性分类 begin -->
			<div class="category">
				<ul>
					<li>
						<a href="">讲个好故事</a>
					</li>
					<li>
						<a href="">画册</a>
					</li>
					<li>
						<a href="">杂志</a>
					</li>
					<li>
						<a href="">小说</a>
					</li>
					<li>
						<a href="">生活</a>
					</li>
				</ul>
			</div>
			<!-- 属性分类 end -->
			<!-- 畅销排行 begin -->
			<div class="best-selling">
				<div class="title">
					<h2>畅销排行</h2>
				</div>
				<div class="tab">
					<a href="">虚构</a>
					<a href="">非虚构</a>
				</div>
				<div class="items">
					<ul>
						<li>
							<h4><a href="">书名：破茧</a></h4>
							<span>作者：程皎旸</span>
						</li>
						<li>
							<h4><a href="">书名：破茧</a></h4>
							<span>作者：程皎旸</span>
						</li>
						<li>
							<h4><a href="">书名：破茧</a></h4>
							<span>作者：程皎旸</span>
						</li>
					</ul>
				</div>
			</div>
			<!-- 畅销排行 end -->
		</div>
		<!-- 左部边栏 end -->
		<!-- 右部内容 begin -->
		<div class="content">
			<div class="head-tab">
				<h4>旅行</h4>
				<div class="head-nav">
					<ul class="first-tab">
						<li><a href="">全部</a></li>
						<li><a href="">作品(num)</a></li>
						<li><a href="">图书(num)</a></li>
						<li><a href="">杂志(num)</a></li>
					</ul>
					<ul>
						<li><a href="">热门</a></li>
						<li><a href="">新上架</a></li>
					</ul>
				</div>
			</div>
			<div class="items">
				<ul>
					<li>
						<div class="cover">
							<a href="">
								<img src="../../Images/read-list-item-pic.jpg" alt="">
							</a>
						</div>
						<div class="item-info">
							<div class="title">
								<h3><a href="">不可思议的印度</a></h3>
								<div class="price">
									<span><strong>1.99元</strong></span>
									<a class="try-read" href="">试读</a>
									<a class="add-cart" href=""><i></i>加入购物车</a>
								</div>
							</div>
							<p>作者<a href="">紫兮</a></p>
							<p>类别 <span>类型1 / 类型2</span><span>(6篇)</span> </p>							
							<p>评分(<a href="">53人评价</a>)</p>
							<div class="synopsis">
								跟一般走马观花的游记不同，这本书并没有介绍印度的风景名胜，旅游景点，而是深入挖掘了印度老百姓的平时生活。 作者深入印度人的生活，和他们同吃同住，吃印度菜，学印地语，跳印度舞，最... &nbsp;<a href="">(更多>)</a>
							</div>
						</div>
					</li>
					<li>
						<div class="cover">
							<a href="">
								<img src="../../Images/read-list-item-pic.jpg" alt="">
							</a>
						</div>
						<div class="item-info">
							<div class="title">
								<h3><a href="">不可思议的印度</a></h3>
								<div class="price">
									<span><strong>1.99元</strong></span>
									<a class="try-read" href="">试读</a>
									<a class="add-cart" href=""><i></i>加入购物车</a>
								</div>
							</div>
							<p>作者<a href="">紫兮</a></p>
							<p>类别 <span>类型1 / 类型2</span><span>(6篇)</span> </p>							
							<p>评分(<a href="">53人评价</a>)</p>
							<div class="synopsis">
								跟一般走马观花的游记不同，这本书并没有介绍印度的风景名胜，旅游景点，而是深入挖掘了印度老百姓的平时生活。 作者深入印度人的生活，和他们同吃同住，吃印度菜，学印地语，跳印度舞，最... &nbsp;<a href="">(更多>)</a>
							</div>
						</div>
					</li>
					<li>
						<div class="cover">
							<a href="">
								<img src="../../Images/read-list-item-pic.jpg" alt="">
							</a>
						</div>
						<div class="item-info">
							<div class="title">
								<h3><a href="">不可思议的印度</a></h3>
								<div class="price">
									<span><strong>1.99元</strong></span>
									<a class="try-read" href="">试读</a>
									<a class="add-cart" href=""><i></i>加入购物车</a>
								</div>
							</div>
							<p>作者<a href="">紫兮</a></p>
							<p>类别 <span>类型1 / 类型2</span><span>(6篇)</span> </p>							
							<p>评分(<a href="">53人评价</a>)</p>
							<div class="synopsis">
								跟一般走马观花的游记不同，这本书并没有介绍印度的风景名胜，旅游景点，而是深入挖掘了印度老百姓的平时生活。 作者深入印度人的生活，和他们同吃同住，吃印度菜，学印地语，跳印度舞，最... &nbsp;<a href="">(更多>)</a>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!-- 右部内容 end -->
	</div>
	<!-- 内容容器 end -->
</body>
</html>