<?php

namespace App\Http\Controllers\NovelsController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Article;
class SearchController extends Controller
{
  public function searchInput()
  {
      $query = request('query');
      $query = trim($query);
      $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];
      if(empty($query)){
        $result['message'] = '搜索关键词不能为空';
        return response()->json($result);
      }
      $data = Article::search($query)->paginate(10);
      if($data->count() <= 0)
      {
        $result['message'] = '没有搜索到内容';
        return response()->json($result);

      }

      $result['error'] = 0;
      $result['message'] = '获取成功';
      $result['bakdata'] = $data;
      return response()->json($result);
  }



  public function search()
  {
    if(\Agent::isMobile()){

        return $this->isMobileSearch();
    }

    return $this->isDesktopSearch();
  }

  protected function isDesktopSearch()
  {
      $this->validate(request(),[
          'query' => 'required'
      ]);
      $query = request('query');
      $searchDatas = Article::search($query)->paginate(12);
      return view('webdashubao.search', compact('query', 'searchDatas'));
  }

  protected function isMobileSearch()
  {
    return view('wapdashubao.search');
  }
}
