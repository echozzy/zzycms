<?php

namespace Modules\Article\Model;

use Illuminate\Database\Eloquent\Model;
use Zzy\Arr\Arr;

class ArticleCategory extends Model
{
    protected $fillable = ['p_id', 'cat_name', 'cat_description', 'list_order'];

    /**
     * 获取所有文章分类
     *
     * @param array $article_category
     * @param boolean $is_create
     * @return array
     * @author zzy
     */
    public function getAll($article_category = null,$is_create = false)
    {
        $data = $this->orderBy('list_order', 'asc')->get()->toArray();
        if($is_create&&!is_null($article_category)){
            foreach ($data as $k => $v) {
                $data[$k]['_selected'] = $article_category['id'] == $v['id'];
            }
        }else{
            if (!is_null($article_category)) {
                foreach ($data as $k => $v) {
                    $data[$k]['_selected'] = $article_category['p_id'] == $v['id'];
                    $data[$k]['_disabled'] = $article_category['id'] == $v['id'] || (new Arr())->isChild($data, $v['id'], $article_category['id'], 'id');
                }
            }
        }
        $data = (new Arr())->tree($data, 'cat_name', 'id', 'p_id');
        return $data;
    }

    /**
     * 获取所有分类(多维数组)
     *
     * @return array
     * @author zzy
     */
    public function getAllLevel()
    {
        $data = $this->orderBy('list_order', 'asc')->get()->toArray();
        $data = (new Arr())->treeLevel($data, 'cat_name', 'id', 'p_id');
        return $data;
    }

    /**
     * 是否有子分类
     *
     * @return boolean
     * @author zzy
     */
    public function hasChild()
    {
        $data = $this->get()->toArray();
        return (new Arr())->hasChild($data, $this->id);
    }
}
