<?php

namespace Modules\Article\Model;

use Illuminate\Database\Eloquent\Model;
use Zzy\Arr\Arr;

class ArticleCategory extends Model
{
    protected $fillable = ['p_id', 'cat_name', 'cat_description', 'list_order'];

    public function getAll($adminCategory = null)
    {
        $data = $this->orderBy('list_order', 'asc')->get()->toArray();
        if (!is_null($adminCategory)) {
            foreach ($data as $k => $v) {
                $data[$k]['_selected'] = $adminCategory['p_id'] == $v['id'];
                $data[$k]['_disabled'] = $adminCategory['id'] == $v['id'] || (new Arr())->isChild($data, $v['id'], $adminCategory['id'], 'id');
            }
        }
        $data = (new Arr())->tree($data, 'cat_name', 'id', 'p_id');
        return $data;
    }

    // 获取所有分类(多维数组)
    public function getAllLevel()
    {
        $data = $this->orderBy('list_order', 'asc')->get()->toArray();
        $data = (new Arr())->treeLevel($data, 'cat_name', 'id', 'p_id');
        return $data;
    }

    public function hasChild()
    {
        $data = $this->get()->toArray();
        return (new Arr())->hasChild($data, $this->id);
    }
}
