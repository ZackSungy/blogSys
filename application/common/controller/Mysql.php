<?php

namespace app\common\controller;

use think\Db;

class Mysql
{
    //查看数据库
    public function checkData($name, $where = [])
    {
        return Db::table($name)->where($where)->select();
    }

    //添加单条数据
    public function addData($name, $data = [], $where = [])
    {
        // 启动事务
        Db::startTrans();
        if ($where !== [] && $this->checkData($name, $where)) {
            return false;
        }
        try {
            $id = Db::table($name)->insertGetId($data);
            // 提交事务
            Db::commit();

            return $id;
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }
    }

    //添加多条数据
    public function addAllData($name, $data = [[]], $where = [])
    {
        $count = 0;
        for ($i = 0; $i < count($data); ++$i) {
            if ($this->addData($name, $data, $where)) {
                ++$count;
            }
        }

        return $count;
    }

    //删除数据
    public function delData($name, $where = [])
    {
        try {
            if (Db::table($name)->where($where)->delete() === 0) {
                return false;
            }
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }

        return true;
    }

    //修改数据
    public function updataData($name, $where = [], $data = [])
    {
        try {
            if (Db::table($name)->where($where)->update($data) === 0) {
                return false;
            }
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }

        return true;
    }
}
