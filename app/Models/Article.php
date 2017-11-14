<?php

namespace App\Models;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

//use Carbon\Carbon;
//use Laravel\Scout\Searchable;
use Watson\Rememberable\Rememberable;
use Nicolaslopezj\Searchable\SearchableTrait;
class Article extends Model
{
    use Traits\ArticleFilterable;
    use SoftDeletes ,Rememberable,SearchableTrait;
    protected $guarded = ['articleid'];
    protected $table = 'jieqi_article_article';
    protected $primaryKey = 'articleid';

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'articlename' => 10,
            'author' => 5,
        ],
    ];
    protected $visible = [
        'articleid',
        'articlename',
        'link',
        'imgflag',
        'fullflag',
        'author',
        'intro',
        'sort',
        'slug',
        'lastupdate',
        'updatetime',
        'mulu',
        'newmulu',
        'relationChapters',
        'lastchapterid',
        'lastchapter',
      ];

    protected $appends = ['link','sort','updatetime','mulu','newmulu'];
    /**
     * 数据模型的启动方法
     *
     * @return void
     */

    /*
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('basic', function(Builder $builder) {
            $builder->where('lastchapterid', '>', 0);
        });
    }
    */
    /**
   * 为路由模型获取键名
   *
   * @return string
   */
    public function getRouteKeyName()
    {
        return 'articleid';
    }




//关联
    public function relationChapters()
    {
      //第2个参数是 chapter类的外键   第3个是 本类中articleid
        return $this->hasMany(Chapter::class ,'articleid' ,'articleid')
                    ->where('chaptertype','<=' ,0)
                    ->where('display', '<=', '0')
                    ->orderBy('chapterorder', 'asc')
                    ->limit(config('app.maxchapter'));
    }

    public function relationBookcases($uid)
    {
        return $this->hasOne(Bookcase::class ,'articleid' ,'articleid')
                    ->where('userid',$uid)->first();
    }


    public function getBidBookData($bid)
    {
        $key = 'getBidBookData_'.$bid;
        return
                \Cache::remember($key, config('app.cacheTime_z'), function () use ($bid){
                    $bookData  =   $this->getBasicsBook()->where('articleid', $bid)->first();
                    if($bookData){
                      $bookData->load('relationChapters');
                      return $bookData->toArray();
                    }

                 });

    }

    public static function getBidBookDataByGet($bid)
    {

      try {
        $isuse = Mulu::where('articleid',$bid)
                                      ->where('is_use',1)
                                      ->count();
        if ($isuse <= 0) {
            $key = 'getBidBookData_'.$bid;
            $mulu =   Mulu::where('articleid',$bid)->first();
            if($mulu){
                Mulu::where('articleid',$bid)->update(['is_use'=>1]);
            }else{
                Mulu::create(['articleid' =>$bid,'is_use' => 1]);
            }
            $bookData  = self::getBasicsBook()->where('articleid', $bid)->first();
            if($bookData){
              $bookData->load('relationChapters');
              \Cache::put($key, $bookData->toArray(), config('app.cacheTime_z'));
            }

            Mulu::where('articleid',$bid)->update(['is_use'=>0]);
        }

      } catch (\Exception $e) {
          \Log::error('ajax更新书的缓存失败',['bookid'=>$bid ,'errno' => $e->getMessage()]);
           Mulu::where('articleid',$bid)->update(['is_use'=>0]);
      }
    }

    public function getImgflagAttribute($value)
    {
      return
              $value > 0 ?
                          config('app.xsfmdir')
                          . floor($this->articleid / 1000)
                          . '/' . $this->articleid . '/'
                          . $this->articleid . 's.jpg'
                        :
                          config('app.dfxsfmdir');

    }

    public function getFullflagAttribute($value)
    {
        return $value > 0 ? '完本' : '连载';
    }

    public function getSortAttribute()
    {
        $key = (int)($this->sortid - 1);
        return config('app.fenlei')[$key] ?? '未知分类';
    }
    public function getUpdatetimeAttribute()
    {
      return formatTime($this->attributes['lastupdate']);
    }
    public function getMuluAttribute()
    {
      return route('mnovels.mulu',['bid'=>$this->articleid] );

    }
    public function getNewmuluAttribute()
    {
      return route('mnovels.newmulu',['bid'=>$this->articleid ,'id'=>1] );

    }
    public function getLinkAttribute()
    {
      /*
      if (empty($this->slug)) {
        return route('novel.info', ['bid' => $this->articleid]);
      }
      return route('novel.info', ['bid' => $this->articleid ,'slug' => $this->slug]);
      */
      return route('mnovels.info', ['bid' => $this->articleid]);

    }

    //前台使用
    public function scopeGetBasicsBook($query)
    {
        return $query->where('lastchapterid', '>', 0)
                    ->where('display', '<=', '0');
    }
}
