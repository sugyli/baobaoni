<?php

namespace App\Admin\Controllers;

use App\Models\Message;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;


use App\Admin\Tools\Form1;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Widgets\Box;
use Validator;
use Illuminate\Http\Request;
use App\Admin\Traits\PublicTrait;
use App\Models\User;
class InboxsController extends Controller
{
    use ModelForm , PublicTrait;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('收件箱');
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

            $grid->fromname('发件人');
            $grid->title('标题')->limit(150);
            $grid->postdate('时间')->display(function ($postdate) {
                return date("Y-m-d",$postdate);
            });
            $grid->toname('收件人');
            $grid->isread('状态')->display(function ($isread) {
                return $isread <= 0 ? "<span style='color:blue'>未读</span>" : "<span style='color:red'>已读</span>";
            });
            //禁用创建按钮
            $grid->disableCreation();
            //禁用行选择checkbox
            $grid->disableRowSelector();
            //禁用导出数据按钮
            $grid->disableExport();
            //禁用查询过滤器
            //$grid->disableFilter();
            $grid->filter(function($filter){
              // 禁用id查询框
              $filter->disableIdFilter();
              $filter->is('fromname', '发件人');
            });

            $grid->model()->where('fromid', '!=', 0);
            $grid->model()->orderBy('postdate', 'desc');

            $grid->actions(function ($actions) {
              //关闭删除按钮
               $actions->disableDelete();
               //关闭编辑按钮
               $actions->disableEdit();
               $id = $actions->getKey();
               //$row = $actions->row;

               $page = request()->page ?: 1;

               $showUrl = route('inboxs.show',['id'=>$id]) . '?page=' . $page;
               $actions->append('<a href="'. $showUrl .'"><i class="fa fa-eye"></i></a>');

            });

        });
    }

    public function show($id)
    {
      return Admin::content(function (Content $content) use ($id){
        //$content->header('内容');
        //$content->description('列表');
        $message = Message::find($id);
        if (!$message) {
          // 抛出异常
          throw new \Exception('出错啦。。。本消息不存在');
        }

        if($message->toid <= 0){
            $message->markAsRead();
        }
        $content->row(function (Row $row) use ($message){
          $row->column(12, function (Column $column) use ($message){
              $showForm = new Form1($message);
              $showForm->display('fromname' ,'发件人');
              $showForm->display('toname', '收件人');
              $showForm->display('' ,'发件时间')->default(date("Y-m-d",$message->postdate));
              $showForm->display('title', '标题');
              $showForm->display('content', '内容');
            //  $showForm->fromname('fromname');
              $showForm->isNeedFoot = false;

              $column->append((new Box('收件内容', $showForm))->collapsable()->style('success'));

          });

          $row->column(12, function (Column $column) use ($message){
              $form = new \Encore\Admin\Widgets\Form();
              $form->action(admin_url('inboxs'));
              $form->text('toname' ,'收件人')->attribute(['readonly' => 'readonly'])->default($message->fromname);
              $form->text('title', '标题')->default('Re: '.$message->title);
              $form->editor('content','内容')->attribute(['rows' => 20]);
              $form->hidden('toid')->default($message->fromid);
              $form->hidden('page')->default(request()->page ?: 1);
              $column->append((new Box('快速回复', $form))->style('success'));
          });

        });

      });

    }

    public function imageUpload(Request $request)
    {
      if ($file = $request->file('imageFile')) {
          try {
              $user = Admin::user();
              $ImageUploadHandler = app('\App\Libraries\ImageUploadHandler');
              $upload_status = $ImageUploadHandler->uploadImage($file ,'admin_' . $user->id);
              $ImageUploadHandler->saveTrash($upload_status , $user->id , 'Encore\Admin\Auth\Database\Administrator');
          } catch (\Exception $exception) {

              return response()->json(['errno' => $exception->getMessage()]);

          }

            return response($upload_status, 200)
                        ->header('Content-Type', 'text/plain');
        //  return response()->json(['errno' => 0, 'data' => [$upload_status]]);

      }

      return response()->json(['errno' => 'Error while uploading file']);
    }

    public function store(Request $request)
    {

      if(!$request->toid){
          $msg = $this->error('非法操作');
          return redirect(admin_url('inboxs'))->with($msg);
      }

      $validator = Validator::make($request->all(), [
          'title' => 'required',
          'content' => 'required',
      ]);
      if ($validator->fails()) {
          return back()->withErrors($validator)
                      ->withInput();
      }

      $user = User::find($request->toid);
      if(!$user){
        $msg = $this->error('发邮件的用户已经不存在了,可能被删除了');
        return back()->with($msg);

      }
      $data = $request->only(['toname', 'toid','title','content']);
      $page = $request->page ?: 1;
      $data = array_merge($data,['fromid'=>0,'fromname'=>'','postdate'=>time()]);

      $message = Message::create($data);

      if ($message) {
          $message->collectImages();
          $user->markAdminemailAsNoRead();
          //User->where('uid', toid)->update(['adminemail' => 1]);
          $msg = $this->success("回复用户 {$data['toname']} 成功");
      }else{
          $msg = $this->error("回复用户 {$data['toname']} 成功");
      }
      $url = admin_url('inboxs') . '?page='.$page;
      return redirect($url)->with($msg);
    }
}
