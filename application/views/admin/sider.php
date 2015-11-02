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
				<li><a href="/admin/products" class="<?php echo array_key_exists('products',$sider)?'active':'';?>">产品</a></li>
				<li><a href="/admin/forum" class="<?php echo array_key_exists('forum',$sider)?'active':'';?>">论坛</a></li>
				<li><a href="/admin/activity" class="<?php echo array_key_exists('activity',$sider)?'active':'';?>">品牌活动</a></li>
			</ul>
		</li>
		<?php /*?>
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
		<?php */?>
		<li class="has-sub">
			<a href="javascript:void();" class="nav-header <?php echo array_key_exists('system',$sider)?'active':'';?>">
				<i class="icon-user"><img src="/assets/images/cms/icon/icon-app-bs.png"></i>
				<span>系统设置</span>
				<span class="btn-right sprite-ui"></span>
			</a>
			<ul class="nav <?php echo array_key_exists('system',$sider)?'':'km-hide';?>">
				<?php /*?>
				<li><a href="/admin/parameter" class="<?php echo array_key_exists('parameter',$sider)?'active':'';?>">基本参数</a></li>
				<li><a href="/admin/log" class="<?php echo array_key_exists('log',$sider)?'active':'';?>">系统日志管理</a></li>
				<li><a href="/admin/backup" class="<?php echo array_key_exists('backup',$sider)?'active':'';?>">数据库备份</a></li>
				<?php */?>
			</ul>
		</li>
	</ul>
</div>