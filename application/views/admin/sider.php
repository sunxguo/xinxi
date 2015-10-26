<div class="panel-sidebar clearfix">
	<ul class="nav">
		<li>
			<a href="/admin/index" class="nav-header <?php echo array_key_exists('index',$sider)?'active':'';?>">
				<i class="icon-home"><img src="/assets/images/cms/icon/icon-home-bs.png"></i>
				<span>控制面板</span>
			</a>
		</li>
		<li class="has-sub">
			<a href="javascript:void();" class="nav-header <?php echo array_key_exists('content',$sider)?'active':'';?>">
				<i class="icon-user"><img src="/assets/images/cms/icon/icon-msg-b2.png"></i>
				<span>内容管理</span>
				<span class="btn-right sprite-ui"></span>
			</a>
			<ul class="nav <?php echo array_key_exists('content',$sider)?'':'km-hide';?>">
				<li><a href="/admin/home" class="<?php echo array_key_exists('home',$sider)?'active':'';?>">首页</a></li>
				<li><a href="/admin/news" class="<?php echo array_key_exists('news',$sider)?'active':'';?>">新闻</a></li>
				<li><a href="/admin/edu" class="<?php echo array_key_exists('edu',$sider)?'active':'';?>">教育</a></li>
				<li><a href="/admin/area" class="<?php echo array_key_exists('area',$sider)?'active':'';?>">市县</a></li>
				<li><a href="/admin/enrol" class="<?php echo array_key_exists('enrol',$sider)?'active':'';?>">招考</a></li>
				<li><a href="/admin/school" class="<?php echo array_key_exists('school',$sider)?'active':'';?>">学校</a></li>
				<li><a href="/admin/policy" class="<?php echo array_key_exists('policy',$sider)?'active':'';?>">政策</a></li>
				<li><a href="/admin/activity" class="<?php echo array_key_exists('activity',$sider)?'active':'';?>">活动</a></li>
				<li><a href="/admin/about" class="<?php echo array_key_exists('about',$sider)?'active':'';?>">关于</a></li>
			</ul>
		</li>
		<li>
			<a href="/admin/users" class="nav-header <?php echo array_key_exists('user',$sider)?'active':'';?>">
				<i class="icon-user"><img src="/assets/images/cms/icon/icon-uc-bs.png"></i>
				<span>用户管理</span>
				<!--
				<span class="btn-right sprite-ui"></span>
				-->
			</a>
		</li>
		<li>
			<a href="/admin/statistic" class="nav-header <?php echo array_key_exists('statistic',$sider)?'active':'';?>">
				<i class="icon-user"><img src="/assets/images/cms/icon/icon-data-bs.png"></i>
				<span>统计</span>
				<!--
				<span class="btn-right sprite-ui"></span>
				-->
			</a>
		</li>
		<li class="has-sub">
			<a href="javascript:void();" class="nav-header <?php echo array_key_exists('system',$sider)?'active':'';?>">
				<i class="icon-user"><img src="/assets/images/cms/icon/icon-app-bs.png"></i>
				<span>系统设置</span>
				<span class="btn-right sprite-ui"></span>
			</a>
			<ul class="nav <?php echo array_key_exists('system',$sider)?'':'km-hide';?>">
				<li><a href="/admin/parameter" class="<?php echo array_key_exists('parameter',$sider)?'active':'';?>">基本参数</a></li>
				<li><a href="/admin/log" class="<?php echo array_key_exists('log',$sider)?'active':'';?>">系统日志管理</a></li>
				<li><a href="/admin/backup" class="<?php echo array_key_exists('backup',$sider)?'active':'';?>">数据库备份</a></li>
			</ul>
		</li>
	</ul>
</div>