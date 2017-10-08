<?php

namespace App\Admin\Controllers;

use App\Models\Sort;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

use Encore\Admin\Tree;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Widgets\Box;
class SortsController extends Controller
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

            $content->header('分类');
            $content->description('列表');

            $content->row(function (Row $row) {
                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('sorts'));

                    $form->select('parent_id', trans('admin::lang.parent_id'))->options(Sort::selectOptions());
                    $form->text('title', trans('admin::lang.title'))->rules('required');
                  //  $form->icon('icon', trans('admin::lang.icon'))->default('fa-bars')->rules('required')->help($this->iconHelp());
                    $form->text('uri', trans('admin::lang.uri'));
                    $form->number('sortid','对应小说sortid')->rules('integer');
                    //$form->multipleSelect('roles', trans('admin::lang.roles'))->options(Role::all()->pluck('name', 'id'));
                    $form->radio('is_hide','隐藏')->options(['yes' => '是', 'no'=> '否'])->default('no');
                    $column->append((new Box(trans('admin::lang.new'), $form))->style('success'));
                });
            });
        });
    }
    /**
     * Redirect to edit page.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        return redirect()->action(
            '\App\Admin\Controllers\SortsController@edit', ['id' => $id]
        );
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
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {

        $this->delCache();
        return Sort::form(function (Form $form) {
            $form->display('id', 'ID');

            $form->select('parent_id', trans('admin::lang.parent_id'))->options(Sort::selectOptions());
            $form->text('title', trans('admin::lang.title'))->rules('required');
          //  $form->icon('icon', trans('admin::lang.icon'))->default('fa-bars')->rules('required')->help($this->iconHelp());
            $form->text('uri', trans('admin::lang.uri'));
          //  $form->multipleSelect('roles', trans('admin::lang.roles'))->options(Role::all()->pluck('name', 'id'));

            $form->number('sortid','对应小说sortid')->rules('integer');
            $form->radio('is_hide','隐藏')->options(['yes' => '是', 'no'=> '否']);
            $form->display('created_at', trans('admin::lang.created_at'));
            $form->display('updated_at', trans('admin::lang.updated_at'));

        });
    }


    /**
     * @return \Encore\Admin\Tree
     */
    protected function treeView()
    {
        return Sort::tree(function (Tree $tree) {
            $tree->disableCreate();

            $tree->branch(function ($branch) {
                $payload = "&nbsp;<strong>{$branch['title']}</strong>";

                if (!isset($branch['children'])) {
                    //$uri = admin_url($branch['uri']);
                    $uri = $branch['uri'];
                    $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$uri\" class=\"dd-nodrag\" target=\"_blank\">$uri</a>";
                }

                return $payload;
            });
        });
    }


    protected function delCache()
    {
      //删除缓存
      \Cache::forget(SORTS);

    }
}
