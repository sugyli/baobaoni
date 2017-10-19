<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Widgets\Box;
use App\Admin\Traits\PublicTrait;
class SystemSettingsController extends Controller
{
    use ModelForm ,PublicTrait;

    public function index()
    {
        return Admin::content(function (Content $content) {
          $content->header('系统参数');
          $content->description('列表');
          $content->row(function (Row $row) {
            $row->column(12, function (Column $column) {
                $form = new \Encore\Admin\Widgets\Form();
                $form->action(admin_url('systemsettings'));
                $form->text('weburi', 'web网站地址')->default(get_sys_set('weburi'))->help('结尾要加 /');
                $form->text('webname', 'web网站名称')->default(get_sys_set('webname'));
                $form->textarea('webkeywords','web网站关键字')->rows(5)->default(get_sys_set('webkeywords'));
                $form->textarea('webdes','web网站描述')->rows(5)->default(get_sys_set('webdes'));
                $form->textarea('weblink','web网站友情链接')->rows(10)->default(get_sys_set('weblink'))->help('直接输入代码就行');
                $form->textarea('webfoot','web网站版权信息')->rows(10)->default(get_sys_set('webfoot'))->help('直接输入代码就行');
                $form->divide();

                $form->number('wapmululiebiao', 'wap目录分页数')->default(get_sys_set('wapmululiebiao'))->help('默认20');

                $form->divide();
                $form->text('dfxsfmdir', '小说默认封面')->default(get_sys_set('dfxsfmdir'))->help('全局通用,结尾要加 /');
                $form->text('xsfmdir', '小说封面路径')->default(get_sys_set('xsfmdir'))->help('全局通用,结尾要加 / ,本地就直接/');
                $form->text('imagedir', '小说内容附件地址')->default(get_sys_set('imagedir'))->help('全局通用,结尾要加 /');
                $form->text('txtdir', 'TXT域名前缀')->default(get_sys_set('txtdir'))->help('全局通用,结尾要加 /');
                $form->number('cacheTime_d', '低缓存时间')->default(get_sys_set('cacheTime_d'))->help('常用于封推或者签到等');
                $form->number('cacheTime_z', '中缓存时间')->default(get_sys_set('cacheTime_z'))->help('常用于介绍等');
                $form->number('cacheTime_g', '高缓存时间')->default(get_sys_set('cacheTime_g'))->help('常用于内容等');
                $form->number('bili', '签到增长基数')->default(get_sys_set('bili'))->help('就是天数乘以这个数字，得到最终积分数');
                $form->number('qiandao_maxnums', '连续签到最高积分')->default(get_sys_set('qiandao_maxnums'))->help('当增长基数乘以天数大于此值以此值为主');
                $form->number('qiandao_newuser', '新用户首次签到积分')->default(get_sys_set('qiandao_newuser'));
                $form->number('maxchapter', '大于此章节书忽略')->default(get_sys_set('maxchapter'))->help('防止数据库卡死');
                $form->number('massagemaxcount', '默认收发件容量')->default(get_sys_set('massagemaxcount'))->help('当权限没设置启用默认');
                $form->number('bookcasemaxcount', '默认书架容量')->default(get_sys_set('bookcasemaxcount'))->help('当权限没设置启用默认');
                $form->number('dayrecommendmaxcount', '默认日推荐票')->default(get_sys_set('dayrecommendmaxcount'))->help('当权限没设置启用默认');
                $form->number('recommendscore', '投一票增长经验')->default(get_sys_set('recommendscore'));
                $form->number('minnr', '内容最小内容')->default(get_sys_set('minnr'))->help('章节内容小于此数值才会去检测附件');;


                $form->select('txtlog','Curl内容错误日记')->options(function () {
                  if(get_sys_set('txtlog')){

                    return[true=>'开启',false=>'关闭'];
                  }
                  return[false=>'关闭',true=>'开启'];
                });
                $form->textarea('dfnr','内容丢失提示语')->rows(3)->default(get_sys_set('dfnr'))->help('直接输入代码就行');
                $column->append((new Box('设置', $form))->style('success'));
            });
          });
        });

    }

    public function seting()
    {
      $data = request()->except(['_token']);
      if (is_array($data)) {
          $data['cacheTime_d'] =   (isset($data['cacheTime_d']) && $data['cacheTime_d']>0) ? $data['cacheTime_d'] : 1;
          $data['cacheTime_z'] =   (isset($data['cacheTime_z']) && $data['cacheTime_z']>0) ? $data['cacheTime_z'] : 2;
          $data['cacheTime_g'] =   (isset($data['cacheTime_g']) && $data['cacheTime_g']>0) ? $data['cacheTime_g'] : 3;
          $data['bili'] =   (isset($data['bili']) && $data['bili']>0) ? $data['bili'] : 5;
          $data['qiandao_maxnums'] =   (isset($data['qiandao_maxnums']) && $data['qiandao_maxnums']>0) ? $data['qiandao_maxnums'] : 35;
          $data['qiandao_newuser'] =   (isset($data['qiandao_newuser']) && $data['qiandao_newuser']>0) ? $data['qiandao_newuser'] : 20;
          $data['maxchapter'] =   (isset($data['maxchapter']) && $data['maxchapter']>0) ? $data['maxchapter'] : 10000;
          $data['massagemaxcount'] =   (isset($data['massagemaxcount']) && $data['massagemaxcount']>0) ? $data['massagemaxcount'] : 20;
          $data['bookcasemaxcount'] =   (isset($data['bookcasemaxcount']) && $data['bookcasemaxcount']>0) ? $data['bookcasemaxcount'] : 20;
          $data['dayrecommendmaxcount'] =   (isset($data['dayrecommendmaxcount']) && $data['dayrecommendmaxcount']>0) ? $data['dayrecommendmaxcount'] : 20;
          $data['recommendscore'] =   (isset($data['recommendscore']) && $data['recommendscore']>0) ? $data['recommendscore'] : 1;
          $data['wapmululiebiao'] =   (isset($data['wapmululiebiao']) && $data['wapmululiebiao']>0) ? $data['wapmululiebiao'] : 20;
          $msg = $this->success('设置成功');
          \Cache::forever(config('app.syskey'), $data);
      }else{

          $msg = $this->error('设置失败');
      }

      return back()->with($msg);
    }

}
