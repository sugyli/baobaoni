<?php
namespace App\Admin\Extensions\Tools;

use Encore\Admin\Widgets\Form;

class Form1 extends Form
{

  public $isNeedFoot = true;

  protected function getVariables()
  {
      foreach ($this->fields as $field) {
          $field->fill($this->data);
      }

      return [
          'fields'        => $this->fields,
          'attributes'    => $this->formatAttribute(),
          'isNeedFoot'   => $this->isNeedFoot,
      ];
  }
  /**
   * Render the form.
   *
   * @return string
   */
  public function render()
  {
      return view('admin::widgets.form1', $this->getVariables())->render();
  }

  /**
   * Output as string.
   *
   * @return string
   */
  public function __toString()
  {
      return $this->render();
  }



}




 ?>
