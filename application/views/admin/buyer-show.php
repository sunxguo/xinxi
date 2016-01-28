<title>用户查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#5bacb6">
  <img class="avatar size-XL l" src="<?php echo $buyer->photo;?>">
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18"><?php echo $buyer->alias;?></span> <!-- <span class="pl-10 f-12">余额：40</span> --></dt>
    <!-- <dd class="pt-10 f-12" style="margin-left:0">这家伙很懒，什么也没有留下</dd> -->
    <dd class="pt-10 f-12" style="margin-left:0">插队码：<?php echo $buyer->linecode;?></dd>
  </dl>
</div>
<div class="pd-20">
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r" width="80">性别：</th>
        <td><?php echo $buyer->gender=='0'?'男':($buyer->gender=='1'?'女':'未知');?></td>
      </tr>
      <tr>
        <th class="text-r">手机：</th>
        <td><?php echo $buyer->phone;?></td>
      </tr>
      <tr>
        <th class="text-r">生日：</th>
        <td><?php echo $buyer->birthdate;?></td>
      </tr>
      <tr>
        <th class="text-r">设备类型：</th>
        <td><?php echo $buyer->devicetype=='0'?'Android':($buyer->devicetype=='1'?'IOS':'未知');?></td>
      </tr>
      <tr>
        <th class="text-r">注册时间：</th>
        <td><?php echo $buyer->addtime;?></td>
      </tr>
      <tr>
        <th class="text-r">默认超市：</th>
        <td><?php echo isset($defaultSuperMarket->name)?$defaultSuperMarket->name.'-'.($defaultSuperMarket->type=='0'?'总店':$defaultSuperMarket->sname):'无';?></td>
      </tr>
      <tr>
        <th class="text-r">状态：</th>
        <?php if($buyer->status=='0'):?>
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