<?php

/**
 * 工具包
 * Create by <米唐>jetamiett@163.com
 * FileName:mt_util_func.php
 * Date:2019/2/18
 */
class Mt_Util
{
	 /**
	  * 功能：二维数组diff
	  * 说明：找出数组$arr1中存在的value值，
	  *	  	  $arr2不存在的值value
	  * 举例：$arr1=['a'=>1,'b'=>2];$arr2=['c'=>2,'d'=>4];
	  * 输出：['a'=>1];
      */
	public static function deep_diff_array($arr1, $arr2)
    {
        try {
         return array_filter($arr1, function ($v) use ($arr2) {
                return !in_array($v, $arr2);
             });
        } catch (Exception $exception) {
            return $arr1;
        }
    }
	/**
     * 功能：二维数组多字段排序
	 * 说明：可以根据字段不同维度给数组排序
     * 举例：dataSortByMoreField($arr,'k1',SORT_DESC,'k2','SORT_ASC')
     */
    public static function dataSortByMoreField()
    {
        $param = func_get_args();
        if (empty($param)) {
            return false;
        }
        $data = array_shift($param);
        if (!is_array($data)) {
            return false;
        }
        foreach ($param as $key=>$field) {
            if (is_string($field)) {
                $tmp = [];
                foreach ($data as $idx=>$row) {
                    $tmp[$idx] = $row[$field];
                }
                $param[$key] = $tmp;
            }
        }
        $param[] = &$data;
        @call_user_func_array('array_multisort', $param);
        return array_pop($param);
    }
	/**
	 * 功能：递归创建文件夹
	 * 说明：此方法跟命令 mkdir -p $dir效果相同，
	 *		 在上级目录不存在时自动创建上级目录
	 * 举例：$dir='/var/local/tang/zhi/qin'
	 */
	public static function create_dir($dir)
	{
		$dirname = dirname($dir);
		//判断上一个文件夹是否存在
		if (!file_exists($dirname)) {
			self::create_dir($dirname);
		}
		mkdir($dir, 0777);
	}
	/**
	 * 功能：倒计时
	 * 说明：$begin_time开始时间，$end_time,结束时间
	 * 举例：输入$begin_time=time();$end_time="2019-05-01";
	 */
	public static function time_diff( $begin_time, $end_time )
	{
	  if ( $begin_time < $end_time ) {
		$starttime = $begin_time;
		$endtime = $end_time;
	  } else {
		$starttime = $end_time;
		$endtime = $begin_time;
	  }
	  $timediff = $endtime - $starttime;
	  $days = intval( $timediff / 86400 );
	  $remain = $timediff % 86400;
	  $hours = intval( $remain / 3600 );
	  $remain = $remain % 3600;
	  $mins = intval( $remain / 60 );
	  $secs = $remain % 60;
	  $res = array( "day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs );
	  return $res;
	}
	/**
	 * 功能：单位换算
	 * 说明：$num输入数字，$unit输入的单位(默认为空)，
	 *	 	 $point保留小数(默认两位)
	 * 举例：输入:$num=10000;$unit='';$point=3;
	 *		 输出:['value'=>1.000,'unit'=>'万']
	 */
	public static function unit_convert($num, $unit='', $point = 2)
	{
		if (!$num) {
			return false;
		}
		$neg = $num < 0?true:false;
		if ($neg) {
			$num = $num*pow(-1, 1);
		}
		if (empty($unit) || $unit == '万' || $unit == '亿' || $unit == '万亿') {
			$tmp = explode('.', $num);
			while(strlen(array_shift($tmp))>4) {
				$num = $num/10000;
				$tmp = explode('.', $num);
				if (empty($unit)) {
					$unit = '万';
				} elseif ($unit == '万') {
					$unit = '亿';
				} elseif ($unit == '亿') {
					$unit = '万亿';
				} elseif ($unit == '万亿') {
					$unit = '万兆';
				} else {
					$num = $num*10000;
					break;
				}
			}
			$num = sprintf('%01.'.$point.'f', $num);
		} else {
			$num = sprintf('%01.'.$point.'f', $num);
		}
		return array(
			'value'=> $neg?$num*pow(-1, 1):$num,
			'unit' => $unit
			);
	}
	/**
	 * 功能：快速排序
	 * 说明：$arr数字数组，输出结果顺序为ASC
	 * 举例：输入:[3,2,7,9,1]
	 *		 输出:[1,2,3,7,9]
	 */
	public static function quick_sort($arr)
	{
		if(!is_array($arr)) {
			return false;
		}
		
		$len = count($arr);
		if ( $len<= 1) {
			return $arr;
		}
		//选取分界点值
		$middle = $arr[0];
		//接受左右值
		$left=$right = array();
		// 循环比较
		for ($i=1; $i < $len; $i++) { 
			if ($middle < $arr[$i]) {
				// 大于分界点值
				$right[] = $arr[$i];
			} else {
				// 小于分界点值
				$left[] = $arr[$i];
			}
		}
		// 递归排序划分好的2边
		$left = self::quick_sort($left);
		$right = self::quick_sort($right);

		// 合并排序后的数据
		return array_merge($left, [$middle], $right);
	}
	/**
	 *获取真实IP
	 */
	public static function get_real_ip()
	{
		static $realip;
		if(isset($_SERVER)){
			if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
				$realip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}else if(isset($_SERVER['HTTP_CLIENT_IP'])){
				$realip=$_SERVER['HTTP_CLIENT_IP'];
			}else{
				$realip=$_SERVER['REMOTE_ADDR'];
			}
		}else{
			if(getenv('HTTP_X_FORWARDED_FOR')){
				$realip=getenv('HTTP_X_FORWARDED_FOR');
			}else if(getenv('HTTP_CLIENT_IP')){
				$realip=getenv('HTTP_CLIENT_IP');
			}else{
				$realip=getenv('REMOTE_ADDR');
			}
		}
		return $realip;
	}
	/**
	 *获取设备
	 */
	public static function get_client_device()
	{
		//获取USER AGENT
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		 
		//分析数据
		$is_pc = (strpos($agent, 'windows nt')) ? true : false;  
		$is_iphone = (strpos($agent, 'iphone')) ? true : false;  
		$is_ipad = (strpos($agent, 'ipad')) ? true : false;  
		$is_android = (strpos($agent, 'android')) ? true : false;  
		 
		//输出数据
		if($is_pc){  
			return 'pc';  
		}  
		if($is_iphone){  
			return 'iPhone';
		}  
		if($is_ipad){  
			return "iPad";  
		}  
		if($is_android){  
			return "Android";  
		}  
		return "No Agent";
	}
	/**
	 * 功能：curl_get_post请求
	 * 说明：$url为链接，$post为字符串(例:"a=22&b=44")
	 */
	public static function curl_get($url, $post='')
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		/*curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
		curl_setopt($ch, CURLOPT_REFERER, _REFERER_);*/
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		if ($post) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($post));
		}
		$r = curl_exec($ch);
		curl_close($ch);
		return $r;
	}
	/**
	 * 功能：保持长连接post
	 * 说明：$url为链接，$param为key-value数组
	 */
	public static function curl_post($url, $param)
	{
		$post = array();
		if ($param) {
			foreach($param as $k=>$v) {
				if ($v != '') {
					$post[] = urlencode($k).'='.urlencode($v);
				}
			}
		}
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
		$header = array(
			'Connection:Keep-Alive'
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, implode('&', $post));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $result = unserialize(curl_exec($ch));
        curl_close($ch);
        return $result;
	}
	/**
	 * 功能：读取配置文件，以数组形式输出
	 */
	public static function get_ini_config($filename)
	{
		if (!file_exists($filename)) {
			return false;
		}
		$result = parse_ini_file($filename, $true);
		return $result;
	}
    /**
     * 功能：获取目录下文件列表
	 * 说明：$type=all/linux,all所有系统可用
     */
    public static function get_file_list($path, $type='all')
    {
		if (!is_dir($path)) {
			return false;
		}
        $dir = array();
		if ($type == 'all') {
			if ($handle = opendir($path)) {
				while ($file = readdir($handle)) {
					if ($file != '.' && $file != '..') {
						$dir[] = $file;
					}
				}
			}
		}
		if ($type == 'linux') {
			ob_start();
			system("ls -m " . $path);
			$dir = explode(",", preg_replace("/\s*(.*?)\s*,/", "$1,", ob_get_contents() . ','));
			array_pop($dir);
			ob_end_clean();
		}
        return $dir;
    }
	/**
	 * 功能：多进程回调执行函数
	 * 说明：$p是进程数，$func 传入的回调函数；
	 */
	public static function mutil_process($p = 4, $func = function(){})
	{
		if (gettype($func) !== "object") {
			die("it's not a function!");
		}
		//默认创建4个进程
		for ($i=0;$i<$p;$i++) {
			$pid = pcntl_fork();
			if ($pid == -1) {
				die("could not fork");
			} elseif ($pid) {
				pcntl_waitpid($pid, $status);
			} else {
				//需要执行的任务
				call_user_func($func);
				exit(0);
			}
		}
		unset($pid);
		$pid = NULL;
		unset($p);
		$p = NULL;
	}
	/**
	 * 功能：十六进制颜色转RGB
	 * 举例：$c = "#FF00D4"
	 */
	public static function hex2color($c){
		$len = strlen($c);
		if(!in_array($len,[4,7])) {
			return false;
		}
		$color = str_replace('#', '', $c);
		if ($len == 4) {
			$r = hexdec(substr($color,0,1).substr($color,0,1));
			$g = hexdec(substr($color,1,1).substr($color,1,1));
			$b = hexdec(substr($color,2,1).substr($color,2,1));
			return "R:".$r." G:".$g." B:".$b;
		}
		$r = hexdec(substr($color,0,2));
		$g = hexdec(substr($color,2,2));
		$b = hexdec(substr($color,4,2));
		return "R:".$r." G:".$g." B:".$b;
	}
	/**
	 * 功能：格式化文件单位
	 */
	public static function get_file_unit($file){
		if (!file_exists($file)) {
			return false;
		}
		$f_b = filesize($file);
		//$f_b = '106020400';
		$tmp = explode('.', $f_b);
		$unit = 'b';
		while(strlen(array_shift($tmp))>3) {
			$f_b = $f_b/1024;
			$tmp = explode('.', $f_b);
			if ($unit=='b') {
				$unit = 'kb';
			} elseif ($unit == 'kb') {
				$unit = 'm';
			} elseif ($unit == 'm') {
				$unit = 'gb';
			} else {
				$f_b = $f_b*1024;
				break;
			}
		}
		return $f_b.$unit;
	}
}
