<?php

namespace App\Admin\Controllers;

use App\Models\Message;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class OutboxsController extends Controller
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

            $content->header('系统发件箱');
            $content->description('列表');

            $content->body($this->grid());
        });
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Message::class, function (Grid $grid) {

            $grid->messageid('ID')->sortable();
            $grid->title('标题');
            $grid->postdate('时间')->display(function ($postdate) {
                return formatTime($postdate);
            });
            $grid->toname('收件人');
            $grid->isread('状态')->display(function ($isread) {
                return $isread <= 0 ? "<span style='color:blue'>对方未读</span>" : "<span style='color:red'>对方已读</span>";
            });
            $grid->disableCreation();
            $grid->disableRowSelector();
            $grid->disableExport();
            $grid->disableFilter();
            $grid->model()->where('fromid', 0);
            $grid->model()->orderBy('postdate', 'desc');
            $grid->actions(function ($actions) {
               $actions->disableDelete();
               $actions->disableEdit();
               $id = $actions->getKey();
               //$row = $actions->row;

               $page = request()->input('page',1);

               $showUrl = route('admin-outboxs.show',['id'=>$id]) . '?page=' . $page;
               $actions->append('<a href="'. $showUrl .'"><i class="fa fa-eye"></i></a>');

            });
        });
    }

    public function show($id)
    {

      return Admin::content(function (Content $content) use ($id) {

          $content->header('邮件');
          $content->description('内容');

          $content->body($this->form()->view($id));
      });

    }
    protected function form()
    {
        return Admin::form(Message::class, function (Form $form) {

             $form->display('toname' ,'收件人');
             $form->display('title' ,'标题');
             //更复杂的显示
              $form->display('postdate', '时间')->with(function ($postdate) {
                  return formatTime($postdate);;
              });
              $form->display('isread', '状态')->with(function ($isread) {

                  return $isread > 0 ? "<span style='color:red'>对方已读</span>" : "<span style='color:blue'>对方未读</span>";
              });
              $form->display('content', '内容');
              /*
              $form->display('content', '内容')->with(function ($content) {
                  $content = \Purifier::clean($content,'default');
                  return $content;
              });
              */
              $form->disableReset();

        });
    }
}
