<title>超市查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#BB0614">
  <img class="avatar size-XL l" src="<?php echo $supermarket->logo;?>">
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18"><?php echo $supermarket->name.' - '.$supermarket->sname;?></span> <!-- <span class="pl-10 f-12">余额：40</span> --></dt>
    <!-- <dd class="pt-10 f-12" style="margin-left:0">这家伙很懒，什么也没有留下</dd> -->
    <dd class="pt-10 f-12" style="margin-left:0">超市代码：<?php echo $supermarket->no;?> 超市编号：<?php echo $supermarket->sno;?></dd>
  </dl>
</div>
<div class="pd-20">
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r" width="80">类型：</th>
        <td><?php echo $supermarket->type=='0'?'总店':'分店';?></td>
      </tr>
      <tr>
        <th class="text-r">省-市-区：</th>
        <td><?php echo $supermarket->province.' - '.$supermarket->city.' - '.$supermarket->area;?></td>
      </tr>
      <tr>
        <th class="text-r">详细地址：</th>
        <td><?php echo $supermarket->detailedarea;?></td>
      </tr>
      <tr>
        <th class="text-r">添加时间：</th>
        <td><?php echo $supermarket->addtime;?></td>
      </tr>
      <tr>
        <th class="text-r">经度：</th>
        <td><?php echo $supermarket->lng;?></td>
      </tr>
      <tr>
        <th class="text-r">纬度：</th>
        <td><?php echo $supermarket->lat;?></td>
      </tr>
      <tr>
        <th class="text-r">状态：</th>
        <?php if($supermarket->status=='0'):?>
        <td class="td-status"><span class="label label-success radius">已启用</span></td>
        <?php else:?>
        <td class="td-status"><span class="label label-defaunt radius">已停用</span></td>
        <?php endif;?>
      </tr>
      <!-- <tr>
        <th class="text-r">二维码：</th>
        <td><img src="/assets/images/about_icon_3.jpg" width="100"></td>
      </tr> -->
    </tbody>
  </table>
</div>
</body>
</html>