<?php

namespace App\Admin\Controllers;

use App\Models\Message;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;


use App\Admin\Extensions\Tools\Form1;
use Encore\Admin\Widgets\Collapse;
use Illuminate\Http\Request;
use App\Admin\Extensions\Traits\PublicTrait;
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

            $content->header('系统收件箱');
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
            $grid->title('标题');
            $grid->postdate('时间')->display(function ($postdate) {
                return formatTime($postdate);
            });
            $grid->toname('收件人');
            $grid->isread('状态')->display(function ($isread) {
                return $isread <= 0 ? "<span style='color:blue'>未读</span>" : "<span style='color:red'>已读</span>";
            });
            $grid->disableCreation();
            $grid->disableRowSelector();
            $grid->disableExport();
            $grid->disableFilter();
            $grid->model()->where('fromid', '!=', 0);
            $grid->model()->orderBy('postdate', 'desc');
            $grid->actions(function ($actions) {
               $actions->disableDelete();
               $actions->disableEdit();
               $id = $actions->getKey();
               //$row = $actions->row;

               $page = request()->input('page',1);

               $showUrl = route('admin-inboxs.show',['id'=>$id]) . '?page=' . $page;
               $actions->append('<a href="'. $showUrl .'"><i class="fa fa-eye"></i></a>');


            });
        });
    }

    public function show($id)
    {
      return Admin::content(function (Content $content) use ($id){

        $message = Message::find($id);
        if($message->toid <= 0){
            $message->markAsRead();
        }
        $showForm = new Form1();

        $showForm->display('' ,'发件人')->default($message->fromname);
        $showForm->display('' ,'收件人')->default($message->toname);
        $showForm->display('' ,'时间')->default(formatTime($message->postdate));
        $showForm->display('','内容')->default($message->content);
        $showForm->action('javascript:');
        $showForm->isNeedFoot = false;
        $showCollapse = new Collapse();
        $showCollapse->add('标题：'.$message->title, $showForm);
        $content->row($showCollapse);

        //快速回复
        $sendForm = new Form1();
        $action =  route('admin-inboxs.reply');
        $sendForm->action($action);
        $sendForm->display('toname' ,'收件人')->default($message->fromname);
        $sendForm->hidden('toname')->default($message->fromname);
        $sendForm->text('title', '标题')->default('Re: '.$message->title);
        //$sendForm->select('select', '快速短语')->options([1 => 'foo', 2 => 'bar', '3' => 'Option name']);
        //$sendForm->checkbox('checkbox', '功能选择')->options([1 => '是否保存内容为短语(10条)', 2=> '是否删除选择中短语', 3 => '使用快捷短语(如有内容会连接组合)'])->default(3);
        //$sendForm->multipleSelect('test','ceshi')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
        $sendForm->editor('content','内容')->attribute(['rows' => 20]);

        $sendForm->hidden('toid')->default($message->fromid);
        $sendForm->hidden('page')->default(request()->input('page',1));


        $collapse = new Collapse();
        $collapse->add('快速回复', $sendForm);

        $content->row($collapse);



      });

    }

    public function imageUpload(Request $request)
    {
      if ($file = $request->file('imageFile')) {
          try {
              $user = Admin::user();
              $ImageUploadHandler = app('App\Libraries\ImageUploadHandler');
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

    public function reply(Request $request)
    {
        $data = $request->only(['toname', 'toid','title','content']);
        $page = $request->input('page',1);
        $data = array_merge($data,['fromid'=>0,'fromname'=>'','postdate'=>time()]);
        $message = Message::create($data);

        if ($message) {
            $message->collectImages();
            $user = User::find($request->toid);
            $user->markAdminemailAsNoRead();
            //User->where('uid', toid)->update(['adminemail' => 1]);
            $msg = $this->success('回复成功');
        }else{
            $msg = $this->error('回复失败');
        }

        $url = route('admin-inboxs.index') . '?page='.$page;


        return redirect($url)->with($msg);
    }
}
