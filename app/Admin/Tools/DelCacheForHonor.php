<?php
namespace App\Admin\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
//use Illuminate\Support\Facades\Request;

class DelCacheForHonor extends AbstractTool
{
  protected function script()
  {

    $url =  route('admin.delhonorscache');

    return <<<EOT

$('.custom-bnt').on('click', function() {

  $.ajax({
      method: 'post',
      url: "$url",
      data: {
          _token:LA.token,
          _method:'delete',
      },
      success: function () {
          $.pjax.reload('#pjax-container');
          toastr.success('操作成功');
      }
  });
});

EOT;
  }

    public function render()
    {
        Admin::script($this->script());
        $bntName = '删除缓存';

        return view('admin.tools.custombnt', compact('bntName'));
    }
}




 ?>
