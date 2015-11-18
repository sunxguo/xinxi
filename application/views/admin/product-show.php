<title>商品查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#5bacb6">
  <img class="avatar size-XL l" src="<?php echo $product->photo;?>">
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18"><?php echo $product->name;?></span> <span class="pl-10 f-12">价格：￥ <?php echo $product->price;?></span></dt>
    <!-- <dd class="pt-10 f-12" style="margin-left:0">这家伙很懒，什么也没有留下</dd> -->
    <dd class="pt-10 f-12" style="margin-left:0">超市：<?php echo $supermarket->name.' - '.$supermarket->sname;?></dd>
  </dl>
</div>
<div class="pd-20">
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r" width="80">分类：</th>
        <td><?php echo $category->name;?></td>
      </tr>
      <tr>
        <th class="text-r" width="80">条形码：</th>
        <td><?php echo $product->barcode;?></td>
      </tr>
      <tr>
        <th class="text-r">添加时间：</th>
        <td><?php echo $product->addtime;?></td>
      </tr>
      <tr>
        <th class="text-r">更新时间：</th>
        <td><?php echo $product->edittime;?></td>
      </tr>
      <tr>
        <th class="text-r">是否可编辑：</th>
        <td><?php echo $product->isedit=='0'?'否':'是';?></td>
      </tr>
      <tr>
        <th class="text-r">状态：</th>
        <?php if($product->status=='0'):?>
        <td class="td-status"><span class="label label-success radius">已上架</span></td>
        <?php else:?>
        <td class="td-status"><span class="label label-defaunt radius">已下架</span></td>
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