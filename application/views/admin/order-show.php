<title>订单查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#dd514c">
  <img class="avatar size-XL l" src="<?php echo $order->buyer->photo;?>">
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18"><?php echo $order->buyer->alias;?></span> <span class="pl-10 f-12">总金额：<?php echo $order->goodsprice;?></span></dt>
    <!-- <dd class="pt-10 f-12" style="margin-left:0">这家伙很懒，什么也没有留下</dd> -->
    <dd class="pt-10 f-12" style="margin-left:0">订单号：<?php echo $order->orderno;?></dd>
  </dl>
</div>
<div class="pd-20">
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r" width="80">超市：</th>
        <td><?php echo $order->supermarket->name.' - '.$order->supermarket->sname;?></td>
      </tr>
      <tr>
        <th class="text-r" width="80">超市账号：</th>
        <td><?php echo $order->seller->name;?></td>
      </tr>
      <tr>
        <th class="text-r" width="80">商品：</th>
        <td>
          <?php foreach($order->details as $detail):?>
          <img src="<?php echo $detail->product->photo;?>" title="<?php echo $detail->product->name;?>" alt="<?php echo $detail->product->name;?>" width="30"> <?php echo $detail->product->name;?> × <?php echo $detail->count;?>
          <?php endforeach;?>
        </td>
      </tr>
      <tr>
        <th class="text-r">收货地址：</th>
        <td><?php echo isset($order->address->province)?$order->address->province.$order->address->city.$order->address->area.$order->address->detailedarea.'<br>'.$order->address->name.' 电话'.$order->address->phone:'';?></td>
      </tr>
      <tr>
        <th class="text-r">总件数：</th>
        <td><?php echo $order->count;?></td>
      </tr>
      <tr>
        <th class="text-r">配送方式：</th>
        <td><?php echo $order->expressway=='0'?'物流':'自提';?></td>
      </tr>
      <tr>
        <th class="text-r">配送时间：</th>
        <td><?php echo $order->expresstime;?></td>
      </tr>
      <tr>
        <th class="text-r">配送费：</th>
        <td><?php echo $order->expressfee;?></td>
      </tr>
      <tr>
        <th class="text-r">优惠价：</th>
        <td><?php echo '￥'.$order->discount;?></td>
      </tr>
      <tr>
        <th class="text-r">优惠券：</th>
        <td><?php echo $order->couponid;?></td>
      </tr>
      <tr>
        <th class="text-r">总价：</th>
        <td><?php echo '￥'.$order->goodsprice;?></td>
      </tr>
      <tr>
        <th class="text-r">实际支付：</th>
        <td><?php echo '￥'.$order->actualpay;?></td>
      </tr>
      <tr>
        <th class="text-r">支付方式：</th>
        <td><?php echo $order->paymentmethod=='0'?'支付宝':'微信';?></td>
      </tr>
      <tr>
        <th class="text-r">是否分享：</th>
        <td><?php echo $order->isshared=='1'?'是':'否';?></td>
      </tr>
      <tr>
        <th class="text-r">用户删除：</th>
        <td><?php echo $order->buyerdel=='1'?'是':'否';?></td>
      </tr>
      <tr>
        <th class="text-r">超市删除：</th>
        <td><?php echo $order->sellerdel=='1'?'是':'否';?></td>
      </tr>
      <tr>
        <th class="text-r">物流删除：</th>
        <td><?php echo $order->deliverydel=='1'?'是':'否';?></td>
      </tr>
      <tr>
        <th class="text-r">状态：</th>

        <?php if($order->status=='0'):?>
        <td class="td-status"><span class="label label-danger radius"><?php echo $order->status_zn?></span></td>
        <?php elseif($order->status=='1'):?>
        <td class="td-status"><span class="label label-primary radius"><?php echo $order->status_zn?></span></td>
        <?php elseif($order->status=='2'):?>
        <td class="td-status"><span class="label label-secondary radius"><?php echo $order->status_zn?></span></td>
        <?php elseif($order->status=='3'):?>
        <td class="td-status"><span class="label label-secondary radius"><?php echo $order->status_zn?></span></td>
        <?php elseif($order->status=='4'):?>
        <td class="td-status"><span class="label label-warning radius"><?php echo $order->status_zn?></span></td>
        <?php elseif($order->status=='5'):?>
        <td class="td-status"><span class="label label-success radius"><?php echo $order->status_zn?></span></td>
        <?php elseif($order->status=='6'):?>
        <td class="td-status"><span class="label label-success radius"><?php echo $order->status_zn?></span></td>
        <?php elseif($order->status=='-1'):?>
        <td class="td-status"><span class="label label-error radius"><?php echo $order->status_zn?></span></td>
        <?php else:?>
        <td class="td-status"><?php echo $order->status_zn?></td>
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