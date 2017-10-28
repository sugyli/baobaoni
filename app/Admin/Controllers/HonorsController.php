<?php

namespace App\Admin\Controllers;

use App\Models\Honor;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

//use Illuminate\Support\MessageBag;
use App\Admin\Extensions\Tools\DelCacheForHonor;
//use Illuminate\Support\Facades\Request;
class HonorsController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('用户等级');
            $content->description('列表');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('修改');
            $content->description('用户等级');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('添加');
            $content->description('用户等级');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Honor::class, function (Grid $grid) {
          //  $grid->honorid('ID')->sortable();
            $grid->caption('等级');
            $grid->minscore('积分大于')->sortable();
            $grid->maxscore	('积分小于')->sortable();

            $grid->column('setting' ,'附加信息')->display(function ($obj) {

              if (empty($obj['bookcasecount'])) {
                  $a =  '默认'. DEFAULTCOUNT .' 书架';
              }else{

                  $a = isset($obj['bookcasecount']) ? $obj['bookcasecount'].' 书架' : '故障';
              }

              if (empty($obj['dayrecommendcount'])) {
                  $b = '默认'. DEFAULTCOUNT .' 日推荐';
              }else{

                  $b = isset($obj['dayrecommendcount']) ? $obj['dayrecommendcount'].' 日推荐' : '故障';
              }

              if (empty($obj['maxmessage'])) {
                  $c = '默认'. DEFAULTMESSAGECOUNT .' 收发箱';
              }else{

                  $c = isset($obj['maxmessage']) ? $obj['maxmessage'].' 收发箱' : '故障';
              }






              return $a . '|'.$b .'|'.$c;



            });
            $grid->tools(function ($tools) {
                $tools->append(new DelCacheForHonor());
            });

            $grid->model()->orderBy('maxscore', 'asc');
            //列出多少数据
            $grid->paginate(1000);
            //不显示分页条
            $grid->disablePagination();
            //禁用查询过滤器
            $grid->disableFilter();
            //$grid->created_at();
            //$grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Honor::class, function (Form $form) {

             //$form->display('honorid', 'ID');
             $form->hidden('honorid');
             $form->text('caption', '等级')->rules('required');
             $form->text('minscore', '积分大于')->rules('required|integer');
             $form->text('maxscore', '积分小于')->rules('required|integer');
             $form->embeds('setting', '附加设置',function ($form) {
                $form->text('bookcasecount','最多书架')->rules('required|integer');
                $form->text('dayrecommendcount','日推荐')->rules('required|integer');
                $form->text('maxmessage','收/发(件)数量')->rules('required|integer');

            });


            //$form->display('created_at', 'Created At');
            //$form->display('updated_at', 'Updated At');
            $form->saving(function (Form $form) {
                if ($form->minscore >= $form->maxscore) {
                    // 抛出异常
                    throw new \Exception('积分范围有问题请检查');

                }

            });

            //保存后回调
            $form->saved(function (Form $form) {
                //删除缓存
                $this->delCache();
            });
        });
    }


    protected function delCache()
    {
      //删除缓存
      \Cache::forget(HONORS);

    }
}
