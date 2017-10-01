<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class WangEditor extends Field
{
    protected $view = 'admin::form.editor';

    protected static $css = [
        '/packages/wangEditor-2.1.23/dist/css/wangEditor.min.css',
    ];

    protected static $js = [
        '/packages/wangEditor-2.1.23/dist/js/wangEditor.min.js',
    ];

    public function render()
    {
        $token = csrf_token();
        $uploadUrl = route('admin-inboxs.imageupload');

        $this->script = <<<EOT
var editor = new wangEditor('{$this->id}');

editor.config.uploadImgUrl = "$uploadUrl";
editor.config.uploadParams = {
  'from':1
};
editor.config.uploadImgFileName = 'imageFile'
editor.config.uploadHeaders = {
    'X-CSRF-TOKEN': "$token",
}
editor.config.menus = $.map(wangEditor.config.menus, function(item, key) {
     if (item === 'location') {
         return null;
     }

    return item;
  });
editor.create();

EOT;
        return parent::render();

    }
}
