<?php

namespace Modules\Article\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded  = ['id'];

    /**
     * 获取文章扩展属性.
     *
     * @param  string  $value
     * @return string
     */
    public function getMoreAttribute($value)
    {
        return json_decode($value,true);;
    }

    /**
     * 设置文章扩展属性.
     *
     * @param  string  $value
     * @return void
     */
    public function setMoreAttribute($value)
    {
        $this->attributes['more'] = json_encode($value);
    }

    /**
     * 该文章所属分类
     */
    public function articleCategory()
    {
        return $this->belongsTo('Modules\Article\Model\ArticleCategory','cat_id');
    }
    
    /**
     * 扩展属性数据结构处理
     *
     * @param [type] $request
     * @return array $data
     * @author zzy
     */
    public function moreHandle($request){
        $data = $request->all();

        if($data['files_url']){
            foreach ($data['files_url'] as $k => $v) {
                $more['files'][$k]['files_url'] = $v;
                $more['files'][$k]['files_name'] = $data['files_name'][$k];
            }
            unset($data['files_url']);
            unset($data['files_name']);
            $data['more'] = $more;
        }

        return $data;
    }

    public function getList($request){
        $length = $request->length>0?$request->length:10;
        $data = $this->orderBy('id', 'desc')->with('articleCategory:id,cat_name')->paginate($length)->toArray();
        $arr['draw'] = $request->draw;
        $arr['recordsTotal'] = $data['total'];
        $arr['recordsFiltered'] = $arr['recordsTotal'];
        $arr['data'] = $data['data'];

        return $arr;
    }
}
