<?php
namespace App\Models\Traits;

trait ArticleFilterable
{
  public function getArticlesWithFilter($filter, $limit = 20)
  {
      $filter = $this->getArticleFilter($filter);

      return $this->applyFilter($filter)->paginate($limit);


  }

  public function getArticleFilter($filter)
  {
      $filters = ['newdata', 'updatedata', 'weekdata','recent', 'wiki', 'jobs', 'excellent-pinned', 'index'];
      if (in_array($filter, $filters)) {
          return $filter;
      }
      return 'default';
  }



  public function applyFilter($filter)
  {


    switch ($filter) {

      case 'newdata':
          return $this->orderBy('postdate', 'desc');
          break;

      case 'updatedata':
          return $this->orderBy('lastupdate', 'desc');
          break;

      case 'weekdata':
          return $this->orderBy('lastupdate', 'desc');
          break;
          

      default:
          return '';
          break;

    }


  }



  //获取一本书
  public function getOneBookData($bookid)
  {

    //return $this->visitOneBook($bookid)->withoutDisplay()->visitBasics();

    return $this->getBasicsBook()->where('articleid', $bookid);

  }


//给书架用的
  public function scopeGetBasicsBookByLastupdate($query ,$od = 'desc')
  {

    return $this->getBasicsBook()->byLastupdate($od);

  }
  public function scopeByLastupdate($query ,$od = 'desc')
  {
      return $query->orderBy('lastupdate', $od);
  }
    //获取列表基础数据
  public function scopeGetBasicsBook($query)
  {
      return $query->where('display', '<=', '0')
                    ->where('lastchapterid', '>', 0);
  }




/*
public function getBasicsBook()
{

  return $this->withoutDisplay()->visitBasics();

}
  public function scopeVisitOneBook($query , $bookid)
  {
      return $query->where('articleid', $bookid);
  }
  public function scopeWithoutDisplay($query)
  {
      return $query->where('display', '<=', '0');
  }

  public function scopeVisitBasics($query)
  {
      return $query->where('lastchapterid', '>', 0);
  }

*/



}







 ?>
