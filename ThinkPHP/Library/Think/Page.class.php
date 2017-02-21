<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2013 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Think;

class Page{
    public $firstRow; // 起始行数
    public $listRows; // 列表每页显示行数
    public $parameter; // 分页跳转时要带的参数
    public $totalRows; // 总行数
    public $totalPages; // 分页总页面数
    public $rollPage   = 11;// 分页栏每页显示的页数
	public $lastSuffix = true; // 最后一页是否显示总页数

    private $p       = 'p'; //分页参数名
    private $url     = ''; //当前链接URL
    private $nowPage = 1;
    public $limit;//自定义

	// 分页显示定制
    private $config  = array(
        'header' => '<span class="rows">共 %TOTAL_ROW% 条记录</span>',
        'prev'   => '<<',
        'next'   => '>>',
        'first'  => '1...',
        'last'   => '...%TOTAL_PAGE%',
        'theme'  => '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
    );

    /**
     * 架构函数
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     */
    public function __construct($totalRows, $listRows, $parameter = array()) {
        C('VAR_PAGE') && $this->p = C('VAR_PAGE'); //设置分页参数名称
        /* 基础设置 */
        $this->totalRows  = $totalRows; //设置总记录数
        $this->listRows   = $listRows;  //设置每页显示行数
        $this->parameter  = empty($parameter) ? $_GET : $parameter;
        $this->nowPage    = empty($_GET[$this->p]) ? 1 : intval($_GET[$this->p]);
        $this->firstRow   = $this->listRows * ($this->nowPage - 1);
        $this->limit      = $this->setLimit();
//        file_put_contents('E:/flag.txt', $_GET[$this->p].'    '.$this->nowPage);
    }

    /**
     * 定制分页链接设置
     * @param string $name  设置名称
     * @param string $value 设置值
     */
    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }
    //自定义
    public function setLimit(){
        return "Limit ".$this->firstRow.", {$this->listRows}";
    }
    /**
     * 生成链接URL
     * @param  integer $page 页码
     * @return string
     */
    
    private function url($page){
        return str_replace(urlencode('[PAGE]'), $page, $this->url);
    }
    //自定义/Index/index/p/
    public function goPage(){
        return '&nbsp;&nbsp;<input type="text" onkeyup=\'this.value=this.value.replace(/\D/gi,"")\' onkeydown="javascript:if(event.keyCode==13){var page=(this.value>'.$this->totalPages.')?'.$this->totalPages.':this.value;location=\''.$this->rewrite_url('\'+page+\'').'\'}" value="'.$this->nowPage.'" style="width:25px"><input type="button" value="GO" onclick="javascript:var page=(this.previousSibling.value>'.$this->totalPages.')?'.$this->totalPages.':this.previousSibling.value;location=\''.$this->rewrite_url('\'+page+\'').'\'">&nbsp;&nbsp;';
    }
    //自定义
//    private function jump_url(){
//        $url1 = str_replace(urlencode('[PAGE]'), '', $this->url);
//        return str_replace('.html', '', $url1);
//    }
    
    private function rewrite_url($page)
    {
        $str = $this->url($page);
        $str_array = explode('/', $str);
        if($str_array[2] === 'index')
        {
            return $str_array[2].'-'.$str_array[4];
        }
        elseif($str_array[2] === 'search')
        {
            return 'article-'.$str_array[4].'-'.$str_array[6].'-'.$str_array[8];
        }
        elseif($str_array[2] === 'juzi')
        {
            return $str_array[2].'-'.$str_array[4].'-'.$str_array[6];
        }
        else
        {
            //file_put_contents('E:/flag.txt', $str_array[2].'-'.$str_array[4].'-'.$str_array[6].'    ',FILE_APPEND);
            return $str;
        }
    }
    /**
     * 组装分页链接
     * @return string
     */
    public function show() {
        if(0 == $this->totalRows) return '';

        /* 生成URL */
        $this->parameter[$this->p] = '[PAGE]';
        $this->url = U(ACTION_NAME, $this->parameter);
        /* 计算分页信息 */
        $this->totalPages = ceil($this->totalRows / $this->listRows); //总页数
        if(!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
            $this->nowPage = $this->totalPages;
        }

        /* 计算分页零时变量 */
        $now_cool_page      = $this->rollPage/2;
		$now_cool_page_ceil = ceil($now_cool_page);
		$this->lastSuffix && $this->config['last'] = $this->totalPages;

        //上一页
        $up_row  = $this->nowPage - 1;
        $up_page = $up_row > 0 ? '<a class="prev" href="' . $this->rewrite_url($up_row) . '">' . $this->config['prev'] . '</a>' : '';

        //下一页
        $down_row  = $this->nowPage + 1;
        $down_page = ($down_row <= $this->totalPages) ? '<a class="next" href="' . $this->rewrite_url($down_row) . '">' . $this->config['next'] . '</a>' : '';

        //第一页
        $the_first = '';
        if($this->totalPages > $this->rollPage && ($this->nowPage - $now_cool_page) >= 1){
            $the_first = '<a class="first" href="' . $this->rewrite_url(1) . '">' . $this->config['first'] . '</a>';
        }

        //最后一页
        $the_end = '';
        if($this->totalPages > $this->rollPage && ($this->nowPage + $now_cool_page) < $this->totalPages){
            $the_end = '<a class="end" href="' . $this->rewrite_url($this->totalPages) . '">' . $this->config['last'] . '</a>';
        }

        //数字连接
        $link_page = "";
        for($i = 1; $i <= $this->rollPage; $i++){
			if(($this->nowPage - $now_cool_page) <= 0 ){
				$page = $i;
			}elseif(($this->nowPage + $now_cool_page - 1) >= $this->totalPages){
				$page = $this->totalPages - $this->rollPage + $i;
			}else{
				$page = $this->nowPage - $now_cool_page_ceil + $i;
			}
            if($page > 0 && $page != $this->nowPage){

                if($page <= $this->totalPages){
                    $link_page .= '<a class="num" href="' . $this->rewrite_url($page) . '">' . $page . '</a>';
                }else{
                    break;
                }
            }else{
                if($page > 0 && $this->totalPages != 1){
                    $link_page .= '<span class="current">' . $page . '</span>';
                }
            }
        }

        //替换分页内容
        $page_str = str_replace(
            array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%','%LIST_ROW%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%','%JUMP_PAGE%'),
            array($this->config['header'], $this->nowPage, $up_page, $down_page, $the_first, $link_page, $this->listRows, $the_end, $this->totalRows, $this->totalPages, $this->goPage()),
            $this->config['theme']);
        return "<div>{$page_str}</div>";
    }
}
