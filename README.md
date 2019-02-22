# mt_util_func.php
个人日常工作学习中的php常用函数方法积累，欢迎大家补充。php交流Q群：294088839
## 方法说明
### deep_diff_array($arr1, $arr2)
* 功能：二维数组diff
* 说明：找出数组$arr1中存在的value值，$arr2不存在的值value
* 举例：$arr1=['a'=>1,'b'=>2];$arr2=['c'=>2,'d'=>4];
* 输出：['a'=>1];

### create_dir($dir)
* 功能：递归创建文件夹
* 说明：此方法跟命令 mkdir -p $dir效果相同，在上级目录不存在时自动创建上级目录
* 举例：$dir='/var/local/tang/zhi/qin'

### time_diff( $begin_time, $end_time )
* 功能：倒计时
* 说明：$begin_time开始时间，$end_time,结束时间
* 举例：输入$begin_time=time();$end_time="2019-05-01";

### unit_convert($num, $unit='', $point = 2)
* 功能：单位换算
* 说明：$num输入数字，$unit输入的单位(默认为空)，$point保留小数(默认两位)
* 举例：输入:$num=10000;$unit='';$point=3;输出:['value'=>1.000,'unit'=>'万']

### quick_sort($arr)
* 功能：快速排序
* 说明：$arr数字数组，输出结果顺序为ASC
* 举例：输入:[3,2,7,9,1]输出:[1,2,3,7,9]

### get_real_ip()
* 功能：获取真实IP

### get_client_device()
* 功能：获取client设备

### curl_get($url, $post='')
* 功能：curl_get_post请求
* 说明：$url为链接，$post为字符串(例:"a=22&b=44")

### curl_post($url, $param)
* 功能：保持长连接post
* 说明：$url为链接，$param为key-value数组

### get_ini_config($filename)
* 功能：读取配置文件，以数组形式输出

### get_file_list($path, $type='all')
* 功能：获取目录下文件列表
* 说明：$type=all/linux,all所有系统可用

# simple_socket
简单实现TCP服务端和客户端，仅供参考
## 类说明

### class Server{}
* 功能：启动服务端

### class Client{}
* 功能：启动客户端
