<?php

class Categories_m extends Trix_Model {

    public $table = 'categories';

    const TOP_LEVEL = 1;

    function orderByLastItem($module)
    {
        $this->db->join("(SELECT cat_id, max( created_on ) AS max
                            FROM ". $this->db->dbprefix($module) ."
                            WHERE is_moderate = 1 AND is_blocked = 0
                            GROUP BY cat_id
                            ORDER BY max DESC ) AS m", "m.cat_id = {$this->table}.id");
        return $this;
    }

    function byParentCategory($category, $include = true)
    {
        if( $include )
        {
            $this->db->where('lft >=', $category->lft);
            $this->db->where('rgt <=', $category->rgt);
        }
        else
        {
            $this->db->where('lft >', $category->lft);
            $this->db->where('rgt <', $category->rgt);
        }

        return $this;
    }

    function get($where)
    {
        foreach($where as $key => $value)
        {
            $this->db->where($key, $value);
        }

        $this->db->order_by('lft', 'ASC');

        return $this->db->get('categories');
    }

    function by_module($module)
    {
        $this->where('module', $module);
        return $this;
    }

    function active()
    {
        $this->db->where('is_active', 1);
        return $this;
    }

    function getByModule($module)
    {
        $this->db->where('modul', $module);
        $this->db->where("is_active", "1");

        return $this->db->get('categories')->result();
    }

    // DEPRICATED
    function get_top_leveled()
    {
        $this->db->where("modul", "catalog");
        $this->db->where("level", "1");
        $this->db->where("is_active", "1");
        $this->db->order_by("order","DESC");

        return $this->db->get('categories');
    }

    function byParent($parentCategory)
    {
        $this->where('level', $parentCategory->level + 1);
        $this->where('lft >', $parentCategory->lft);
        $this->where('rgt >', $parentCategory->rgt);
        return $this;
    }

    // DEPRICATED
    function get_childs($parent_id, $main_page = false)
    {
        $this->db->where("modul", "catalog");
        $this->db->where("id", $parent_id);
        $cat = $this->db->get('categories');
        $parent = $cat->row();

        $this->db->select("id, title, description, icon ");
        $this->db->where("level", $parent->level+1);
        $this->db->where("lft >", $parent->lft);
        $this->db->where("rgt <", $parent->rgt);
        $this->db->where("is_active", "1");
        $this->db->order_by("order","DESC");
        if($main_page) $this->db->where("description !=","hidden");

        return $this->db->get('categories');
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $node = $this->db->get('categories')->row();

        $this->db->where('lft >=', $node->lft);
        $this->db->where('rgt <=', $node->rgt);
        $this->db->delete('categories');

        $subtract = $node->rgt - $node->lft + 1;

        $this->db->where('rgt > ', $node->rgt);
        $this->db->set('rgt', 'rgt - '.$subtract, FALSE);
        $this->db->update('categories');

        $this->db->where('lft > ', $node->rgt);
        $this->db->set('lft', 'lft - '.$subtract, FALSE);
        $this->db->update('categories');
    }

    function insert($data, $parent_id)
    {
        if( $parent_id != 0 )
        {
            $this->where('id', $parent_id);
        }
        else
        {
            $this->where('level', 0);
        }

        $parent = $this->get_one();

        // пересчитываем остальные
        $this->db->where('lft > ', $parent->rgt - 1);
        $this->db->set('lft', 'lft + 2', FALSE);
        $this->db->update('categories');

        $this->db->where('rgt >', $parent->rgt - 1);
        $this->db->set('rgt', 'rgt + 2', FALSE);
        $this->db->update('categories');

        $data['lft']    = $parent->rgt;
        $data['rgt']    = $parent->rgt + 1;
        $data['level']  = $parent->level + 1;

        parent::insert($data);
    }
}