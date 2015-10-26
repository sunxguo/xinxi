<div class="" style="padding-left:30px;">
	<ul class="summary-card row-fluid clearfix">
		<li class="span3 text-center">
			<h2>文章数量</h2>
			<p class="summary-today-income"><?php echo $amount;?></p>
		</li>
		<li class="span3 text-center">
			<h2>今天添加</h2>
			<p class="summary-yesterday-income"><?php echo $todayAmount;?></p>
		</li>
		<li class="span3 text-center">
			<h2>用户数量</h2>
			<p class="summary-total-income">0</p>
		</li>
		<li class="span3 text-center">
			<h2>访问量</h2>
			<p class="summary-balance">0</p>
		</li>
	</ul>
	<table id="summary_table" class="app-list table ymtable table-striped">
        <caption class="clearfix">
            <h2 class="pull-left list-income" style="width: 250px;text-align: left;">
				<i class="icon-list-1"><img src="/assets/images/cms/icon/icon-list.png"></i>
				最近添加
			</h2>
        </caption>
        <thead>
            <tr>
                <th style="width:20%;">栏目</th>
                <th style="width:40%;">标题</th>
                <th style="width:20%;">作者</th>
                <th style="width:20%;">发布时间</th>
            </tr>
        </thead>
        <tbody>
        	<?php foreach ($recentEssays as $value):?>
			<tr>
				<td><?php echo $value->columnName;?></td>
				<td>
					<a href=""><?php echo $value->title;?></a>
				</td>
				<td>管理员</td>
				<td><?php echo $value->time;?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</div>