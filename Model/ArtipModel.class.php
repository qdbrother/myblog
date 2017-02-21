<?php

namespace Model;
use Think\Model;


class ArtipModel extends Model{
    
    public function ips($ip,$article_id) {
        $ips = D('Artip');
        $row = $ips->where("ip='".$ip."'")->find();
        if(empty($row))
        {
            $data['ip'] = $ip;
            $data['article_ids'] = $article_id;
            $ips->add($data);
            return true;
        }
        else{
            $res = explode(',', $row['article_ids']);
            if(in_array($article_id, $res))
            {
                return false;
            }
            else
            {
                $row['article_ids'] = $row['article_ids'].','.$article_id;
                $ips->save($row);
                return true;
            }
            
        }
    }
}
