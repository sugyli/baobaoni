<?php

namespace App\Admin\Controllers;

use App\Models\Article;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;



class ArticlesController extends Controller
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

            $content->header('小说');
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

            $content->header('编辑');
            $content->description('列表');

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
            $content->description('小说');

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
        return Admin::grid(Article::class, function (Grid $grid) {

            $grid->articleid('ID')->sortable();
            $grid->articlename('小说名');
            $grid->postdate('入库时间')->display(function ($postdate) {
                return formatTime($postdate);
            });
            $grid->lastupdate('最后更新')->display(function ($lastupdate) {
                return formatTime($lastupdate);
            });
            $grid->lastchapter('最新章节')->display(function ($lastchapter) {
                return empty($lastchapter) ? '无最新章节' : str_limit($lastchapter,40);
            });
            //禁用导出数据按钮
            $grid->disableExport();
            $grid->model()->orderBy('lastupdate', 'desc');
            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();

                // 在这里添加字段过滤器
                $filter->equal('articlename', '小说名');


            });
            $grid->actions(function ($actions) {

                // append一个操作
                $actions->append('<a href=""><i class="fa fa-eye"></i></a>');

                // prepend一个操作
                $actions->prepend('<a href=""><i class="fa fa-paper-plane"></i></a>');
            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Article::class, function (Form $form) {

            $form->display('articleid', 'ID');
            $form->text('articlename', '小说名称')->rules('required');
            $form->text('author', '小说作者')->rules('required');
            //$a = app('\App\Models\Article')->getSort();
          //  dd($form->model()->fullflag);
            $sorts = select_sort();
            $form->select('sortid', '分类')->options($sorts);
            $items = ['连载'=>'连载','完本'=>'完本'];
            $form->select('fullflag', '状态')->options($items);
            $form->textarea('intro','简介')->rows(8);
            $form->hidden('postdate');
            $form->hidden('lastupdate');
            //保存前回调
            $form->saving(function (Form $form) {
                $t = time();
                if(empty($form->postdate)){

                  $form->postdate = $t;
                }
                if(empty($form->lastupdate)){

                  $form->lastupdate = $t;
                }
            });

          });
    }


}
